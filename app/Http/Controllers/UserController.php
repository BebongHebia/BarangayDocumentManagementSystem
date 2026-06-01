<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){
         $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }else{
            return back()->withErrors([
                'error' => 'Sorry we cannot find your account please try again.',
            ]);
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function addUser(Request $request){


        if ($request->password === $request->confirm_password){
            User::create([
                'completeName' => $request->completeName,
                'purok' => $request->purok,
                'sex' => $request->sex,
                'bday' => $request->bday,
                'civilStatus' => $request->civilStatus,
                'placeOfBirth' => $request->placeOfBirth,
                'citizenship' => $request->citizenship,
                'currentAddress' => $request->currentAddress,
                'profession' => $request->profession,
                'phone' => $request->phone,
                'role' => $request->role,
                'status' => "Active",
                'userCode' => date("Ymdhis"),
                'profilePic' => "N/A",
                'username' => $request->username,
                'password' => $request->password,
            ]);

            return response()->json();
        }else{
            return back()->withErrors([
                'error' => 'Password does not match please try again',
            ]);
        }
    }

    public function register(Request $request){

        // Create the user
        $user = User::create([
            'listCode' => $request->listCode,
            'completeName' => $request->completeName,
            'purok' => "N/A",
            'sex' => "N/A",
            'bday' => "N/A",
            'civilStatus' => "N/A",
            'placeOfBirth' => "N/A",
            'citizenship' => "N/A",
            'currentAddress' => "N/A",
            'profession' => "N/A",
            'phone' => $request->phone,
            'role' => "User",
            'status' => "Active",
            'userCode' => date("Ymdhis"),
            'profilePic' => "N/A",
            'username' => $request->username,
            'password' => bcrypt($request->password), // Always hash passwords!
        ]);

        // Log the user in
        Auth::login($user);
        return redirect('/dashboard');

    }

    public function editUser(Request $request){
        $data = User::find($request->userId);
        $data->completeName = $request->completeName;
        $data->sex = $request->sex;
        $data->purok = $request->purok;
        $data->bday = $request->bday;
        $data->civilStatus = $request->civilStatus;
        $data->placeOfBirth = $request->placeOfBirth;
        $data->citizenship = $request->citizenship;
        $data->currentAddress = $request->currentAddress;
        $data->profession = $request->profession;
        $data->phone = $request->phone;
        $data->role = $request->role;
        $data->userCode = $request->userCode;
        $data->status = $request->status;
        $data->save();
        return response()->json();
    }

        public function deleteUser(Request $request){
        $data = User::find($request->userId);
        $data->delete();
        return response()->json();
    }

    public function editProfile(Request $request){
        $data = User::find($request->userId);
        $data->completeName = $request->completeName;
        $data->sex = $request->sex;
        $data->bday = $request->bday;
        $data->civilStatus = $request->civilStatus;
        $data->placeOfBirth = $request->placeOfBirth;
        $data->citizenship = $request->citizenship;
        $data->phone = $request->phone;
        $data->profession = $request->profession;
        $data->purok = $request->purok;
        $data->currentAddress = $request->currentAddress;
        $data->save();
        return response()->json();
    }
}