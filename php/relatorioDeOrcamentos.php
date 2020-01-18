<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<title>Relatório de Orçamento</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/relatorioDeOrcamentos.css">
</head>
<body>
<?php include("menuGerente.php"); ?>
<main>

	<h1 id="tituloPrincipal">Relatório de Orçamento</h1>

	<fieldset class="caixa">
		<legend>Filtros</legend>

		<form action="#"  method="GET">
			<label id="labelCliente">Cliente</label>
			<select name="cliente" id="cliente">
			<option value="">Selecione</option>
			<?php
				require_once("conexaoBanco.php");

				$comando = "SELECT codigo, nome FROM clientes";

				$resultado = mysqli_query($conexao, $comando);

				$clientes = array();

				while($cadaCliente = mysqli_fetch_assoc($resultado)){
					array_push($clientes, $cadaCliente);
				}

				foreach ($clientes as $cadaCliente){
			?>
				<option value="<?=$cadaCliente['codigo'];?>">
	 										<?=$cadaCliente['nome'];?>
	 	 		</option>
	 	  <?php
	 			}//fechamento do FOREACH
	 	  ?>
			</select>

			<label for="dataInicial" id="labelDataInicial">Data Inicial</label>
			<input type="date" name="dataInicial" id="dataInicial">

			<br>
			<br>

			<label id="labelStatus">Status</label>
			<select name="status" id="status">
				<option value="">Selecione</option>
				<option value="1">Em aberto</option>
				<option value="2">Aprovado</option>
				<option value="3">Rejeitado</option>
			</select>

			<label for="dataFinal" id="labelDataFinal">Data Final</label>
			<input type="date" name="dataFinal" id="dataFinal">

			<br>
			<br>

			<button type="reset" class="botoes" id="botaoLimpar"><img src="../img/limpar.png"></button>
			<button type="submit" class="botoes"><img src="../img/button_pesquisar.png"></button>

		</form>
	</fieldset>
<?php
function exibeProdutos($conexao, $idOrc){
$comando="SELECT produtos.nome FROM produtos
INNER JOIN orcamentos_has_produtos ON produtos.codigo=orcamentos_has_produtos.produtos_codigo
INNER JOIN orcamentos ON orcamentos_has_produtos.orcamentos_codigo=orcamentos.codigo
WHERE orcamentos.codigo=".$idOrc;

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


<fieldset class="caixa" id="tabelaRelatorio">
	<legend id="tituloRelatorio">Relatório</legend>

	<form>
		<table>
			<tr>
				<th>Código</th>
				<th>Cliente</th>
				<th>Valor total</th>
				<th>Produtos</th>
			</tr>

		<?php

		//Se o usuário clicar no PESQUISAR
		if(isset($_GET['dataInicial']) && isset($_GET['dataFinal']) && isset($_GET['cliente']) && isset($_GET['status'])){
			$dataInicial = $_GET['dataInicial'];
			$dataFinal = $_GET['dataFinal'];
			$codigoCliente = $_GET['cliente'];
			$status = $_GET['status'];

			$dataAtual=date('Y/m/d');
			$dataMinima='2004/01/01';

			//Se o usuário gera o relatório sem informar os date_default_timezone_set
			if($dataInicial=="" && $dataFinal=="" && $codigoCliente=="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente, data inicial, data final e status
			else if($dataInicial!="" && $dataFinal!="" && $codigoCliente!="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orc.clientes_codigo=".$codigoCliente." AND orc.status=".$status." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente
			else if($dataInicial=="" && $dataFinal=="" && $codigoCliente!="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.clientes_codigo=".$codigoCliente." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente e uma data inicial
			else if($dataInicial!="" && $dataFinal=="" && $codigoCliente!="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orc.clientes_codigo=".$codigoCliente." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente, data inicial e data final
			else if($dataInicial!="" && $dataFinal!="" && $codigoCliente!="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orc.clientes_codigo=".$codigoCliente." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente, data final e status
			else if($dataInicial=="" && $dataFinal!="" && $codigoCliente!="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orc.clientes_codigo=".$codigoCliente." AND orc.status=".$status." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente e status
			else if($dataInicial=="" && $dataFinal=="" && $codigoCliente!="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE  orc.clientes_codigo=".$codigoCliente." AND orc.status=".$status." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente e data final
			else if($dataInicial=="" && $dataFinal!="" && $codigoCliente!="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orc.clientes_codigo=".$codigoCliente." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por um cliente, data inicial e status
			else if($dataInicial!="" && $dataFinal=="" && $codigoCliente!="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orc.clientes_codigo=".$codigoCliente." AND orc.status=".$status." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por data inicial
			else if($dataInicial!="" && $dataFinal=="" && $codigoCliente=="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por data inicial, data final e status
			else if($dataInicial!="" && $dataFinal!="" && $codigoCliente=="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orc.status=".$status." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por data final e status
			else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orc.status=".$status." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por status
			else if($dataInicial=="" && $dataFinal=="" && $codigoCliente=="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.status=".$status." GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por data inicial e data final
			else if($dataInicial!="" && $dataFinal!="" && $codigoCliente=="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por data final
			else if($dataInicial=="" && $dataFinal!="" && $codigoCliente=="" && $status==""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' GROUP BY orc.codigo";
			}
			//Se o usuário pesquisou por data inicial e status
			else if($dataInicial!="" && $dataFinal=="" && $codigoCliente=="" && $status!=""){
				$comando = "SELECT orc.codigo, orc.preco_total,
				cli.nome as nomeCli, pro.nome FROM clientes as cli INNER JOIN orcamentos as orc ON
				cli.codigo=orc.clientes_codigo INNER JOIN
				orcamentos_has_produtos as orcEpro ON
				orc.codigo=orcEpro.orcamentos_codigo INNER JOIN
				produtos as pro ON
				orcEpro.produtos_codigo=pro.codigo WHERE orc.data_emissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orc.status=".$status." GROUP BY orc.codigo";
			}

			$resultado = mysqli_query($conexao, $comando);
			$linhas = mysqli_num_rows($resultado);

			if($linhas==0){

					$html = "";
		?>

		<tr>
			<td colspan="4">Nenhum orçamento encontrado!</td>
		</tr>
		<?php
			}//fechamento if linhas
			else{
				$orcamentos = array();

				while($cadaOrc = mysqli_fetch_assoc($resultado)){
					array_push($orcamentos, $cadaOrc);
				}

				$html = "";

				foreach ($orcamentos as $cadaOrc){
					$lista=exibeProdutos($conexao,$cadaOrc['codigo']);
					$lista=substr($lista,0,-2);
					$html.="

					<tr>
						<td>".$cadaOrc['codigo']."</td>
						<td>".$cadaOrc['nomeCli']."</td>
						<td>".$cadaOrc['preco_total']."</td>
						<td>".$lista."</td>
					</tr>
					";
				}//fechamento do foreach
				echo $html;
			}//fechamento do else
		}//fechamento do primeiro if
		?>

		</table>
	</form>

		<form action="geraPDF.php" method="POST">
			<input type="hidden" name="html" value="<?=$html?>">
			<button type="submit" class="botoes "id="botaoGerarPdf">
				<img src="../img/button_gerar-pdf.png">
			</button>
		</form>

		</fieldset>
	</main>
	</body>
</html>
<?php
}else{
	header("Location: ../paginasSite/login.php");
}
?>
