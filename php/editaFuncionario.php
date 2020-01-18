<?php
	require_once("conexaoBanco.php");
	$codigo=$_POST['codigoUsuario'];
	$nome=$_POST['nome'];
	$email=$_POST['email'];
	$senha=$_POST['senha'];
	$nivel=$_POST['nivel'];

	if($senha==""){
		$comando="UPDATE usuarios SET nome='".$nome."', email='".$email."', nivel=".$nivel." WHERE codigo=".$codigo;
	}else if($senha!=""){
		$senha=md5($senha);
		$comando="UPDATE usuarios SET nome='".$nome."', email='".$email."', senha='".$senha."', nivel=".$nivel." WHERE codigo=".$codigo;
	}

	//echo $comando;

	$resultado=mysqli_query($conexao,$comando);

	if($resultado==true){
		header("Location: registroFuncionarioForm.php?retorno=1");
	}else{
		header("Location: registroFuncionarioForm.php?retorno=0");
	}
?>
