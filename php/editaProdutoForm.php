<?php

		session_start();

		if(isset($_SESSION['nivelLogado'])==true && $_SESSION['nivelLogado']==1){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Edição de produto</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/editaProduto.css">
	<script src="../js/editaProdutos.js"></script>

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
</head>

<body>
	<?php include("menuGerente.php"); ?>

  <br><br><br>

    <h1> Edição de Produto</h1>

    <div>
      <?php
        if(isset($_GET['retorno']) && $_GET['retorno']==1){
          include("../alertas/sucesso.php");
        }else if(isset($_GET['retorno']) && $_GET['retorno']==2){
          include("../alertas/erro.php");
        }
      ?>
    </div>

    <fieldset>

      <legend id="titulo">Dados do produto</legend>

      <?php
        require_once("conexaoBanco.php");
      	$codigo=$_POST['codigoPro'];
      	//echo "id do produto: " .$codigo;

      	$comando="SELECT * FROM produtos WHERE codigo=".$codigo;
      	//echo $comando;

      	$resultado=mysqli_query($conexao,$comando);
      	$produto=mysqli_fetch_assoc($resultado);
      	// echo $produto['codigo']."<br>";
      	// echo $produto['nome']."<br>";
        // echo $produto['preco_unitario']."<br>";
        // echo $produto['categorias_codigo']."<br>";
				//echo $produto['imagem'];
      ?>

				<br>

       <form action="editaProduto.php" method="POST" enctype="multipart/form-data" onsubmit="return validarCampos()">

        <input type="hidden" name="codigo" value="<?=$produto['codigo'];?>">

       	<label class="campos">Nome*</label>
       	<input type="text" name="nome" id="nomeProd" size="25px" value="<?=$produto['nome'];?>">

       	<label id="precoUni">Preço Unitário (R$)*</label>
       	<input  type="text" step="any" name="preco" id="preco" value="<?=$produto['preco_unitario'];?>" onkeypress="return (moeda(this,'.',',',event))">

        <label class="campos" id="produtoCat">Categoria*</label>
        <select class="camposForm" id="categoria" name="categoria">
          <?php
          require_once("conexaoBanco.php");

          $comando2="SELECT * FROM categorias";
          //echo $comando;
          $resultado2=mysqli_query($conexao,$comando2);
          $categorias=array();

          while ($cadaCategoria=mysqli_fetch_assoc($resultado2)){
            array_push($categorias, $cadaCategoria);
          }

          foreach ($categorias as $cadaCategoria){
						if($cadaCategoria['codigo']==$produto['categorias_codigo']){
          ?>

					<option selected="selected" value="<?=$cadaCategoria['codigo'];?>">
						<?=$cadaCategoria['nome'];?>
					</option>

          <?php
					}//fechamento do IF
							else{
					?>
						<option value="<?=$cadaCategoria['codigo'];?>">
							<?=$cadaCategoria['nome'];?>
						</option>
					<?php
							}//fechamento do ELSE
						}//fechamento do FOREACH
					?>
        </select>
				<br><br>

				<label for="imagemP" id="imagemAtualProd">Atual:</label>
				<input type="text" name="imagemP" id="imagemP" value="<?=$produto['imagem'];?>" readonly="readonly">

				<label for="imagemP" id="imagemProd">Imagem do produto</label>
				<input type="file" name="imagemEditaPro" id="imagemEditaPro">


        <br><br>
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
