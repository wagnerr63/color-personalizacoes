<?php

	session_start();

	if(isset($_SESSION['nivelLogado'])==true && ($_SESSION['nivelLogado']==2 )){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Visualizar Ordem de Servico</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/visualizaOrdemConsulta.css">
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
<?php include("menuAtendente.php"); ?>

<main>

	<br><br><br>
	<h1 id="tituloPrincipal">Visualizar Ordem de Serviço</h1>

	<fieldset class="caixa">
		<legend>Dados Gerais</legend>

		<?php
			require_once("conexaoBanco.php");

			$codigoOrdem = $_POST['codigoOrdem'];
			//echo $codigoOrdem;

			$comando = "SELECT clientes.nome AS nome_cliente, ordens_de_servicos.codigo, ordens_de_servicos.data_geracao, ordens_de_servicos.status,
			usuarios.nome AS nome_funcionario, ordens_de_servicos.data_entrega FROM clientes INNER JOIN orcamentos
			ON clientes.codigo=orcamentos.clientes_codigo INNER JOIN ordens_de_servicos
			ON ordens_de_servicos.orcamentos_codigo=orcamentos.codigo INNER JOIN usuarios
			ON ordens_de_servicos.usuarios_codigo=usuarios.codigo
			WHERE ordens_de_servicos.codigo=".$codigoOrdem;

			$resultado = mysqli_query($conexao, $comando);

			$ordem = mysqli_fetch_assoc($resultado);

			/*echo $ordem['codigo'] ."<br>";
			echo $ordem['nome_cliente'] ."<br>";
			echo $ordem['data_entrega'] ."<br>";
			echo $ordem['nome_funcionario'] ."<br>";
			echo $ordem['data_geracao'] ."<br>";
			echo $ordem['status'] ."<br>";*/
		?>

		<br>
		<form action="#"  method="POST" onsubmit="return validarCampos()">

			<label for="codigo" id="labelCodigo">Código do orçamento</label>
      <input type="text" name="codigo" id="codigo" readonly="readonly" value="<?=$ordem['codigo'];?>">
				<!-- <select id="codigo" name="codigo" readonly="readonly">
					<option value="1">000</option>
					<option value="2">001</option>
					<option value="3">003</option>
					<option value="3">004</option>
				</select> -->

			<label for="nome" id="labelnome">Nome do cliente</label>
			<input type="text" name="nome" id="nome" readonly="readonly" value="<?=$ordem['nome_cliente'];?>">
			<br><br>

			<label for="dataG" id="labelDataG">Data de geração</label>
			<input type="date" name="dataG" id="dataG" readonly="readonly" value="<?=$ordem['data_geracao'];?>">

			<label for="dataE" id="labelDataE">Data da entrega</label>
			<input type="date" name="dataE" id="dataE" readonly="readonly" value="<?=$ordem['data_entrega'];?>">
			<br><br>

			<label for="funcionario" id="labelFuncionario">Operário responsável</label>
			<input type="text" name="nome" id="nome" readonly="readonly" value="<?=$ordem['nome_funcionario'];?>">
				<!--<select id="funcionario" name="funcionario" readonly="readonly">
					<option value="0" selected>Selecione</option>
					<option value="1">Marcelinho</option>
					<option value="2">Ricardo</option>
					<option value="3">Rodolfo</option>
					<option value="4">Carina</option>
				</select>-->

				<label for="status" id="labelStatus">Status</label>
				<?php
				if($ordem['status']==1){
					$status = "Em aberto";
				}else if($ordem['status']==2){
					$status = "Em andamento";
				}else if($ordem['status']==3){
					$status = "Feita";
				}else if($ordem['status']==4){
					$status = "Cancelada";
				}
				?>
				<input type="text" name="status" id="status" readonly="readonly" value="<?=$status ?>">
				<br><br>

			<button type="button" class="botao"><a href="consultaOrdem.php">
        <img src="../img/voltar.png">
      </a></button>

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
