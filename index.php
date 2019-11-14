<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Maurício Luminárias</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Folha de Estilo -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
        atualizar();
        $('#formComentario').submit(function(event) {
            event.preventDefault();
            // seleciona o botão de submit
            var botao = $(this).find('input[type="submit"]');
            // desabilita o botão para evitar multiplos envio
            botao.prop("disabled", true).val("Enviando..").css('opacity', '0.5');
            data = $("#formComentario").serialize();
            $.ajax({
                type: "post",
                url: "bd/_enviarComentario_.php",
                data: data,
                success: function(data){
                    if(data === "sucesso"){
                        $("#resposta_ajax").removeClass("alert-danger").addClass("alert-success").css('display', 'block').html("Comentário inserido com sucesso");
                        $('#formComentario')[0].reset();
                    } else{
                        $("#resposta_ajax").removeClass("alert-success").addClass("alert-danger").css('display', 'block').html(data);
                    }
                    botao.prop("disabled", false).val("Enviar").css('opacity', '1');
                }
            });
        });
    });

//     // Quando carregar a página
//    $(function() {
//        // Faz a primeira atualização
//        atualizar();
//    });
    
    function atualizar(){
        // Fazendo requisição AJAX
        $.post('bd/exibirComentarios.php', function (comentario) {
            // Exibindo comentario
            $('#nome').html(comentario.nome);
            $('#comentario').html(comentario.comentario);
            $('#data').html(comentario.data + ' dias atrás');
            $('#teste').attr('checked', false);
            $('#teste1').attr('checked', false);
            $('#teste2').attr('checked', false);
            $('#teste3').attr('checked', false);
            $('#teste4').attr('checked', false);
            $('#teste5').attr('checked', false);
            if(comentario.nota == 1){
                $('#teste1').attr('checked', true);
            }else if(comentario.nota == 2){
                $('#teste2').attr('checked', true);
            }else if(comentario.nota == 3){
                $('#teste3').attr('checked', true);
            }else if(comentario.nota == 4){
                $('#teste4').attr('checked', true);
            }else if(comentario.nota == 5){
                $('#teste5').attr('checked', true);
            }               
        }, 'JSON');
    }

    // Definindo intervalo em que a função será chamada
    setInterval("atualizar()", 5000); 

    </script>
    

</head>

<body>

    <!-- ===========1º Container - Principal =========== -->
    <div class="box" id="container1">
        <?php include 'topo.php'; ?>
        <div class="d-flex justify-content-end" style="height: 68%;">
            <div class="d-flex align-items-center" id="C1main" style="width:50%;">
                <div>
                    <h1 class="h1-principal display-lg-3">Luminárias Artesanais</h1>
                    <p>As melhores luminárias artesanais do Rio de Janeiro.</p>
                    <div id="cliqueAqui">
                        <a class="btn btn-md border border-dark mt-2" href="galeria.php" style="font-weight: bold;">Ver luminárias</a>
                        <a class="btn btn-md border border-dark mt-2" href="pre_encomenda.php" style="font-weight: bold;">Encomendar</a>
                    </div>
                </div>
            </div>
        </div>
        <div >
            <ul style="list-style:none;" id="redeSociais">
                <li class="mt-2"><a class="text-white" href="https://www.instagram.com/mauricioluminarias/"><img src="imagens/insta.png" style="width:40px;" alt=""></a></li>
                <li class="mt-2"><a class="text-white" href="https://www.facebook.com/mauricio.luminarias.5"><img src="imagens/face.png" style="width:40px;" alt=""></a></li>
                <li class="mt-2"><a class="text-white" href=""><img src="imagens/email.png" style="width:40px;" alt=""></a></li>
                <li class="mt-2"><a class="text-white" href="https://api.whatsapp.com/send?phone=5522988465242&text=Ol%C3%A1%2C%20tenho%20interesse%20em%20adquirir%20seus%20produtos"><img src="imagens/whats.png" style="width:40px;" alt=""></a></li>
            </ul>
        </div>
    </div>

    <!-- ===========2º Container - Fotos =========== -->
    <div class="container box2 pb-4" id="container2">
        <section class="container" id="carousel1">
            <!--Carousel Wrapper-->
            <div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2" data-ride="carousel">

                <!--Controls-->
                <div class="controls-top d-flex justify-content-center">
                    <a class="text-dark" href="#multi-item-example" data-slide="prev"><i class="fas fa-arrow-circle-left fa-2x p-3"></i></a>
                    <a class="text-dark" href="#multi-item-example" data-slide="next"><i class="fas fa-arrow-circle-right fa-2x p-3"></i></a>
                </div>
                <!--/.Controls-->

                <!--Slides-->
                <div class="carousel-inner" role="listbox">

                    <!--First slide-->
                    <div class="carousel-item active">

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini3.png" alt="Card image cap"></a>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini4.png" alt="Card image cap"></a>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini6.png" alt="Card image cap"></a>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini7.png" alt="Card image cap"></a>
                            </div>
                        </div>

                    </div>
                    <!--/.First slide-->

                    <!--Second slide-->
                    <div class="carousel-item">

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini8.png" alt="Card image cap"></a>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini9.png" alt="Card image cap"></a>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini10.png" alt="Card image cap"></a>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <a href="galeria.php"><img class="img-fluid" src="imagens/Low/Mini15.png" alt="Card image cap"></a>
                            </div>
                        </div>

                    </div>
                    <!--/.Second slide-->

                </div>
                <!--/.Slides-->

            </div>
            <!--/.Carousel Wrapper-->
        </section>
    </div>

    <div class="container box2 pb-4" id="container2">
        <section class="container" id="carousel2">
            <!--Carousel Wrapper-->
            <div id="multi-item-example2" class="carousel slide carousel-multi-item carousel-multi-item-2" data-ride="carousel">

                <!--Controls-->
                <div class="controls-top d-flex justify-content-center">
                    <a class="text-dark" href="#multi-item-example2" data-slide="prev"><i class="fas fa-arrow-circle-left fa-2x p-3"></i></a>
                    <a class="text-dark" href="#multi-item-example2" data-slide="next"><i class="fas fa-arrow-circle-right fa-2x p-3"></i></a>
                </div>
                <!--/.Controls-->

                <!--Slides-->
                <div class="carousel-inner" role="listbox">

                    <!--First slide-->
                    <div class="carousel-item active">

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <img class="img-fluid" src="imagens/Low/Mini3.png" alt="Card image cap">
                            </div>
                        </div>

                    </div>
                    <!--/.First slide-->

                    <!--Second slide-->
                    <div class="carousel-item">

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <img class="img-fluid" src="imagens/Low/Mini4.png" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                    <!--/.Second slide-->
                    <!--third slide-->
                    <div class="carousel-item">

                        <div class="col-md-3 mb-3">
                            <div class="card" id="zoom">
                                <img class="img-fluid" src="imagens/Low/Mini6.png" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                    <!--/.third slide-->

                </div>
                <!--/.Slides-->

            </div>
            <!--/.Carousel Wrapper-->
        </section>
    </div>
    <!-- ===========3º Container - Comentários =========== -->
    <div class="box" id="container3" style="align-items: center;">
        <div class="row d-flex" style="color:white;align-items:center;height:100%;">
            <div class="col-lg-6">
                <div class="ml-4 mb-4">
                    <h4>Comentários mais relevantes:</h4>
                </div>

                <div class="card ml-4 mr-4 d-block" style="border: solid 1px; opacity: 0.5;min-width: 400px;" id="comentarioPai">
                    <div class="row">
                        <div  class="col-sm-8 balao d-flex mt-1" id="ocultar">
                            <p id="nome" class="text-dark text-start"></p>
                        </div>
                        <div class="col" >
                            <div class="estrelas mt-1 text-dark text-center">
                                <input type="radio" id="teste" name="nota" value="" checked="checked">
                                
                                <label for="teste1"><i class="fa estrelaLabel ml-1"></i></label>
                                <input type="radio" id="teste1" value="1" disabled="disabled">
                                
                                <label for="teste2"><i class="fa estrelaLabel ml-1"></i></label>
                                <input type="radio" id="teste2" value="2" disabled="disabled">
                                
                                <label for="teste3"><i class="fa estrelaLabel ml-1"></i></label>
                                <input type="radio" id="teste3" value="3" disabled="disabled">
                                
                                <label for="teste4"><i class="fa estrelaLabel ml-1"></i></label>
                                <input type="radio" id="teste4"value="4" disabled="disabled">
                                
                                <label for="teste5"><i class="fa estrelaLabel ml-1"></i></label>
                                <input type="radio" id="teste5" value="5" disabled="disabled">
                                
                                
                            </div>
                        </div>
                    </div>

                    <div class="ml-2">
                        <p id="data" class="text-dark blockquote-footer"></p>
                    </div>

                    <div class="row container">
                        <div class="col-8" style="padding-left:-10px;">
                            <p id="comentario" class="text-justify text-dark" style="opacity: 0.9;"></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <br>
                <form id="formComentario" class="form form-group p-4 pb-5 mr-4 ml-4" method="post" style="border-radius: 5px;background-color:rgba(192,192,192,0.3);">
                    <div id="resposta_ajax" class="alert" style="display:none;"></div>

                    <label for="exampleFormControlTextarea6" class="d-block">Digite Seu Nome: *</label>
                    <input type="text" class=" form-control z-depth-1" maxlength="100" style="border: solid 1px; opacity: 0.5;" rows="3" name="nome" required placeholder="João de Souza">

                    <label for="exampleFormControlTextarea6" class="d-block">Digite Seu Email: *</label>
                    <input type="email" class=" form-control z-depth-1" maxlength="100" name="email" id="exampleFormControlTextarea6" style="border: solid 1px; opacity: 0.5;" rows="3" required placeholder="Seuemail@email.com">

                    <div class="form-group shadow-textarea">
                        <label for="exampleFormControlTextarea6">Deixe seu feedback abaixo: *</label>
                        <textarea class="form-control z-depth-1" maxlength="255" name="comentario" id="exampleFormControlTextarea6" minlength="6" maxlength="255" style="border: solid 1px; opacity: 0.5;" rows="3" required placeholder="Deixe seu elogio, ou faça uma crítica construtiva.."></textarea>
                    </div>
                    <div class="align-items-center mt-4"><h6>Dê sua nota:</h6>   
                        <div class="estrelas">
                            <input type="radio" id="cm_star-empty" name="nota" value="" required checked/>
                            <label for="cm_star-1"><i class="fa estrelaLabel ml-1"></i></label>
                            <input type="radio" id="cm_star-1" name="nota" required value="1"/>
                            <label for="cm_star-2"><i class="fa estrelaLabel ml-1"></i></label>
                            <input type="radio" id="cm_star-2" name="nota" value="2" required/>
                            <label for="cm_star-3"><i class="fa estrelaLabel ml-1"></i></label>
                            <input type="radio" id="cm_star-3" name="nota" value="3" required/>
                            <label for="cm_star-4"><i class="fa estrelaLabel ml-1"></i></label>
                            <input type="radio" id="cm_star-4" name="nota" value="4" required/>
                            <label for="cm_star-5"><i class="fa estrelaLabel ml-1"></i></label>
                            <input type="radio" id="cm_star-5" name="nota" value="5" required/>
                        </div>
<!--
                    <div id="recaptcha" class="g-recaptcha pt-4" data-sitekey="6LddWMAUAAAAADRCg4WisruBXquj-6cnR9lgyVKo"></div>
                    <span class="msg-error error"></span>
-->
                    </div>
                    <div class="form-group">
                        <input id="btnenviar" name="btnenviar" type="submit" class="btn bg-light float-right login_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- =========== 4º Container - Sobre Maurício =========== -->
    <div class="container box2 pt-2 mt-4" id="container4">
        <section class="pr-5">
            <div class="accordion" id="accordionExample">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-header" style="background-color:#FFA500" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-light nav-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <i class="fas fa-hand-point-up mr-3"></i>Saiba mais:
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="d-flex">
                            <img width="186" height="186" id="ocultar" src="imagens/Foto5.png" class="d-flex justify-content-center pt-2" />
                            <div class="card-body font-italic text-justify float-right">
                                A empresa Maurício Luminárias foi criada em 1994, tendo como fundador, José Maurício Perciliano. Iniciou seus trabalhos com carpete e marchetaria. Logo depois, entrou no negócio de luminárias artesanais tendo como público alvo turistas que visitam a sua cidade, Casimiro de Abreu - RJ. Atualmente seus produtos são fábricados em sua casa que fica em Cabo Frio - RJ e sua loja física localiza-se na Av. Amaral Peixoto 395 - Barra de São João. Mais de 25 anos no mercado o seu Maurício se tornou um grande artista se tornando referência em sua região.
                            </div>
                        </div>
                    </div>
                    <div id="DIVMaps">
                        <div class="d-flex justify-content-center">
                            <div class="mt-3">
                                <h1 class="text-center">Visite minha loja <i class="fas fa-map-marked-alt ml-2"></i></h1>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <a href="">Av. Amaral Peixoto 395, Barra de São João - RJ <i class="fas fa-hand-point-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- JavaScript (Opcional)  -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>
