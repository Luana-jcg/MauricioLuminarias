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
        $('#listar-comentarios').DataTable({
            responsive: true,
            "scrollX": true,
            scrollCollapse: true,
            "columnDefs": [
                { "width": "05%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "30%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "05%", "targets": 6 },
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            }
        });
        
        $("input[name='status']").click(function(){
            var status = $(this).prop('checked') ? 1 : 0;
            var id = $(this).val();
            var cod = $(this).parent().parent().find(':nth-child(1)').html();
            $.ajax({
                url: 'bd/atualizarRelevancia.php',
                type: 'POST',
                data: 'status='+status+'&id='+id+'&cod='+cod,
                success: function( data ){
                    $("#resposta_ajax").addClass("alert alert-success").css('display', 'block').html(data);
                }
            });
        });
    });
	</script>
</head>

<body>
    
    <?php include 'topo_adm.php'; ?>

    <?php include 'dashboard.php'; ?>

    <div class="container animated zoomIn">
        <div class="card-header">
            <div class="d-flex justify-content-center social_icon">
                <span><i class="fas fa-fw fa-comments fa-3x"></i></span>
                <h5 class="mt-2 ml-2">Lista de Comentários</h5>
            </div>
        </div>
        <?php
                
        include_once 'bd/conexao.php';

        $sql = "SELECT * FROM comentarios ORDER BY data_criacao DESC";

        $result = mysqli_query($con, $sql); 

        $totalRegistros = mysqli_num_rows($result);

        if($totalRegistros > 0){?>
            <br>
            <div id="resposta_ajax" class="alert" style="display:none"></div>
            <form action="" method="post" >
                <table id="listar-comentarios" class="table  table-bordered hover" style="width:100%">
                    <thead class="text-light" style="background-color:#343a40">
                        <th>Código</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Comentário</th>
                        <th>Nota</th>
                        <th>Data de criação</th>
                        <th>Tornar Relevante</th>
                    </thead>
                    <tbody>
                        <?php
                        $cont = 1;
                        while($row = mysqli_fetch_array($result)){
                            $id = $row['id'];
                        ?>
                            <tr>
                                <td><?php echo $cont ?></td>
                                <td><?php echo $row['nome'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['comentario'] ?></td>
                                <td><?php echo $row['nota'] ?></td>
                                <td><?php echo date('d/m/Y H:i:s',strtotime($row['data_criacao']))?></td>
                                <td>
                                <input type="checkbox" name="status" value="<?php echo $id ?>" <?php if($row['relevante'] == 1){echo 'checked="checked"';} ?>/>
                                </td>
                            </tr>
                        <?php
                            $cont++;
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        <?php
        }else{
            echo "Nenhum registro encontrado!";
        }  
        mysqli_close($con);
        ?>
    </div>
</body>
</html>