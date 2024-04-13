<?php

namespace App\Http\Controllers\approval;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserManagement\Dao\UserDaoImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserApprovalController extends Controller
{
    protected $userDaoImpl;
    public function __construct(UserDaoImpl $userDaoImpl)
    {
        $this->userDaoImpl = $userDaoImpl;
        $this->middleware(['auth', 'prevent-back-history']);
    }
    public function index()
    {
        $d['users'] = $this->userDaoImpl->getUnApprovedUsers();
        return view('pages.approval.users.index', $d);
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $user = $this->userDaoImpl->findUserById($data['id']);
            $password = $this->generateRandomPassword(6);

            try {
                $user->update([
                    'status' => Constants::STATUS_ACTIVE,
                    'activation_status' => Constants::STATUS_ACTIVE,
                    'is_approved'=>Constants::APPROVED,
                    'password' => bcrypt($password)
                ]);

                $email = $user->email;
                $name = $user->firstname.' '.$user->middlename.' '.$user->lastname;
                if ($user) {
                    Mail::send('emails.staff_approval', ['email' => $email, 'name' => $name,'password'=>$password], function ($message) use ($user) {
                        $message->to($user->email);
                        $message->subject('Staff Registration Approval');
                    });
                    $response = 'Data Approved Successfully';
                    return ['success' => true, 'response' => $response];
                }
            } catch (\Exception $error) {
                $response = 'Operation Failed,Please Contact System Administrator ' . $error;
                return ['success' => 'failure', 'response' => $response];
            }
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
}
