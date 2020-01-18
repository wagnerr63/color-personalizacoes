<?php
	session_start();

	if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==2){
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Menu principal</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/paginaAtendente.css">
</head>
	<body>
		<header class="botoesMenu">
				<div id="nav">
		    <ul>
			    <li id="liLogo"><a href="paginaAtendente.php" id="home"><img src="../img/icon.png" alt="Logo Color Personalizações" id="logoHome"></a></li>
				<li id="registros"><a href="#">REGISTROS</a>
				    <ul>
					    <li class="submenus"><a href="registroClienteForm.php">CLIENTES</a></li>
					</ul>
				</li>

				<li id="orcamento"><a href="aberturaOrcamentoForm.php">ORÇAMENTO</a></li>

				<li id="consulta"><a href="consultaOrdem.php">CONSULTA</a></li>

				<p id="bemVindo">Bem vindo(a) Atendente</p>
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
