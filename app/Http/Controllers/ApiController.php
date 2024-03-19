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



    public function get_free_dados($placa)
    {
        $dados = array();
        $token = TokenModel::orderBy('id', 'desc')->first();
        $bearer = $token->token;
        $cpfatual = null;

        //Busca no banco pela placa e tras todo OBJ > to cpf $cpf->cpf
        $cpf = ApiModel::where('placa', 'like', '%' . $placa . '%')->orderBy('cpf', 'desc')->first();

        if ($cpf && $cpf->cpf) {
            $urlCPF = 'https://www2.detran.rn.gov.br/SharedASP/grdMulta.asp?NossoNumero=' . $cpf->documento;
            $html = file_get_contents($urlCPF);
            // Usa expressão regular para encontrar o CPF/CNPJ
            if (preg_match('/CPF\/CNPJ<BR><SPAN CLASS="cellef">([\d\.\-\/]+)<\/SPAN>/', $html, $matches)) {
                $cpfatual = preg_replace('/[^0-9]/', '', $matches[1]);
            } else {
                $cpfatual = null;
            }
        }





        // URLs das consultas
        $urls = [
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdadosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemmultasveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdebitosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obteminfracoesveiculo',
        ];

        function get_profile_dados($cpf)
        {
            $captoken = exec('python C:\Users\f\Desktop\a\eye-of-god\app\Http\Controllers\CapToken.py');
            // $captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');
            
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
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
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            return $response;
        }

        $curl_handles = array();
        $mh = curl_multi_init();

        foreach ($urls as $url) {

            //$captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');
            $captoken = exec('python C:\Users\f\Desktop\a\eye-of-god\app\Http\Controllers\CapToken.py');

            $ch = curl_init();

            curl_setopt_array(
                $ch,
                array(
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
                )
            );

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



            if ($count == 2) {

                if ($cpfatual && $pegaperfil == 0) {
                    $cpfSemPontos = preg_replace('/\D/', '', $cpfatual);
                    $resultadoPF = json_decode(get_profile_dados($cpfSemPontos), true);
                    if (isset($resultadoPF['data']) && in_array("Usuário não localizado", $resultadoPF['data'])) {
                        $resultadoArray = array(
                            'success' => true,
                            'data' => array(
                                
                                'documento' =>$cpfatual,
                           
                            )
                        );
                        $dados[] = $resultadoArray;

                    } else {
                        $dados[] = $resultadoPF;
                    }
                    $pegaperfil = 1;

                } else {

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
                                    $decodedResponse[0]['cpf'] = $matches[1];
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
                }
                // Verifica se a chave 'data' existe e se é um array
                $count = $count + 1;

            } else {
                $count = $count + 1;
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

        $dadossensurados = $dados;

        // Função para censurar dados sensíveis
        function censurarDadosSensíveis($data)
        {
            $censoredData = $data;
    
            // Adicione aqui as chaves que você deseja censurar e a quantidade de letras a serem censuradas
            $sensitiveKeys = array('valorNominal' => 8,'valorAtualizado' => 8,'complemento' => 8,'descricaoAuto'=> 8,'localInfracao'=> 8,'horaAutuacao'=> 8,'descricaoStatus'=> 20,'descricaoInfracao'=> 8,'cidadeInfracao'=> 8,'dataAutuacao'=> 4,'dataAquisicao'=> 4,'proprietarioAnterior' => 6,'municipioEmplacamento' => 6,'proprietarioAnteriorLocadora' => 6, 'nomeProprietario' => 6, 'renavam' => 4, 'documento' => 4, 'email' => 8, 'telefone' => 5, 'cpf' => 4);
    
            foreach ($censoredData as &$item) {
                if (is_array($item)) {
                    $item = censurarDadosSensíveis($item);
                }
            }
    
            foreach ($sensitiveKeys as $key => $numLettersToCensor) {
                if (isset($censoredData[$key])) {
                    $censoredData[$key] = censurarPalavra($censoredData[$key], $numLettersToCensor);
                }
            }
    
            return $censoredData;
        }
    
        // Função para censurar uma palavra com base no número de letras a serem censuradas
        function censurarPalavra($word, $numLettersToCensor)
        {
            $wordLength = strlen($word);
            $censoredPart = str_repeat('*', $numLettersToCensor);
    
            if ($numLettersToCensor < $wordLength) {
                $uncensoredPart = substr($word, -$wordLength, $numLettersToCensor);
                return $uncensoredPart . $censoredPart;
            } else {
                return $censoredPart; // Censura completa se $numLettersToCensor for maior ou igual ao comprimento da palavra
            }
        }
    

        // Aplica a função aos dados sensíveis
        $dadossensurados = censurarDadosSensíveis($dadossensurados);

        // Retorna os dados sensurados
        return $dadossensurados;
    }
    public function get_d_dados($placa)
    {
        $dados = array();
        $token = TokenModel::orderBy('id', 'desc')->first();
        $bearer = $token->token;
        $cpfatual = null;

        //Busca no banco pela placa e tras todo OBJ > to cpf $cpf->cpf
        $cpf = ApiModel::where('placa', 'like', '%' . $placa . '%')->orderBy('cpf', 'desc')->first();

        if ($cpf && $cpf->cpf) {
            $urlCPF = 'https://www2.detran.rn.gov.br/SharedASP/grdMulta.asp?NossoNumero=' . $cpf->documento;
            $html = file_get_contents($urlCPF);
            // Usa expressão regular para encontrar o CPF/CNPJ
            if (preg_match('/CPF\/CNPJ<BR><SPAN CLASS="cellef">([\d\.\-\/]+)<\/SPAN>/', $html, $matches)) {
                $cpfatual = preg_replace('/[^0-9]/', '', $matches[1]);
            } else {
                $cpfatual = null;
            }
        }





        // URLs das consultas
        $urls = [
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdadosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemmultasveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obtemdebitosveiculo',
            'https://gateway.detran.rn.gov.br/portal/meudetran/auth/obteminfracoesveiculo',
        ];

        function get_profile_dados($cpf)
        {
            $captoken = exec('python C:\Users\f\Desktop\a\eye-of-god\app\Http\Controllers\CapToken.py');
            // $captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');

            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
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
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            return $response;
        }

        $curl_handles = array();
        $mh = curl_multi_init();

        foreach ($urls as $url) {

            //$captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');
            $captoken = exec('python C:\Users\f\Desktop\a\eye-of-god\app\Http\Controllers\CapToken.py');

            $ch = curl_init();

            curl_setopt_array(
                $ch,
                array(
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
                )
            );

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



            if ($count == 2) {

                if ($cpfatual && $pegaperfil == 0) {
                    $cpfSemPontos = preg_replace('/\D/', '', $cpfatual);
                    $resultadoPF = json_decode(get_profile_dados($cpfSemPontos), true);
                    if (isset($resultadoPF['data']) && in_array("Usuário não localizado", $resultadoPF['data'])) {
                        $resultadoArray = array(
                            'success' => true,
                            'data' => array(
                                
                                'documento' =>$cpfatual,
                           
                            )
                        );
                        $dados[] = $resultadoArray;

                    } else {
                        $dados[] = $resultadoPF;
                    }
                    $pegaperfil = 1;

                } else {

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
                                    $decodedResponse[0]['cpf'] = $matches[1];
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
                }
                // Verifica se a chave 'data' existe e se é um array
                $count = $count + 1;

            } else {
                $count = $count + 1;
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

        // $captoken = exec('python3 /var/www/eye-of-god/app/Http/Controllers/CapToken.py');
        $captoken = exec('python C:\Users\f\Desktop\a\eye-of-god\app\Http\Controllers\CapToken.py');

        $data = array(
            "username" => "00056623461",
            "password" => "dada12"
        );

        $data_string = json_encode($data);

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
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
            )
        );

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
