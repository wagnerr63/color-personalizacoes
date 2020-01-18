<?php

  /*Incluir banco de dados*/
  require_once("conexaoBanco.php");

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

  /*echo $cpf_cnpj. "<br>";
  echo $telefone1. "<br>";
  echo $telefone2. "<br>";
  echo $cep. "<br>";*/

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
    $comando = "INSERT INTO  clientes (nome, cpf_cnpj, cep, estado, cidade, bairro, rua, complemento, inscricao_estadual,
    telefone_1, telefone_2, email) VALUES ('".$nome."', '".$cpf_cnpj."', ".$cep.", '".$estado."', '".$cidade."', '".$bairro."',
    '".$rua."', '".$complemento."', ".$inscEstadual.", ".$telefone1.", ".$telefone2.", ".$email.")";
  }else{
    $comando = "INSERT INTO  clientes (nome, cpf_cnpj, cep, estado, cidade, bairro, rua, complemento, inscricao_estadual,
    telefone_1, telefone_2, email) VALUES ('".$nome."', '".$cpf_cnpj."', ".$cep.", '".$estado."', '".$cidade."', '".$bairro."',
    '".$rua."', '".$complemento."', ".$inscEstadual.", ".$telefone1.", ".$telefone2.", '".$email."')";
  }
  //echo $comando;

  $resultado = mysqli_query($conexao, $comando);
  //echo $resultado;

  if($resultado==true){
		header("Location: registroClienteForm.php?retorno=1"); //Tem retorno
	}else{
		header("Location: registroClienteForm.php?retorno=0"); //Não tem retorno
	}

?>
