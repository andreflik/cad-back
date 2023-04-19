<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;


class PessoasController extends Controller
{
    public function index(){
        $pessoa = Pessoa::paginate();

        return response()->json(['pessoas' => $pessoa], 200);
    }


   public function create(Request $request){
    $pessoa = new Pessoa;

    $pessoa->nome = $request->input('nome');
    $pessoa->email = $request->input('email');
    $pessoa->telefone = $request->input('telefone');
    $pessoa->data_nascimento = $request->input('data_nascimento');
    $pessoa->sexo = $request->input('sexo');
    $pessoa->cidade = $request->input('cidade');
    $pessoa->uf = $request->input('uf');

    $pessoa->save();

    return response()->json(['message' => 'Cadastro criado com sucesso']);
   }


   public function edit(Request $request, $id){
    $pessoa = Pessoa::find($id);

    if(!$pessoa){
        return response()->json(['message' => 'Cadastro não encontrado!'], 404);
    }

    $pessoa->nome = $request->input('nome');
    $pessoa->email = $request->input('email');
    $pessoa->telefone = $request->input('telefone');
    $pessoa->data_nascimento = $request->input('data_nascimento');
    $pessoa->sexo = $request->input('sexo');
    $pessoa->cidade = $request->input('cidade');
    $pessoa->uf = $request->input('uf');

    $pessoa->save();

    return response()->json(['message' => 'Cadastro atualizado com sucesso!'], 200);

   }

   public function destroy($id){

    $pessoa = Pessoa::find($id);

    if(!$pessoa){
        return response()->json(['message' => 'Cadastro não encontrado!'], 404);
    }

    $pessoa ->delete();

    return response()->json(['message' => 'Cadastro deletado com sucesso!'], 200);
   }
}
