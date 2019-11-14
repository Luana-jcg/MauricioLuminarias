<?php 
include 'conexao.php';
$id = $_GET['id'];
$deletar = "DELETE FROM fotos WHERE id = $id";
$query = mysqli_query($con,"SELECT * FROM fotos WHERE id = $id");
$buscar = mysqli_fetch_array($query);

if(mysqli_query($con,$deletar)){
    unlink('../galeria/' . $buscar['imagem']);
    header("location: ../gerenciadorGaleria.php?status=5");
}else{
    header("location: ../gerenciadorGaleria.php?status=6");
}
?>