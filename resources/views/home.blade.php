<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Eye of God</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/image-removebg-preview (1).png" rel="shortcut icon" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

</head>


<body>



    <!-- As a heading -->
    <div id="loading">
        <img src="img/giphy.gif" alt="Loading...">
        <h1 id="labelbuscando">Buscando...</h1>
    </div>
    <div class="d-flex justify-content-start align-items-center all flex-column">
        <nav class="navbar navbar-light justify-content-between bg-black d-flex" style="width:100%;">
            <div class="d-flex container flex-row align-items-center justify-content-center text-center color-white">
                @php
                if (session('pro') == 0) {
                echo '<p id="top-ser-vip" class="justify-content-center align-items-center" onclick="telas(2)">Busque
                    sem limites, tenha o controle em suas mãos
                    <span style="color: gold; ">Seja VIP</span> <img style="margin-bottom: -7px;" src="img/coroa.png"
                        alt="">
                </p>';
                }
                @endphp




                @php

                if (session('pro') == 1) {
                echo '<div class="d-flex container justify-content-between align-items-center">';
                    echo '<p><span style="color: gold; ">Você é VIP</span> <img style="margin-bottom: -7px;"
                            src="img/coroa.png" alt=""> </p>';
                    echo "<a href='" . route('logout') . "'><p>Sair</p></a>" ; echo '</div>' ; } @endphp </div>


        </nav>
        @if ($errors->has('message'))
        <nav class="navbar navbar-light justify-content-center bg-black d-flex"
            style="width:100%; background-color: red; ">
            <div class="d-flex container flex-row align-items-center justify-content-center text-center color-white">

                <p style="color: white;font-weight:bold;">🚨{{ $errors->first('message') }}🚨</p>
            </div>


        </nav>
        @endif

        @if (session('message'))
        <nav class="navbar navbar-light justify-content-center bg-black d-flex"
            style="width:100%; background-color: red; ">
            <div class="d-flex container flex-row align-items-center justify-content-center text-center color-white">

                <p style="color: white;font-weight:bold;">🚨 {{ session('message') }} 🚨</p>
            </div>


        </nav>
        @endif


        @php
        if (!session('nome')) {
        echo '<div class="d-flex">
            <button onclick="login()" class="mt-3 freetest mr-4">
                Entrar</button>
            <button onclick="telas(5)" class="mt-3 freetest">Experimente<br>
                Grátis</button>
        </div>';
        }
        @endphp


        <div class="d-flex gif mt-5">
            <img src="img/giphy.gif" alt="">
        </div>

        @php
        if (!session('nome')) {
        echo '<div id="ativarvip">
            <div class="d-flex flex-column text-center justify-content-center align-items-center">
                <p style="padding: 10px; color: white;" id="aviso">Consulte informações <span
                        style="color: gold">VIP</span> sobre um veículo</p>
                <div>
                </div>
                <input type="text" id="dados" maxlength="7" class="mb-4" value="" placeholder="Chave de ativação">
                <button onclick="ativar_key()">Ativar</button>

            </div>
        </div>';
        }
        @endphp



        @php
        if (session('nome')) {
        echo '<div id="pesquisa">
            <div class="d-flex flex-column text-center justify-content-center align-items-center">
                <p style="padding: 10px; color: red;" id="aviso"></p>
                <div class="d-flex justify-content-center align-items-center "><input
                        style="border-radius:15px 0px 0px 15px ;" type="text" maxlength="7" id="dados" class="mb-4"
                        value="" placeholder="Placa do Veículo">
                    <div onclick="clearinput();" id="clearbtn"
                        style="border-radius:0px 15px 15px 0px; background:#00A86B; width:30px; height:67px; display:flex;align-items:center; justify-content:center; cursor:pointer"
                        class="mb-4">
                        <p style="color:white; font-size:25px;" class="align-items-center">X</p>
                    </div>
                </div>
                <button id="btnpesquisar3" onclick="novaPesquisa()">Nova Pesquisa</button>
                <button id="btnpesquisar2" class="d-none"
                    style="background-color: gray; color: #c3c3c3; cursor:not-allowed">Pesquisar</button>
                <button id="btnpesquisar" onclick="autorizador()">Pesquisar</button>
                <button id="btnativar" class="d-none" onclick="ativar_key()">Ativar</button>
                <button id="btnativar2" class="d-none"
                    style="background-color: gray; color: #c3c3c3; cursor:not-allowed">Ativar</button>

            </div>
        </div>';
        }
        @endphp
        <div id="showpesquisa" style="background: black; display: none !important;">
            <div class="showpesquisa d-flex flex-column justify-content-center align-items-center">
                <div id="card-roubo" class="mb-2 mt-2" style="background-color: #f44336;
                width: 100%;
                padding: 10px;
                justify-content: center;
                text-align: center;
                color: white;
                font-weight: bold;
                border-radius: 0.25rem;
                display: none;
            }">

                </div>
                <button id="btncrlv" style="line-height: 15px;
                cursor:pointer;
                width: 102px;
                height: 56px;
                font-size: 13px;
                background:#f44336;">BAIXAR
                    - CRLV</button>
                <div id="accordion">
                    <div id="alertboxinfo" style="display: none !important; max-width:367px;"
                        class="alert alert-primary d-flex justify-content-center align-items-center " role="alert">
                        <div class="mr-3"><img width="27px" src="https://i.ibb.co/RNQ8Jh0/icons8-info-52-2.png" alt="">
                        </div>
                        <div> Veículos que não são do RN tem informações LIMITADAS<br><br>O Veículo que pesquisou
                            pertence a
                            UF de <pl id="insertUF" style="
                            font-weight: bold;
                            color: #00A86B;
                            text-decoration: underline;"></pl>
                        </div>

                    </div>
                    <div class="card">

                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-open" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Dados Proprietario
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="d-flex flex-column flex-lg-row" style="align-items: self-start;">

                                <div style="width: 300px"
                                    class="text-center d-flex flex-column justify-content-center align-items-center">

                                    <span>PROPRIETÁRIO:</span>
                                    <p id="nome"></p>
                                    <span>CPF:</span>
                                    <p id="cpf"></p>
                                    <div id="divcomp" style="display:none;width: 100%;">
                                        <span>Telefone:</span>
                                        <p id="telefone"></p>
                                        <span>E-mail:</span>
                                        <p id="email"></p>
                                        <span>Data de Nascimento:</span>
                                        <p id="datanascimento"></p>
                                    </div>
                                    <div id="data-aquisicao" style="width: 100%;">

                                        <span>DATA AQUISIÇÃO:</span>
                                        <p id="dataaquisicao"></p>
                                    </div>
                                </div>




                            </div>
                        </div>



                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-open" data-toggle="collapse"
                                    data-target="#collapseVeiculo" aria-expanded="true" aria-controls="collapseVeiculo">
                                    Dados Veiculo </button>
                            </h5>
                        </div>

                        <div id="collapseVeiculo" class="collapse " aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="d-flex flex-column flex-lg-row" style="align-items: self-start;">
                                <div style="width: 300px"
                                    class="text-center d-flex flex-column justify-content-center align-items-center">

                                    <span>MODELO:</span>
                                    <p id="modelo"></p>
                                    <span>COR:</span>
                                    <p id="cor"></p>
                                    <div id="divpotencia" style="display:none;width: 100%;">
                                        <span>POTÊNCIA:</span>
                                        <p id="potencia"></p>
                                    </div>
                                    <span>FABRICAÇÃO/MODELO:</span>
                                    <p id="fabmodelo"></p>
                                    <span>COMBUSIVEL:</span>
                                    <p id="combustivel"></p>
                                    <span>LUGARES:</span>
                                    <p id="lugares"></p>
                                    <span>PLACA:</span>
                                    <p id="placa"></p>
                                    <span>PLACA ANTERIOR:</span>
                                    <p id="placaanterior"></p>
                                    <span>RENAVAM:</span>
                                    <p id="renavam"></p>
                                    <span>EMPLACAMENTO EM:</span>
                                    <p id="emplacamentoem"></p>
                                    <div id="prop-anterior" style="width: 100%;">
                                        <span>PROPRIETÁRIO ANTERIOR:</span>
                                        <p id="proprietario-anterior"></p>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="card divs-info-car">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-open" data-toggle="collapse" data-target="#collapseFor"
                                    aria-expanded="true" aria-controls="collapseFor">
                                    Infrações </button>
                            </h5>
                        </div>

                        <div id="collapseFor" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="d-flex flex-column " id="infracao-container"
                                style="align-items: self-start;">

                            </div>
                        </div>



                    </div>
                    <div class="card divs-info-car">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-open" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="true" aria-controls="collapseTwo">
                                    Multas
                                </button>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="d-flex flex-column " id="multas-container"
                                style="align-items: self-start;">

                            </div>
                        </div>



                    </div>
                    <div class="card divs-info-car">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-open" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    Débitos
                                </button>
                            </h5>
                        </div>

                        <div id="collapseThree" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="d-flex flex-column " id="debito-container"
                                style="align-items: self-start;">

                            </div>
                        </div>



                    </div>


                    <div class="d-flex justify-content-between mt-5">
                        <button class="controladores mr-3" id="anterior" onclick="mostrarAnterior()">Anterior</button>
                        <button class="controladores" id="proximo" onclick="mostrarProximo()">Próximo</button>
                    </div>
                    <button id="novaPesquisa" onclick="novaPesquisa()" class="mt-3 mb-3">Nova pesquisa</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="part1modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style='font-weight: bold;'>NÃÃÃO PAGUE PARA
                            TESTAR
                            !!! 🆓</h5>
                    </div>
                    <div class="modal-body">
                        <p>Aproveite agora um <b style='font-weight: bold;'>TESTE GRATUITO!</b><br><br>
                            Com nosso benefício, você tem direito a <b style='font-weight: bold;'>3 CONSULTAS
                                GRATUITAS</b>
                            de veículos na região do <b style='font-weight: bold;'>RN e arredores.</b><br><br>
                            Deseja mais? Torne-se um apoiador e desbloqueie acesso ilimitado, informações em tempo real
                            e
                            muito mais!</p>
                        <hr>
                        <p class="mt-2 mb-2" style="font-weight: bold ">Torne-se um apoiador e Seja VIP <img
                                style="margin-bottom: -7px; width:30px;" src="img/coroa.png" alt=""></p>
                        <p>Seja um VIP! Tornando-se um apoiador, você terá o controle nas suas mãos e acesso a um mundo
                            de
                            possibilidades:<br><br>
                            <span class="mr-2">•</span> Identifique carros e seus condutores em tempo real de onde
                            estiver.<br><br>
                            <span class="mr-2">•</span> Tenha informações precisas que podem te ajudar em diversas
                            situações.<br><br>
                            <span class="mr-2">•</span> Realize consultas por nome e CPF.<br><br>
                            <span class="mr-2">•</span> Desfrute de novas atualizações sem custo adicional.<br><br>
                            Aproveite ao máximo seu teste gratuito e eleve sua experiência tornando-se um apoiador VIP
                            agora!

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" onclick="telas(1)">Teste Grátis</button>
                    </div>
                </div>
                <div class="modal-content" id="part2modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Teste Grátis</h5>
                    </div>

                    <form method="post" action="{{ route('free-test') }}">
                        @csrf
                        <div class="modal-body">
                            <P>Falta pouco, você está a <b style="font-weight: bold ">um clique</b> de começar!</P>
                            <div class="d-flex flex-column">
                                <input type="text" name="nome" minlength="3" class="inputtest mt-2"
                                    placeholder="Digite seu nome" required>
                                <input type="email" name="email" class="inputtest mt-2" placeholder="Digite seu e-mail"
                                    required>
                                <input type="text" id="whatsapp" name="telefone" maxlength="15" class="inputtest mt-2"
                                    onkeyup="mascaraWhatsApp(this.value)" placeholder="WhatsApp" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn">Iniciar Teste Gratuito</button>
                        </div>
                    </form>
                </div>
                <div class="modal-content" id="part5modal">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;" id="exampleModalLabel">Parabéns, sua
                            assinatura foi ativada, você é VIP <img style="margin-bottom: -7px; width:30px;"
                                src="img/coroa.png" alt=""></h5>
                    </div>

                    <div class="modal-body">
                        <div class="d-flex flex-column">
                            <P>Sua assinatura foi ativada e você ja pode desfrutar de todas as funções</P>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="fecharmodal()" class="btn">Começar</button>
                    </div>

                </div>
                <div class="modal-content" id="part4modal">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;" id="exampleModalLabel">Entre em sua conta
                        </h5>
                    </div>
                    @if (session('mensagem'))
                    <div class="alert alert-success">
                        {{ session('mensagem') }}
                    </div>
                    @endif
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column">
                                <input type="email" name="email" class="inputtest mt-2" placeholder="Digite seu email"
                                    required>
                                <input type="password" name="senha" class="inputtest mt-2" placeholder="Senha" required>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn">Entrar</button>
                        </div>
                    </form>

                    </form>
                </div>
                <div class="modal-content" id="part6modal">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;" id="exampleModalLabel">Cadastre-se</h5>
                    </div>
                    @if (session('mensagem'))
                    <div class="alert alert-success">
                        {{ session('mensagem') }}
                    </div>
                    @endif
                    <form method="post" action="{{ route('cadastro') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column">
                                <input type="text" name="nome" class="inputtest mt-2" placeholder="Digite seu nome"
                                    required>
                                <input type="email" name="email" class="inputtest mt-2" placeholder="Digite seu email"
                                    required>
                                <input type="text" id="whatsapp2" name="whatsapp" class="inputtest mt-2" maxlength="15"
                                    placeholder="Whatsapp" required onkeyup="mascaraWhatsApp(this.value)">
                                <input type="text" id="cadsenha" name="senha" class="inputtest mt-2"
                                    oninput="vsenhacad()" placeholder="Senha" required>
                                <input type="text" id="cadsenha2" name="senha2" class="inputtest mt-2"
                                    oninput="vsenhacad()" placeholder="Confirme a senha" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btncadsenha" class="btn" disabled>Cadastrar</button>
                        </div>
                    </form>

                    </form>
                </div>
                <div class="modal-content" id="part7modal">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-weight: bold;" id="exampleModalLabel">Defina uma senha
                            para sua conta</h5>
                    </div>
                    @if (session('mensagem'))
                    <div class="alert alert-success">
                        {{ session('mensagem') }}
                    </div>
                    @endif
                    <form method="post" action="/cadastro-senha">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex flex-column">
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                <input type="text" id="beforesenha" oninput="vbeforesenha()" name="senha"
                                    class="inputtest mt-2" placeholder="Senha" required>
                                <input type="text" name="senha2" oninput="vbeforesenha()" id="beforesenha2"
                                    class="inputtest mt-2" placeholder="Confirme a senha" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnbeforesenha" disabled class="btn">Cadastrar</button>
                        </div>
                    </form>

                    </form>
                </div>
                <div class="modal-content" id="part3modal">
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Não perca o
                            controle!
                        </h5>
                        <p style="
                    margin: 0px !important;
                    padding: 8px !important;
                    background: #00a86b;
                    color: white;
                    border-radius: 17px;
                    cursor: pointer;
                " onclick="telas(3)">
                            Inserir Chave

                    </div>
                    <div class="modal-body">
                        <p>Eai, gostou ? é claro né ! Não fique sem acesso, torne-se um apoiador <img
                                style="margin-bottom: -7px; width:30px;" src="img/coroa.png" alt=""><b
                                style="font-weight: bold;"></b></p>
                        <hr>
                        <p class="mt-2 mb-2" style="font-weight: bold">Torne-se um apoiador e Seja VIP <img
                                style="margin-bottom: -7px; width:30px;" src="img/coroa.png" alt=""></p>
                        <p>Como apoiador VIP, você terá o controle total:<br><br>
                            <span class="mr-2">•</span> Identifique carros e seus condutores em tempo real, de onde
                            estiver.<br><br>
                            <span class="mr-2">•</span> Tenha acesso a informações precisas que podem te ajudar em
                            diversas situações.<br><br>
                            <span class="mr-2">•</span> Realize consultas por nome e CPF.<br><br>
                            <span class="mr-2">•</span> Desfrute de novas atualizações sem custo adicional.
                        </p>
                    </div>
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                        <div style="
                    position: relative;
                    top: -51px;
                    left: 31px;
                    height:155px;
                ">
                            <div>
                                <p style="
                        position: relative;
                        left: 34px;
                        top: 74px;
                        font-weight: bold;
                        color: #c3c3c3;

                    ">
                                    de: </p>
                                <img style="margin-bottom: -7px;width: 55px;position: relative;top: 43px;left: -25px;"
                                    src="img/coroa.png" alt="">
                                <p style="
                        top: 3px;
                        font-size: 23px;
                        text-decoration: line-through;
                        position: relative;
                        left: 60px;
                        font-weight: bold;
                        text-decoration-color: red;
    text-decoration-style: double;
    text-decoration-thickness: from-font;
    color: #c3c3c3;
                    ">

                                    139,00</p>

                            </div>
                            <div>
                                <p style="
                        position: relative;
                        left: 27px;
                        top: 1px;
                        font-weight: bold;
                    ">
                                    por apenas: </p>
                                <p style="
                        font-size: 44px;
                        font-weight: bold;
                        color: #00a86b;

                    ">
                                    49,99</p>
                                <p style="
                                top: 5px;
                                position: relative;
                                left: -33px;
                                color: #919191;
                                font-size:14px;
                            ">
                                    Acesso liberado na hora*</p>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="https://wa.me/5584998954309?text=Tenho+interesse+no+APP+de+consulta+de+placas"
                            target="_blank"><button type="button" class="btn">Torne-se um Apoiador
                                VIP</button></a>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        <script>
            document.getElementById("part1modal").style.display = 'none';
            document.getElementById("part2modal").style.display = 'none';
            document.getElementById("part3modal").style.display = 'none';
            document.getElementById("part4modal").style.display = 'none';
            document.getElementById("part5modal").style.display = 'none';
            document.getElementById("part6modal").style.display = 'none';
            document.getElementById("part7modal").style.display = 'none';
            document.getElementById("btnpesquisar3").style.display = 'none';

            function mascaraWhatsApp(valor) {
                valor = valor.replace(/\D/g, '');
                valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
                valor = valor.replace(/(\d)(\d{4})$/, '$1-$2');
                document.getElementById('whatsapp').value = valor;
                document.getElementById('whatsapp2').value = valor;

            }

            function exibirLoading() {
                document.getElementById('loading').style.display = 'block';
            }

            // Ocultar tela de loading
            function ocultarLoading() {
                document.getElementById('loading').style.display = 'none';
            }

            function vsenhacad() {
                var senha = document.getElementById('cadsenha').value;
                var confirmarSenha = document.getElementById('cadsenha2').value;
                var botao = document.getElementById('btncadsenha');

                if (senha === confirmarSenha && senha.length > 0) {
                    botao.disabled = false;
                } else {
                    botao.disabled = true;
                }
            }

            function vbeforesenha() {
                var senha = document.getElementById('beforesenha').value;
                var confirmarSenha = document.getElementById('beforesenha2').value;
                var botao = document.getElementById('btnbeforesenha');

                if (senha === confirmarSenha && senha.length > 0) {
                    botao.disabled = false;
                } else {
                    botao.disabled = true;
                }
            }
            btnpesquisar = document.getElementById("btnpesquisar");
            btnpesquisar2 = document.getElementById("btnpesquisar2");
            divnaovip = document.getElementById("top-ser-vip");
            divevip = document.getElementById("top-e-vip");

            btnativar = document.getElementById("btnativar");
            btnativar2 = document.getElementById("btnativar2");
            inputdados = document.getElementById("dados");
            alert = document.getElementById("aviso");
            var id = @json(session('email'));
            var csrfToken = "{{ csrf_token() }}";

            var dados = new FormData();
            dados.append('id', id);

            var url = '/usr-info';

            $.ajax({
                url: url,
                method: 'post',
                data: dados,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(data) {

                    if (data.pro == 1) {
                        ses_pesq();
                        divevip.classList.remove("d-none");

                    } else {
                        divnaovip.classList.remove("d-none");

                    }

                }

            });


            function login() {
                telas(4);
            }


            function ses_atv() {
                campo = document.getElementById("dados");
                btnativar = document.getElementById("btnativar");
                btnpesquisar = document.getElementById("btnpesquisar");
                campo.value = '';
                campo.placeholder = 'Chave de ativação';
                btnativar.classList.remove("d-none");
                btnpesquisar.classList.add("d-none");
                btnpesquisar2.classList.add("d-none");
                btnativar2.classList.add("d-none");

            }

            function ses_pesq() {
                campo = document.getElementById("dados");
                btnativar = document.getElementById("btnativar");
                btnpesquisar = document.getElementById("btnpesquisar");
                campo.value = '';
                campo.placeholder = 'PLACA DO VEÍCULO';
                btnpesquisar.classList.remove("d-none");
                btnativar.classList.add("d-none");
                btnpesquisar2.classList.add("d-none");
                btnativar2.classList.add("d-none");
                localStorage.removeItem('atv_on');

            }

            if (localStorage.getItem('atv_on')) {
                ses_atv()
            }

            function fecharmodal() {
                $('#meuModal').modal('hide');

            }

            function telas(x) {


                if (x == 1) {
                    // TELA 2 CADASTRO_FREE
                    document.getElementById("part5modal").style.display = 'none';
                    document.getElementById("part4modal").style.display = 'none';
                    document.getElementById("part3modal").style.display = 'none';
                    document.getElementById("part2modal").style.display = 'block';
                    document.getElementById("part1modal").style.display = 'none';
                } else if (x == 2) {
                    // ACABOU TESTES
                    document.getElementById("part5modal").style.display = 'none';
                    document.getElementById("part4modal").style.display = 'none';
                    document.getElementById("part3modal").style.display = 'block';
                    document.getElementById("part2modal").style.display = 'none';
                    document.getElementById("part1modal").style.display = 'none';
                    $('#meuModal').modal('show');

                } else if (x == 3) {
                    // MUDA PRA TELA DE ATIVAÇÃO
                    $('#meuModal').modal('hide');
                    campo = document.getElementById("dados");
                    btnativar = document.getElementById("btnativar");
                    btnpesquisar = document.getElementById("btnpesquisar");
                    campo.value = '';
                    campo.placeholder = 'Chave de ativação';
                    btnativar.classList.remove("d-none");
                    btnpesquisar.classList.add("d-none");
                    localStorage.setItem('atv_on', 1);

                } else if (x == 4) {

                    // TELA DE LOGIN
                    document.getElementById("part5modal").style.display = 'none';
                    document.getElementById("part4modal").style.display = 'block';
                    document.getElementById("part3modal").style.display = 'none';
                    document.getElementById("part2modal").style.display = 'none';
                    document.getElementById("part1modal").style.display = 'none';
                    $('#meuModal').modal('show');

                } else if (x == 5) {

                    // TELA 1 ° EXPERIMENTE
                    document.getElementById("part5modal").style.display = 'none';
                    document.getElementById("part4modal").style.display = 'none';
                    document.getElementById("part3modal").style.display = 'none';
                    document.getElementById("part2modal").style.display = 'none';
                    document.getElementById("part1modal").style.display = 'block';
                    $('#meuModal').modal('show');

                } else if (x == 6) {

                    // TELA 1 ° EXPERIMENTE
                    document.getElementById("part5modal").style.display = 'block';
                    document.getElementById("part4modal").style.display = 'none';
                    document.getElementById("part3modal").style.display = 'none';
                    document.getElementById("part2modal").style.display = 'none';
                    document.getElementById("part1modal").style.display = 'none';
                    $('#meuModal').modal('show');

                } else if (x == 7) {

                    // TELA 1 ° EXPERIMENTE
                    document.getElementById("part6modal").style.display = 'block';
                    document.getElementById("part5modal").style.display = 'none';
                    document.getElementById("part4modal").style.display = 'none';
                    document.getElementById("part3modal").style.display = 'none';
                    document.getElementById("part2modal").style.display = 'none';
                    document.getElementById("part1modal").style.display = 'none';
                    $('#meuModal').modal('show');

                } else if (x == 8) {

                    // TELA 1 ° EXPERIMENTE
                    document.getElementById("part7modal").style.display = 'block';
                    document.getElementById("part6modal").style.display = 'none';
                    document.getElementById("part5modal").style.display = 'none';
                    document.getElementById("part4modal").style.display = 'none';
                    document.getElementById("part3modal").style.display = 'none';
                    document.getElementById("part2modal").style.display = 'none';
                    document.getElementById("part1modal").style.display = 'none';
                    $('#meuModal').modal('show');

                } else {
                    document.getElementById("part4modal").style.display = 'none';
                    document.getElementById("part3modal").style.display = 'none';
                    document.getElementById("part2modal").style.display = 'none';
                    document.getElementById("part1modal").style.display = 'block';
                }

            }
        </script>

        <script>
            var resultados = []; // Array para armazenar os resultados
            var indiceAtual = 0; // Índice do resultado atual
            document.getElementById("pesquisa").style.display = 'block';
            document.getElementById("showpesquisa").style.display = 'none';
            document.getElementById("anterior").style.display = 'none';
            document.getElementById("proximo").style.display = 'none';

            function consulta(config) {
                var xyz = document.getElementById("dados").value;
                if(config == 0){
                    var url = '/api/d/' + encodeURIComponent(xyz);
                }else{
                    var url = '/api/free/' + encodeURIComponent(xyz);

                }
                updateProgress();


                $.ajax({
                    url: 'api/token',
                    method: 'get',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data == 200) {
                            $.ajax({
                                url: url,
                                method: 'get',
                                contentType: false,
                                processData: false,
                                success: function(data) {
                                    console.log(data);
                                    console.log(data[0].data.classe);

                                    if (Object.keys(data).length == 0) {
                                        alert.innerHTML =
                                            'Placa incorreta ou veículo não pertencente ao RN';
                                        document.getElementById('btnpesquisar2').style.display = 'none';
                                        document.getElementById('btnpesquisar3').style.display =
                                            'block';
                                        ocultarLoading();
                                        return;
                                    }
                                    if (data[1].success) {
                                        exibirResultado(data);

                                    } else if (data[0].data.classe == 'rev-outrauf') {
                                        exibirResultadoOutraUF(data[0].data);
                                        return;

                                    }else if (data[1].data[0] ==
                                        'Placa Não Cadastrada na Base Local' || data == null) {
                                        alert.innerHTML =
                                            'Placa incorreta ou veículo não pertencente ao RN';
                                        document.getElementById('btnpesquisar2').style.display = 'none';
                                        document.getElementById('btnpesquisar3').style.display =
                                            'block';
                                        ocultarLoading();

                                        return;
                                    } else {
                                        alert.innerHTML =
                                            'Algum erro ocorreu, contate um responsável pelo sistema';
                                        document.getElementById('btnpesquisar2').style.display = 'none';
                                        document.getElementById('btnpesquisar3').style.display =
                                            'block';
                                        ocultarLoading();
                                        return;

                                    }
                                }

                            });
                        }else{
                            alert.innerHTML =
                                            'Autherror 404';
                                        document.getElementById('btnpesquisar2').style.display = 'none';
                                        document.getElementById('btnpesquisar3').style.display =
                                            'block';
                                        ocultarLoading();
                                        return; 
                        }
                    }
                });




            }

            function formatarString(str) {
                // Encontre a posição do primeiro espaço
                const posPrimeiroEspaco = str.indexOf('-');

                // Remova os caracteres até o primeiro espaço
                const strSemNumero = str.slice(posPrimeiroEspaco + 1);

                // Remova os parênteses
                const strFormatada = strSemNumero.replace(/[\(\)]/g, '');

                return strFormatada;
            }


            function exibirResultadoOutraUF(data) {
                ocultarLoading();
                var resultado = data;
                var btncrlv = document.getElementById('btncrlv');
                var divs_info_car = document.getElementsByClassName('divs-info-car');
                var data_aquisicao = document.getElementById('data-aquisicao');    
                var prop_anterior = document.getElementById('prop-anterior');    
                var alertboxinfo = document.getElementById('alertboxinfo');    

                alertboxinfo.style.display = 'flex';
                data_aquisicao.remove();
                prop_anterior.remove();
                btncrlv.remove();

                for (var i = 0; i < divs_info_car.length; i++) {
    // Adiciona a classe 'd-none' a cada elemento
    divs_info_car[i].classList.add('d-none');
}
                document.getElementById("cpf").innerHTML = 'Não Disponivel';
                document.getElementById("aviso").innerHTML = '';
                document.getElementById("pesquisa").style.display = 'none';
                document.getElementById("showpesquisa").style.display = 'flex';
                document.getElementById("nome").innerHTML = resultado.nomeProprietario;
                document.getElementById("cor").innerHTML = formatarString(resultado.cor);
                if(resultado.potencia != 0){
                    document.getElementById("divpotencia").style.display = 'block';
                    document.getElementById("potencia").innerHTML = resultado.potencia;

                }
                document.getElementById("insertUF").innerHTML = resultado.municipioEmplacamento;

                document.getElementById("fabmodelo").innerHTML = resultado.anoFabricacaoModelo;
                document.getElementById("combustivel").innerHTML = formatarString(resultado.combustivel);
                document.getElementById("lugares").innerHTML = resultado.lugares;
                document.getElementById("emplacamentoem").innerHTML = resultado.municipioEmplacamento;
                document.getElementById("placaanterior").innerHTML = resultado.placaAnterior;
                document.getElementById("modelo").innerHTML = formatarString(resultado.marcaModelo);
                document.getElementById("placa").innerHTML = resultado.placa + ' / ' + resultado.municipioEmplacamento;
                document.getElementById("renavam").innerHTML = resultado.renavam;
            }
            function exibirResultado(data) {
                ocultarLoading();
                console.log(data.length);
                if (data.length == 4) {
                    var resultado = data[0].data;
                    var multas = data[1].data;
                    var debito = data[2].data;
                    var infracao = data[3].data;
                    var resultadoX = data[0];
                    var multasX = data[1];
                    var debitoX = data[2];
                    var infracaoX = data[3];
                } else if (data.length == 5) {
                    var complemento = data[2].data;
                    var resultado = data[0].data;
                    var multas = data[1].data;
                    var debito = data[3].data;
                    var infracao = data[4].data;
                    var complementoX = data[2];
                    var resultadoX = data[0];
                    var multasX = data[1];
                    var debitoX = data[3];
                    var infracaoX = data[4];
                }
                            

                if (typeof debitoX !== 'undefined' && typeof debitoX.cpf !== 'undefined') {

document.getElementById("cpf").innerHTML = debitoX.cpf;
var btncrlv = document.getElementById('btncrlv');
var cpfLimpo = debitoX.cpf.replace(/\D/g, '');
var linkcrlv = 'https://crlvdigital.detran.rn.gov.br/Home/ImprimirCRLV?placa=' + resultado.placa +
    '&renavam=' +
    resultado.renavam + '&documentoProprietario=' + cpfLimpo;

//console.log(linkcrlv);

btncrlv.addEventListener('click', function() {
    window.open(linkcrlv, '_blank');
});

}else{
    var btncrlv = document.getElementById('btncrlv');

    document.getElementById("cpf").innerHTML = 'Não Disponivel';
    btncrlv.remove();
}


                        

                            





                /// DADOS GERAIS /////
                document.getElementById("aviso").innerHTML = '';
                document.getElementById("pesquisa").style.display = 'none';
                document.getElementById("showpesquisa").style.display = 'flex';
                document.getElementById("nome").innerHTML = resultado.nomeProprietario;
                document.getElementById("cor").innerHTML = formatarString(resultado.cor);

                if(resultado.potencia != 0){
                    document.getElementById("divpotencia").style.display = 'block';
                    document.getElementById("potencia").innerHTML = resultado.potencia;

                }

                document.getElementById("fabmodelo").innerHTML = resultado.anoFabricacaoModelo;
                document.getElementById("combustivel").innerHTML = formatarString(resultado.combustivel);
                document.getElementById("lugares").innerHTML = resultado.lugares;
                document.getElementById("emplacamentoem").innerHTML = resultado.municipioEmplacamento;
                document.getElementById("placaanterior").innerHTML = resultado.placaAnterior;
                document.getElementById("dataaquisicao").innerHTML = resultado.dataAquisicao;

                if(resultado.classe == 'rev-furto-roubo'){
                    document.getElementById("card-roubo").style.display = 'block';
                    document.getElementById("card-roubo").innerHTML = 'Veículo com queixa de Roubo / Furto. 🚨🚨🚨';
                }
                if(resultado.classe == 'rev-restricao'){
                    document.getElementById("card-roubo").style.display = 'block';
                    document.getElementById("card-roubo").innerHTML = 'Veículo com restrição';
                }
                
                if (Object.keys(data).length == 5 && complementoX.success === true && Object.keys(complemento).length > 1) {
                    document.getElementById("divcomp").style.display = 'block';
                    document.getElementById("telefone").innerHTML = complemento.telefone;
                    document.getElementById("email").innerHTML = complemento.email;
                    var dataNascimento = complemento.datanascimento;
                    var dataFormatada = new Date(dataNascimento).toLocaleDateString('pt-BR');
                    document.getElementById("datanascimento").innerHTML = dataFormatada;
                }

                document.getElementById("modelo").innerHTML = formatarString(resultado.marcaModelo);
                document.getElementById("placa").innerHTML = resultado.placa + ' / ' + resultado.municipioEmplacamento;
                document.getElementById("renavam").innerHTML = resultado.renavam;
                if (resultado.proprietarioAnterior) {
                    document.getElementById("proprietario-anterior").innerHTML = resultado.proprietarioAnterior;
                } else if (resultado.proprietarioAnteriorLocadora) {
                    document.getElementById("proprietario-anterior").innerHTML = resultado.proprietarioAnteriorLocadora;
                } else {
                    document.getElementById("proprietario-anterior").innerHTML = 'Único dono';
                }

               /// MULTAS /////

                    var multasContainer = document.getElementById("multas-container");

                    if (multasX.success === true && multas != null && Object.keys(multas).length >= 1) {
                        for (var i = 0; i < Object.keys(multas).length; i++) {
                            var resultado = multas[i];
                            var horaFormatada = resultado.horaAutuacao.slice(0, 2) + ":" + resultado.horaAutuacao.slice(2);

                            if (debitoX.success === true && debito != null && Object.keys(debito).length >= 1) {
                                for (var j = 0; j < Object.keys(debito).length; j++) {
                                    var resultadodebito = debito[j];
                                    if (resultado.descricaoAuto == resultadodebito.descricaoClasse) {
                                        var link = `https://www2.detran.rn.gov.br/SharedASP/grdEscolhaVeiculo.asp?NossoNumero=${resultadodebito.nossoNumero}&codigo=${resultadodebito.codigoSeguranca}&iddebito=${resultadodebito.idDebito}&Classe=${resultadodebito.classe}`;

                                        console.log(resultadodebito);
                                        // Crie elementos HTML para exibir cada multa
                            var div = document.createElement("div");
                            div.classList.add("text-center");
                            div.classList.add("mt-2");

                            // Defina os atributos "style" para largura
                            div.style.width = "300px";
                            div.innerHTML = `
                                <span>AUTO DE INFRAÇÃO:</span>
                                <p>${resultado.descricaoAuto}</p>
                                <span>INFRACÃO</span>
                                <p>${resultado.descricaoInfracao}${resultadodebito.idDebito}</p>
                                <span>DATA:</span>
                                <p>${resultado.dataAutuacao + ' - ' + horaFormatada}</p>
                                <span>LOCAL:</span>
                                <p>${resultado.localInfracao + ' - ' + resultado.cidadeInfracao}</p>
                                <span>COMPLEMENTO:</span>
                                <p>${resultado.complemento}</p>
                                <span>STATUS</span>
                                <p>${resultado.descricaoStatus}</p>
                                <span>Valor</span>
                                <p>${resultadodebito.valorAtualizado}</p>
                                <a href="${link}" target="_blank"><span style="
                                    border: 15px solid #00a86b;
                                    padding: 25px 0px;
                                    background: #1c5e46;
                                    font-size: 20px;
                                    cursor: pointer;
                                    color: white;
                                    border-radius: 0px 0px 10px 10px;
                                ">PAGAR</span></a>
                            `;

                            // Adicione o elemento criado ao container de multas
                            multasContainer.appendChild(div);

                                    }
                                }
                            }
                            
                        }
                    } else {
                        var div = document.createElement("div");
                        div.classList.add("text-center");
                        div.classList.add("mt-2");

                        // Defina os atributos "style" para largura
                        div.style.width = "300px";
                        div.innerHTML = `
                            <span></span>
                            <p>Sem multas disponíveis.</p>
                            <span></span>
                        `;
                        multasContainer.appendChild(div);
                    }

                    /// DEBITOS /////

                    var debitoContainer = document.getElementById("debito-container");
                    if (debitoX.success === true && debito != null && Object.keys(debito).length >= 1) {
                        for (var i = 0; i < Object.keys(debito).length; i++) {
                            var resultado = debito[i];
                            var hasMatch = false;

                            if (multasX.success === true && multas != null && Object.keys(multas).length >= 1) {
                                for (var j = 0; j < Object.keys(multas).length; j++) {
                                    var resultadomultas = multas[j];
                                    if (resultado.descricaoClasse == resultadomultas.descricaoAuto) {
                                        hasMatch = true;
                                        break; // Se houver correspondência, pare de procurar
                                    }
                                }
                            }

                            // Se não houver correspondência, exiba os detalhes do débito
                            if (!hasMatch) {
                                if (resultado.classe != null) {
                                    var div = document.createElement("div");
                                    div.classList.add("text-center");
                                    div.classList.add("mt-2");
                                    var link = `https://www2.detran.rn.gov.br/SharedASP/grdEscolhaVeiculo.asp?NossoNumero=${resultado.nossoNumero}&codigo=${resultado.codigoSeguranca}&iddebito=${resultado.idDebito}&Classe=${resultado.classe}`;

                                    // Defina os atributos "style" para largura
                                    div.style.width = "300px";
                                    div.innerHTML = `
                                        <span>DESCRIÇÃO:</span>
                                        <p>${resultado.descricaoClasse} - ${resultado.exercicio}</p>
                                        <span>DATA VENCIMENTO</span>
                                        <p>${resultado.dataVencimento}</p>
                                        <span>VALOR:</span>
                                        <p>R$:${resultado.valorNominal}</p>
                                        <span>VALOR ATUALIZADO:</span>
                                        <p>R$:${resultado.valorAtualizado}</p>
                                        <a href="${link}" target="_blank"><span style="
                                        border: 15px solid #00a86b;
                                        padding: 25px 0px;
                                        background: #1c5e46;
                                        font-size: 20px;
                                        cursor: pointer;
                                        color: white;
                                        border-radius: 0px 0px 10px 10px;
                                    ">PAGAR</span></a>
                                    `;
                                    debitoContainer.appendChild(div);
                                }
                            }
                        }
                    } else {
                        var div = document.createElement("div");
                        div.classList.add("text-center");
                        div.classList.add("mt-2");

                        // Defina os atributos "style" para largura
                        div.style.width = "300px";
                        div.innerHTML = `
                            <span></span>
                            <p>Sem Débitos disponíveis.</p>
                            <span></span>
                        `;
                        debitoContainer.appendChild(div);
                    }


                /// INFRAÇÕES  /////


                var infracaoContainer = document.getElementById("infracao-container");
                if (infracaoX.success === true && infracao != null && Object.keys(infracao).length >= 1) {
                    for (var i = 0; i < Object.keys(infracao).length; i++) {

                        var resultado = infracao[i];
                        // console.log(resultado)
                        var horaFormatada = resultado.horaAutuacao.slice(0, 2) + ":" + resultado.horaAutuacao.slice(2);

                        var div = document.createElement("div");
                        div.classList.add("text-center");
                        div.classList.add("mt-2");

                        // Defina os atributos "style" para largura
                        div.style.width = "300px";
                        div.innerHTML = `
                    <span>AUTO DA INFRAÇÃO:</span>
                    <p>${resultado.descricaoAuto}</p>
                    <span>DESCRIÇÃO DA INFRAÇÃO:</span>
                    <p>${resultado.descricaoInfracao}</p>
                    <span>COMPLEMENTO</span>
                    <p>${resultado.complemento}</p>
                    <span>LOCAL:</span>
                    <p>${resultado.localInfracao}</p>
                    <span>DATA E HORA:</span>
                    <p>${resultado.dataAutuacao + ' - ' + horaFormatada}</p>

                `;
                        infracaoContainer.appendChild(div);
                    }



                } else {
                    var div = document.createElement("div");
                    div.classList.add("text-center");
                    div.classList.add("mt-2");

                    // Defina os atributos "style" para largura
                    div.style.width = "300px";
                    div.innerHTML = `
                    <span></span>
                    <p>Sem Infrações disponíveis.</p>
                    <span></span>
                   
                `;
                    infracaoContainer.appendChild(div);

                }
            }


            function ativar_key() {
                var csrfToken = "{{ csrf_token() }}";
                exibirLoading();
                inputdados = document.getElementById("dados");

                if (inputdados.value.length < 7) {
                    inputdados.focus();
                    document.getElementById("aviso").innerHTML =
                        'Preencha o campo abaixo';
                    ocultarLoading();

                    return;
                }

                // btnativar.classList.add("d-none");
                // btnativar2.classList.remove("d-none");

                var dados = new FormData();
                var id = @json(session('email'));
                dados.append('chave', inputdados.value);
                dados.append('id', id);

                var url = '/ativar-vip';

                $.ajax({
                    url: url,
                    method: 'post',
                    data: dados,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        console.log(data);
                        ocultarLoading();

                        if (data == 202) {
                            telas(7);
                        } else if (data == 203) {
                            telas(8);
                        } else if (data == 200) {
                            ses_pesq();
                            telas(6);
                            setTimeout(function() {
                                location.reload();
                            }, 10000);

                        } else if (data == 201) {
                            alert.innerHTML = 'Chave já foi ativada !';

                        } else {

                            alert.innerHTML = 'A chave inserida não é válida';
                        }
                    }
                });
            }

            function updateProgress() {
                const totalTime = 13000; // Tempo total esperado para todas as requisições (em milissegundos)
                let elapsedTime = 0; // Tempo decorrido

                function calculatePercentage() {
                    const percentage = (elapsedTime / totalTime) * 100;
                    document.getElementById("labelbuscando").innerHTML = 'Buscando...<br>' + percentage.toFixed(0) + '%';
                }

                // Inicia o cronômetro
                const timer = setInterval(function() {
                    elapsedTime += 100; // Incrementa o tempo decorrido a cada segundo
                    calculatePercentage();

                    // Se o tempo decorrido atingir o tempo total, interrompe o cronômetro
                    if (elapsedTime >= totalTime) {
                        clearInterval(timer);
                    }
                }, 100);
            }

            // Atualize a função uma vez (ou conforme necessário)




            function autorizador() {
                var csrfToken = "{{ csrf_token() }}";

                if (inputdados.value.length < 7) {
                    inputdados.focus();
                    document.getElementById("aviso").innerHTML =
                        'Preencha o campo abaixo';

                    return;
                }
                exibirLoading();

                btnpesquisar.classList.add("d-none");
                btnpesquisar2.classList.remove("d-none");

                var dados = new FormData();
                var id = @json(session('email'));
                var xyz = document.getElementById("dados").value;

                dados.append('id', id);
                dados.append('placa', xyz);

                var url = '/api/free-test';

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: dados,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        if (data == 200) {
                            consulta(0);
                            localStorage.setItem('ultimaplaca', document.getElementById("dados").value);

                        } else if (data == 201){
                            consulta(1);
                            localStorage.setItem('ultimaplaca', document.getElementById("dados").value);

                        } else {
                            $('#meuModal').modal('show');
                            console.log("nao pode");
                            ses_atv()
                            telas(2);
                            localStorage.setItem('atv_on', 1);
                            ocultarLoading();
                        }
                    }
                });
            }


            function novaPesquisa() {
                var pesquisa = document.getElementById("dados").value;

// Verifica se o valor obtido não é vazio
if (pesquisa.trim() !== '') {
    // Define o valor obtido no localStorage com a chave 'ultimaplaca'
    localStorage.setItem('ultimaplaca', pesquisa);
    location.reload();

}     
            }

            function verificarLocalStorage() {
    // Verifica se o item 'ultimaplaca' está definido no localStorage
    var ultimaPlaca = localStorage.getItem('ultimaplaca');
    if (ultimaPlaca !== null) {
        document.getElementById("dados").value = ultimaPlaca;
    } else {
        console.log("O item 'ultimaplaca' não está definido no localStorage.");
    }
}

function clearinput(){
    document.getElementById("dados").value = '';
    localStorage.setItem('ultimaplaca', '');

}
   

// Chama a função verificarLocalStorage quando a página é carregada
window.onload = function() {
    verificarLocalStorage();
};

         

         
        </script>
        <!-- Inclua o jQuery uma única vez -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!--====== Outros Javascripts & Jquery ======-->
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/meu.js"></script>
        <script src="js/main.js"></script>
</body>

</html>







</html>