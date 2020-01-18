<?php

  require_once("conexaoBanco.php");

  $codigo = $_POST['codigoOrdem'];
  $status = $_POST['status'];

  /*echo $codigo. "<br>";
  echo $status. "<br>";*/

  $comando = "UPDATE ordens_de_servicos SET status=".$status." WHERE codigo=".$codigo;

  // echo $comando;

  $resultado = mysqli_query($conexao, $comando);

  if(resultado==true){
    header ("Location: alterarStatusOrdem.php?retorno=1");
  }else{
    header ("Location: alterarStatusOrdem.php?retorno=0");
  }
?>
