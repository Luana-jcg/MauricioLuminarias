<?php 
    session_start(); 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/LoginEstilo.css">

    <title>Maurício Luminárias</title>
</head>

<style>
    body,
    html {
        background-image: url('imagens/Foto10.png');
    }

</style>

<body>

    <?php
        //Guarda na variável chave a chave que veio da url caso exista uma chave
        $chave_confirmacao = isset($_GET["chave"]) ? $_GET["chave"] : "null";
      
        include 'bd/conexao.php';
        
        //Verifica se a chave da url existe no banco
        $verificachave = mysqli_query($con, "SELECT * FROM encomenda WHERE chave_confirmacao = '$chave_confirmacao'");
        
        //Caso a condição acima seja verdadeira, verifca se o link e válido e dá acesso ao usuário, caso não contrário, diz que a página não foi encontrada
        if(mysqli_num_rows($verificachave) == 1){
            
            //Verifica no banco se o link ainda é válido
            $verificalink = mysqli_query($con, "SELECT * FROM encomenda WHERE chave_confirmacao = '$chave_confirmacao' AND data_expiracao_confirmacao >= NOW()");
            
            //Se a condição acima for verdadeira, exibe a página
            if(mysqli_num_rows($verificalink) == 1){
            
                mysqli_query($con, "UPDATE encomenda SET confirmado = 1 WHERE chave_confirmacao = '$chave_confirmacao'");
    ?>
    
    <?php include 'topo_adm.php'; ?>
    
    <div class="container-fluid">
        <div class="container-fluid float-left" id="main">

            <!------ Início Conteúdo ----->
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-body" style="background-color:#363636;">
                       <br>
                        <p class="text-center mt-5" style="color:white"><b>Interesse confirmado com sucesso.</b></p>
                        <p class="text-center mt-5" style="color:white"><b>Aguarde que em breve entraremos em contato.</b></p>
                    </div>
                </div>
            </div>
            <!------ Fim Conteúdo ----->

        </div>
    </div>

    <?php
            } else{
                echo "<script language='javascript' type='text/javascript'>
                alert('Link inválido');</script>";
            }
      
        } else{
            echo "<h1>Página não encontrada</h1>";
        }
    
    ?>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
