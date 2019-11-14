<?php
    session_start();
    if(isset($_SESSION['perfil'])):
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
    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#formesqueceusenha').submit(function(event) {
             event.preventDefault();
             // seleciona o botão de submit
             var botao = $(this).find('input[type="submit"]');
             // desabilita o botão para evitar multiplos envio
             botao.prop("disabled", true).val("Enviando..").css('opacity', '0.5');
             data = $("#formesqueceusenha").serialize();
             $.ajax({
                type: "post",
                url: $(this).attr('action'),
                dataType: "json",
                data: data,
            }).done(function(data){
                alert(data.status);
                $('#formesqueceusenha')[0].reset();
                botao.prop("disabled", false).val("Enviar").css('opacity', '1');
            });
        });
    });
    </script>

</head>

<style>
    body,
    html {
        background-image: url('imagens/Foto10.png');
    }

</style>

<body>

    <?php include 'topo_adm.php'; ?>

    <div class="container-fluid">

        <div class="container-fluid float-left" id="main">
                <div class="d-flex justify-content-center h-100">
                    <div class="card">
                        <div class="card-body" style="background-color:#363636;">
                            <form id="formesqueceusenha" action="bd/envianovasenha.php">
                                <br><br>
                                <label class="text-center" style="color:white">Digite seu email abaixo e nós enviaremos um link para redefinir sua senha </label>
                                <br><br><br>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <br><br><br>
                                <div class="form-group">
                                    <input id="btnenviaremail" name="btnenviaremail" type="submit" value="Enviar" class="btn float-right login_btn">
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            <!------ Fim Modal Esqueceu senha ----->
        </div>
    </div>
</body>
</html>
