<?php

	require_once("conexaoBanco.php");

	$nome=$_POST['nomeCat'];
	$descricao=$_POST['descricao'];

	// echo $nome."<br>";
	// echo $descricao;

	$comando="INSERT INTO categorias (nome, descricao) VALUES ('".$nome."', '".$descricao."')";
	// echo $comando;

	$resultado=mysqli_query($conexao,$comando);
	//echo $resultado;

	if($resultado==true){
		header("Location: registroCategoriaForm.php?retorno=1");
		echo"Sucesso!";
	}else{
		header("Location: registroCategoriaForm.php?retorno=0");
	}

?>
