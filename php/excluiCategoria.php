<?php

  require_once("conexaoBanco.php");

  $codigoCat=$_POST['codigoCat'];

  //echo $codigoCat;

  $comando="SELECT codigo FROM produtos WHERE categorias_codigo=".$codigoCat;

  $resultado=mysqli_query($conexao,$comando);
  $linhas=mysqli_num_rows($resultado);

  if($linhas==0){ //poder excluir a categoria
    $comando2="DELETE FROM categorias WHERE codigo=".$codigoCat;
    $resultado2=mysqli_query($conexao,$comando2);

      if($resultado2==true){
        header("Location: registroCategoriaForm.php?retorno=1");
      }else{
        header("Location: registroCategoriaForm.php?retorno=0");
      }
  }

  else{
      header("Location: registroCategoriaForm.php?retorno=2");
  }

?>
