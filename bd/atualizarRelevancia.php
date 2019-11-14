<?php
    
    session_start();
    
	if(isset($_POST['status']) && isset($_POST['id']) && isset($_POST['cod'])){
        
        include_once 'conexao.php';
        
		$id = $_POST['id'];
        $status = $_POST['status'];
        $cod = $_POST['cod'];
        
		$sql = "UPDATE comentarios SET relevante = $status WHERE id = $id";

		if(mysqli_query($con, $sql)){
            if($status == 1){
                echo "O comentário $cod agora é relevante e aparecerá na tela incial";
            }else{
                echo "O comentário $cod deixou de ser relevante e desaparecerá da tela incial";
            }
        }
        
        
        mysqli_close($con);
	}

?>