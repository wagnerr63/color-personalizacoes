<?php

	session_start();

	if(isset($_SESSION['nivelLogado'])==true && ($_SESSION['nivelLogado']==1)){

?>
<?php
require_once("conexaoBanco.php");
function mostraOrcamentos($conexao){
	$comando="SELECT * FROM orcamentos WHERE status=1";
	$resultado=mysqli_query($conexao,$comando);
	$orcamentos=array();

	while($cadaOrcamento = mysqli_fetch_assoc($resultado)){
		array_push($orcamentos,$cadaOrcamento);
	}
	$options="<option value='0'>Selecione...</option>";
	foreach($orcamentos as $cadaOrcamento){
		$options.="<option value='".$cadaOrcamento['codigo']."'>".$cadaOrcamento['codigo']."</option>";
	}
	return $options;

}
?>
<input type="hidden" id="todosOsOrcamentos" type="text" value="<?=mostraOrcamentos($conexao);?>">

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Abertura da Ordem de Servico</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/aberturaOrdemServico.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../js/aberturaOrdemServico.js"></script>

	<script type="text/javascript">
	function onlyChars(e)
	{
	var tecla=new Number();
	if(window.event) {
	tecla = e.keyCode;
	}
	else if(e.which) {
	tecla = e.which;
	}
	else {
	return true;
	}
	if((tecla >= "48") && (tecla <= "57")){
	return false;
	}
	}
	</script>
</head>
<body>

	<?php
		include("menuGerente.php");
	?>
	<br><br>
<main>

	<h1 id="tituloPrincipal">Abertura da Ordem de Serviço</h1>

	<?php
		//RETORNO VEIO DA PÁGINA registraCategoria.php

		//VERIFICA SE VEIO OU NÃO ALGUMA COISA
		if(isset($_GET['retorno'])==true){
			//SE VIER ALGUMA COISA MOSTRA QUE TEVE SUCESSO
			if($_GET['retorno']==1){
				include("../alertas/sucesso.php");
			//SE NÃO TIVER VINDO NADA MOSTRA ERRO
			}else if ($_GET['retorno']==0){
				include("../alertas/erro.php");
			}
		}
	?>

	<form action="aberturaOrdemServico.php"  method="POST" onsubmit="return validarCampos()">

	<fieldset class="caixa">
		<legend>Dados Gerais</legend>

			<br>
			<label for="codigo" id="labelCodigo">Código do orçamento</label>
			<select name="orcamentos" onchange="retornaCodigoCliente()" id="orcamentos" required="required">
				<?=mostraOrcamentos($conexao);?>
			</select>

			<label for="nome" id="labelnome">Nome do cliente</label>
			<input type="text" id="codigoClie" name="codigoClie" readonly="readonly">
			<br><br>

			<label for="dataG" id="labelDataG">Data de geração</label>
			<input type="text" name="dataG" id="dataG" readonly="readonly">
			<input type="hidden" name="dataAtual" id="dataAtual">

			<label for="dataE" id="labelDataE">Data da entrega</label>
			<input type="date" name="dataE" id="dataE">
			<br><br>

			<label for="funcionario" id="labelFuncionario">Operário responsável</label>
			<select id="operarioRes" name="operario">
			<option value="0">Selecione</option>
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
			<br><br>

			<input type="hidden" value="1" name="botaoGerarOr" id="botaoGerarOr">
			<button type="submit" class="botoes"><img src="../img/gerarO.png"></button>

	</fieldset>
	</form>

	<fieldset class="caixa">
		<legend>Consulta de Ordem de Serviço</legend>

		<table id="tabelaConsulta">
			<tr>
			<form action="#" method="GET">
				<td>
					<label for="inputConsulta" id="consulta">Nome do cliente</label>
					<input type="text" name="buscaOrdem" id="inputConsulta" onkeypress="return onlyChars(event)" size="25px">
				</td>
				<td>
					<button type="submit" class="botoes" id="botaoConsultar"><img src="../img/consultar.png"></button>
				</td>
			</form>
			</tr>
		</table>

		<table>
			<tr>
				<th>Código</th>
				<th>Cliente</th>
				<th>Data de entrega</th>
				<th>Funcionário reponsável</th>
				<th>Status</th>
				<th>Ações</th>
			</tr>
			<tr>
				<?php
	if(isset($_GET['buscaOrdem']) && $_GET['buscaOrdem']==""){
		$comando="SELECT ordens_de_servicos.*, orcamentos.codigo as codigoOrca, clientes.nome, usuarios.nome as operario FROM
		ordens_de_servicos INNER JOIN orcamentos ON ordens_de_servicos.orcamentos_codigo = orcamentos.codigo INNER JOIN clientes
		 ON clientes.codigo=orcamentos.clientes_codigo INNER JOIN usuarios ON usuarios.codigo=ordens_de_servicos.usuarios_codigo
		 WHERE ordens_de_servicos.status BETWEEN 1 AND 3";
	}else if (isset($_GET['buscaOrdem'])==false ){
		$comando="SELECT ordens_de_servicos.*, orcamentos.codigo as codigoOrca, clientes.nome, usuarios.nome as operario FROM
		ordens_de_servicos INNER JOIN orcamentos ON ordens_de_servicos.orcamentos_codigo = orcamentos.codigo INNER JOIN clientes
		 ON clientes.codigo=orcamentos.clientes_codigo INNER JOIN usuarios ON usuarios.codigo=ordens_de_servicos.usuarios_codigo
		  WHERE ordens_de_servicos.status BETWEEN 1 AND 3";
	}else if(isset($_GET['buscaOrdem']) && $_GET['buscaOrdem']!=""){
		$buscaOrdem=$_GET['buscaOrdem'];
		$comando="SELECT ordens_de_servicos.*, orcamentos.codigo as codigoOrca, clientes.nome, usuarios.nome as operario FROM
		ordens_de_servicos INNER JOIN orcamentos ON ordens_de_servicos.orcamentos_codigo = orcamentos.codigo INNER JOIN clientes
		 ON clientes.codigo=orcamentos.clientes_codigo INNER JOIN usuarios ON usuarios.codigo=ordens_de_servicos.usuarios_codigo
		 WHERE LOWER(clientes.nome) LIKE '".$buscaOrdem."%'";
	}
		$resultado=mysqli_query($conexao,$comando);
		$linhas= mysqli_num_rows($resultado);
		if($linhas==0){ ?>
		<tr>
			<td colspan="6">Nenhuma ordem de serviço encontrada!</td>
		</tr>
			<?php
				}else{
					$ordens=array();
					while($cadaOrdem=mysqli_fetch_assoc($resultado)){
						array_push($ordens, $cadaOrdem);
					}
					foreach ($ordens as $cadaOrdem) {
					?>
					<tr>
						<td><?=$cadaOrdem['codigo'];?></td>
						<td><?=$cadaOrdem['nome'];?></td>
						<td><?php
						echo $data=date("d/m/Y",strtotime($cadaOrdem['data_entrega']));

						?></td>
						<td><?=$cadaOrdem['operario'];?></td>
						<td><?php
						if($cadaOrdem['status']==1){
							echo "Em aberto";
						}
						if($cadaOrdem['status']==2){
							echo "Em andamento";
						}
						if($cadaOrdem['status']==3){
							echo "Feita";
						};
						if($cadaOrdem['status']==4){
							echo "Cancelada";
						};
						?></td>
						<td>
							<form action="editaOrdemForm.php" method="POST">
								<input type="hidden" name="codigoOrdem" value="<?=$cadaOrdem['codigo'];?>">
								<input type="hidden" name="nomeClie" value="<?=$cadaOrdem['nome'];?>">
								<input type="hidden" name="nomeOpe" value="<?=$cadaOrdem['operario'];?>">
								<button class="botoesTabela" type="submit"><img src="../img/editar.png"></button>
							</form>
							<form action="cancelaOrdem.php" method="POST">
								<input type="hidden" name="codigoOrdem" value="<?=$cadaOrdem['codigo'];?>">
								<input type="hidden" name="nomeClie" value="<?=$cadaOrdem['nome'];?>">
								<input type="hidden" name="nomeOpe" value="<?=$cadaOrdem['operario'];?>">
								<button class="botoesTabela" type="submit"><img src="../img/excluir.png" onclick="return confirm('Tem certeza que deseja cancelar esta ordem de serviço?');"></button>
							</form>
						</td>
					</tr>
					<?php
					}
				}
		?>
		</table>

	</fieldset>
</main>

</body>
</html>
<?php
	}//fechamento do if
	else{
		header("Location: ../paginasSite/login.php");
	}
?>
