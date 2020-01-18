<?php

require_once("conexaoBanco.php");

$produtoCodigo = $_POST['codigo'];

$comando="SELECT nome FROM produtos WHERE codigo=".$produtoCodigo;
$resultado=mysqli_query($conexao, $comando);
$precoProduto=array();
$precoProduto=mysqli_fetch_assoc($resultado);

 ?>

 <?=$precoProduto['nome'];?>
