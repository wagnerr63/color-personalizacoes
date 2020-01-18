<?php

$nome=$_POST['campoNome'];
$telefone=$_POST['campoTelefone'];
$email=$_POST['campoEmail'];
$mensagem=$_POST['caixaMensagem'];
$assunto=$_POST['assuntos'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../php/PHPMailer/src/Exception.php';
require '../php/PHPMailer/src/PHPMailer.php';
require '../php/PHPMailer/src/SMTP.php';

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
$mail->Subject = "Mensagem — ".$assunto;
$assuntoLowerCase = strtolower($assunto);
$mail-> msgHTML('<b>Mensagem relacionada com '.$assuntoLowerCase.'</b><br><br>De: <i>'.$nome.' ('.$email.')</i><br><br>"'.$mensagem.'"');

if(!$mail->Send()){
  header("Location: ../index.php?retorno=0");
}else{
  header("Location: ../index.php?retorno=1");
}
?>
