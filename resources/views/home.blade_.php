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
                            VIP</span> <img style="margin-bottom: -7px;" src="img/coroa.png" alt=""></a> <?php $nome = session('nome');
echo $nome;                            ?>

                </p>

            </div>

        </nav>
        <div class="d-flex gif mt-5">
            <img src="img/giphy.gif" alt="">
        </div>
        <div id="pesquisa">
            <div class="d-flex flex-column text-center justify-content-center align-items-center">
                <p style="padding: 10px; color: white;" id="aviso">Consulte informações <span
                        style="color: gold">VIP</span> sobre um veículo</p>
                <input type="text" id="dados" class="mb-4" value="" placeholder="Chave de ativação">
                <button onclick="consulta()">Ativar</button>
                <button class="mt-5 freetest " data-bs-toggle="modal" data-bs-target="#meuModal">Experimente
                    Grátis</button>

            </div>
        </div>
        <div id="pesquisa" class='d-none'>
            <div class="d-flex flex-column text-center justify-content-center align-items-center">
                <p style="padding: 10px; color: red;" id="aviso"></p>
                <input type="text" id="dados" class="mb-4" value="" placeholder="Placa do Veículo">
                <button onclick="consulta()">Pesquisar</button>
            </div>
        </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Teste Grátis</h5>
                </div>
                <div class="modal-body">
                    <p>Isso mesmo !!! Estamos te oferecendo um <b style="font-weight: bold;">TESTE
                            GRÁTIS.</b><br><br>Nosso benefício te dá direito a <b style="font-weight: bold;">3
                            TENTATIVAS</b> bem sucedidas de consulta a veiculos do <b style="font-weight: bold;">RN e
                            Região.</b><br><br> Após isso, para continuar usando nossos benefícios você deve se tornar
                        um apoiador.</p>
                    <hr>
                    <p class="mt-2" style="font-weight: bold">Torne-se um apoiador e Seja VIP <img
                            style="margin-bottom: -7px; width:30px;" src="img/coroa.png" alt=""></p>
                    <p>Tornando-se um apoiador, você pode fazer quantas consultas quiser e ter o controle nas suas
                        mãos.<br><br><span class="mr-2">•</span>Identifique carros e seus condutores em tempo real de
                        onde estiver. <br><br>
                        <span class="mr-2">•</span>Tenha informações precisas e que podem te ajudar em diversas
                        situações
                    </p> <br>
                    <span class="mr-2">•</span>Consultas por nome e CPF também estão disponíveis</p><br>
                    <span class="mr-2">•</span>Novas atualizações sem custo adicional</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" onclick="testegratis(1)">Teste Grátis</button>
                </div>
            </div>
            <div class="modal-content" id="part2modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Teste Grátis</h5>
                </div>

                <form method="post" action="{{route('free-test')}}">
                @csrf  
                <div class="modal-body">
                    <P>Precisamos de apenas alguns dados.<br>Ao preencher será liberado automaticamente<br><br></P>
                    <div class="d-flex flex-column">
                        <input type="text" name="nome" minlength="5" class="inputtest mt-2" placeholder="Digite seu nome" required>
                        <input type="email" name="email" class="inputtest mt-2" placeholder="Digite seu e-mail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn">Iniciar Teste</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById("part2modal").style.display = 'none';

        function testegratis(x) {

            if (x == 1) {
                document.getElementById("part2modal").style.display = 'block';
                document.getElementById("part1modal").style.display = 'none';

            } else {
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
