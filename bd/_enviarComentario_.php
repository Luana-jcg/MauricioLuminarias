<?php 
    include_once('../funcoesPHP.php');
    include 'conexao.php';

    if(isset($_POST['nome'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $comentario = $_POST['comentario'];
        $nota = $_POST['nota'];
//        $captcha = $_POST['g-recaptcha-response'];
    }

//    if($captcha != ''){
//        $secreto = '6LddWMAUAAAAAAW_PFJnWjOOS9OJ6EGpNwBERZwl';
//        $ip      = $_SERVER['REMOTE_ADDR'];
//        $var     = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secreto&response=$captcha&remoteip=$ip");
//        $resposta = json_decode($var, true);
//        if($resposta['success']){
            
            if(empty($nome) || empty($email) || empty($comentario) || empty($nota)){
                echo "Verifique se todos os campos obrigatórios foram preenchidos";
            }else{
                $nota = $nota + 0; 
                $sql = "INSERT INTO comentarios VALUES(null, '{$nome}', '{$email}', '{$comentario}', {$nota} , NOW(), 0)";
                if(mysqli_query($con, $sql)){ 
                    echo "sucesso";
                }else{ 
                    echo "Erro ao gravar no banco"; 
                } 

                // Close connection 
                mysqli_close($con); 
            }
            
//        }else{
//            echo "Erro na Captcha. Por favor, tente novamente"; 
//        }
//    }else{
//        echo "Por favor, selecione a Captcha";
//    }

?>
