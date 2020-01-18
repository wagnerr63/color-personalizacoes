<?php

	session_start();

	if(isset($_SESSION['nivelLogado'])==true && ($_SESSION['nivelLogado']==1 || $_SESSION['nivelLogado']==2)){
?>
<?php
require_once("conexaoBanco.php");
function mostraCategorias($conexao){
	$comando="SELECT codigo, nome FROM categorias";
	$resultado=mysqli_query($conexao,$comando);
	$categorias = array();

	while($cadaCategoria = mysqli_fetch_assoc($resultado)){
		array_push($categorias, $cadaCategoria);
	}
	$options="";
	foreach($categorias as $cadaCategoria){
	$options.="<option value='".$cadaCategoria['codigo']."'>".$cadaCategoria['nome']."</option>";

	} //fechamento do foreach
	return $options;
}
?>

<input style="display:none" id="todasAsCategorias" value="<?=mostraCategorias($conexao);?>">

<!DOCTYPE html>

<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Abertura de orçamento</title>
	<link rel="stylesheet" href="../css/aberturaOrcamento.css"> <!--Pra sair da página e encontrar o css-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../js/aberturaOrcamentoValidacao.js"></script>
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

	<?php
	if ($_SESSION['nivelLogado']==1){
		include("menuGerente.php");
	}
	else if($_SESSION['nivelLogado']==2){
		include("menuAtendente.php");
	}
	?>

<body>

<main>

	<br><br><br>
	<h1>Abertura de orçamento</h1>



	<form onsubmit="return validarCampos()" action="aberturaOrcamento.php" method="POST" id="formOrcamento">
		<fieldset>
		<legend class="titulo">Dados gerais</legend>
		<br>
		<?php
			require_once("conexaoBanco.php");
			$comando2="SELECT MAX(codigo) FROM orcamentos";
			$resultado=mysqli_query($conexao, $comando2);
			$resultadoFetchRow = mysqli_fetch_row($resultado);
			$codigo = $resultadoFetchRow[0];
			$codigoOrcamento=$codigo+1;
		?>
		<label for="codigoCategoria" class="campos">Código*</label>
		<input type="text" name="codigoOrcamento" id="codigoOrcamento" class="camposForm" size="22px" maxlength="11" disabled="disabled" value=<?=$codigoOrcamento?>>

		<label for="cliente" class="campos" id="cliente">Cliente*</label>
		<select id="nomeCli" name="nomeCli">
		<option value=0>Selecione</option>
			<?php
			require_once("conexaoBanco.php");

			$comando="SELECT codigo, nome FROM clientes";
			$resultado=mysqli_query($conexao,$comando);
			$clientes = array();

			while($cadaCliente = mysqli_fetch_assoc($resultado)){
				array_push($clientes, $cadaCliente);
			}
			foreach($clientes as $cadaCliente){
			?>

			<option value="<?=$cadaCliente['codigo'];?>">
				<?=$cadaCliente['nome'];?>
			</option>

			<?php
			} //fechamento do foreach
			?>
		</select>

		<?php
		require_once("conexaoBanco.php");
		$comandoFunc="SELECT codigo, nome FROM usuarios WHERE codigo='".$_SESSION['idLogado']."'";
		$resultadoFunc=mysqli_query($conexao,$comandoFunc);
		$resultadoFuncFetch=mysqli_fetch_assoc($resultadoFunc);
		?>
		<label for="atendente" class="campos" id="atendente2">Atendente*</label>
		<input type="text" name="atendente" id="atendente" class="camposForm" size="22px" value="<?=$resultadoFuncFetch['nome']?>" disabled><br><br>
		<input type="hidden" name="codigoAtendente" id="codigoAtendente" value="<?=$resultadoFuncFetch['codigo']?>">

		<label for="ruaEntrega" class="campos">Rua*</label>
		<input type="text" name="ruaEntrega" id="ruaEntrega" class="camposForm" size="22px">

		<label for="bairroEntrega" class="campos" id="bairro">Bairro*</label>
		<input type="text" name="bairroEntrega" id="bairroEntrega" class="camposForm" size="22px" onkeypress="return onlyChars(event)">

		<label for="complementoEntrega" class="campos" id="complemento">Complemento*</label>
		<input type="text" name="complementoEntrega" id="complementoEntrega" class="camposForm" size="22px"><br><br>

		<label for="cidadeEntrega" class="campos">Cidade*</label>
		<input type="text" name="cidadeEntrega" id="cidadeEntrega" class="camposForm" size="22px" onkeypress="return onlyChars(event)">

		<label id="labelEstado">Estado*</label>
				<select name="estadoEntrega" id="estadoEntrega" class="camposForm">
					<option value="0">Selecione</option>
					<option value="AC">AC</option>
					<option value="AL">AL</option>
					<option value="AM">AM</option>
					<option value="BA">BA</option>
					<option value="CE">CE</option>
					<option value="DF">DF</option>
					<option value="ES">ES</option>
					<option value="GO">GO</option>
					<option value="MA">MA</option>
					<option value="MT">MT</option>
					<option value="MS">MS</option>
					<option value="MG">MG</option>
					<option value="PA">PA</option>
					<option value="PB">PB</option>
					<option value="PR">PR</option>
					<option value="PE">PE</option>
					<option value="PI">PI</option>
					<option value="RJ">RJ</option>
					<option value="RN">RN</option>
					<option value="RS">RS</option>
					<option value="RO">RO</option>
					<option value="RR">RR</option>
					<option value="SC">SC</option>
					<option value="SP">SP</option>
					<option value="SE">SE</option>
					<option value="TO">TO</option>
				</select>

		<label for="cepEntrega" class="campos" id="cep">CEP</label>
		<input type="text" name="cepEntrega" id="cepEntrega" class="camposForm" maxlength="8" size="22px" onkeypress="return isNumberKey(event)"><br><br>

		<label for="cliente" class="campos" id="parcelas">Parcelas</label>
			<select id="numParcelas" name="numParcelas">
				<option value="1" selected>1 vez</option>
				<option value="2">2 vezes</option>
				<option value="3">3 vezes</option>
				<option value="4">4 vezes</option>
				<option value="5">5 vezes</option>
				<option value="6">6 vezes</option>
				<option value="7">7 vezes</option>
				<option value="8">8 vezes</option>
				<option value="9">9 vezes</option>
				<option value="10">10 vezes</option>
				<option value="11">11 vezes</option>
				<option value="12">12 vezes</option>
			</select>

		<label for="desconto" class="campos" id="desconto2">Desconto %</label>
		<input type="number" name="desconto" id="desconto" onblur="atualizaValorTotalDesconto()" class="camposForm" size="22px" maxlength="3" onkeypress="return isNumberKey(event)">

		<label for="dataEmissao" class="campos" id="dataEmi">Data de Emissão*</label>
		<input type="date" id="dataEmissao" name="dataEmissao" class="camposForm" size="22px" value="<?php echo date("Y-m-d");?>"><br><br>

		<br><br>

	</fieldset>

	<fieldset>
		<legend class="titulo">Produtos</legend>

		<table id="tabelaProdutos">
		<tr>
			<th class="nomeColuna">Categoria</th>
			<th class="nomeColuna">Produto</th>
			<th class="nomeColuna">Valor unitário</th>
			<th class="nomeColuna">Quantidade</th>
			<th id="colunaQuantidade">Descrição</th>
			<th id="colunaBotaoMais"></th>
		</tr>

		<tr id="linhaTabela0">
			<td td="colunaTabela0"><select id="categorias0" name="categorias[]" onchange="retornaProdutos(0,this.value)">
				<option value="0">Selecione</option>
				<?php
				echo mostraCategorias($conexao);
				?>
			</select></td>
			<td class="colunaTabela0">
			<select id="produtos0" name="produtos[]" onchange="retornaValorUnitarioProduto(0)">
			<option value="0">Selecione</option>
			</select></td>
			<td class="colunaTabela0"><input type="text" readonly name="vlUnitario[]" step = "any" value = "0.00" id="vlUnitario0" class="camposForm"></td>
			<td class="colunaTabela0"><input type="number" name="quantidade[]" id="quantidade0" onblur="atualizaValorTotal(this.value,0)"  class="camposForm" maxlength="10" onkeypress="return isNumberKey(event)"></td>
			<td class="colunaTabela0"><input type="text" name="descricao[]" id="descricao0" class="camposForm" onkeypress="return onlyChars(event)"></td>
			<td><button onclick="adicionaProduto()" type="button" class="colunaBotaoMais"><img src="../img/mais.png"></button></td>
		</tr>
		</table>

		<br>

		<label for="valorTotal" class="campos" id="valorTotal">Valor total</label>
		<input type="text" readonly="readonly" name="valorTotal" id="inputValorTotal" step="any" value="0.00" class="camposForm" maxlength="10">
		<label for="valorTotalDesconto" class="campos" id="valorTotalDsc">Valor total com desconto</label>
		<input type="text" readonly="readonly" name="valorTotalDesconto" id="inputValorTotalDesconto" step="any" value="0.00" class="camposForm" maxlength="10"><br>

		<br>

		<button type="submit" class="botoes" id="botaoOrcar"><img src="../img/orcar.png"></button>
	</form>
	</fieldset>

	<fieldset>
		<legend class="titulo">Consulta de Orçamentos</legend>

		<form action="#" method="POST">

		<table border="1" id="tabelaConsulta">
		<tr>

			<form action="#" method="POST">
			<td>
				<label for="consultaNomeCli" id="consultaNome">Nome do Cliente</label>
				<input type="text" id="consultaNomeCli" name="consultaNomeCli" class="camposForm" size="25px" onkeypress="return onlyChars(event)">
			</td>
			<td>
				<button type="submit" class="botoes" id="botaoConsultar">
				<img src="../img/consultar.png"></button>
			</td>
			</form>

		</tr>
		</table>

		<table border="1" id="tabelaOrcamentos">
		<tr>
			<th class="nomeColuna">Código</th>
			<th class="nomeColuna">Cliente</th>
			<th class="nomeColuna">CPF/CNPJ</th>
			<th class="nomeColuna">Valor Total</th>
			<th class="nomeColuna">Ações</th>
		</tr>
		<?php
		$comandoConsulta="";
		  if(isset($_POST['consultaNomeCli']) && $_POST['consultaNomeCli']!=""){
		    $nome = strtolower($_POST['consultaNomeCli']);
		    $comandoConsulta = "SELECT orcamentos.status, orcamentos.codigo, clientes.nome, clientes.cpf_cnpj, preco_total FROM orcamentos INNER JOIN clientes ON clientes.codigo=orcamentos.clientes_codigo WHERE status=1 AND clientes.nome LIKE '".$nome."%'";
		  }else if(isset($_POST['consultaNomeCli']) && $_POST['consultaNomeCli']==""){
		    $comandoConsulta = "SELECT orcamentos.status, orcamentos.codigo, clientes.nome, clientes.cpf_cnpj, preco_total FROM orcamentos INNER JOIN clientes ON clientes.codigo=orcamentos.clientes_codigo WHERE status=1";
		  }else if(isset($_POST['consultaNomeCli'])==false){
		    $comandoConsulta = "SELECT orcamentos.status, orcamentos.codigo, clientes.nome, clientes.cpf_cnpj, preco_total FROM orcamentos INNER JOIN clientes ON clientes.codigo=orcamentos.clientes_codigo WHERE status=1";
		  }

			$resultadoConsulta = mysqli_query($conexao,$comandoConsulta);
			$linhas = mysqli_num_rows($resultadoConsulta);

			if($linhas==0){
			?>
			<tr><td colspan="5">Nenhum orçamento encontrado!</td></tr>
			<?php
			}else{
				$orcamentos = array();
				while($cadaOrcamento=mysqli_fetch_assoc($resultadoConsulta)){
					array_push($orcamentos, $cadaOrcamento);
				}
				foreach($orcamentos as $cadaOrcamento){
			?>
				<tr>
					<td><?=$cadaOrcamento['codigo'];?></td>
					<td><?=$cadaOrcamento['nome'];?></td>
					<td><?php
						$montado = "";

						if(strlen($cadaOrcamento['cpf_cnpj'])==11){
							//CPF-CNPJ
							$nbr_cpf = $cadaOrcamento['cpf_cnpj'];

							$parte_um     = substr($nbr_cpf, 0, 3);
							$parte_dois   = substr($nbr_cpf, 3, 3);
							$parte_tres   = substr($nbr_cpf, 6, 3);
							$parte_quatro = substr($nbr_cpf, 9, 2);

							$montado = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

							echo $montado;
						}else{
							$valor = $cadaOrcamento['cpf_cnpj'];

							$cnpj_cpf = preg_replace("/\D/", '', $valor);

							$montado = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);

							echo $montado;
						}
						 ?>
					</td>
					<td><?php echo "R$".$cadaOrcamento['preco_total'];?></td>
					<td>
						<form action="editaOrcamentoForm.php" method="POST">
							<input type="hidden" name="codigo" value="<?=$cadaOrcamento['codigo'];?>">
							<button type="submit" class="icones">
								<img src="../img/editar.png">
							</button>
						</form>
						<form action="rejeitaOrcamento.php" method="POST">
							<input type="hidden" name="codigo" value="<?=$cadaOrcamento['codigo'];?>">
							<button class="icones" type="submit" onclick="return confirm('Tem certeza que deseja rejeitar este orçamento?');">
								<img src="../img/excluir.png">
							</button>
						</form>
					</td>

				</tr>


			<?php
				}//fechamento do foreach
			}//fechamento do else
			?>
		</table>
		</form>
	</fieldset>
</main>
</body>
</html>

<?php
	}//fechamento do if
	else{
		header("Location: ../paginasSite/login.php");
	}
?>
