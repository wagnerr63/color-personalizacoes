<?php
require_once("conexaoBanco.php");
$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$senha=md5($senha);
$nivel=$_POST['nivel'];
$comando="INSERT INTO usuarios (nome, email, senha, nivel) VALUES ('".$nome."', '".$email."', '".$senha."', ".$nivel.")";
// echo $comando;
$resultado=mysqli_query($conexao,$comando);
if($resultado){
	header("Location: registroFuncionarioForm.php?retorno=1");
}else {
	header("Location: registroFuncionarioForm.php?retorno=0");
}
?>
