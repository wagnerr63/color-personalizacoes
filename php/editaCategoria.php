<?php

  require_once("conexaoBanco.php");

  $codigoCat=$_POST['codigo'];
  $nome=$_POST['nome'];
  $descricao=$_POST['descricao'];

  // echo $codigoCat."<br>";
  // echo $nome."<br>";
  // echo $descricao."<br>";

  $comando="UPDATE categorias SET nome='".$nome."', descricao='".$descricao."' WHERE codigo=".$codigoCat;

  //echo $comando;

  $resultado=mysqli_query($conexao,$comando);

  if($resultado==true){
    header("Location: registroCategoriaForm.php?retorno=1");
  }else{
      header("Location: registroCategoriaForm.php?retorno=0");
  }

?>
