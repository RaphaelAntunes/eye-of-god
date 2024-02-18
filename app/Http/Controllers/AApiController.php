<?php

namespace App\Http\Controllers;

use App\Models\ApiModel;
use App\Models\TokenModel;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Consulta($data)
    {
        $evento = ApiModel::where('placa', 'like', '%' . $data . '%')->first();
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
        $cpf = ApiModel::where('placa', 'like', '%' . $placa . '%')->orderBy('cpf', 'desc')->first();
    
        // URLs das consultas
        $urls = [
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdadosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemmultasveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdebitosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obteminfracoesveiculo',
        ];
    
        function get_profile_dados($cpf)
        {
           //$captoken = exec('python C:\Users\Phael\Documents\GitHub\eye-of-god\app\Http\Controllers\CapToken.py');
            $captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');

            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://gateway.detran.rn.gov.br/portal/meudetran/auth/consultausuario/' . $cpf,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'sec-ch-ua-platform: "Windows"',
                    'Sec-Fetch-Site: same-site',
                    'TokenCaptcha: ' . $captoken,
                    'Sec-Fetch-Mode: cors',
                    'Sec-Fetch-Dest: empty',
                ),
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
    
            return $response;
        }
    
        $curl_handles = array();
        $mh = curl_multi_init();
    
        foreach ($urls as $url) {
            
            $captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');
            //$captoken = exec('python C:\Users\Phael\Documents\GitHub\eye-of-god\app\Http\Controllers\CapToken.py');

            $ch = curl_init();
    
            curl_setopt_array($ch, array(
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
                    'TokenCaptcha: ' . $captoken,
                    'Sec-Fetch-Mode: cors',
                    'Sec-Fetch-Dest: empty',
                ),
            ));
    
            curl_multi_add_handle($mh, $ch);
            $curl_handles[] = $ch;
        }
    
        $active = null;
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    
        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) == -1) {
                continue;
            }
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    
        $pegaperfil = 0;
        $count = 0;
        foreach ($curl_handles as $ch) {
            $response = curl_multi_getcontent($ch);
            $decodedResponse = json_decode($response, true);
    
            if ($cpf) {
                $decodedResponse['data']['cpf'] = $cpf->cpf;
    
                if ($pegaperfil == 0 && $cpf->cpf) {
                    $cpfSemPontos = preg_replace('/\D/', '', $cpf->cpf);
                    $resultadoPF = json_decode(get_profile_dados($cpfSemPontos), true);
                    $pegaperfil = 1;
                    $dados[] = $resultadoPF;
                }else {
                    if ($count == 2) {
                        // Verifica se a chave 'data' existe e se é um array
                        if (isset($decodedResponse['data']) && is_array($decodedResponse['data'])) {
                            // Pega o primeiro elemento do array 'data'
                            $firstData = reset($decodedResponse['data']);
    
                            // Verifica se a chave 'idDebito' existe dentro do primeiro elemento
                            if (isset($firstData['idDebito'])) {
                                // Obtém e imprime o idDebito
                                $idDebito = $firstData['idDebito'];
                                $classe = $firstData['classe'];
    
                                $urlCPF = 'https://pix.detran.rn.gov.br/?idDebito=' . $idDebito . '&Tipo=V&Classe=' . $classe . '';
                                $html = file_get_contents($urlCPF);
    
                                // Verifica se o conteúdo foi obtido com sucesso
                                if ($html !== false) {
                                    // Usa expressão regular para encontrar o CPF
                                    if (preg_match('/<p><b>CPF:<\/b>\s*(\d{11})<\/p>/', $html, $matches)) {
                                        $decodedResponse['data']['cpf'] = $cpf->$matches[1];
                                        $cpfSemPontos = preg_replace('/\D/', '', $matches[1]);
                                        $resultadoPF = json_decode(get_profile_dados($cpfSemPontos), true);
                                        $pegaperfil = 1;
                                        $dados[] = $resultadoPF;    
                                    } else {
                                        $decodedResponse['data']['cpf'] = null;
                                    }
                                }
                            }
                        }
                    } else {
                        $count = $count + 1;
                    }
                }

            }  
    
            if ($decodedResponse !== null) {
                $dados[] = $decodedResponse;
            } else {
                // Lida com erros na decodificação JSON, se necessário.
            }
    
            curl_multi_remove_handle($mh, $ch);
            curl_close($ch);
        }
    
        curl_multi_close($mh);
    
        return $dados;
    }
    



    public function api_token()
    {
        
         $captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');
          // $captoken = exec('python C:\Users\Phael\Documents\GitHub\eye-of-god\app\Http\Controllers\CapToken.py');

        $data = array(
            "username" => "00056623461",
            "password" => "dada12"
        );

        $data_string = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://gateway.detran.rn.gov.br/portal/meudetran/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'TokenCaptcha: ' . $captoken
            ),
        ));

        $response = curl_exec($curl);
        $data = json_decode($response, true);

        $cad = new TokenModel([
            'token' => $data['data']
        ]);
        $cad->save();

        if ($cad) {
            return 200;
        }
    }
}
