<?php

  require_once("conexaoBanco.php");

  $id = $_POST['codigo'];

  $comando="SELECT codigo FROM orcamentos WHERE codigo=".$id;

  $resultado=mysqli_query($conexao, $comando);

  $linhas=mysqli_num_rows($resultado);

  if($linhas==0){
    header("Location: aberturaOrcamentoForm.php?retorno=2");
  }else{
    $comando2="UPDATE orcamentos SET status=3 WHERE codigo=".$id;
    $resultado2=mysqli_query($conexao,$comando2);

    if($resultado2==true){
      header("Location: aberturaOrcamentoForm.php?retorno=1");
    }else{
      header("Location: aberturaOrcamentoForm.php?retorno=0");
    }
  }

?>
