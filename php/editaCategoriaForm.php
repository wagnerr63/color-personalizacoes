<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Edição de categoria</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/editaCategoria.css">
		<script src="../js/editaCategoria.js"></script>
	</head>

	<body>
		<?php include("menuGerente.php"); ?>

		<br><br><br>

			<h1> Edição de Categoria</h1>

			<div>
				<?php
					if(isset($_GET['retorno']) && $_GET['retorno']==1){
						include("../alertas/sucesso.html");
					}else if(isset($_GET['retorno']) && $_GET['retorno']==2){
						include("../alertas/erro.html");
					}
				?>
			</div>

			<fieldset>

				<legend id="titulo">Informações da Categoria</legend>

				<?php

					require_once("conexaoBanco.php");

					$codigoCat = $_POST['codigoCat'];

					$comando="SELECT * FROM categorias WHERE codigo=".$codigoCat;

					$resultado=mysqli_query($conexao, $comando);

					$categoria=mysqli_fetch_assoc($resultado);
				  // echo $categoria['codigoCat']."<br>";
					// echo $categoria['nome']."<br>";
					// echo $categoria['descricao']."<br>";
				?>

				 <form action="editaCategoria.php" method="POST" onsubmit="return validarCampos()">
					 <input class="inputsForm" type="hidden" name="codigo" value="<?=$categoria['codigo'];?>">

					<br>
					<label class="campos" id="campoDesc">Nome da categoria</label>
					<input class="camposForm" type="text" name="nome" id="nomeCat" value="<?=$categoria['nome'];?>"><br><br>

				 	<label class="campos">Descrição</label>
				 	<textarea class="camposForm" name="descricao" id="descricao"><?=$categoria['descricao'];?></textarea><br>

				 	<button id="botao" type="submit"><img src="../img/botao_editar.png"></button>
				 </form>

			</fieldset>

			</body>
</html>
<?php
}else{
	header("Location: ../paginasSite/login.php");
}
?>
