<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Edição de Ordem de Serviço</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/editaOrdem.css">
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
<?php include("menuGerente.php"); ?>
<main>

	<br><br><br>
	<h1 id="tituloPrincipal">Edição de Ordem de Serviço</h1>
	<?php
	if(isset($_GET['retorno']) && $_GET['retorno']==1){
		include("../alertas/sucesso.php");
	}else if(isset($_GET['retorno']) && $_GET['retorno']==0){
		include("../alertas/erro.php");
	}
	?>
	<form action="editaOrdem.php"  method="POST" onsubmit="return validarCampos()">

	<fieldset class="caixa">
		<legend>Dados Gerais</legend>
    <?php
    	require_once("conexaoBanco.php");
    	$codigo=$_POST['codigoOrdem'];
      $cliente=$_POST['nomeClie'];
      $operario=$_POST['nomeOpe'];
    	$comando="SELECT * FROM ordens_de_servicos WHERE codigo=".$codigo;
    	$resultado=mysqli_query($conexao,$comando);
    	$ordem=mysqli_fetch_assoc($resultado);
    	// echo $ordem['codigo'];
      // echo $cliente;
    	// echo $ordem['data_geracao'];
      // echo $ordem['data_entrega'];
      // echo $operario;
      // echo $ordem['status'];
    ?>

			<label for="codigo" id="labelCodigoOrca">Código do orçamento</label>
			<input type="text" id="codigo" name="codigo" readonly="readonly" value="<?=$ordem['codigo'];?>">

			<label for="nome" id="labelnome">Nome do cliente</label>
			<input type="text" id="codigoClie" name="codigoClie" readonly="readonly" value="<?=$cliente;?>">
			<br><br>

			<label for="dataG" id="labelDataG">Data de geração</label>
			<input type="text" name="dataG" id="dataG" readonly="readonly" value="<?=$ordem['data_geracao'];?>">
			<input type="hidden" name="dataAtual" id="dataAtual">

			<label for="dataE" id="labelDataE">Data da entrega</label>
			<input type="text" name="dataE" id="dataE"  readonly="readonly" value="<?=$ordem['data_entrega'];?>">
			<br><br>

			<label for="funcionario" id="labelFuncionario">Operário responsável</label>
			<input type="text" readonly="readonly" value="<?=$operario;?>">

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

			<label for="status" id="labelStatus">Status</label>
			<select id="status" name= "status">
				<?php
					if($status=="Em aberto"){
				?>
						<option value="1" selected>Em aberto</option>
						<option value="2">Em andamento</option>
						<option value="3">Feita</option>
						<option value="4">Cancelada</option>
					</select>
				<?php
					}else if($status=="Em andamento"){
				?>
						<option value="1">Em aberto</option>
						<option value="2" selected>Em andamento</option>
						<option value="3">Feita</option>
						<option value="4">Cancelada</option>
					</select>
				<?php
					}else if($status=="Feita"){
				?>
						<option value="1">Em aberto</option>
						<option value="2">Em andamento</option>
						<option value="3" selected>Feita</option>
						<option value="4">Cancelada</option>
					</select>
				<?php
					}else if($status=="Cancelada"){
				?>
						<option value="1">Em aberto</option>
						<option value="2">Em andamento</option>
						<option value="3">Feita</option>
						<option value="4" selected>Cancelada</option>
					</select>
				<?php
					}
				?>

			<button type="submit" class="botao"><img src="../img/botao_editar.png"></button>

	</fieldset>
</form>
</body>
</main>
</html>
	<?php
	}else{
		header("Location: ../paginasSite/login.php");
	}
	?>
