<?php

    session_start();

	if(isset($_POST['nome']) && isset($_POST['id'])){
        
        include_once 'conexao.php';
        
		$nome = $_POST['nome'];
        $id = $_POST['id'];
		
        $sql =  "DELETE FROM usuarios where id_usuario = $id";
        
        if(mysqli_query($con, $sql)){
            echo "Usuário $nome deletado com sucesso";
        }
        
        mysqli_close($con);
	}

?>
