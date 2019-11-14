<?php
    session_start();
    if(!isset($_SESSION['logado'])){
        header('Location: login.php');
        exit;
    }
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

    <!-- Folha de Estilo -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/admStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
    $(document).ready(function() {
        $('#formCadastro').submit(function(event) {
            event.preventDefault();
            // seleciona o botão de submit
            var botao = $(this).find('input[type="submit"]');
            // desabilita o botão para evitar multiplos envio
            botao.prop("disabled", true).val("Cadastrando..").css('opacity', '0.5');
            data = $("#formCadastro").serialize();
            $.ajax({
                type: "post",
                url: "bd/gravar.php",
                data: data,
                success: function( data ){
                    if(data === "sucesso"){
                        $("#resposta_ajax").removeClass("alert-danger").addClass("alert-success").css('display', 'block').html("Cadastro realizado com sucesso");
                        $('#formCadastro')[0].reset();
                    } else{
                        $("#resposta_ajax").removeClass("alert-success").addClass("alert-danger").css('display', 'block').html(data);
                    }
                    botao.prop("disabled", false).val("Cadastrar").css('opacity', '1');
                }
            });
        });
    });
    </script>
</head>

<body>

    <?php include 'topo_adm.php'; ?>
    <?php include 'dashboard.php'; ?>

    <div class="container-fluid animated zoomIn">

        <div class="container-fluid float-left" id="main">

            <!------ Início Conteúdo ----->
            <div class="d-flex justify-content-center h-100">

                <div class="card mt-5 h-100 " style="width: 400px;">

                    <div class="card-header">
                        <div class="d-flex justify-content-center social_icon">
                            <span><i class="fas fa-fw fa-user fa-3x"></i></span>
                            <h5 class="mt-2 ml-2">Cadastrar Usuário</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="resposta_ajax" class="alert" style="display:none"></div>
                        <form id="formCadastro" method="post">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="senha" class="form-control" placeholder="Senha" minlength="6" maxlength="8" required autocomplete="off">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="confirmasenha" class="form-control" placeholder="Confirmar Senha" minlength="6" maxlength="8" required autocomplete="off">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                </div>
                                <select class="form-control" name="perfil" required>
                                    <option value="" disabled selected>- Selecione -</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Funcionário">Funcionário</option>
                                </select>
                            </div>

                            <div class="card-footers mb-2">
                                <div class="d-flex justify-content-end links">
                                    <input value="Cadastrar" name="btncadastro" type="submit" style="font-weight: bold;" class="btn btn-warning">
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

                <!------ Fim Conteúdo ----->
            </div>
        </div>
    </div>
</body>
</html>
