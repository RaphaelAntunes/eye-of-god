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
        <nav class="navbar navbar-light bg-black d-flex">
            <div class="d-flex flex-row align-items-center justify-content-center text-center color-white">
                <p>Busque sem limites, tenha o controle em suas mãos <a href=""><span style="color: gold; ">Seja
                            VIP</span> <img style="margin-bottom: -7px;" src="img/coroa.png" alt=""></a>
                </p>

            </div>

        </nav>
        <div class="d-flex gif mt-5">
            <img src="img/giphy.gif" alt="">
        </div>

        @php
            if (!session('nome')) {
                echo '<div id="ativarvip">
            <div class="d-flex flex-column text-center justify-content-center align-items-center">
                <p style="padding: 10px; color: white;" id="aviso">Consulte informações <span
                        style="color: gold">VIP</span> sobre um veículo</p>
                <input type="text" id="dados" class="mb-4" value="" placeholder="Chave de ativação">
                <button onclick="consulta()">Ativar</button>
                <button class="mt-5 freetest " data-bs-toggle="modal" data-bs-target="#meuModal">Experimente
                    Grátis</button>

            </div>
        </div>';
            }
        @endphp



        @php
            if (session('nome')) {
                echo '<div id="pesquisa">
                <div class="d-flex flex-column text-center justify-content-center align-items-center">
                    <p style="padding: 10px; color: red;" id="aviso"></p>
                    <input type="text" id="dados" class="mb-4" value="qgm6c28" placeholder="Placa do Veículo">
                    <button onclick="autorizador();">Pesquisar</button>
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
                    <button type="button" class="btn" onclick="testegratis(1)">Teste Grátis</button>
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

                </form>
            </div>
            <div class="modal-content" id="part3modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Não perca o controle!</h5>
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
                                <p style="
                                top: 5px;
                                position: relative;
                                left: -33px;
                                color: #919191;
                                font-size:14px;
                            ">Acesso liberado na hora*</p>

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
        document.getElementById("part2modal").style.display = 'none';
        document.getElementById("part3modal").style.display = 'none';

        function testegratis(x) {

            if (x == 1) {
                document.getElementById("part3modal").style.display = 'none';
                document.getElementById("part2modal").style.display = 'block';
                document.getElementById("part1modal").style.display = 'none';
            } else if (x == 2) {
                document.getElementById("part3modal").style.display = 'block';
                document.getElementById("part2modal").style.display = 'none';
                document.getElementById("part1modal").style.display = 'none';
            } else {
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
                        document.getElementById("aviso").innerHTML =
                            'Não foi encontrado nenhum veículo com essa placa';
                        document.getElementById("showpesquisa").style.display = 'none';
                        document.getElementById("pesquisa").style.display = 'block';
                    } else {
                        exibirResultado(indiceAtual); // Exibe o primeiro resultado

                    }
                }
            });


        }


        function autorizador() {
            var csrfToken = "{{ csrf_token() }}";

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
                        testegratis(2);
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
