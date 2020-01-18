<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==3){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Edição da Ordem de Servico</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/editaOrdemOperario.css">
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

<?php include("menuOperario.php"); ?>

<main>

	<br><br><br>
	<h1 id="tituloPrincipal">Edição da Ordem de Serviço</h1>
	<div>
		<?php
				if(isset($_GET['retorno']) && $_GET['retorno']==1){
					include("../alertas/sucesso.php");
				}else if(isset($_GET['retorno']) && $_GET['retorno']==2){
					include("../alertas/erro.php");
				}
		?>
	</div>
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
		<form action="editaOrdemOperario.php"  method="POST">

			<input type="hidden" name="codigoOrdem" value= "<?=$ordem['codigo'];?>">

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
			<input type="text" name="nomeFuncionario" id="nomeFuncionario" readonly="readonly" value="<?=$ordem['nome_funcionario'];?>">
				<!--<select id="funcionario" name="funcionario" readonly="readonly">
					<option value="0" selected>Selecione</option>
					<option value="1">Marcelinho</option>
					<option value="2">Ricardo</option>
					<option value="3">Rodolfo</option>
					<option value="4">Carina</option>
				</select>-->

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

				<br><br>

        <button type="submit" class="botoes">
          <img src="../img/botao_editar.png" alt="Editar">
        </button>

	</fieldset>
	</form>
</main>

</body>
</html>
<?php
}else{
	header("Location: ../paginasSite/login.php");
}
?>
