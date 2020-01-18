<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Registro de Funcionário</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/registroFuncionario.css">
	<script src="../js/registroFuncionario.js"></script>

</head>
<body>

	<?php include("menuGerente.php"); ?>

<main>
	<h1 id="tituloPrincipal">Registro de Funcionários</h1>
	<div>
		<?php
			if((isset($_GET['retorno'])==true)&&($_GET['retorno']==1)){
				include("../alertas/sucesso.php");
			}elseif((isset($_GET['retorno'])==true)&&($_GET['retorno']==0)) {
				include("../alertas/erro.php");
			}elseif((isset($_GET['retorno'])==true)&&($_GET['retorno']==2)) {
				include("../alertas/erroExclusaoFuncionario.php");
			}
		?>
	</div>

		<form action="registroFuncionario.php"  method="POST" onsubmit="return validarCampos()">
		<fieldset class="caixa">
				<legend>Dados Pessoais</legend>
				<br>

				<label for="nome" id="labelNome">Nome completo*</label>
				<input type="text" name="nome" id="nome" onkeypress="return onlyChars(event)" size="25">

				<label id="labelNivel">Nível*</label>
				<select name="nivel" id="nivel">
					<option value="Selecione">Selecione</option>
					<option value="1">Gerente</option>
					<option value="2">Atendente</option>
					<option value="3">Operário</option>
				</select>
				<br><br>

				<label for="email" id="labelEmail">E-mail*</label>
				<input type="text" name="email" id="email" size="34">

				<label for="senha" id="labelSenha">Senha*</label>
				<input type="password" name="senha" id="senha" maxlength="16">

				<button type="reset" class="botoes" id="botaoLimpar"><img src="../img/limpar_campos.png"></button>
				<button type="submit" class="botoes"><img src="../img/cadastrar.png"></button>
			</fieldset>
		</form>

			<fieldset class="caixa">
				<legend>Consulta de Funcionários</legend>
				<table id="tabelaConsulta">
				<tr>

				<form action="registroFuncionarioForm.php" method="GET">
				<td>
				<label for="consultaNomeCate" id="consultaNome">Nome do Funcionário</label>
				<input type="text" id="consultaNome" name="consultaNome" class="camposForm" onkeypress="return onlyChars(event)" size="25px">
				</td>
				<td>
				<button type="submit" class="botoes" id="botaoConsultar">
				<img src="../img/consultar.png"></button>
				</td>
				</form>

				</tr>
				</table>

				<table id="tabelaConsulta2">
					<tr>
						<th>Código</th>
						<th>E-mail</th>
						<th>Nome de Usuário</th>
						<th>Nível</th>
						<th>Ações</th>
					</tr>
					<tr>
						<?php
						require_once("conexaoBanco.php");

						//usuário acessou a página, mostrar todas as cat.

						if(isset($_GET['consultaNome'])==false){
							$comando="SELECT * FROM usuarios";

						}else if (isset($_GET['consultaNome'])==true && $_GET['consultaNome']==""){
							$comando="SELECT * FROM usuarios";

						}else if (isset($_GET['consultaNome'])==true && $_GET['consultaNome']!=""){
								$busca = $_GET['consultaNome'];
								$comando="SELECT * FROM usuarios WHERE nome LIKE '%".$busca."%'";
							}
						$resultado = mysqli_query($conexao,$comando);
						$linhas=mysqli_num_rows($resultado);
						if($linhas==0){		?>

						<tr>
							<td colspan="5">Nenhuma categoria encontrada</td>
						</tr>

						<?php
							}else{
								$usuariosRetornados = array();

								while($cadaLinha = mysqli_fetch_assoc($resultado)){
									array_push($usuariosRetornados,$cadaLinha);
								}
								foreach($usuariosRetornados as $cadaUsuario){
								?>
								<tr>

								<td> <?php echo $cadaUsuario['codigo'];?> </td>
								<td> <?php echo $cadaUsuario['email'];?> </td>
								<td> <?php echo $cadaUsuario['nome'];?> </td>
								<td> <?php
								 if ($cadaUsuario['nivel']==1){
									 echo "Gerente";
								 }else if($cadaUsuario['nivel']==2){
									 	echo "Atendente";
								 }else if($cadaUsuario['nivel']==3){
									 echo "Operário";
								 }else if($cadaUsuario['nivel']==4){
									 echo "Administrador";
								 }
								 ?>
							 </td>
								<td>

								<form class="formAcoes" class="editafun" action="editaFuncionarioForm.php" method="post">
									<input type="hidden" name="codigoUsuario" value="<?php echo $cadaUsuario['codigo'];?>">
									<button class="botoesAcao" type="submit">
										<img src="../img/editar.png">
									</button>
								</form>

								<form class="formAcoes" class="espacoBotao" action="excluiFuncionario.php" method="POST" onsubmit="return confirmarExclusao()">
									<input type="hidden" name="codigoUsuario" value="<?php echo $cadaUsuario['codigo'];?>">
									<button class="botoesAcao" type="submit">
										<img src="../img/excluir.png">
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
	</main>
</body>
</html>
<?php
}else{
	header("Location: ../paginasSite/login.php");
}
?>
