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
            $('#formEditaUsuario').submit(function(event) {
                event.preventDefault();
                // seleciona o botão de submit
                var botao = $(this).find('input[type="submit"]');
                var id = $("#id").val();
                // desabilita o botão para evitar multiplos envio
                botao.prop("disabled", true).val("Enviando..").css('opacity', '0.5');
                data = $("#formEditaUsuario").serialize();
                $.ajax({
                    type: "post",
                    url: "bd/editaUsuario.php",
                    data: data + '&id_usuario=' + id,
                    success: function(data) {
                        if(data === "sucesso"){
                        $("#resposta_ajax").removeClass("alert-danger").addClass("alert-success").css('display', 'block').html("Alterações realizadas com sucesso");
                    } else{
                        $("#resposta_ajax").removeClass("alert-success").addClass("alert-danger").css('display', 'block').html(data);
                    }
                        botao.prop("disabled", false).val("Atualizar").css('opacity', '1');
                    }
                });
            });
        });

    </script>
</head>

<body>

    <?php
    include 'topo_adm.php';
    include 'dashboard.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        include 'bd/conexao.php';
        $sql = "SELECT * FROM usuarios WHERE id_usuario=".$id;
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);   
    }
    ?>
    <div class="container-fluid animated zoomIn">
        <div class="container-fluid float-left">
            <div class="d-flex justify-content-center h-100">
                <div class="card mt-5 h-100" style="width: 400px;">
                    <div class="card-header">
                        <div class="d-flex justify-content-center social_icon">
                            <span><i class="fas fa-fw fa-user fa-3x"></i></span>
                            <h5 class="mt-2 ml-2">Editar Usuário</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="resposta_ajax" class="alert" style="display:none"></div>
                        <form id="formEditaUsuario" method="post">
                            <input id="id" type="hidden" value="<?php echo $row['id_usuario'];?>">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="nome" class="form-control" value="<?php echo $row['nome'];?>" required>
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'];?>" required>
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
                                    <input name="btneditar" type="submit" class="btn btn-warning" value="Atualizar">
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
