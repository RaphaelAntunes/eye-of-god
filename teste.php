<?php

use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Page;

require 'vendor/autoload.php'; // Certifique-se de que o caminho para o autoload.php está correto.

// Inicialize o navegador
$browserFactory = new BrowserFactory();
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

    sleep(5);


    // Execute código JavaScript na página para acessar o localStorage e obter o id_token

$evaluation = $page->evaluate('localStorage.getItem("id_token")');


$idToken = $evaluation->getReturnValue();

    if ($idToken) {

        // Conexão com o banco de dados MySQL
        $conexao = new \mysqli('localhost', 'root', '', 'detran');

        if ($conexao->connect_error) {
            die('Erro na conexão com o banco de dados: ' . $conexao->connect_error);
        }

        // Inserção do id_token no banco de dados MySQL
        $sql = "INSERT INTO token (token) VALUES ('$idToken')";
        if ($conexao->query($sql) === TRUE) {
            echo 200;
        } else {
            echo 'Erro ao salvar o id_token no banco de dados: ' . $conexao->error;
        }

        $conexao->close();
    } else {
        echo 'id_token não encontrado no localStorage.';
    }
} else {
    echo 'Botão "Login" não encontrado.';
}

// Feche o navegador
$browser->close();
