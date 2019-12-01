<?php
    session_start();
    if(isset($_SESSION['logado'])):
       header('Location: adm.php');
       exit;
    endif;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Maurício Luminárias</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/LoginEstilo.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
    $(document).ready(function() {
        $('#formLogar').submit(function(event) {
            event.preventDefault();
            // seleciona o botão de submit
            var botao = $(this).find('input[type="submit"]');
            // desabilita o botão para evitar multiplos envio
            botao.prop("disabled", true).val("Entrando..").css('opacity', '0.5');
            data = $("#formLogar").serialize();
            $.ajax({
                type: "post",
                url: "bd/logar.php",
                data: data,
                success: function( data ){
                    if(data === "sucesso"){
                        window.location="adm.php";
                    }else{
                        $("#resposta_ajax").addClass("alert alert-danger").html(data);
                    }
                    botao.prop("disabled", false).val("Entrar").css('opacity', '1');
                }
            });
        });
        
        $('#show_senha').click(function(e) {
            e.preventDefault();
            if ( $('#senha').attr('type') == 'password' ) {
                $('#senha').attr('type', 'text');
                $('#show_senha').attr('class', 'fa fa-eye');
            } else {
                $('#senha').attr('type', 'password');
                $('#show_senha').attr('class', 'fa fa-eye-slash');
            }
        });
    });
    </script>
</head>

<style>
    body,
    html {
        background-image: url('imagens/Foto9.png');
    }

</style>

<body>

    <?php include 'topo.php'; ?>

    <div class="container-fluid">

        <div class="container-fluid float-left" id="main">

            <!------ Início Conteúdo ----->
            <div class="d-flex justify-content-center h-100">
                <div class="card h-100">
                    <div class="card-header">
                        <h3><img src="imagens/logo.png" style="width: 50px;" alt=""></h3>
                    </div>

                    <div class="card-body">
                        <div id="resposta_ajax"></div>
                        <br>
                        <form id="formLogar" method="post">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input name="email" type="email" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha" required autocomplete="off">
                                <button type="button" id="show_senha" name="show_senha" class="fa fa-eye-slash"></button>
                            </div>

                            <div class="row align-items-center remember">
                                <input type="checkbox" id="autoSizingCheck">Lembrar-me
                            </div>

                            <div class="form-group">
                                <input id="btnlogar" name="btnlogar" type="submit" value="Entrar" class="btn float-right login_btn">
                            </div>
                        </form>
                    </div>
                    <div class="card-footers mb-2">
                        <div class="d-flex justify-content-center">
                            <a href="esqueceuSenha.php">Esqueceu sua senha?</a>
                        </div>
                    </div>
                </div>
            </div>
            <!------ Fim Conteúdo ----->
        </div>
    </div>
</body>
</html>
