<?php

namespace App\Http\Controllers\Leaner;

use App\Constants\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\UserManagement\CustomUser;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserManagement\Dao\UserDaoImpl;

class LeanerController extends Controller
{
    protected $userDaoImpl;
    public function __construct(UserDaoImpl $userDaoImpl)
    {
        $this->userDaoImpl = $userDaoImpl;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index(Request $request)
    {
        $d['leaners'] = $this->userDaoImpl->getApprovedlearners();
        $d['activeStatus']  = Constants::STATUS_ACTIVE;
        return view('pages.user_management.leaner.index', $d);
    }


    public function create()
    {
        $d['leaner'] = null;
        return view('pages.user_management.leaner.create', $d);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), CustomUser::$learner_rules);
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
                    $data['password'] = bcrypt($data['password']);
                    $data['userType'] = Constants::LEARNER;
                    $user = $this->userDaoImpl->createUser($data);
                    // 

                    $response = 'Data Saved  Successfully';
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

}
