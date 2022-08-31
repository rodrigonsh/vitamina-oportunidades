<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NovaOportunidadeRequest;
use App\Http\Requests\UpdateOportunidadeStatusRequest;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Oportunidade;
use Illuminate\Support\Facades\Auth;

class OportunidadeController extends Controller
{
    
    public function new(NovaOportunidadeRequest $r)
    {
        $input = $r->validated();

        $user = Auth::user();

        // verificar se o usuario tem o produto e cliente
        Cliente::where('user_id', $user->id)->findOrFail($input['cliente_id']);
        Produto::where('user_id', $user->id)->findOrFail($input['produto_id']);

        $op = new Oportunidade();
        $op->user_id = $user->id;
        $op->cliente_id = $input['cliente_id'];
        $op->produto_id = $input['produto_id'];
        $op->save();

        return $op;

    }

    public function updateStatus(UpdateOportunidadeStatusRequest $r, $id)
    {
        $input = $r->validated();
        $user = Auth::user();

        $op = Oportunidade::findOrFail($id);
        if ( $op->user_id != $user->id ) return "SHIT";

        if ( $input['status'] != "vencida" && $input['status'] != "perdida" )
        {
            return "SHIT";
        }

        $op->status = $input['status'];
        return $op->save();

    }

}
