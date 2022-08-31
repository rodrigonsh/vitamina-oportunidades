<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NovoItemRequest;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    
    public function new(NovoItemRequest $r)
    {
        $input = $r->validated();

        $user = Auth::user();

        if ( $user == null ) return "SHIT";

        $item = new Produto();
        $item->user_id = $user->id;
        $item->nome = $input['nome'];
        $item->save();

        return $item;

    }

}
