<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==3){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
		<title>Alteração das Ordens de Serviço</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/consultaOrdem.css">
		<!--Sem número no nome-->
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
		<h1 id="tituloPrincipal">Alteração da ordem de serviço</h1>

		<div>
			<?php
				//RETORNO VEIO DA PÁGINA registraCategoria.php

				//VERIFICA SE VEIO OU NÃO ALGUMA COISA
				if(isset($_GET['retorno'])==true){
					if($_GET['retorno']==1){
						include("../alertas/sucesso.php");
					}else if ($_GET['retorno']==0){
						include("../alertas/erro.php");
				}
	    }
			?>
		</div>

		<fieldset class="caixa">
		<legend>Consulta</legend>
		<form action="#" method="GET">

		<table border="1" id="tabelaConsulta">
		<tr>

			<form action="#" method="GET">
			<td>
				<label for="consultaNomeCliente" id="consultaNome">Nome do cliente</label>
				<input type="text" id="consultaNomeCliente" name="consultaNomeCliente" class="camposForm" size="25px" onkeypress="return onlyChars(event)">
			</td>
			<td>
				<button type="submit" class="botoes" id="botaoConsultar">
					<img src="../img/consultar.png">
				</button>
			</td>
			</form>

		</tr>
		</table>

				<table id="tabela">
					<tr>
						<th>Código</th>
						<th>Cliente</th>
						<th>Data de entrega</th>
						<th>Funcionário responsável</th>
						<th>Status</th>
						<th>Ações</th>
					</tr>

				<?php

					require_once("conexaoBanco.php");

					//Acesso a página
					if(isset($_GET['consultaNomeCliente'])==false){
						$comando = "SELECT clientes.nome AS nome_cliente, ordens_de_servicos.codigo, ordens_de_servicos.status, usuarios.nome AS
						nome_funcionario, ordens_de_servicos.data_entrega FROM clientes INNER JOIN orcamentos
						ON clientes.codigo=orcamentos.clientes_codigo INNER JOIN ordens_de_servicos
						ON ordens_de_servicos.orcamentos_codigo=orcamentos.codigo INNER JOIN usuarios
						ON ordens_de_servicos.usuarios_codigo=usuarios.codigo";
					//Busca na lupa
					}else if(isset($_GET['consultaNomeCliente'])==true && $_GET['consultaNomeCliente']==""){
						$comando = "SELECT clientes.nome AS nome_cliente, ordens_de_servicos.codigo, ordens_de_servicos.status, usuarios.nome AS
						nome_funcionario, ordens_de_servicos.data_entrega FROM clientes INNER JOIN orcamentos
						ON clientes.codigo=orcamentos.clientes_codigo INNER JOIN ordens_de_servicos
						ON ordens_de_servicos.orcamentos_codigo=orcamentos.codigo INNER JOIN usuarios
						ON ordens_de_servicos.usuarios_codigo=usuarios.codigo";
					//Pesquisa algo
					}else if(isset($_GET['consultaNomeCliente'])==true && $_GET['consultaNomeCliente']!=""){
						$busca = $_GET['consultaNomeCliente'];
						$comando = "SELECT clientes.nome AS nome_cliente, ordens_de_servicos.codigo, ordens_de_servicos.status, usuarios.nome AS
						nome_funcionario, ordens_de_servicos.data_entrega FROM clientes INNER JOIN orcamentos
						ON clientes.codigo=orcamentos.clientes_codigo INNER JOIN ordens_de_servicos
						ON ordens_de_servicos.orcamentos_codigo=orcamentos.codigo INNER JOIN usuarios
						ON ordens_de_servicos.usuarios_codigo=usuarios.codigo WHERE clientes.nome LIKE '".$busca."%'";
					}

					//echo $comando;

					$resultado = mysqli_query($conexao, $comando);

					$linhas = mysqli_num_rows($resultado);

				if($linhas==0){
				?>
					<tr>
						<td colspan="6">Nenhuma ordem de serviço foi encontrada</td>
					</tr>
				<?php
				}//fechamento do if
				else{
					//Array para guardar as linhas
					$ordensRetornados = array();

					//Cada linha vai ser guardada na var $cadaOrdem e adicionada no array array_push

					//O mysqli_fetch_assoc organiza cada linha
					while($cadaLinha = mysqli_fetch_assoc($resultado)){
						array_push($ordensRetornados, $cadaLinha);
					}

					//Um for que no caso é o foreach, a var $cadaOrdem vai assumir $ordensRetornados
					foreach ($ordensRetornados as $cadaOrdem){
					//Criando uma linha da tabela para cada cliente
					?>

					<tr>
						<td> <?php echo $cadaOrdem['codigo'] ?></td>
						<td> <?php echo $cadaOrdem['nome_cliente'] ?></td>
						<td> <?php echo $data=date("d/m/Y",strtotime($cadaOrdem['data_entrega']));?></td>
						<td> <?php echo $cadaOrdem['nome_funcionario'] ?></td>
						<td> <?php if($cadaOrdem['status']==1){
									$status = "Em aberto";
								}else if($cadaOrdem['status']==2){
									$status = "Em andamento";
								}else if($cadaOrdem['status']==3){
									$status = "Feita";
								}else if($cadaOrdem['status']==4){
									$status = "Cancelada";
								}
								echo $status ?>
						</td>

						<td id="acoes">
							<form action="editaOrdemOperarioForm.php" method="POST">
								<input type="hidden" value="<?=$cadaOrdem['codigo'];?>" name="codigoOrdem">
								<button type="submit" class="botoes">
									<img src="../img/editar.png">
								</button>
							</form>

							<form action="visualizaOrdemAlterarStatus.php" method="POST">
								<input type="hidden" value="<?=$cadaOrdem['codigo'];?>" name="codigoOrdem">
								<button type="submit" class="botoes2">
									<img src="../img/visualizar.png">
								</button>
							</form>
						</td>
					</tr>

					<?php
							}//fechamento foreach
						}//fechamento else
					?>

				</table>

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
