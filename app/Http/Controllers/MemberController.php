<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use App\Models\freetestModel;

use Carbon\Carbon;

use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function ativarvip(Request $request)
    {
        $chave = $request->input('chave');
        $id = $request->input('id');
        $dataHoraAtual = Carbon::now();
        $dataHoraFormatada = $dataHoraAtual->toDateTimeString();

        try {
            // Tenta encontrar o registro com base na chave
            $verify = MemberModel::where('chave', $chave)->firstOrFail();
            $usr = freetestModel::where('email', $id)->first();

            if ($verify->email_ativo) {
                // Se o email já está ativo, retorne um código de status apropriado
                return 201;
            } else {
                // Atualize o registro existente
                $verify->email_ativo = $id;
                $verify->data_ativo = $dataHoraFormatada;
                $verify->save();
                $usr->pro = 1;
                $usr->chave = $chave;
                $usr->save();

                // Retorne um código de status de sucesso
                return 200;
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Registro não encontrado, retorne um código de status apropriado
            return 404;
        }
    }

    public function buscarusr(Request $request)
    {
        $id = $request->input('id');
        $usr = freetestModel::where('email', $id)->first();

        return $usr;
    }


    public function login(Request $request)
    {

        $id = $request->input('email');
        $usr = freetestModel::where('email', $id)->first();
        $senha = $request->input('senha');

        if ($usr) {

            if ($usr->senha == $senha) {

                session([
                    'nome' => $usr->nome,
                    'email' => $usr->email,
                ]);
                return redirect()->back();
            }
            return password_verify($senha, $usr->senha);

            if (password_verify($senha, $usr->senha)) {
                // A senha é válida, o usuário está autenticado
                // Você pode adicionar o usuário à sessão ou realizar outras ações de autenticação aqui
                return 'senha ok';
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->back();
    }
}
