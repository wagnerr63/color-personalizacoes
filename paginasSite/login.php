<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/login.css">
	<script src="../js/login.js"></script>
	<!-- Modal -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
			.modal .modal-dialog { width: 31%; margin-top: 15%;}
	</style>

</head>
<body>
	<div id="home">
	<a href="../index.php"><img src="../img/homeIcon.png"></a>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">

					<!--Janela Modal-->
					<div class="modal-content">
							<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">
										<img  src="../img/excluir.png">
									</button>
									<label class="modal-title">Digite seu e-mail para enviarmos uma nova senha!</label>
							</div>
							<form action="../php/emailSenha.php" method="POST">
							<div class="modal-body">
								<label>E-mail</label>
								<input type="text" name="email">
							</div>
							<div class="modal-footer">
									<button type="submit" class="botoes" id="botaoEnviar">
										<img  src="../img/enviar.png">
									</button>
							</div>
						</form>
					</div>
			</div>
	</div>

<script>
$(document).on('change', '.select-input', function () {
	var value = $(this).val();
	$('.close').trigger('click');
	$('.unidade-input').val(value);
});
</script>
<?php

if(isset($_GET['retorno']) && $_GET['retorno']==1){
?>
	<script>
		alert("Sua nova senha foi enviada para seu e-mail!");
	</script>
<?php
}else if(isset($_GET['retorno']) && $_GET['retorno']!=1){
?>
	<script>
		alert("Ocorreu um erro ao enviar a sua nova senha!");
	</script>

<?php
}
?>
	<div id="divPrincipal">
	<!-- <div id="divImagem">
	<a href="../index.html"><img src="../img/logoComFundo.png" title="Clique para voltar ao menu" alt="Logo color" id="logoColor"></a>
	</div> -->
	<h1 id="login">Login</h1>
	<form id="formularioLogin" action="../php/efetuaLogin.php"  method="POST" onsubmit="return validarCampos()">
	<div id="camposFormulario">
	<div id="divEmail">
	<input type="text" name="campoEmail" id="campoEmail" class="camposFacaSeuLogin" placeholder="E-mail">
	</div>
	<br><br>

	<input type="password" name="campoSenha" id="campoSenha" class="camposFacaSeuLogin" placeholder="Senha">
	<br><br>
	</div>
	<button type="button" id="botaoSenha" data-toggle="modal" data-target="#myModal">Esqueci minha senha</button>
	<br><br>

	<button type="reset" class="botoes" id="botaoLimparCampos"><img src="../img/button_limpar-campos-1.png" alt="Limpar campos" title="Limpar campos"></button>
	<button type="submit" class="botoes" id="botaoEnviar"><img src="../img/button_entrar.png" alt="Entrar" title="Entrar"></button>
	</form>

	</div>
</body>
</html>
