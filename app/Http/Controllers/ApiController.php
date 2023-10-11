<?php

namespace App\Http\Controllers;

use App\Models\ApiModel;
use App\Models\TokenModel;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Consulta($data)
    {
        $evento = ApiModel::where('placa', $data)
            ->get();
        if (!$evento) {
            return response()->json(['message' => 'Placa não encontrada'], 404);
        }


        return response()->json(['message' => 'Placa Encontrada', 'Data' => $evento], 200);
    }




    public function get_d_dados($placa)
    {
        $dados = array();
        $token = TokenModel::orderBy('id', 'desc')->first();
        $bearer = $token->token;

        $cpf = ApiModel::where('placa', $placa)
        ->first();
        // URLs das consultas
        $urls = [
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdadosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemmultasveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdebitosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obteminfracoesveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemultimoprocessoveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemhistoricoimpedimentosveiculo',
        ];

        foreach ($urls as $url) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"placa":"' . $placa . '","renavam":"0"}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $bearer,
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'sec-ch-ua-platform: "Windows"',
                    'Sec-Fetch-Site: same-site',
                    'Sec-Fetch-Mode: cors',
                    'Sec-Fetch-Dest: empty'
                ),
            ));

            $response = curl_exec($curl);
            $decodedResponse = json_decode($response,true);

            if($url == 'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdadosveiculo'){
                $decodedResponse['data']['cpf'] = $cpf->cpf;
            }

            if ($decodedResponse !== null) {
                $dados[] = $decodedResponse;
            } else {
                // Lida com erros na decodificação JSON, se necessário.
            }


            curl_close($curl);
        }

        return $dados;
    }
}
