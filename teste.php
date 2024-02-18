<?php

use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Page;

require 'vendor/autoload.php'; // Certifique-se de que o caminho para o autoload.php está correto.

// Inicialize o navegador
$tempDir = '/var/www/html/temp/';
$browserFactory = new BrowserFactory('/opt/google/chrome/chrome', null, $tempDir);
$browser = $browserFactory->createBrowser([
    'headless' => true, // Garante que seja executado como headless
]);

// Crie uma nova página
$page = $browser->createPage();
$page->navigate('https://portal.detran.rn.gov.br/#/login')->waitForNavigation();

// Localize elementos na página

$botaoLogin = $page->evaluate('document.querySelector(\'button[label="Login"]\')');


$page->evaluate('
    const inputUsuario = document.querySelector(\'input[formcontrolname="username"]\');
    const event = new Event("input", { bubbles: true });
    inputUsuario.value = "70716058405";
    inputUsuario.dispatchEvent(event);
');

// Execute JavaScript para disparar eventos de teclado no campo de senha
$page->evaluate('
    const inputSenha = document.querySelector(\'input[formcontrolname="password"]\');
    inputSenha.value = "antunes123";
    const keydownEvent = new Event("keydown", { bubbles: true, cancelable: true });
    keydownEvent.key = "a"; // Simulando a pressão da tecla "a" para acionar o evento
    inputSenha.dispatchEvent(keydownEvent);
    const inputEvent = new Event("input", { bubbles: true, cancelable: true });
    inputSenha.dispatchEvent(inputEvent);
');


if ($botaoLogin) {
    $page->evaluate('
    const botaoLogin = document.querySelector(\'button[label="Login"]\');
    botaoLogin.click();
');

    // Execute código JavaScript na página para acessar o localStorage e obter o id_token

    function buscarIdToken($page)
    {
        // Execute código JavaScript na página para acessar o localStorage e obter o id_token
        $evaluation = $page->evaluate('localStorage.getItem("id_token")');
        $idToken = $evaluation->getReturnValue();
        return $idToken;
    }

    $idToken = '';

    while (empty($idToken)) {
        $idToken = buscarIdToken($page);
        if (empty($idToken)) {
            sleep(2); // Aguarde 2 segundos antes de tentar novamente
        }
    }
    if ($idToken) {
        echo $idToken;
    } else {
        echo 400; // Retornar código de erro 400 se o idToken não for encontrado
    }
}


// Feche o navegador
$browser->close();
