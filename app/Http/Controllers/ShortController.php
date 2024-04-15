<?php

namespace App\Http\Controllers;

use App\Models\ShortModel;
use Illuminate\Http\Request;


class ShortController extends Controller
{
    public function index(Request $request, $data)
    {   

        function generateRandomString() {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $length = 5;
            $randomString = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            return $randomString;
        }

        
        $sl = generateRandomString();
        
        $cad = new ShortModel([
            'link' => $data,
            'shortlink' =>$sl,
            'open' =>0
        ]);
        $cad->save();

        return response()->json(['message' => 'Shortlink Criado', 'Data' => $sl], 200);
    }

    public function pay($data){
        // Procurando o link correspondente no banco de dados
        $consulta = ShortModel::where('shortlink', 'like', '%' . $data . '%')->first();
    
        // Verificando se o link foi encontrado
        if ($consulta) {
            // Construindo o link completo para o redirecionamento
            $link = 'https://www2.detran.rn.gov.br/SharedASP/grdEscolhaVeiculo.asp?' . $consulta->link;
            
            // Redirecionando para o link encontrado
            return redirect()->away($link);
        } else {
            // Caso o link não seja encontrado, retornar uma mensagem de erro
            return response()->json(['message' => 'Shortlink não encontrado'], 404);
        }
    }
    



    
}
