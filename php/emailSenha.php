<?php

$email=$_POST['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 require_once('conexaoBanco.php');
require '../php/PHPMailer/src/Exception.php';
require '../php/PHPMailer/src/PHPMailer.php';
require '../php/PHPMailer/src/SMTP.php';


$comando="SELECT email FROM usuarios WHERE email='".$email."'";
$resultado=mysqli_query($conexao, $comando);
$linhas=mysqli_num_rows($resultado);
if($linhas==0){
	header("Location: ../paginasSite/login.php?retorno=0");
}else{
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail-> Username="suporte.colorpersonalizacoes@gmail.com";
	$mail-> Password="color12345";
	$mail->From = "suporte.colorpersonalizacoes@gmail.com";
	$mail->FromName = "Color Personalizações";
	$mail->AddAddress("suporte.colorpersonalizacoes@gmail.com", "Color Personalizações");
	$mail->WordWrap = 50;
	$mail->IsHTML = true;
	$mail->Subject = "Color Personalizações - Esqueci minha senha";
	$senha=mt_rand(10000000, 99999999);
	$senha2=md5($senha);
	$comando2="UPDATE usuarios SET senha='".$senha2."' WHERE email='".$email."'";
	$resultado=mysqli_query($conexao, $comando2);
	if($resultado==true){
		$mail-> msgHTML("<b>Mensagem relacionada com esquecimento de senha</b><br><br>Nova Senha: ".$senha);
		if(!$mail->Send()){
		  header("Location: ../paginasSite/login.php?retorno=0");
		}else{
		  header("Location: ../paginasSite/login.php?retorno=1");
		}
	}else{
		header("Location: ../paginasSite/login.php?retorno=4");
	}

}

?>
