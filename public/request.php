<?php
$documento = $_POST['documento'];

$url = 'https://www2.detran.rn.gov.br/SharedASP/grdMulta.asp?NossoNumero='.$documento;
$conteudo = @file_get_contents($url);

if ($conteudo !== false) {

    

    $var2 = explode('<DIV class="msginstr"><PRE>--------------------------------------------------------------------------------<BR>Placa:       Marca /', $conteudo);
  
    ///
    $varb = explode("Local", $var2[1]);
    $posicao_fim = strpos($varb[1], 'no dia');
    $local = $varb[1] = substr($varb[1], 0, $posicao_fim);
    ///
    $varb = explode("no dia", $var2[1]);
    $posicao_fim = strpos($varb[1], '<BR>');
    $datahora = $varb[1] = substr($varb[1], 0, $posicao_fim);
    ///
    $varb = explode("min<BR>    ", $var2[1]);
    $posicao_fim = strpos($varb[1], '<BR>');
    $rua = $varb[1] = substr($varb[1], 0, $posicao_fim);
    $rua = preg_replace('/\d+/', '', $rua);
    ///
    $varb = explode("Infr  :", $var2[1]);
    $posicao_fim = strpos($varb[1], '<BR>');
    $motivo = $varb[1] = substr($varb[1], 0, $posicao_fim);
    ///
    $varb = explode("Compl :", $var2[1]);
    $posicao_fim = strpos($varb[1], '<BR>');
    $complemento = $varb[1] = substr($varb[1], 0, $posicao_fim);
    ///
    
    
    echo $local . '%' . $datahora . '%' . $rua . '%' . $motivo . '%' . $complemento;
}