<?php

    session_start();

	if(!empty($_POST['id_usuario']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['perfil'])){
        
        include_once 'conexao.php';
        
		$nome = $_POST['nome'];
        $email = $_POST['email'];
        $perfil = $_POST['perfil'];
        $id = $_POST['id_usuario'];
        
		$sql = "UPDATE usuarios SET nome = '$nome', email = '$email', perfil = '$perfil' WHERE id_usuario = $id";
        
        if(mysqli_query($con, $sql)){
            echo "sucesso";
        }else{
            echo "Erro ao gravar no banco";
        }
        
        mysqli_close($con);
        
	} else{
        echo "Por favor, preencha todos os campos obrigatórios.";
    }

?>