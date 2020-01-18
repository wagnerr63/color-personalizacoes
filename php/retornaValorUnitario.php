<?php

    require_once("conexaoBanco.php");

    $id=$_POST['codigo'];
    $comando = "SELECT preco_unitario FROM produtos WHERE codigo=".$id;
    $resultado = mysqli_query($conexao, $comando);
    $preco_unitario = array();
    $preco_unitario = mysqli_fetch_assoc($resultado);

?>
<?=$preco_unitario['preco_unitario'];?>
