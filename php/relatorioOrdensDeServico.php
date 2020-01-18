<?php

	session_start();

	if(isset($_SESSION['nivelLogado'])==true && ($_SESSION['nivelLogado']==1)){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<title>Relatório de Ordem de Serviço</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/relatorioOrdensDeServico.css">
</head>
<body>

<?php include("menuGerente.php"); ?>

<main>
<br><br><br>
<h1 id="tituloPrincipal">Relatório de Ordem de Serviço</h1>
<form action="#"  method="GET" onsubmit="return validarCampos()">
<fieldset class="caixa">
<legend>Filtros</legend>

<br>
<?php
function exibeProdutos($conexao, $idOrd){
$comando="SELECT produtos.nome FROM produtos
INNER JOIN orcamentos_has_produtos ON produtos.codigo=orcamentos_has_produtos.produtos_codigo
INNER JOIN ordens_de_servicos ON orcamentos_has_produtos.orcamentos_codigo=ordens_de_servicos.codigo
WHERE ordens_de_servicos.codigo=".$idOrd;

$resultado= mysqli_query($conexao, $comando);
$produtos= array();

while($cadaProduto =mysqli_fetch_assoc($resultado)){
	array_push($produtos, $cadaProduto);
}
$listaProdutos="";
foreach ($produtos as $cadaProduto) {
	$listaProdutos.=$cadaProduto['nome'].", ";
}
return $listaProdutos;
}

?>
<label id="labelCliente">Cliente</label>
<select name="cliente" id="cliente">
<option value="">Selecione</option>
	<?php
		require_once("conexaoBanco.php");
		$comando="SELECT codigo, nome FROM clientes";
		$resultado=mysqli_query($conexao,$comando);
		$clientes = array();
		while ($cadaCliente = mysqli_fetch_assoc($resultado)){
			array_push($clientes, $cadaCliente);
		}
		foreach ($clientes as $cadaCliente) {
	?>
	<option value="<?=$cadaCliente['codigo'];?>">
		<?=$cadaCliente['nome'];?>
	</option>
	<?php }	?>
</select>

<label for="dataInicial" id="labelDataInicial">Data Inicial</label>
<input type="date" name="dataInicial" id="dataInicial">

<br><br>

<label id="labelStatus">Status</label>
<select name="status" id="status">
<option value="">Selecione</option>
<option value="1">Em aberto</option>
<option value="2">Em andamento</option>
<option value="3">Feita</option>
<option value="4">Cancelada</option>
</select>

<label for="dataFinal" id="labelDataFinal">Data Final</label>
<input type="date" name="dataFinal" id="dataFinal">

<br>
<br>

<label id="labelFuncionarioExecutor">Operário responsável</label>
<select name="operario">
<option value="">Selecione</option>
	<?php
		require_once("conexaoBanco.php");
		$comando="SELECT codigo, nome FROM usuarios WHERE nivel=3";
		$resultado=mysqli_query($conexao,$comando);
		$operarios = array();
		while ($cadaOperario = mysqli_fetch_assoc($resultado)){
			array_push($operarios, $cadaOperario);
		}
		foreach ($operarios as $cadaOperario) {
	?>
	<option value="<?=$cadaOperario['codigo'];?>">
		<?=$cadaOperario['nome'];?>
	</option>
	<?php }	?>
</select>


<br>
<br>

<button type="reset" class="botoes" id="botaoLimpar"><img src="../img/limpar.png"></button>
<button type="submit" class="botoes"><img src="../img/button_pesquisar.png"></button>
</fieldset>

</form>

<fieldset class="caixa" id="tabelaRelatorio">
<legend id="tituloRelatorio">Relatório</legend>
<br>
<table>
<tr>
<th>Código</th>
<th>Cliente</th>
<th>Valor total</th>
<th>Funcionário responsável</th>
<th>Produtos</th>
</tr>
<?php
//Se o usuário clicar no PESQUISAR
if(isset($_GET['dataInicial']) && isset($_GET['dataFinal']) && isset($_GET['cliente']) && isset($_GET['status']) && isset($_GET['operario'])){
	$dataInicial = $_GET['dataInicial'];
	$dataFinal = $_GET['dataFinal'];
	$codigoCliente = $_GET['cliente'];
	$status =$_GET['status'];
	$operario=$_GET['operario'];


	$dataAtual=date('Y/m/d');
	$dataMinima='2004/01/01';
	$comando="SELECT ordens_de_servicos.codigo as codigoOrdem, clientes.nome as nomeCli, orcamentos.preco_total,
	usuarios.nome as nomeOpe, produtos.nome FROM orcamentos
	INNER JOIN ordens_de_servicos ON ordens_de_servicos.codigo=orcamentos.codigo
	INNER JOIN clientes ON clientes.codigo=orcamentos.clientes_codigo
	INNER JOIN usuarios ON usuarios.codigo=ordens_de_servicos.usuarios_codigo
	INNER JOIN orcamentos_has_produtos ON orcamentos_has_produtos.orcamentos_codigo=orcamentos.codigo
	INNER JOIN produtos ON produtos.codigo=orcamentos_has_produtos.produtos_codigo";

	//Se o usuário gera o relatório sem informar os date_default_timezone_set
	if($dataInicial=="" && $dataFinal=="" && $codigoCliente=="" && $status=="" && $operario==""){
		$comando.=" GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente, data inicial, data final, status e operario
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente!="" && $status!="" && $operario!=""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."'
		AND orcamentos.clientes_codigo=".$codigoCliente." AND ordens_de_servicos.status=".$status." AND ordens_de_servicos.usuarios_codigo=".$operario."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente
	else if($dataInicial=="" && $dataFinal=="" && $codigoCliente!="" && $status=="" && $operario==""){
		$comando.= " WHERE orcamentos.clientes_codigo=".$codigoCliente."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente e uma data inicial
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente!="" && $status=="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orcamentos.clientes_codigo=".$codigoCliente."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente, data inicial e data final
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente!="" && $status=="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orcamentos.clientes_codigo=".$codigoCliente."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente, data final e status
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente!="" && $status!="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orcamentos.clientes_codigo=".$codigoCliente." AND ordens_de_servicos.status=".$status."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente e status
	else if($dataInicial=="" && $dataFinal=="" && $codigoCliente!="" && $status!="" && $operario==""){
		$comando.=" WHERE  orcamentos.clientes_codigo=".$codigoCliente." AND ordens_de_servicos.status=".$status."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente e data final
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente!="" && $status=="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orcamentos.clientes_codigo=".$codigoCliente."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por um cliente, data inicial e status
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente!="" && $status!="" && $operario==""){
		$comando.= " WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orcamentos.clientes_codigo=".$codigoCliente." AND ordens_de_servicos.status=".$status."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por data inicial
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente=="" && $status=="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataAtual."' GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por data inicial, data final e status
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente=="" && $status!="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND ordens_de_servicos.status=".$status."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por data final e status
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status!="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND ordens_de_servicos.status=".$status."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por status
	else if($dataInicial=="" && $dataFinal=="" && $codigoCliente=="" && $status!="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.status=".$status."  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por data inicial e data final
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente=="" && $status=="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."'  GROUP BY codigoOrdem";
	}
	//Se o usuário pesquisou por data inicial e status
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente=="" && $status!="" && $operario==""){
		$comando.=" WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND ordens_de_servicos.status=".$status." GROUP BY codigoOrdem";
	}
	//Pesquisa só operario
	else if($dataInicial=="" && $dataFinal=="" && $codigoCliente=="" && $status=="" && $operario!=""){
		$comando.=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." GROUP BY codigoOrdem";
	}
	//Pesquisa operario e DATA INICIAL
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente=="" && $status=="" && $operario!=""){
		$comando .=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataAtual."' GROUP BY codigoOrdem";
	}
	//Pesquisa operario e DATA FINAL
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status=="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataFinal."' GROUP BY codigoOrdem";
	}
	//Pesquisa operario, DATA INICIAL E FINAL
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente=="" && $status=="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."' GROUP BY codigoOrdem";
	}
	//Pesquisa operario e STATUS
	else if($dataInicial=="" && $dataFinal=="" && $codigoCliente=="" && $status!="" && $operario!=""){
		$comando.=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataAtual."' GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e data INICIAl
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente=="" && $status!="" && $operario!=""){
		$comando .=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND ordens_de_servicos.status=".$status." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e data FINAL
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status!="" && $operario!=""){
		$comando.=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND ordens_de_servicos.status=".$status." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e data INICAL E FINAL
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente=="" && $status!="" && $operario!=""){
		$comando.=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND ordens_de_servicos.status=".$status." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e data INICAL E FINAL e cliente
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status!="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND ordens_de_servicos.status=".$status." AND orcamentos.clientes_codigo=".$clientes." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e data INICAL E cliente
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente!="" && $status!="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao
		BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND ordens_de_servicos.status=".$status." AND
		orcamentos.clientes_codigo=".$codigoCliente." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e data FINAL E cliente
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente!="" && $status!="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.data_geracao
		BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND ordens_de_servicos.status=".$status." AND
		orcamentos.clientes_codigo=".$codigoCliente." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e cliente
	else if($dataInicial=="" && $dataFinal=="" && $codigoCliente!="" && $status!="" && $operarios!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.status=".$status." AND
		orcamentos.clientes_codigo=".$codigoCliente." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, status e cliente
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status!="" && $operario!=""){
		$comando.=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND ordens_de_servicos.status=".$status." AND orcamentos.clientes_codigo=".$clientes." GROUP BY codigoOrdem";
	}
	//Pesquisa operario, DATA INICIAL FINAL e cliente
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente!="" && $status=="" && $operario!=""){
		$comando .=" WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND orcamentos.clientes_codigo=".$codigoCliente."
		AND ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."' GROUP BY codigoOrdem";
	}
	//Pesquisa operario, DATA FINAL e cliente
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente!="" && $status=="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND orcamentos.clientes_codigo=".$codigoCliente." AND
		ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataFinal."' GROUP BY codigoOrdem";
	}
	//Pesquisa operario, DATA INICIAL e cliente
	else if($dataInicial!="" && $dataFinal=="" && $codigoCliente!="" && $status=="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND orcamentos.clientes_codigo=".$codigoCliente." AND
		ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataAtual."' GROUP BY codigoOrdem";
	}
	//Pesquisa operario e cliente
	else if($dataInicial=="" && $dataFinal=="" && $codigoCliente!="" && $status=="" && $operario!=""){
		$comando.= " WHERE ordens_de_servicos.usuarios_codigo=".$operario." AND orcamentos.clientes_codigo=".$codigoCliente." GROUP BY codigoOrdem";
	}
	//Pesquisa status e data INICAL E FINAL e cliente
	else if($dataInicial!="" && $dataFinal!="" && $codigoCliente!="" && $status!="" && $operario==""){
		$comando.= " WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND ordens_de_servicos.status=".$status." AND orcamentos.clientes_codigo=".$codigoCliente." GROUP BY codigoOrdem";
	}
	//Pesquisa FINAL
	else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status=="" && $operario==""){
		$comando.= " WHERE ordens_de_servicos.data_geracao BETWEEN '".$dataMinima."' AND '".$dataFinal."' GROUP BY codigoOrdem";
	}
	$resultado = mysqli_query($conexao, $comando);
	$linhas=mysqli_num_rows($resultado);

	if($linhas==0){

	$html="";
?>
<tr><td colspan="5">Nenhum pedido encontrado!</td></tr>
<?php
}//fechamento do IF do LINHAS
	else{
		$ordens=array();
		while($cadaOrdem = mysqli_fetch_assoc($resultado)){
				array_push($ordens,$cadaOrdem);
		}
		$html="";
		foreach ($ordens as $cadaOrdem){
		$lista=exibeProdutos($conexao,$cadaOrdem['codigoOrdem']);
		$lista=substr($lista,0,-2);
		$html.="

		<tr>
			<td>".$cadaOrdem['codigoOrdem']."</td>
			<td>".$cadaOrdem['nomeCli']."</td>
			<td>".$cadaOrdem['preco_total']."</td>
			<td>".$cadaOrdem['nomeOpe']."</td>
			<td>".$lista."</td>
		</tr>
		";

		}//fechamento do FOREACH
		echo $html;
	}//fechamento do ELSE
}//fechamento do primeiro IF
?>
</table>
<form action="geraPDF-Ordem.php" method="POST">
	<input type="hidden" name="html" value="<?=$html?>">
	<button type="submit" class="botoes" id="botaoGerarPdf">
		<img src="../img/button_gerar-pdf.png">
	</button>
</fieldset>
</form>
</main>

</body>
</html>
<?php
	}//fechamento do if
	else{
		header("Location: ../paginasSite/login.php");
	}
?>
