<?php

    include 'conexao.php';
    
    $senhanova = sha1($_POST['senhanova']);
    $confirmasenhanova = sha1($_POST['confirmasenhanova']);
    $chave_senha = $_POST["chave"];

    if(empty($senhanova) || empty($confirmasenhanova)){
        echo "Verifique se todos os campos obrigatórios foram preenchidos";
    } else{
    
        //Verifica se as senhas são iguais
        if($senhanova == $confirmasenhanova){

            //Grava a nova senha no banco de dados
            $alterasenha = "UPDATE usuarios SET senha = '$senhanova' WHERE chave_senha = '$chave_senha'";

            if(mysqli_query($con, $alterasenha)){
                echo "sucesso";
            }else{
                echo "Erro ao connectar com o banco";
            }
        } else{
            echo "Senhas diferentes";
        }
    }
    
    mysqli_close($con);

?>