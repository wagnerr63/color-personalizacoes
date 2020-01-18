<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Registro de Produtos</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/registroProdutos.css">
	<script src="../js/registroProdutos.js"></script>

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
	<script language="javascript">
	function moeda(a, e, r, t) {
		let n = ""
		  , h = j = 0
		  , u = tamanho2 = 0
		  , l = ajd2 = ""
		  , o = window.Event ? t.which : t.keyCode;
		if (13 == o || 8 == o)
			return !0;
		if (n = String.fromCharCode(o),
		-1 == "0123456789".indexOf(n))
			return !1;
		for (u = a.value.length,
		h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
			;
		for (l = ""; h < u; h++)
			-1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
		if (l += n,
		0 == (u = l.length) && (a.value = ""),
		1 == u && (a.value = "0" + r + "0" + l),
		2 == u && (a.value = "0" + r + l),
		u > 2) {
			for (ajd2 = "",
			j = 0,
			h = u - 3; h >= 0; h--)
				3 == j && (ajd2 += e,
				j = 0),
				ajd2 += l.charAt(h),
				j++;
			for (a.value = "",
			tamanho2 = ajd2.length,
			h = tamanho2 - 1; h >= 0; h--)
				a.value += ajd2.charAt(h);
			a.value += r + l.substr(u - 2, u)
		}
		return !1
	}
	</script>

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
		<h1 id="tituloPrincipal">Registro de Produtos</h1>

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
						include("../alertas/erroExclusaoProduto.php");
					}
				}
			?>
		</div>

		<form action="registroProdutos.php"  method="POST" enctype="multipart/form-data" onsubmit="return validarCampos()">
			<fieldset class="caixa">
				<legend>Informações dos Produtos</legend>

						<br>

						<label for="nome" id="labelNome">Nome*</label>
						<input type="text" name="nome" id="nome" onkeypress="return onlyChars(event)" size="25px">

						<label for="precoUni" id="labelPrecoUn">Preço Unitário (R$)*</label>
						<input type="text" name="precoUni" id="precoUni" onkeypress="return (moeda(this,'.',',',event))">

						<br><br>

						<label for="categoria" id="labelCatProd">Categoria*</label>
						<select id="categoriaProd" name="categorias">
							<option value="0">Selecione</option>
							<?php
							require_once("conexaoBanco.php");
										//PAREI AQUI
							$comando="SELECT codigo, nome FROM categorias";
							//echo $comando;
							$resultado=mysqli_query($conexao,$comando);
							$categorias=array();

							while ($cadaCategoria=mysqli_fetch_assoc($resultado)){
								array_push($categorias, $cadaCategoria);
							}

							foreach ($categorias as $cadaCategoria){
							?>

							<option value="<?=$cadaCategoria['codigo'];?>">
								<?=$cadaCategoria['nome'];?>
							</option>

							<?php	}	// fechamento foreach	?>
						</select>

						<label for="imagemP" id="imagemProd">Imagem do produto</label>
						<input type="file" name="imagemP" id="imagemP">
						<br><br>


					<button type="reset" class="botoes" id="botaoLimpar">
						<img src="../img/limpar_campos.png">
					</button>

					<button type="submit" class="botoes">
						<img src="../img/cadastrar.png">
					</button>

			</fieldset>
		</form>

		<form action="#" method="GET">
			<fieldset class="caixa">
				<legend>Consulta de Produtos</legend>

					<table border="1" id="tabelaConsulta">
						<tr>

						<form action="#" method="GET">
						<td>
							<label for="consultaNome" id="consultaNome">Nome do produto</label>
							<input type="text" id="consultaNome" name="consultaNomePr" onkeypress="return onlyChars(event)" size="25px">
						</td>
						<td>
							<button type="submit" class="botoes" id="botaoConsultar">
							<img src="../img/consultar.png"></button>
						</td>
						</form>

						</tr>
					</table>

				<table order="1" id="tabelaProduto">
					<tr>
						<th>Código</th>
						<th>Nome</th>
						<th>Preço Unitário</th>
						<th>Categoria</th>
						<th>Ações</th>
					</tr>

					<?php
					require_once("conexaoBanco.php");

					if(isset($_GET['consultaNomePr']) && $_GET['consultaNomePr']==""){
				   $comando="SELECT p.*, c.nome as nomeCat FROM produtos as p INNER JOIN categorias as c on p.categorias_codigo=c.codigo";
					}
					else if(isset($_GET['consultaNomePr'])==false){
					  $comando="SELECT p.*, c.nome as nomeCat FROM produtos as p INNER JOIN categorias as c on p.categorias_codigo=c.codigo";
					}
					else if(isset($_GET['consultaNomePr']) && $_GET['consultaNomePr']!=""){
						$consultaNomePr=$_GET['consultaNomePr'];
					  $comando="SELECT p.*, c.nome as nomeCat FROM produtos as p INNER JOIN categorias as c on p.categorias_codigo=c.codigo WHERE LOWER(p.nome) LIKE '%".$consultaNomePr."%'";
					}

						$resultado=mysqli_query($conexao,$comando);
						$linhas=mysqli_num_rows($resultado);

						if($linhas==0){
					?>
					 <tr>
						 <td colspan="5">Nenhum produto encontrado!</td>
					 </tr>
					<?php
						}//fechamento do IF
						else{
							$produtos=array();

							while($cadaProduto=mysqli_fetch_assoc($resultado)){
								array_push($produtos,$cadaProduto);
							}
							foreach($produtos as $cadaProduto){
							?>

								<tr>
									<td><?=$cadaProduto['codigo'];?></td>
									<td><?=$cadaProduto['nome'];?></td>
									<td><?="R$ ".$cadaProduto['preco_unitario'];?></td>
									<td><?=$cadaProduto['nomeCat'];?></td>
									<td>
										<form class="formAcoes" action="editaProdutoForm.php" method="POST">
											<input type="hidden" name="codigoPro" value="<?=$cadaProduto['codigo'];?>">
											<button class="icones" type="submit">
												<img src="../img/editar.png">
											</button>
										</form>

										<form class="formAcoes" action="excluiProduto.php" method="POST" onsubmit="return confirmarExclusao()">
												<input type="hidden" name="codigoPro" value="<?=$cadaProduto['codigo'];?>">
												<button class="icones" type="submit">
													<img src="../img/excluir.png">
												</button>
										</form>
									</td>
									</tr>
									<?php
									}//fechamento doFOREACH
									}//fechamtno do ELSE
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
