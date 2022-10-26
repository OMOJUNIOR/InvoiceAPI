<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GenerateApiKeyController extends Controller
{
    public function generateKey(){
        $credentials = [
            'email'=>'admin@admin.com',
            'password'=>'password',
        ];
        if(!Auth::attempt($credentials)){
            $createUser = new \App\Models\User();
            $createUser->name = 'Admin';
            $createUser->email = $credentials['email'];
            $createUser->password = bcrypt($credentials['password']);
    
            $createUser->save();
        }
    
            if(Auth::attempt($credentials)){
                $user = Auth::user();
                $adminToken = $user->createToken('admin-token',['create','update','delete']);
                $updateToken = $user->createToken('update-token',['create','update']);
                $basicToken = $user->createToken('based-token',['none']);
    
                return [
                    'admin'=>$adminToken->plainTextToken,
                    'update'=>$updateToken->plainTextToken,
                    'basic'=>$basicToken->plainTextToken,
                ];
            }

    }
}
