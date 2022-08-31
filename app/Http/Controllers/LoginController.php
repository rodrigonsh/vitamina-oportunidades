<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function doLogin(LoginRequest $r)
    {
        $input = $r->validated();

        if (Auth::attempt($input)) {
            return Auth::user();
        }
 
        return "SHIT";

    }

}
