<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Redirect;
use Auth;
use DataTables;
use DB;
/*use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;*/
use App\Models\UserManagement\Permission;
use App\Constants\Constants;

class PermissionController extends Controller
{

    public function __construct()
    {
       $this->middleware(['auth','prevent-back-history']);
    }

    public function index(Request $request) {
        if(Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)){
        if ($request->ajax()) {
            $data = Permission::select('name','action','module','description')->orderBy("id","desc");
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('options', function ($data) {
                    $str='';
                    $str.='<a  href="#" class="text-secondary editPermission" data-toggle="modal"  data-target="#PermissionForm" data-name='.$data->name.' data-id='.$data->id.' data-action='.$data->action.' data-module='.$data->module.' data-description='.$data->description.' onclick="'."return GetPermissionDataToEdit('$data->name','$data->action','$data->module','$data->description','$data->id')".' " data-attr="#"><i class="fas fa-edit text-blue-300" style="color:#009ef7"></i></a>&nbsp;&nbsp;';
                    return $str;
                })
                ->rawColumns(['options'])
                ->make(true);
        }
        return view('pages.user_management.permissions.index');
    }
    }

    public function store(Request $request)
    {
        if(Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)){
        if($request->ajax()){
            //return $request -> all();

            //validation for name and action
            //name has -
            //action has \xx\xx
            $validator = Validator::make($data = $request -> all(), Permission::$rules);
            if ($validator -> fails()) {
                return ['success' => false, 'response' => $validator->messages()];
            }
            $formattedName = strtolower($data['name']);

            $permission_exists = Permission::where("name","=",$formattedName)->first();
            if($permission_exists != null){
                $response = 'Permission: ' . $data['name'] . ', Already Exists';
                return ['success' => "failure", 'response' => $response];
            }
            $data['name'] = $formattedName;
            $data['guard_name'] = "web";
            try {
                $permission = Permission::create($data);
                if ($permission) {
                    $response = 'Permission: ' . $data['name'] . ', Created Successfully';
                    \Log::channel('daily')->info($response . ' ' . $permission);

                    return ['success' => true, 'response' => $response];
                }
            }
            catch (\Exception $error){
                    $response = 'Permission: ' . $data['name'] . ',Failed to be created';
                    \Log::channel('daily')->error($response . ' ' . $error->getMessage());
                    return ['success' => true, 'response' => $response];

            }

        }
      }
    }

    public function update(Request $request) {
        if(Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)){
        if($request->ajax()){
            $rules =  [
            'name' => 'required',
            'action' => 'required',
            'module' => 'required',
            'description' => 'required'
           ];

            $validator = Validator::make($data = $request -> all(), Permission::$rules);
            if ($validator -> fails()) {
                return ['success' => false, 'response' => $validator->messages()];
            }

            $formattedName = strtolower($data['name']);
            $data['name'] = $formattedName;

            $permission = Permission::find($data['id']);
            try {
                $permission -> update($data);
                if ($permission) {
                    $response = 'Permission: ' . $data['name'] . ', Updated Successfully';
                    \Log::channel('daily')->info($response . ' ' . $permission);
                    return ['success' => true, 'response' => $response];
                }
            }catch (\Exception $error){
                    $response = 'Permission: ' . $data['name'] . ', Updated Successfully';
                    \Log::channel('daily')->error($response . ' ' . $error->getMessage());
                    return ['success' => true, 'response' => $response];
            }
        }
        }
    }


}
