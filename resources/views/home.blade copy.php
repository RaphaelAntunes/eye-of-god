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
</head>

<body>



    <!-- As a heading -->

    <div class="d-flex justify-content-start align-items-center all flex-column">
        <nav class="navbar navbar-light justify-content-between bg-black d-flex" style="width:100%;">
            <div class="d-flex container flex-row align-items-center justify-content-between text-center color-white">

                <p id="top-ser-vip" class="d-none" onclick="telas(2)">Busque sem limites, tenha o controle em suas mãos
                    <span style="color: gold; ">Seja
                        VIP</span> <img style="margin-bottom: -7px;" src="img/coroa.png" alt="">
                </p>

                <p id="top-e-vip" class="d-none"><span style="color: gold; ">Você é VIP</span> <img
                        style="margin-bottom: -7px;" src="img/coroa.png" alt=""> </p>


                @php
                    
                    if (session('pro') == '1') {
                        echo "<a href='" . route('logout') . "'><p>Sair</p></a>";
                    }
                @endphp
            </div>


        </nav>
        @if ($errors->has('message'))
            <nav class="navbar navbar-light justify-content-center bg-black d-flex"
                style="width:100%; background-color: red; ">
                <div
                    class="d-flex container flex-row align-items-center justify-content-center text-center color-white">

                    <p style="color: white;font-weight:bold;">🚨{{ $errors->first('message') }}🚨</p>
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
                    <input type="text" maxlength="7" id="dados" class="mb-4" value="" placeholder="Placa do Veículo">
                    <button id="btnpesquisar2" class="d-none" style="background-color: gray; color: #c3c3c3; cursor:not-allowed" >Pesquisar</button>
                    <button id="btnpesquisar" onclick="autorizador()">Pesquisar</button>
                    <button id="btnativar"class="d-none" onclick="ativar_key()">Ativar</button>
                    <button id="btnativar2" class="d-none" style="background-color: gray; color: #c3c3c3; cursor:not-allowed" >Ativar</button>

                </div>
            </div>';
            }
        @endphp
        <div id="showpesquisa" style="background: black">
            <div class="showpesquisa d-flex flex-column justify-content-center align-items-center">
                <div class="d-flex flex-column flex-lg-row" style="align-items: self-start;">
                    <div style="width: 300px"
                        class="text-center mr-3 d-flex flex-column justify-content-center align-items-center">
                        <p id="contador">0/0</p>

                        <span>NOME:</span>
                        <p id="nome"></p>
                        <span>CPF:</span>
                        <p id="cpf"></p>
                        <span>MODELO:</span>
                        <p id="modelo"></p>
                        <span>PLACA:</span>
                        <p id="placa"></p>
                        <span>RENAVAM:</span>
                        <p id="renavam"></p>
                    </div>
                    <div style="width: 300px"
                        class="text-center d-flex flex-column justify-content-center align-items-center">

                        <span>LOCAL:</span>
                        <p id="local"></p>
                        <span>HORA E DATA:</span>
                        <p id="datahora"></p>
                        <span>RUA:</span>
                        <p id="rua"></p>
                        <span>MOTIVO:</span>
                        <p id="motivo"></p>
                        <span>OBS:</span>
                        <p id="complemento"></p>

                    </div>



                </div>
                <div class="d-flex justify-content-between mt-5">
                    <button class="controladores mr-3" id="anterior" onclick="mostrarAnterior()">Anterior</button>
                    <button class="controladores" id="proximo" onclick="mostrarProximo()">Próximo</button>
                </div>
                <button id="novaPesquisa" onclick="novaPesquisa()" class="mt-5">Nova pesquisa</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="part1modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style='font-weight: bold;'>NÃÃÃO PAGUE PARA TESTAR
                        !!! 🆓</h5>
                </div>
                <div class="modal-body">
                    <p>Aproveite agora um <b style='font-weight: bold;'>TESTE GRATUITO!</b><br><br>
                        Com nosso benefício, você tem direito a <b style='font-weight: bold;'>3 CONSULTAS GRATUITAS</b>
                        de veículos na região do <b style='font-weight: bold;'>RN e arredores.</b><br><br>
                        Deseja mais? Torne-se um apoiador e desbloqueie acesso ilimitado, informações em tempo real e
                        muito mais!</p>
                    <hr>
                    <p class="mt-2 mb-2" style="font-weight: bold ">Torne-se um apoiador e Seja VIP <img
                            style="margin-bottom: -7px; width:30px;" src="img/coroa.png" alt=""></p>
                    <p>Seja um VIP! Tornando-se um apoiador, você terá o controle nas suas mãos e acesso a um mundo de
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
                            <input type="text" name="nome" minlength="5" class="inputtest mt-2"
                                placeholder="Digite seu nome" required>
                            <input type="email" name="email" class="inputtest mt-2"
                                placeholder="Digite seu e-mail" required>
                            <input type="text" name="telefone" class="inputtest mt-2" placeholder="WhatsApp"
                                required>
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
                    <h5 class="modal-title" style="font-weight: bold;" id="exampleModalLabel">Entre em sua conta</h5>
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
                            <input type="email" name="email" class="inputtest mt-2"
                                placeholder="Digite seu email" required>
                            <input type="password" name="senha" class="inputtest mt-2" placeholder="Senha"
                                required>

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
                            <input type="text" name="nome" class="inputtest mt-2"
                                placeholder="Digite seu nome" required>
                            <input type="email" name="email" class="inputtest mt-2"
                                placeholder="Digite seu email" required>
                            <input type="text" name="whatsapp" class="inputtest mt-2" placeholder="Whatsapp"
                                required>
                            <input type="password" name="senha" class="inputtest mt-2" placeholder="Senha"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn">Cadastrar</button>
                    </div>
                </form>

                </form>
            </div>
            <div class="modal-content" id="part3modal">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Não perca o controle!
                    </h5>
                    <p style="
                    margin: 0px !important;
                    padding: 8px !important;
                    background: #00a86b;
                    color: white;
                    border-radius: 17px;
                    cursor: pointer;
                "
                        onclick="telas(3)">
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
                    <div
                        style="
                    position: relative;
                    top: -51px;
                    left: 31px;
                    height:155px;
                ">
                        <div>
                            <p
                                style="
                        position: relative;
                        left: 34px;
                        top: 74px;
                        font-weight: bold;
                        color: #c3c3c3;

                    ">
                                de: </p>
                            <img style="margin-bottom: -7px;width: 55px;position: relative;top: 43px;left: -25px;"
                                src="img/coroa.png" alt="">
                            <p
                                style="
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

                                80,00</p>

                        </div>
                        <div>
                            <p
                                style="
                        position: relative;
                        left: 27px;
                        top: 1px;
                        font-weight: bold;
                    ">
                                por apenas: </p>
                            <p
                                style="
                        font-size: 44px;
                        font-weight: bold;
                        color: #00a86b;

                    ">
                                14,99</p>
                            <p
                                style="
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
                    <button type="button" class="btn" onclick="sejaApoiador()">Torne-se um Apoiador
                        VIP</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById("part1modal").style.display = 'none';
        document.getElementById("part2modal").style.display = 'none';
        document.getElementById("part3modal").style.display = 'none';
        document.getElementById("part4modal").style.display = 'none';
        document.getElementById("part5modal").style.display = 'none';
        document.getElementById("part6modal").style.display = 'none';

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
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json' // Defina o cabeçalho Accept para JSON

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

        document.getElementById("showpesquisa").style.display = 'none';
        document.getElementById("anterior").style.display = 'none';
        document.getElementById("proximo").style.display = 'none';

        function consulta() {
            var dados = new FormData();
            var xyz = document.getElementById("dados").value;
            dados.append('xyz', xyz);
            var url = '/api/placa/' + encodeURIComponent(xyz);


            $.ajax({
                url: url,
                method: 'get',
                data: dados,
                contentType: false,
                processData: false,
                success: function(data) {
                    resultados = data.Data; // Armazena os resultados no array
                    if (resultados.length === 0) {
                        alert.innerHTML =
                            'Não foi encontrado nenhum veículo com essa placa';
                        document.getElementById("showpesquisa").style.display = 'none';
                        document.getElementById("pesquisa").style.display = 'block';
                        ses_pesq();
                    } else {
                        exibirResultado(indiceAtual); // Exibe o primeiro resultado
                        btnpesquisar2.classList.add("d-none");
                        btnpesquisar.classList.remove("d-none");
                    }
                }
            });


        }

        function ativar_key() {
            var csrfToken = "{{ csrf_token() }}";

            if (inputdados.value.length < 7) {
                inputdados.focus();
                document.getElementById("aviso").innerHTML =
                    'Preencha o campo abaixo';

                return;
            }

            // btnativar.classList.add("d-none");
            // btnativar2.classList.remove("d-none");

            var dados = new FormData();
            var id = @json(session('email'));
            dados.append('chave', inputdados.value);
            dados.append('id', id);

            var url = '/ativar-vip/';

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
                    if (data == 200) {
                        ses_pesq();
                        telas(6);

                    } else if (data == 202) {
                        telas(7);
                    } else if (data == 303) {
                        alert.innerHTML = 'A conta já existe, faça login';

                    } else {

                        alert.innerHTML = 'A chave inserida não é válida';
                    }
                }
            });
        }




        function autorizador() {
            var csrfToken = "{{ csrf_token() }}";

            if (inputdados.value.length < 7) {
                inputdados.focus();
                document.getElementById("aviso").innerHTML =
                    'Preencha o campo abaixo';

                return;
            }

            btnpesquisar.classList.add("d-none");
            btnpesquisar2.classList.remove("d-none");

            var dados = new FormData();
            var id = @json(session('email'));
            dados.append('id', id);
            var url = '/api/free-test/';

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
                    if (data == 200) {
                        consulta();

                    } else {
                        $('#meuModal').modal('show');
                        console.log("nao pode");
                        ses_atv()
                        telas(2);
                        localStorage.setItem('atv_on', 1);

                    }
                }
            });
        }



        function exibirResultado(indice) {
            var resultado = resultados[indice];
            document.getElementById("aviso").innerHTML = '';
            document.getElementById("pesquisa").style.display = 'none';
            document.getElementById("showpesquisa").style.display = 'flex';
            document.getElementById("nome").innerHTML = resultado.nome;
            document.getElementById("cpf").innerHTML = resultado.cpf;
            document.getElementById("modelo").innerHTML = resultado.modelo;
            document.getElementById("placa").innerHTML = resultado.placa + ' / ' + resultado.estado;
            document.getElementById("renavam").innerHTML = resultado.renavam;

            var dados = new FormData();
            dados.append('documento', resultado.documento);

            $.ajax({
                url: 'request.php',
                method: 'post',
                contentType: false,
                processData: false,
                data: dados,
                success: function(data) {

                    console.log(data);
                    resultado = data.split('%');
                    exibirInfos(resultado);

                }
            });

            // Atualiza o contador
            var contador = "Registro: " + (indice + 1) + "/" + resultados.length;
            document.getElementById("contador").textContent = contador;

            // Mostra ou oculta os botões "Anterior" e "Próximo" com base no índice atual
            if (indiceAtual === 0) {
                document.getElementById("anterior").style.display = 'block';
                document.getElementById("anterior").style.background = 'grey';
                document.getElementById("proximo").style.display = 'block';
                document.getElementById("proximo").style.background = '#00a86b';
            } else if (indiceAtual === resultados.length - 1) {
                document.getElementById("anterior").style.display = 'block';
                document.getElementById("anterior").style.background = '#00a86b';
                document.getElementById("proximo").style.display = 'block';
                document.getElementById("proximo").style.background = 'grey';
            } else {
                document.getElementById("anterior").style.display = 'block';
                document.getElementById("anterior").style.background = '#00a86b';
                document.getElementById("proximo").style.display = 'block';
                document.getElementById("proximo").style.background = '#00a86b';
            }
        }




        function mostrarAnterior() {
            if (indiceAtual > 0) {
                indiceAtual--; // Decrementa o índice
                exibirResultado(indiceAtual); // Exibe o resultado anterior
            }
        }

        function mostrarProximo() {
            if (indiceAtual < resultados.length - 1) {
                indiceAtual++; // Incrementa o índice
                exibirResultado(indiceAtual); // Exibe o próximo resultado
            }
        }

        function exibirInfos(x) {
            document.getElementById("local").innerHTML = x[0];
            document.getElementById("datahora").innerHTML = x[1];
            document.getElementById("rua").innerHTML = x[2];
            document.getElementById("motivo").innerHTML = x[3];
            document.getElementById("complemento").innerHTML = x[4];
        }

        function novaPesquisa() {
            resultados = []; // Limpa os resultados
            indiceAtual = 0; // Reinicia o índice
            document.getElementById("dados").value = ''; // Limpa o campo de pesquisa
            document.getElementById("aviso").innerHTML = '';
            document.getElementById("showpesquisa").style.display = 'none';
            document.getElementById("pesquisa").style.display = 'block';
            document.getElementById("anterior").style.display = 'none';
            document.getElementById("proximo").style.display = 'none';
        }
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
