<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Registro de Funcionário</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/editaFuncionario.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="../js/editaFuncionario.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#inputNivelEscondido").trigger('click');
		});
	</script>
</head>
<body>

	<?php include("menuGerente.php"); ?>

	<main>
		<h1 id="tituloPrincipal">Edição de Funcionários</h1>
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
					<legend>Dados Pessoais</legend>
	        <?php
	      	require_once("conexaoBanco.php");

	      	$codigoUsuario = $_POST['codigoUsuario'];

	      	//echo "ID da categoria: ".$idCategoria;

	      	$comando="SELECT * FROM usuarios WHERE codigo=".$codigoUsuario;

	      	$resultado=mysqli_query($conexao,$comando);

	      	$usuarios=mysqli_fetch_assoc($resultado);
	      	// echo $usuarios['codigo']."<br>";
	      	// echo $usuarios['nome']."<br>";
	      	// echo $usuarios['email']."<br>";
	        // echo $usuarios['nivel']."<br>";

					$nivel = $usuarios['nivel'];

	      ?>


	        <input type="hidden" id="inputNivelEscondido" value="<?=$nivel;?>" onclick="retornaNiveis(this.value)">

					<form action="editaFuncionario.php"  method="POST" onsubmit="return validarCampos()">

						<input type="hidden" name="codigoUsuario" value="<?=$usuarios['codigo'];?>">

						<label for="nome" id="labelNome">Nome completo*</label>
						<input type="text" name="nome" id="nome" onkeypress="return onlyChars(event)" size="25" value="<?=$usuarios['nome'];?>">

						<label id="labelNivel">Nível*</label>
						<select name="nivel" id="nivel">

						</select>
						<br><br>

						<label for="email" id="labelEmail">E-mail*</label>
						<input type="text" name="email" id="email" size="34" value="<?=$usuarios['email'];?>">

						<label for="senha" id="labelSenha">Senha</label>
						<input type="password" name="senha" value="" id="senha" maxlength="16">

						<button type="submit" class="botoes"><img src="../img/botao_editar.png"></button>

					</form>
				</fieldset>
	</body>
	</html>
			<?php
			}else{
				header("Location: ../paginasSite/login.php");
			}
			?>
