<?php 
    session_start();
    if(!isset($_SESSION['perfil'])){
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

    <!-- Folha de Estilo -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/admStyle.css">

    <title>Maurício Luminárias</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        $(document).ready(function() {
            $('#formAlterarSenha').submit(function(event) {
                event.preventDefault();
                // seleciona o botão de submit
                var botao = $(this).find('input[type="submit"]');
                var id = $("#id").val();
                // desabilita o botão para evitar multiplos envio
                botao.prop("disabled", true).val("Enviando..").css('opacity', '0.5');
                data = $("#formAlterarSenha").serialize();
                $.ajax({
                    type: "post",
                    url: "bd/alteraSenha.php",
                    data: data + '&id=' + id,
                    success: function(data) {
                        if(data === "sucesso"){
                        $("#resposta_ajax").removeClass("alert-danger").addClass("alert-success").css('display', 'block').html("Senha alterada com sucesso");
                        $('#formAlterarSenha')[0].reset();
                    } else{
                        $("#resposta_ajax").removeClass("alert-success").addClass("alert-danger").css('display', 'block').html(data);
                    }
                        botao.prop("disabled", false).val("Alterar").css('opacity', '1');
                    }
                });
            });
        });
    </script>
</head>

<body>    
    <?php include 'topo_adm.php'; ?>
    <div class="container-fluid animated zoomIn">
        <div class="container-fluid float-left">
            <div class="d-flex justify-content-center h-100">
                <div class="card mt-5 h-100" style="width: 400px;">
                    <div class="card-header">
                        <div class="d-flex justify-content-center social_icon">
                            <span><i class="fas fa-fw fa-key fa-3x"></i></span>
                            <h5 class="mt-2 ml-2">Alterar Senha</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="resposta_ajax" class="alert" style="display:none"></div>
                        <form id="formAlterarSenha" method="post">
                            <input id="id" type="hidden" value="<?php echo $_SESSION['id'];?>">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input name="senhanova" type="password" class="form-control" placeholder="Senha nova" required minlength="6" maxlength="8">
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input name="confirmasenhanova" type="password" class="form-control" placeholder="Confirmar Senha nova" required minlength="6" maxlength="8">
                            </div>
                            <div class="card-footers mb-2">
                                <div class="d-flex justify-content-end links">
                                    <input name="btneditar" type="submit" class="btn btn-warning" value="Alterar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>