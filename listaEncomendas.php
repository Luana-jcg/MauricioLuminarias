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
    function format (d) {
        // `d` is the original data object for the row
        return '<tr>'+
                '<td>'+d+'</td>'+
            '</tr>';
    }
    
    $(document).ready(function() {
        var table = $('#listar-encomendas').DataTable({
            responsive: true,
            "scrollX": true,
            "columnDefs": [
                { "width": "100px", "targets": 0 },
                { "width": "100px", "targets": 1 },
                { "width": "150px", "targets": 2 },
                { "width": "200px", "targets": 3 },
                { "width": "300px", "targets": 4 },
                { "width": "150px", "targets": 5 },
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
        });
        
        $('#listar-encomendas').on('click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format(tr.data('child-value'))).show();
              tr.addClass('shown');
          }
      });
        
        $("input[name='status']").click(function(){
            var status = $(this).prop('checked') ? 1 : 0;
            var id = $(this).val();
            var cod = $(this).parent().parent().find(':nth-child(1)').html();
            $.ajax({
                url: 'bd/encomendaRespondida.php',
                type: 'POST',
                data: 'status='+status+'&id='+id,
                success: function( data ){
                    $("#resposta_ajax").addClass("alert alert-success").css('display', 'block').html(data);
                }
            });
        });
    });
	</script>
</head>

<style>
    table{
      table-layout: fixed;
      word-wrap:break-word;
    }
</style>

<body>
    
    <?php include 'topo_adm.php'; ?>

    <?php include 'dashboard.php'; ?>

    <div class="container animated zoomIn" >  
        <div class="card mt-5 grow" style="width: 100%;">
            <div class="card-header">
                <div class="d-flex justify-content-center social_icon">
                    <span><i class="fas fa-fw fa-list fa-3x"></i></span>
                    <h5 class="mt-2 ml-2">Lista de Interesses</h5>
                </div>
            </div>

            <?php

            include_once 'bd/conexao.php';

            $sql = "SELECT c1.*, c2.* FROM clientes c1 INNER JOIN encomenda c2 
            ON c1.id = c2.cliente_id ORDER BY c2.confirmado DESC";

            $result = mysqli_query($con, $sql); 

            $totalRegistros = mysqli_num_rows($result);

            if($totalRegistros > 0){?>
                <div class="card-body">
                    <div id="resposta_ajax" class="alert" style="display:none"></div>
                    <form action="" method="post">
                        <table id="listar-encomendas" class="table hover" cellspacing="0" style="width:100%">
                            <thead class="text-light" style="background-color:#343a40">
                                <th></th>
                                <th>Nº</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Foto</th>
                                <th>Respondido</th>
                            </thead>
                            <tbody>
                                <?php
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['id'];
                                    $descricao = $row['descricao'];
                                    $telefone = $row['telefone'];
                                    $celular = $row['celular'];
                                    $medida = $row['medida'];
                                    $qtd = $row['qtd'];
                                    $confirmado = $row['confirmado'];
                                ?>
                                    <tr data-child-value="Telefone: <?php echo $telefone ?> <br>Celular: <?php echo $celular ?> <br>Medida: <?php echo $medida ?> <br>Quantidade: <?php echo $qtd ?> <br>Descrição: <?php echo $descricao ?> <br>Confirmado: <?php echo ($confirmado == 1) ? "Sim" : "Não"; ?>">
                                        <td class="details-control"><i class="fas fa-caret-down"></i></td>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $row['nome'] ?></td>
                                        <td><a href="mailto:<?php echo $row['email'] ?>?body=Olá, <?php echo $row['nome'] ?>.%0A%0ANós da Maurício Luminárias estamos entranto em contato referente ao formulário preenchido em nosso site com os seguintes dados:%0A%0ADescrição: <?php echo $descricao ?>%0AMedida: <?php echo $medida ?>%0AQuantidade: <?php echo $qtd ?>%0AFoto: <?php echo $row['fotoambiente'] ?>%0A%0A"><?php echo $row['email'] ?></a></td>
                                        <td>
                                            <?php 
                                            if(!empty($row['fotoambiente'])){?>
                                                <figure>
                                                    <img src="<?php echo isset($row['fotoambiente']) ? 'encomenda/'. $row['fotoambiente'] : "" ?>" style="width:100px;" />
                                                    <figcaption><?php echo $row['fotoambiente'] ?></figcaption>
                                                </figure>
                                            <?php
                                            }?>
                                        </td>
                                        <td>
                                        <input type="checkbox" name="status" value="<?php echo $id ?>" <?php if($row['respondida'] == 1){echo 'checked="checked"';} ?>/>
                                        </td>
                                    </tr>
                                <?php
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
        </div>
    </div>
</body>
</html>