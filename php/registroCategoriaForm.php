<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Registro de categoria</title>
	<link rel="stylesheet" href="../css/registroCategoria.css"> <!--Pra sair da página e encontrar o css-->
	<script src="../js/registroCategoria.js"></script>
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

	<!--Somente números-->
	<script language="Javascript">
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
   </script>
</head>
<body>
<?php include("menuGerente.php"); ?>
<main>

	<br><br><br>
	<h1>Registro de Categoria</h1>

	<div>
		<?php
			//RETORNO VEIO DA PÁGINA registraCategoria.php

			//VERIFICA SE VEIO OU NÃO ALGUMA COISA
			if(isset($_GET['retorno'])==true){
				//SE VIER ALGUMA COISA MOSTRA QUE TEVE SUCESSO
				if($_GET['retorno']==1){
					include("../alertas/sucesso.php");
				//SE NÃO TIVER VINDO NADA MOSTRA ERRO
				}else if ($_GET['retorno']==0){
					include("../alertas/erro.php");
				}else if($_GET['retorno']==2){
					include("../alertas/erroExclusaoCategoria.php");
				}
			}
		?>
	</div>

	<fieldset>
		<legend class="titulo">Informações da Categoria</legend><br>

		<form action="registroCategoria.php" method="POST" onsubmit="return validarCampos()">

				<label for="nomeCategoria" class="campos">Nome da categoria*</label>
				<input type="text" name="nomeCat" id="nomeCat" class="camposForm" size="22px" onkeypress="return onlyChars(event)">
				<br><br>

				<label for="descricao" class="campos" id="campoDesc">Descrição</label>
				<textarea type="text" name="descricao" id="descricao" class="camposForm"></textarea><br><br>

				<button type="reset" class="botoes" id="botaoLimparCampos">
				<img src="../img/limpar_campos.png"></button>

				<button type="submit" class="botoes">
				<img src="../img/cadastrar.png"></button>
		</form>

	</fieldset>

	<fieldset>
		<legend class="titulo">Consulta de Categoria</legend>


		<form action="#" method="GET">
			<table id="tabelaConsulta">
				<tr>
					<td><label for="consultaNomeCate" id="consultaNome" >Nome de categoria</label></td>
					<td><input type="text" id="consultaNomeCate" name="consultaNome" class="camposForm" size="25px" onkeypress="return onlyChars(event)"></td>
					<td><button type="submit" class="botoes" id="botaoConsultar"><img src="../img/consultar.png"></button></td>
				</tr>
				</table>
		</form>

		<table border="1" id="tabelaCategoria">
		<tr>
			<th class="nomeColuna">Código</th>
			<th class="nomeColuna">Nome</th>
			<th class="nomeColuna">Descrição</th>
			<th class="nomeColuna">Ações</th>
		</tr>
		<?php
			//recebe a conexão com o banco, para não repetir código.
			require_once("conexaoBanco.php");

			//usuário acessou a página, mostrar todas as categorias.
			if(isset($_GET['consultaNome'])==false){
				$comando="SELECT * FROM categorias";

			//usuário buscou por categoria, sem digitar nada.
			}else if (isset($_GET['consultaNome'])==true && $_GET['consultaNome']==""){
			$comando="SELECT * FROM categorias";

			//usuário buscou por categoria, digitando algum valor.
			}else if (isset($_GET['consultaNome'])==true && $_GET['consultaNome']!=""){
					$busca = $_GET['consultaNome'];
					$comando="SELECT * FROM categorias WHERE nome LIKE '".$busca."%'";
			}

			//executando o comando SQL no banco para a $conexao que
			//esta vindo do arquivo conexaoBanco.php incluso antes.
			$resultado = mysqli_query($conexao,$comando);
			//verificando quantas linhas foram retornadas da cnsulta utilizando a
			//função msqli_num_rows. Caso seja 0 linhas, nenhuma categoria foi encontrada.
			$linhas=mysqli_num_rows($resultado);
			//Se a consulta retornou 0 linhas, é necessário criar umas linhas na tabela
			//informando "Nenhuma categoria encontrada". Para isso, fechamos o PHP,
			//criamos a linha e fechamos a estrutura de condição ir abrindo o PHP novamente.
			if($linhas==0){
		?>

				<!--HTML-->
				<tr>
					<td colspan="4">Nenhuma categoria encontrada</td>
				</tr>

		<?php
			}//Fechamento do if .
			//Se a consulta não retornou 0 linhas, retornou 1 ou mais, ou seja,
			//temos resultados para exibir.
			else{
				//criamos um array para guardar as linha do retorno da consulta
				$categoriasRetornadas = array();
				//retirar do $resultado as linha de cosulta e guarda-las dentro do array.
				//Cada linha, será guardada na variável $cadaCategoria e depois adicionada
				//no array pela funçÃo array_push. A função mysqli_fetch_assoc organiza
				//cada linha retornada dentro da variável $cadaCategoria.

				while($cadaLinha = mysqli_fetch_assoc($resultado)){
					array_push($categoriasRetornadas,$cadaLinha);
				}
				//O array é uma estrutura semelhante a um vetor, portanto para percorrê-lo
				//é necessário que utilizemos uma estruturs de repetição. Temos o foreach
				//que facilita o processo, é um tipo especial de for, onde, no nosso caso,
				//a variável $cadaCategoria irá assumir cada linha organizada no array
				//$categoriasRetornadas. Sendo assim, extraimos da variável $cadaCategoria
				//o que queremos, pelo nome da chave, que são os campos da tabela categoria.
				foreach($categoriasRetornadas as $cadaCategoria){
				//Como a cada "rodada" do foreach nós precisamos criar uma linha da tabela
				//com o registro, fechamos o foreach somente após o conteúdo HTML ser criado.
		?>

				<tr>
				 	<td><?=$cadaCategoria['codigo'];?></td>
					<td><?=$cadaCategoria['nome'];?></td>
				 	<td><?=$cadaCategoria['descricao'];?></td>
					<td>
				 	<form action="editaCategoriaForm.php" method="POST">
				 		<input type="hidden" name="codigoCat" value="<?=$cadaCategoria['codigo']?>" id="idUsuario">
				 		<button type="submit" class="icones"><img src="../img/editar.png"></button>
				 	</form>
					<form action="excluiCategoria.php" id="espacoBotao" method="POST" onsubmit="return confirmarExclusao()">
				 		<input type="hidden" value="<?=$cadaCategoria['codigo']?>" name="codigoCat" id="idUsuario">
				 		<button type="submit" class="icones"><img src="../img/excluir.png"></button>
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
</html>
<?php
}else{
	header("Location: ../paginasSite/login.php");
}
?>
