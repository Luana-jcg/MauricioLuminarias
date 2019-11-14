<?php 
    session_start();
    $id = $_SESSION['id'];
    echo $id ."<br>" ;
    include_once('../funcoesPHP.php');
    include_once('conexao.php');

    if(isset($_FILES['imagem'])){
        $imagem = $_FILES["imagem"];
        $descricao = $_POST['descricao']; 
        echo $descricao;
        $destino = '../galeria/' . $_FILES['imagem']['name'];
        $nome = $_FILES['imagem'][ 'name' ];
        $tipo = $_FILES['imagem']['type'];
        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );
        if (strstr('.jpg;.jpeg;.gif;.png', $extensao)){
            // Concatena a pasta com o nome
            $destino = '../galeria/' . $nome;
            // tenta mover o arquivo para o destino
            
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                
                $sql = "INSERT INTO fotos values (null,'{$nome}','png','{$descricao}',1)";
                
                if (mysqli_query($con,$sql)){
                    header('location: ../gerenciadorGaleria.php?status=1');
                }else{ 
                   header('location: ../gerenciadorGaleria.php?status=2');
                    
//                    echo ($sql);
//                    echo "ERRO: " . mysqli_error($con) . "\n";
                } 
            }else{
               header('location: ../gerenciadorGaleria.php?status=3');
            }
        }else{
            header('location: ../gerenciadorGaleria.php?status=4');
        }
    }else{
       header('location:../gerenciadorGaleria.php?status=5');
    }



?>