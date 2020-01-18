<?php

require_once("conexaoBanco.php");

$email=$_POST['campoEmail'];
$senha=$_POST['campoSenha'];

$senha=md5($senha);

// echo $email."    ".$senha;

$comando="SELECT * FROM usuarios WHERE email='".$email."' AND senha='".$senha."'";

//echo $comando;
$resultado=mysqli_query($conexao,$comando);
$usuario=mysqli_fetch_assoc($resultado);
$linhas=mysqli_num_rows($resultado);

if($linhas==0){
	header("Location: ../paginasSite/login.php");
}else{
	session_start();
	$_SESSION['idLogado']=$usuario['codigo'];
	$_SESSION['emailLogado']=$usuario['email'];
	$_SESSION['nivelLogado']=$usuario['nivel'];

	if($_SESSION['nivelLogado']==1){
		header("Location: ../php/paginaGerente.php");
	}else if($_SESSION['nivelLogado']==2){
		header("Location: ../php/paginaAtendente.php");
	}else if($_SESSION['nivelLogado']==3){
		header("Location: ../php/paginaOperario.php");
	}
}

?>
