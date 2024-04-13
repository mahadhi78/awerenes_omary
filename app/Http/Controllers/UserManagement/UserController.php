<?php

namespace App\Http\Controllers\UserManagement;


use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Constants\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\UserManagement\CustomUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\UserManagement\Dao\RoleDaoImpl;
use App\Http\Controllers\UserManagement\Dao\UserDaoImpl;

class UserController extends Controller
{
    use ResetsPasswords;
    protected $userDaoImpl, $roleDaoImpl, $school;
    public function __construct(UserDaoImpl $userDaoImpl, RoleDaoImpl $roleDaoImpl)
    {
        $this->userDaoImpl = $userDaoImpl;
        $this->roleDaoImpl = $roleDaoImpl;
        $this->middleware('auth', ['except' => ['login', 'resetPassword', 'resetPasswordEmail']]);
        $this->middleware('prevent-back-history', ['except' => ['login', 'resetPassword', 'resetPasswordEmail']]);
    }

    public function index(Request $request)
    {
        $d['users'] = $this->userDaoImpl->getApprovedUsers();
        $d['activeStatus'] = Constants::STATUS_ACTIVE;
        return view('pages.user_management.users.index', $d);
    }


    public function create()
    {
        $d['roles'] = $this->roleDaoImpl->getRoleNotLikeAdmin();
        $d['user'] = null;
        return view('pages.user_management.users.create', $d);
    }
    public function edit($id)
    {
        $d['roles'] = $this->roleDaoImpl->getRoleNotLikeAdmin();
        $user = $this->userDaoImpl->findUserById($id);
        if ($user) {
            $d['user'] = $user;
        } else {
            $d['mesage'] = 'The is no user for Selected Details';
        }
        return view('pages.user_management.users.create', $d);
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), CustomUser::$rules);
            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }
            $email = $data['email'];
            $emalExists = CustomUser::where('email', $email)->first();
            if ($emalExists) {
                $response = 'Email Exists';
                return response()->json([
                    'success' => 'failure',
                    'response' => $response,
                ]);
            } else {

                try {
                    $password = $this->generateRandomPassword(6);
                    $data['userType'] = Constants::STAFF;
                    $data['password'] = bcrypt($password);
                    $user = $this->userDaoImpl->createUser($data);

                   
                            $response = 'Data Saved && Email Sent Successfully';
                            Log::channel('daily')->info($response . ' ' . $user);
                            return ['success' => true, 'response' => $response];
                       
                } catch (\Exception $error) {
                    $response = 'Operation Failed,Please Contact System Administrator ' . $error;
                    Log::channel('daily')->error($response . ' ' . $error->getMessage());

                    return response()->json([
                        'error' => false,
                        'response' => $response,
                    ]);
                }
            }
        }
    }


    public function activation(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->input('id');
            $user = CustomUser::find($id);
            $activation = null;

            if ($user->status == Constants::STATUS_ACTIVE) {
                $data['status'] = Constants::STATUS_INACTIVE;
                $data['activation_status'] = Constants::STATUS_INACTIVE;
                $activation = "Deactivated";
            } else {
                $data['status'] = Constants::STATUS_ACTIVE;
                $data['activation_status'] = Constants::STATUS_ACTIVE;
                $activation = "Activated";
            }

            if ($user->update($data)) {
                $response = 'User: ' . $user->firstname . " " . $user->lastname . " " . $activation . ' Successfully';
                return ['success' => true, 'response' => $response];
            }
        }
    }


    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), CustomUser::$update_rules);
            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            try {

                $user = $this->userDaoImpl->updateUserById($data['id'], $data);
                if ($user) {
                    $roleAssigned =  $user->syncRoles([$data['roles']]);
                    if ($roleAssigned) {
                        $response = 'User $ Role Updated Successfully';
                        Log::channel('daily')->info($response . ' ' . $roleAssigned);
                        return ['success' => true, 'response' => $response];
                    }
                }
            } catch (\Exception $error) {
                $response = 'Operation Failed,Please Contact System Administrator ' . $error;
                Log::channel('daily')->error($response . ' ' . $error->getMessage());

                return response()->json([
                    'error' => false,
                    'response' => $response,
                ]);
            }
        }
    }


    public function updatePhoto(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            $user = User::find($data['id']);

            if ($request->hasFile('photo_url')) {

                $extensions = array("jpe", "jpeg", "png", "gif", "jpg");

                $getFileExtension = $request->file('photo_url')->extension();
                if (!in_array($getFileExtension, $extensions)) {
                    return ['success' => 'failure', 'response' => 'Please Upload Valid Photo'];
                }

                if ($request->file('photo_url')->isValid()) {
                    $file = $request->file('photo_url');
                    $name = time() . '_' . $user->firstname . '_' . $user->lastname . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/uploads/profile/', $name);

                    $pathName = '/uploads/profile/';
                    $data['photo_path'] = $pathName . $name;
                }
            }

            try {
                $user->update($data);
                if ($user) {
                    $response = 'Photo Uploaded Successfully: ';
                    Log::channel('daily')->info($response . ' ' . $user);

                    return ['success' => true, 'response' => $response];
                }
            } catch (\Exception $error) {
                $response = 'Operation Failed,Please Contact System Administrator ' . $error;
                Log::channel('daily')->error($response . ' ' . $error->getMessage());

                return ['success' => "failure", 'response' => $response];
            }
        }
    }

    public function login()
    {

        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        Session()->invalidate();
        Session()->regenerateToken();
        return redirect('/login');
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation|min:8|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        ]);

        $data = $request->all();
        $email = $data['email'];
        $token = $data['token'];
        $password = bcrypt($data['password']);


        $password_resets = DB::table('password_resets')
            ->where('email', '=', $email)
            ->where('token', '=', $token)
            ->orderBy('created_at', 'DESC')
            ->first();

        //check if Email Exists
        if ($password_resets != null) {
            $user = User::where('email', '=', $email)
                ->where('email_token', '=', $token)
                ->where('activation_status', '=', Constants::STATUS_ACTIVE);

            if ($user != null) {
                $data['password'] = $password;

                if ($user->update(
                    [
                        'email' => $email,
                        'password' => $password,
                        'status' => Constants::STATUS_ACTIVE,
                        'email_token' => $token,
                    ]
                )) {
                    DB::table('password_resets')
                        ->where('email', $email)
                        ->where('token', $token)
                        ->delete();

                    return redirect('login')
                        ->with('message', 'Account Activated successfully,You may Login')
                        ->with('status', 'success');
                } else {
                    return back()
                        ->with('message', 'Activation Failed, Contact Administrator')
                        ->with('status', 'warning');
                }
            } else {
                return back()
                    ->with('message', 'Account has Locked,Contact Administrator')
                    ->with('status', 'warning');
            }
        } else {
            return back()
                ->with('message', 'Account has Expired,Contact Administrator')
                ->with('status', 'warning');
        }
    }

    function generateRandomPassword($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }
        return $password;
    }

    public function resetPasswordEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);


        $data = $request->all();
        $email = $data['email'];

        $user = User::where('email', '=', $email)->first();

        if ($user != null) {
            if ($user->activation_status == Constants::STATUS_ACTIVE) {
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
                $user->update(['email_token' => $token]);

                Mail::send('emails.email_notifications', ['token' => $token, 'email' => $email], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Reset Password');
                });


                return back()
                    ->with('message', 'Password Reset Link has been Successfully sent to your Email.')
                    ->with('status', 'success');
            } else {
                return back()
                    ->with('message', 'Account has Locked,Contact Administrator')
                    ->with('status', 'warning');
            }
        } else {
            return back()
                ->with('message', 'The Data you have Entered Are Incorrect')
                ->with('status', 'danger');
        }
    }
}
