<?php
require_once("conexaoBanco.php");
$codigo=$_POST['codigo'];

$comando="SELECT clientes.nome FROM clientes INNER JOIN orcamentos ON orcamentos.clientes_codigo=clientes.codigo WHERE orcamentos.codigo=".$codigo;
$resultado=mysqli_query($conexao,$comando);
$nomeClie=mysqli_fetch_assoc($resultado);
?>

<?=$nomeClie['nome'];?>
