<?php
require_once("conexaoBanco.php");

$id=$_POST['idOrcamento'];
$comando = "DELETE FROM orcamentos_has_produtos WHERE orcamentos_codigo=".$id;
$resultado1 = mysqli_query($conexao, $comando);

$comando2 = "DELETE FROM orcamentos WHERE codigo=".$id;
$resultado2 = mysqli_query($conexao, $comando2);

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
  session_start();
  $idFuncionario = $_SESSION['idLogado'];
  $idCliente = $_POST['nomeCli'];
  $arrayCategorias = array();
  $arrayCategorias = $_POST['categorias'];
  $arrayProdutos = array();
  $arrayProdutos = $_POST['produtos'];
  $arrayQuantidades = array();
  $arrayQuantidades = $_POST['quantidade'];
  $arrayDescricoes = array();
  $arrayDescricoes = $_POST['descricao'];
  $arrayValoresUnitarios = array();
  $arrayValoresUnitarios = $_POST['vlUnitario'];

  if($cepEntrega==""){
    $cepEntrega = "null";
  }
  if($desconto==""){
    $desconto = "null";
  }
$comando3 = "INSERT INTO orcamentos (codigo, preco_total, data_emissao, desconto, parcelamento, usuarios_codigo, clientes_codigo, status, rua,
             bairro, complemento, cidade, estado, cep) VALUES (".$id.", ".$precoTotal.", '".$dataEmissao."', ".$desconto.", ".$numParcelas.",
             ".$idFuncionario.", ".$idCliente.", 1, '".$ruaEntrega."', '".$bairroEntrega."', '".$complementoEntrega."', '".$cidadeEntrega."', '".$estadoEntrega."', ".$cepEntrega.")";

$resultado3 = mysqli_query($conexao, $comando3);

$tamanho = sizeof($arrayProdutos);

for($i=0; $i<$tamanho; $i++){
$comando = "INSERT INTO orcamentos_has_produtos (orcamentos_codigo, produtos_codigo, qtde, descricao, preco_atual)
            VALUES (".$id.", ".$arrayProdutos[$i].", ".$arrayQuantidades[$i].", '".$arrayDescricoes[$i]."', ".$arrayValoresUnitarios[$i].")";

           $resultado4 = mysqli_query($conexao, $comando);
}

if($resultado4==true){
  header("Location: aberturaOrcamentoForm.php?retorno=1");
}else{
  header("Location: aberturaOrcamentoForm.php?retorno=2");
}
?>
