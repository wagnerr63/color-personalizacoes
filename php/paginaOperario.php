<?php
	session_start();

	if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==3){
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Menu principal</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/paginaOperario.css">
</head>
	<body>
		<header class="botoesMenu">
				<div id="nav">
		    <ul>
			    <li id="liLogo"><a href="paginaOperario.php" id="home"><img src="../img/icon.png" alt="Logo Color Personalizações" id="logoHome"></a></li>

				<li id="alterarStatus"><a href="alterarStatusOrdem.php">CONSULTA</a></li>

				<p id="bemVindo">Bem vindo(a) Operário</p>
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
