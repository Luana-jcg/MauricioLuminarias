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
    
    <title>Mauricio Luminárias</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#listar-usuarios').DataTable({
            responsive: true,
            "scrollX": true,
            "columnDefs": [
                {"targets": 0, "searchable": false},
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        });
        
        $(".deletarUsuario").click(function(){
            if(confirm('Excluir usuário?')){
                var nome = $(this).parent().parent().find(':nth-child(2)').html();  
                var id = $(this).parent().parent().find(':nth-child(1)').html();  
                $.ajax({
                    url: 'bd/deletarUsuario.php',
                    type: 'POST',
                    data: 'nome='+nome+'&id='+id,
                    success: function(data){
                        $("#resposta_ajax").addClass("alert alert-success").css('display', 'block').html(data);
                    }
                });
            }
        });
    });
    </script>
</head>
<body>
    <?php include 'topo_adm.php' ?>

    <?php include 'dashboard.php'; ?>
    <div class="container animated zoomIn" >
        <br>
        <div class="row">
            <div class="col">
                <div class="card-header">
                    <div class="d-flex justify-content-center social_icon">
                        <span><i class="fas fa-fw fa-users fa-3x"></i></span>
                        <h5 class="mt-2 ml-2">Lista de Usuários</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col d-flex justify-content-end">
            <div class="btn btn-light">
                <span style="color: blue" class="mr-2"><i class="fas fa-plus"></i></span>
                <a href="cadastro_adm.php" style="text-decoration:none; color:blue">Adicionar Usuário</a>
            </div>
        </div>
        <br>
        <div id="resposta_ajax" class="alert" style="display:none"></div>
        <form action="" method="post">
            <table id="listar-usuarios" class="table table-bordered hover" style="width:100%">
                <thead class="text-light" style="background-color:#343a40">
                    <th style="display:none">Código</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>
                <tbody>
                    <?php
                    include 'bd/conexao.php';

                    $query = mysqli_query($con, "SELECT id_usuario, nome, email, perfil FROM usuarios");
                    
                    while($row = mysqli_fetch_array($query)){
                        $id = $row['id_usuario'];
                        echo "<tr>
                            <td style='display:none'>".$id."</td>
                            <td>".$row['nome']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['perfil']."</td>
                            <td>
                                <a href='editarUsuario.php?id=$id'><i class='fas fa-user-edit'></i></a>
                            </td>
                            <td>
                                <a class='deletarUsuario'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>";
                    }
                    mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
