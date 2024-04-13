<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\User;

use Illuminate\Support\Str;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();


        $getRoleName = $user->roles->pluck('name', 'name')->first();
        if ($getRoleName == null) {
            $getRoleName = Constants::GUEST;
        }

        return view('pages.user_management.profile.index', compact('getRoleName'));
    }

    public function changePassword()
    {
        return view('pages.user_management.profile.password.index');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {

        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), [
                'email' => 'required|email',
                'title' => 'required |min:2|max:30',
                'firstname' => 'required |min:3|max:30',
                'lastname' => 'required|min:3|max:30',
                'phone_number' => 'required',
            ]);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->error()];
            }

            $user = auth()->user();
            if ($user->category == Constants::GUEST) {
                $token = Str::random(60);
                $data['remember_token'] = Str::random(60);
                $data['email_token'] = $token;
                $generatedPassword = $this->generateRandomPassword(6);
                $data['password'] = bcrypt($generatedPassword);
                $data['api_token'] = $token;
            }
            $user->update($data);
            if ($user) {
                
                return ['success' => true, 'response' => "User Basic Information Updated Successfully."];
            } else {
                return ['success' => false, 'response' => "Operation Failed, please Contact System Administrator"];
            }
        }
    }


    public function updateAdmin(Request $request)
    {

        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), [
                'email' => 'required|email',
                'firstname' => 'required |min:3|max:30',
                'lastname' => 'required|min:3|max:30',
                'phone_number' => 'required',
            ]);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->messages()];
            }

            if ((substr($data['phone_number'], 0, 1) != "0" && (substr($data['phone_number'], 0, 3)) != "255")) {
                $response = "Please enter valid Phone Number example 0700000000 or 255700000000";
                return ['success' => "failure", 'response' => $response];
            }

            if ((substr($data['phone_number'], 0, 1)) == "0") {
                if ((strlen($data['phone_number']) != 10 || $data['phone_number'] < 0 || $data['phone_number'] == 0)) {
                    $response = "Please enter valid Phone Number example 0700000000 or 255700000000";
                    return ['success' => "failure", 'response' => $response];
                }
            }
            if ((substr($data['phone_number'], 0, 3)) == "255") {
                if ((strlen($data['phone_number']) != 12 || $data['phone_number'] < 0 || $data['phone_number'] == 0)) {
                    $response = "Please enter valid Phone Number example 0700000000 or 255700000000";
                    return ['success' => "failure", 'response' => $response];
                }
            }


            $formattedFirstName = ucwords(strtolower($data['firstname']));
            $formattedLastName = ucwords(strtolower($data['lastname']));

            $formattedMiddleName = ucwords(strtolower($data['middlename']));

            $data['firstname'] = $formattedFirstName;
            $data['lastname'] = $formattedLastName;
            $data['middlename'] = $formattedMiddleName;

            $user = auth()->user();
            $user->update($data);
            if ($user) {
                return ['success' => true, 'response' => "User Information Updated Successfully."];
            } else {
                return ['success' => false, 'response' => "Operation Failed, please Contact System Administrator"];
            }
        }
    }


    public function updatePassword(Request $request)
    {

        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), [
                'password' => 'required|same:password_confirmation|min:8|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            ]);

            if (Hash::check($data['old_password'], Auth::user()->password) != 1) {
                return ['success' => false, 'response' => "Your current password does not matches with the password you provided. Please try again"];
            }


            if (Hash::check($data['old_password'], bcrypt($data['password'])) == 1) {
                return ['success' => false, 'response' => "New Password cannot be same as your current password. Please choose a different password"];
            }

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->messages()];
            }

            $user = Auth::user();
            $user->password = bcrypt($data['password']);
            $user->save();

            if ($user) {

                Auth::logout();
                Session::flush();
                Session()->invalidate();
                Session()->regenerateToken();

                return ['success' => "login", 'response' => "Password Changed successfully,You may Login"];
            } else {
                return ['success' => false, 'response' => "Operation Failed, please Contact System Administrator"];
            }
        }
    }
}
