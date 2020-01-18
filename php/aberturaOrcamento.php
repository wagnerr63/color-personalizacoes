<?php
  session_start();
  require_once("conexaoBanco.php");

  $codigoCli = $_POST['nomeCli'];
  $codigoAtendente = $_POST['codigoAtendente'];
  $ruaEntrega = $_POST['ruaEntrega'];
  $bairroEntrega = $_POST['bairroEntrega'];
  $complementoEntrega = $_POST['complementoEntrega'];
  $cidadeEntrega = $_POST['cidadeEntrega'];
  $estadoEntrega = $_POST['estadoEntrega'];
  $cepEntrega = $_POST['cepEntrega'];
  $numParcelas = $_POST['numParcelas'];
  $desconto = $_POST['desconto'];
  $dataEmissao = $_POST['dataEmissao'];
  $precoTotal = $_POST['valorTotal'];
  $produtos = array();
  $produtos = $_POST['produtos'];
  $vlUnitarios = array();
  $vlUnitarios = $_POST['vlUnitario'];
  $qtdes = array();
  $qtdes = $_POST['quantidade'];
  $descricoes = array();
  $descricoes = $_POST['descricao'];

  if($cepEntrega==""){
    $cepEntrega = "null";
  }
  if($desconto==""){
    $desconto = "null";
  }

  $comando="INSERT INTO orcamentos (clientes_codigo, usuarios_codigo, rua, bairro, complemento, cidade, estado, cep, parcelamento,
  desconto, data_emissao, preco_total, status) VALUES (".$codigoCli.", ".$codigoAtendente.", '".$ruaEntrega."', '".$bairroEntrega."',
  '".$complementoEntrega."', '".$cidadeEntrega."', '".$estadoEntrega."', ".$cepEntrega.", ".$numParcelas.", ".$desconto.",
  '".$dataEmissao."', ".$precoTotal.", 1)";

  $resultado = mysqli_query($conexao,$comando);

  $comando2="SELECT MAX(codigo) as codigo FROM orcamentos";

  $resultado2=mysqli_query($conexao,$comando2);

  $idPedido=mysqli_fetch_assoc($resultado2);

  $resultado3=null;

  for($i=0; $i<sizeof($produtos); $i++){
      $comando3="INSERT INTO orcamentos_has_produtos (orcamentos_codigo, produtos_codigo, qtde, descricao, preco_atual) VALUES
      (".$idPedido['codigo'].", ".$produtos[$i].", ".$qtdes[$i].", '".$descricoes[$i]."', ".$vlUnitarios[$i].")";

      $resultado3=mysqli_query($conexao,$comando3);

  }

  if(($resultado==true) && ($resultado3==true)){
    header("Location: aberturaOrcamentoForm.php?retorno=1");
  }else{
    header("Location: aberturaOrcamentoForm.php?retorno=0");
  }

?>
