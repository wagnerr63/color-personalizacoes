<?php

  require_once("conexaoBanco.php");

  $codigoCliente = $_POST['codigoCliente'];
  //echo $codigoCliente;

  $comando = "SELECT clientes_codigo FROM orcamentos WHERE clientes_codigo=".$codigoCliente;
  $resultado=mysqli_query($conexao,$comando);

  $linhas = mysqli_num_rows($resultado);

  if($linhas>0){
    header("Location: registroClienteForm.php?retorno=2");
  }else{
    echo $comando2 = "DELETE FROM clientes WHERE codigo =".$codigoCliente;
    $resultado2 = mysqli_query($conexao, $comando2);

    if($resultado2==true){
      header("Location: registroClienteForm.php?retorno=1");
    }else{
      header("Location: registroClienteForm.php?retorno=0");
    }
  }

?>
