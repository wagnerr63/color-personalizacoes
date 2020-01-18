<?php
session_start();
require_once("conexaoBanco.php");

$codigoOrca=$_POST['orcamentos'];
$dataGeracao=$_POST['dataAtual'];
$dataEntrega=$_POST['dataE'];
$operario=$_POST['operario'];


$comando="INSERT INTO ordens_de_servicos (codigo, orcamentos_codigo, usuarios_codigo, data_geracao, data_entrega, status) VALUES
(".$codigoOrca.", ".$codigoOrca.", ".$operario.", '".$dataGeracao."', '".$dataEntrega."', 1)";

$resultado= mysqli_query($conexao,$comando);

if($resultado){
  $comando2="UPDATE orcamentos SET status=2 WHERE codigo=".$codigoOrca;
  $resultado2= mysqli_query($conexao,$comando2);
  if($resultado2){
    header("Location: aberturaOrdemServicoForm.php?retorno=1");
  }else{
    header("Location: aberturaOrdemServicoForm.php?retorno=0");
  }
}else{
  header("Location: aberturaOrdemServicoForm.php?retorno=0");
}




?>
