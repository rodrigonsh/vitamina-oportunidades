<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Oportunidade;
use App\Models\Produto;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function doLogin(LoginRequest $r)
    {
        $input = $r->validated();

        if (Auth::attempt($input)) {

            $user = Auth::user();

            if ( $user->root )
            {
                $user->oportunidades = Oportunidade::get();
                $user->clientes = Cliente::get();
                $user->produtos = Produto::get();
                $user->usuarios = User::get();
            } else {
                $user->oportunidades = Oportunidade::where('user_id', $user->id)->get();
                $user->clientes = Cliente::where('user_id', $user->id)->get();
                $user->produtos = Produto::where('user_id', $user->id)->get();
                $user->usuarios = [];
            }

            return $user;
        }
 
        return "SHIT";

    }

}
