<?php
    
    session_start();

    if(isset($_POST['nome'])){
        
        include 'conexao.php';
        
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = sha1($_POST['senha']);
        $confirmasenha = sha1($_POST['confirmasenha']);
        $perfil = $_POST['perfil'];

        if(empty($nome) || empty($email) || empty($senha) || empty($confirmasenha) || empty($perfil)){
            echo "Verifique se todos os campos obrigatórios foram preenchidos";
        } else{
            $sql_verificaemail = mysqli_query($con, "SELECT * FROM usuarios WHERE email = '$email'");

            if(mysqli_num_rows($sql_verificaemail)!=1){
                //Verifica se as senhas são iguais
                if($senha == $confirmasenha){

                    //Insere no banco todos os dados informados
                    $sql_cadastro = "INSERT INTO usuarios VALUES(null, '{$nome}', '{$email}', '{$senha}', '{$perfil}', 'null', 'null')";

                    if(mysqli_query($con, $sql_cadastro)){
                        echo "sucesso";
                    }else{
                        echo "Erro ao conectar com o banco";
                    }
                    
                }else{
                    echo "Senhas diferentes";
                } 
            }else{
                echo "Email já existe. Tente outro.";
            }
        }
        
        mysqli_close($con);
    }

?>