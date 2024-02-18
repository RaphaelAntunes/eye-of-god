<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

use App\Models\freetestModel;
use App\Models\logModel;

use Illuminate\Http\Request;

class FreeTestController extends Controller
{
  public function index(Request $request)
  {

    $usr = freetestModel::where('email', $request->input('email'))->first();

    if (!$usr) {

      $cad = new freetestModel([
        'nome' => $request->input('nome'),
        'email' => $request->input('email'),
        'telefone' => $request->input('telefone'),

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
        Cookie::queue(Cookie::make('laravel_session', Session::getId(), 60 * 24 * 365 * 10));
        return redirect()->back()->with('message', 'Cadastrado com Sucesso');
      }

      return redirect()->back()->with('message', 'Erro ao cadastrar');
    } else {

      return redirect()->back()->with('message', 'Esse e-mail já está atribuido a uma conta');
    }
  }



  public function autorizador(Request $request)
  {

    $id = $request->input('id');
    $placa = $request->input('placa');

    $usr = freetestModel::where('email', $id)->first();

    $log = new logModel([
      'conta' => $id,
      'placa' => $placa,
      'ip' => $request->ip(),

    ]);

    $log->save();
    
    if ($usr->pro == 1) {
      return 200;
    } else if ($usr->qtdconsultas && $usr->qtdconsultas > 2) {

      return 201;
    } else {

      $usr->qtdconsultas = $usr->qtdconsultas + 1;
      $usr->save();
      return 200;
    }
  }
}
