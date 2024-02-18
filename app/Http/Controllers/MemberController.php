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

        if ($id === 'null') {
            return 202;
        }

        try {
            // Tenta encontrar o registro com base na chave
            $verify = MemberModel::where('chave', $chave)->first();
            $usr = freetestModel::where('email', $id)->first();

            if ($verify) {
                if ($usr && is_null($usr->senha)) {
                    return 203;
                }

                if ($verify && !is_null($verify->email_ativo)) {
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

                    session([
                        'nome' => $usr->nome,
                        'email' => $usr->email,
                        'pro' => $usr->pro,
                    ]);

                    return 200;
                }
            } else {

                return 303;
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

        if ($usr) {
            session([
                'nome' => $usr->nome,
                'email' => $usr->email,
                'pro' => $usr->pro,
            ]);

            return $usr;
        } else {

            return 300;
        }
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
                    'pro' => $usr->pro,
                ]);
                return redirect()->back();
            } else if ($usr->senha == null) {
                $usr->senha = $senha;
                $usr->save();
                session([
                    'nome' => $usr->nome,
                    'email' => $usr->email,
                    'pro' => $usr->pro,
                ]);
                return redirect()->back();
            } else {
                return redirect()->back()->withErrors(['message' => 'Usuário ou senha incorretos']);
            }
        } else {
            return redirect()->back()->withErrors(['message' => 'Usuário ou senha incorretos']);
        }
    }
    public function cadastro(Request $request)
    {

        $id = $request->input('email');
        $usr = freetestModel::where('email', $id)->first();

        if ($usr) {
            return redirect()->back()->withErrors(['message' => 'O E-mail já foi cadastrado. Entre para continuar !']);
        } else {

            $cad = new freetestModel([
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'telefone' => $request->input('whatsapp'),
                'senha' => $request->input('senha'),
                'pro' => 0,
                'ip' => $request->ip(),

            ]);

            $cad->save();

            if ($cad) {
                session([
                    'nome' => $cad->nome,
                    'email' => $cad->email,
                    'ip' => $cad->ip,
                    'pro' => 0,
                ]);
            }


            return redirect()->back()->withErrors(['message' => 'Contra criada com sucesso']);
        }
    }
    public function cadastrosenha(Request $request)
    {

        $id = $request->input('email');
        $usr = freetestModel::where('email', $id)->first();

        if ($usr->senha) {
            return redirect()->back()->with(['message' => 'Ocorreu um erro']);
        } else {

            $usr->senha = $request->input('senha');
            $usr->save();
            return redirect()->back()->with(['message' => 'Sua senha foi cadastrada com sucesso !']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->back();
    }
}
