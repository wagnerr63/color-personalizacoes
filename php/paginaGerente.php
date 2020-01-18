<?php
	session_start();

	if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Página principal - Gerente</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/paginaGerente.css">
</head>

	<body>
		<header class="botoesMenu">
				<div id="nav">
		    <ul>
			    <li id="liLogo"><a href="paginaGerente.php" id="home"><img src="../img/icon.png" alt="Logo Color Personalizações" id="logoHome"></a></li>
				<li id="registros"><a href="#">REGISTROS</a>
				    <ul>
					    <li class="submenus"><a href="registroClienteForm.php">CLIENTES</a></li>
						<li class="submenus" id="funcionarios"><a href="registroFuncionarioForm.php">FUNCIONÁRIOS</a></li>
						<li class="submenus" id="categoria"><a href="registroCategoriaForm.php">CATEGORIAS</a></li>
						<li class="submenus" id="produtos"><a href="registroProdutosForm.php">PRODUTOS</a></li>
					</ul>
				</li>

				<li id="orcamento"><a href="aberturaOrcamentoForm.php">ORÇAMENTO</a></li>
				<li id="ordemDeServico"><a href="aberturaOrdemServicoForm.php">ORDEM DE SERVIÇO</a></li>


				<li id="relatorios"><a href="#">RELATÓRIOS</a>
				    <ul>
					    <li class="submenus"><a href="relatorioDeOrcamentos.php">ORÇAMENTOS</a></li>
						<li class="submenus"><a href="relatorioOrdensDeServico.php">ORDENS DE SERVIÇO</a></li>
					</ul>
				</li>

				<p id="bemVindo">Bem vindo(a) Gerente</p>
				<a href="efetuaLogout.php"><img src="../img/logoutIcon.png" id="logoutIcon" alt="Ícone de logout"></a>
			</ul>
			</div>
		</header>

	</body>
</html>

<?php
}//fechamento do if
else{
	header("Location: ../paginasSite/login.php");
}
?>
