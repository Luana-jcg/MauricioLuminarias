<?php
    
    session_start();

    if(isset($_POST['email'])){
        
        include 'conexao.php';
        
        $email = $_POST['email'];
        $senha = sha1($_POST['senha']);

        if(empty($email) || empty($senha)){
            echo "Verifique se todos os campos obrigatórios foram preenchidos";
        } else{
            $sql = mysqli_query($con, "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");

            if(mysqli_num_rows($sql) == 1){
                $dados = mysqli_fetch_array($sql);
                $_SESSION['perfil'] = $dados['perfil'];
                $_SESSION['id'] = $dados['id_usuario'];
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['logado'] = true;
                echo "sucesso";
            }else{
                echo "Login incorreto";
            }
        }

    }

?>