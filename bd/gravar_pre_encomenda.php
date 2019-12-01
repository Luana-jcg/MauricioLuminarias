<?php
    session_start();
    include_once('../funcoesPHP.php');
    include 'conexao.php';
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $descricao = $_POST['descricao'];
    $medida = $_POST['medida'];
    $quantidade = $_POST['quantidade'];
    date_default_timezone_set('America/Sao_Paulo');
    $data_interesse = date('Y-m-d H:i:s', time()+1440*60);
    
    function tratarImagem(){
        $imagem = $_FILES["imagem"];
        $destino = '../encomenda/' . $_FILES['imagem']['name'];
        $nome_imagem = $_FILES['imagem']['name'];
        $tipo = $_FILES['imagem']['type'];
        // Pega a extensão
        $extensao = pathinfo($nome_imagem, PATHINFO_EXTENSION);
        // Converte a extensão para minúsculo
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.gif;.png', $extensao)){
            // Concatena a pasta com o nome
            $destino = '../encomenda/' . $nome_imagem;
            // tenta mover o arquivo para o destino
            if(move_uploaded_file($imagem['tmp_name'], $destino)) {
                return "sucesso";

            }else{
                return "Por favor, envie imagens de até 2,0 MB.";
            }

        }else{
            return "Arquivo não suportado. Formatos permitidos: jpg, jpeg, gif e png.";
        }
    }
    

    if(empty($nome) || empty($email) || empty($descricao) || empty($medida) || empty($quantidade)){
        echo "Verifique se todos os campos obrigatórios foram preenchidos";
    }else{
        $sql_verificaemail = mysqli_query($con, "SELECT * FROM clientes WHERE email = '$email'");
        
        if(!empty($_FILES['imagem']['name'])){
            $resp = tratarImagem();
        }else{
            $nome_imagem = null;
        }
        
        if((isset($resp) && $resp === "sucesso") || !isset($resp)){
            $nome_imagem = $_FILES['imagem']['name'];
            
            if(mysqli_num_rows($sql_verificaemail)!=1){

                $sql_cliente = "INSERT INTO clientes VALUES(null, '{$nome}', '{$email}', '{$telefone}', '{$celular}')";

                if(mysqli_query($con, $sql_cliente)){
                    echo "sucesso";
                }

                $cliente_id = mysqli_insert_id($con);
                
            }else{
                while($row = mysqli_fetch_array($sql_verificaemail)){
                    $cliente_id = $row['id'];
                }
            }
            
            $chave_confirmacao = geradorchave();

            $sql_encomenda = "INSERT INTO encomenda VALUES (null, '{$descricao}', '{$medida}', {$quantidade}, '{$nome_imagem}', '{$cliente_id}', '{$chave_confirmacao}', '{$data_interesse}', 0, 0)";

            if(mysqli_query($con, $sql_encomenda)){
                if(linkconfirmacao($chave_confirmacao, $email) === "sucesso"){
                    echo "sucesso";
                }
            }
            
        }else{
            echo $resp;
        }
        
    }
?>