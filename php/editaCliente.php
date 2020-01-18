<?php

  require_once("conexaoBanco.php");

  $codigo = $_POST['codigoCliente'];
  $nome = $_POST['nome'];
  $cpf_cnpj = $_POST['cpf'];
  $email = $_POST['email'];
  $inscEstadual = $_POST['inscricaoEs'];
  $telefone1 = $_POST['telefone'];
  $telefone2 = $_POST['telefone2'];
  $rua = $_POST['rua'];
  $bairro = $_POST['bairro'];
  $complemento = $_POST['complemento'];
  $cidade = $_POST['cidade'];
  $estado = $_POST['estado'];
  $cep = $_POST['cep'];

  /*echo $nome. "<br>";
  echo $cpf_cnpj. "<br>";
  echo $email. "<br>";
  echo $inscEstadual. "<br>";
  echo $telefone1. "<br>";
  echo $telefone2. "<br>";
  echo $rua. "<br>";
  echo $bairro. "<br>";
  echo $complemento. "<br>";
  echo $cidade. "<br>";
  echo $estado. "<br>";
  echo $cep. "<br>";*/

  $cpf_cnpj = preg_replace("/\D+/", "", $cpf_cnpj);
  $telefone1 = preg_replace("/\D+/", "", $telefone1);
  $telefone2 = preg_replace("/\D+/", "", $telefone2);

  if($email==""){
    $email = 'null';
  }
  if($inscEstadual==""){
    $inscEstadual = 'null';
  }
  if($telefone2==""){
    $telefone2 = 'null';
  }
  if($cep==""){
    $cep = 'null';
  }

  if($email=="null"){
    $comando = "UPDATE clientes SET nome='".$nome."', cpf_cnpj=".$cpf_cnpj.", email=".$email.", inscricao_estadual=".$inscEstadual.", telefone_1=".$telefone1.", telefone_2=".$telefone2.", rua='".$rua."', bairro='".$bairro."', complemento='".$complemento."', cidade='".$cidade."', estado='".$estado."', cep=".$cep." WHERE codigo=".$codigo;
  }else{
      $comando = "UPDATE clientes SET nome='".$nome."', cpf_cnpj=".$cpf_cnpj.", email='".$email."', inscricao_estadual=".$inscEstadual.", telefone_1=".$telefone1.", telefone_2=".$telefone2.", rua='".$rua."', bairro='".$bairro."', complemento='".$complemento."', cidade='".$cidade."', estado='".$estado."', cep=".$cep." WHERE codigo=".$codigo;
  }
  //echo $comando;

  $resultado = mysqli_query($conexao, $comando);

  if($resultado==true){
    header ("Location: registroClienteForm.php?retorno=1");
  }else{
    header ("Location: registroClienteForm.php?retorno=0");
  }
?>
