<?php

namespace App\Http\Controllers\UserManagement;


use App\Constants\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use App\Models\UserManagement\CustomRole;
use App\Http\Controllers\UserManagement\Dao\RoleDaoImpl;

class RoleController extends Controller
{
    protected $roles;
    public function __construct(RoleDaoImpl $roles)
    {
        $this->roles = $roles;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index(Request $request)
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');

        }
        $d['roles'] = $this->roles->getAllRoles();
        return view('pages.user_management.roles.index', $d);
    }


    public function create()
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');

        }
        $user = Auth::user();

        if ($user->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
            $permissions = Permission::select('id', 'description', 'group')
                ->whereNotIn('group', ['0', 'Administration Exclusive', 'Common'])
                ->orderBy('group', 'asc')->get();
        } else {
            // Get user roles
            $roles = $user->getRoleNames();

            // Get permissions associated with user roles
            $permissions = Permission::join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
                ->whereIn('roles.name', $roles)
                ->select('permissions.id', 'permissions.description', 'permissions.group')
                ->orderBy('permissions.group', 'asc')
                ->distinct()
                ->get();
        }

        $d['permissionList'] = $this->formatPermissions($permissions);
        $d['role'] = null;

        return view('pages.user_management.roles.create', $d);
    }

    private function formatPermissions($permissions, $rolePermissions = null)
    {
        $permissionList = [];
        foreach ($permissions as $permission) {
            $namePart = preg_split("/\s+(?=\S*+$)/", $permission->description, 2);
            if (count($namePart) === 2) {
                $moduleName = $namePart[0];
                $verb = $namePart[1];
            } else {
                $moduleName = $namePart[0];
                $verb = '';
            }
            $permissionList[$permission->group][$moduleName][$verb]['ids'][] = $permission->id;
            if ($rolePermissions) {
                $permissionList[$permission->group][$moduleName][$verb]['checked'] = in_array($permission->id, $rolePermissions) ? 1 : 0;
            } else {
                $permissionList[$permission->group][$moduleName][$verb]['checked'] = 0;
            }
        }
        return $permissionList;
    }

    private function proccessInputPermissions($permissionList, $type, $roleOrUserId)
    {

        $rolePermissions = [];
        if (!empty($permissionList) && count($permissionList)) {

            foreach ($permissionList as $permissions) {
                $permissions = explode(',', $permissions);
                foreach ($permissions as $permission) {
                    $rolePermissions[] = [
                        $type => $roleOrUserId,
                        'permission_id' => $permission,
                    ];
                }
            }
        }
        $permissions = Permission::select('id')->where('group', 'Dashboard')->get();
        foreach ($permissions as $permission) {
            $rolePermissions[] = [
                $type => $roleOrUserId,
                'permission_id' => $permission->id,
            ];
        }
        return $rolePermissions;
    }


    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, CustomRole::$rules);

            try {
                $role = Role::create([
                    'name' => $request->get('name'),
                    'created_by' => Auth()->user()->id,
                    'status' => $request->get('status')
                ]);

                $permissionList = $request->get('permissions');

                if (count($permissionList)) {
                    $rolePermissions = $this->proccessInputPermissions($permissionList, 'role_id', $role->id);
                    DB::table('role_has_permissions')->insert($rolePermissions);
                }

                Cache::flush();
                // CacheClear::clearCache();
                $response = 'Role: ' . $role->name . ', Created Successfully';
                return redirect()->route('roles.index')->with('success', $response);
            } catch (\Exception $e) {
                return redirect()->route('roles.index')->with('error', $e->getMessage());
            }
        }
    }


    public function edit($id)
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');

        }
        $user = Auth::user();
        $role = Role::findOrFail($id);
        $rolePermissions = DB::table('role_has_permissions')->where('role_id', $role->id)->pluck('permission_id')->toArray();

        if ($user->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
            $permissions = Permission::select('id', 'description', 'group')
                ->whereNotIn('group', ['0', 'Administration Exclusive', 'Common'])
                ->orderBy('group', 'asc')->get();
        } else {
            // Get user roles
            $roles = $user->getRoleNames();
            
            // Get permissions associated with user roles
            $permissions = Permission::join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
                ->whereIn('roles.name', $roles)
                ->select('permissions.id', 'permissions.description', 'permissions.group')
                ->orderBy('permissions.group', 'asc')
                ->distinct()
                ->get();
        }

        $d['permissionList'] = $this->formatPermissions($permissions,$rolePermissions);
        $d['role'] = $role ?? null;

        return view('pages.user_management.roles.create', $d);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        if ($request->isMethod('post')) {

            try {
                if ($request->has('permissions')) {
                    $permissions = $request->input('permissions');

                    $role->syncPermissions($permissions);
                    // dd($role);
                }
                $response = 'Permissions updated succesfully';

                return redirect()->route('roles.index')->with('success', $response);
            } catch (\Exception $e) {
                return redirect()->route('roles.index')->with('error', $e->getMessage());
            }
        }
    }
    public function destroy(Request $request)
    {

        $class =  Role::findOrFail($request['id'])->delete();
        try {
            if ($class) {
                $response = 'Data Deleted Successfully';
                Log::channel('daily')->info($response . ' ' . $class);
                return ['success' => true, 'response' => $response];
            }
        } catch (\Exception $error) {
            $response = 'Operation Failed,Please Contact System Administrator ' . $error;
            Log::channel('daily')->error($response . ' ' . $error->getMessage());
            return ['success' => 'failure', 'response' => $response];
        }
    }
}
