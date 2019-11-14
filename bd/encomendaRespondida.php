<?php
    
    session_start();
    
	if(isset($_POST['status']) && isset($_POST['id'])){
        
        include_once 'conexao.php';
        
		$id = $_POST['id'];
        $status = $_POST['status'];
        
		$sql = "UPDATE encomenda SET respondida = $status WHERE id = $id";

		if(mysqli_query($con, $sql)){
            if($status == 1){
                echo "A encomenda $id foi marcada como respondida";
            }else{
                echo "A encomenda $id foi marcada como não respondida";
            }
        }
        
        
        mysqli_close($con);
	}

?>