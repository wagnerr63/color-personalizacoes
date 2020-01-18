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

<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Edição de orçamento</title>
	<link rel="stylesheet" href="../css/editaAberturaOrcamento.css"> <!--Pra sair da página e encontrar o css-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="../js/funcoesOrcamentoEdicao.js"></script>
  <script type="text/javascript">
			$(document).ready(function(){
				$("#inputEstadoEscondido").trigger('click');
			});
	</script>

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

	<?php
	if ($_SESSION['nivelLogado']==1){
		include("menuGerente.php");
	}
	else if($_SESSION['nivelLogado']==2){
		include("menuAtendente.php");
	}
	?>

<br>
<h1>Edição de orçamento</h1>
<?php
$idOrcamentos = $_POST['codigo'];

$comando = "SELECT orc.codigo, orc.preco_total, orcpro.preco_atual, orcpro.produtos_codigo,
            orcpro.qtde, orcpro.descricao, pro.categorias_codigo as idCat, pro.codigo as idProd FROM orcamentos as orc INNER JOIN orcamentos_has_produtos
            as orcpro ON orc.codigo=orcpro.orcamentos_codigo INNER JOIN produtos as pro ON orcpro.produtos_codigo=pro.codigo
            WHERE orc.codigo=".$idOrcamentos;

$resultado = mysqli_query($conexao, $comando);

$comando2 = "SELECT preco_total, data_emissao, desconto, parcelamento, usuarios_codigo, clientes_codigo, rua, bairro, complemento, cidade,
             estado, cep FROM orcamentos WHERE codigo=".$idOrcamentos;

$resultado2 = mysqli_query($conexao, $comando2);
$clientesInfos = mysqli_fetch_assoc($resultado2);
$itensOrcamento = array();

$estado = $clientesInfos['estado'];
while ($cadaItem = mysqli_fetch_assoc($resultado)){
  array_push ($itensOrcamento, $cadaItem);
}

?>


<input type="hidden" id="inputEstadoEscondido" value="<?=$estado;?>" onclick="retornaEstados(this.value)">
<form onsubmit="return validarCampos()" action="editaOrcamento.php" method="POST" id="formOrcamento">
  <input type="hidden" value="<?=$idOrcamentos?>" name="idOrcamento">
  <fieldset>
  <legend class="titulo">Dados gerais</legend>

	<br>

  <label for="codigoCategoria" class="campos">Código*</label>
  <input type="text" name="codigoOrcamento" id="codigoOrcamento" class="camposForm" size="22px" maxlength="11" disabled="disabled" value=<?=$idOrcamentos?>>

  <label for="cliente" class="campos" id="cliente">Cliente*</label>
  <select id="nomeCli" name="nomeCli">
	<option value="0">Selecione</option>
  <?php
  $comandoCli="SELECT * FROM clientes";

  $resultadoCli=mysqli_query($conexao,$comandoCli);
	$clientes=array();

	while($cadaCliente = mysqli_fetch_assoc($resultadoCli)){
		array_push($clientes, $cadaCliente);
	}
  foreach($clientes as $cadaCliente){
    if($cadaCliente['codigo']==$clientesInfos['clientes_codigo']){
  ?>
    <option selected value="<?=$cadaCliente['codigo'];?>"><?= $cadaCliente['nome'];?>
  <?php
  }else{
  ?>
  <option value="<?=$cadaCliente['codigo'];?>"> <?=$cadaCliente['nome'];?></option>
  <?php
  }
  }
  ?>
  </select>

  <label for="atendente" class="campos" id="atendente2">Atendente*</label>
  <?php
  $comandoUsuarios = "SELECT codigo, nome FROM usuarios WHERE codigo=".$clientesInfos['usuarios_codigo'];
  $resultadoUsuarios = mysqli_query($conexao, $comandoUsuarios);
  $usuariosCodigo = mysqli_fetch_assoc($resultadoUsuarios);
  ?>
  <input type="text" name="atendente" id="atendente" class="camposForm" size="22px" value="<?=$usuariosCodigo['nome'];?>" disabled><br><br>
  <input type="hidden" name="codigoAtendente" id="codigoAtendente" value="<?=$usuariosCodigo['codigo']?>">

  <label for="ruaEntrega" class="campos" id="rua">Rua*</label>
  <input type="text" name="ruaEntrega" id="ruaEntrega" class="camposForm" size="22px" value="<?=$clientesInfos['rua'];?>">

  <label for="bairroEntrega" class="campos" id="bairro">Bairro*</label>
  <input type="text" name="bairroEntrega" id="bairroEntrega" class="camposForm" size="22px" onkeypress="return onlyChars(event)" value="<?=$clientesInfos['bairro'];?>">

  <label for="complementoEntrega" class="campos" id="complemento">Complemento*</label>
  <input type="text" name="complementoEntrega" id="complementoEntrega" class="camposForm" size="22px" value="<?=$clientesInfos['complemento'];?>"><br><br>

  <label for="cidadeEntrega" class="campos">Cidade*</label>
  <input type="text" name="cidadeEntrega" id="cidadeEntrega" class="camposForm" size="22px" onkeypress="return onlyChars(event)" value="<?=$clientesInfos['cidade'];?>">

  <label id="labelEstado">Estado*</label>
  <select name="estadoEntrega" id="estadoEntrega" class="camposForm" value="<?=$clientesInfos['estado'];?>">

	</select>

  <label for="cepEntrega" class="campos" id="cep">CEP</label>
  <input type="text" name="cepEntrega" id="cepEntrega" class="camposForm" size="22px" onkeypress="return isNumberKey(event)" value="<?=$clientesInfos['cep'];?>"><br><br>

  <label for="cliente" class="campos" id="parcelas">Parcelas</label>
    <select id="numParcelas" name="numParcelas">
      <?php
        if($clientesInfos['parcelamento']==1){
      ?>
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
      <?php
        }else if($clientesInfos['parcelamento']==2){
      ?>
      <option value="1">1 vez</option>
      <option value="2" selected>2 vezes</option>
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
      <?php
        }else if($clientesInfos['parcelamento']==3){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3" selected>3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
      <?php
    }else if($clientesInfos['parcelamento']==4){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4" selected>4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
      <?php
        }else if($clientesInfos['parcelamento']==5){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5" selected>5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
      <?php
        }else if($clientesInfos['parcelamento']==6){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6" selected>6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
      <?php
        }else if($clientesInfos['parcelamento']==7){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7" selected>7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
      <?php
    		}else if($clientesInfos['parcelamento']==8){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8" selected>8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
      <?php
    		}else if($clientesInfos['parcelamento']==9){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9" selected>9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
      <?php
    		}else if($clientesInfos['parcelamento']==10){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10" selected>10 vezes</option>
      <option value="11">11 vezes</option>
      <option value="12">12 vezes</option>
			<?php
		}else if($clientesInfos['parcelamento']==11){
      ?>
      <option value="1">1 vez</option>
      <option value="2">2 vezes</option>
      <option value="3">3 vezes</option>
      <option value="4">4 vezes</option>
      <option value="5">5 vezes</option>
      <option value="6">6 vezes</option>
      <option value="7">7 vezes</option>
      <option value="8">8 vezes</option>
      <option value="9">9 vezes</option>
      <option value="10">10 vezes</option>
      <option value="11" selected>11 vezes</option>
      <option value="12">12 vezes</option>
			<?php
		}else if($clientesInfos['parcelamento']==12){
      ?>
			<option value="1">1 vez</option>
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
      <option value="12" selected>12 vezes</option>
			<?php
		}
			?>
    </select>

  <label for="desconto" class="campos" id="desconto2">Desconto %</label>
  <input type="text" name="desconto" id="desconto" onblur="atualizaValorTotalDesconto()" class="camposForm" size="22px" maxlength="3" onkeypress="return isNumberKey(event)" value="<?=$clientesInfos['desconto']?>">

  <label for="dataEmissao" class="campos" id="dataEmi">Data de Emissão*</label>
  <input type="date" id="dataEmissao" name="dataEmissao" class="camposForm" size="22px" value="<?=$clientesInfos['data_emissao']?>"><br><br>

  <button type="reset" class="botoes" id="botaoLimparCampos">
  <img src="../img/limpar_campos.png"></button>
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
<?php
$cont=0;
foreach($itensOrcamento as $cadaItem){
?>
  <tr id="<?="linhaTabela".$cont;?>">
    <td id="<?="colunaTabela".$cont;?>">
		<select id="<?="categorias".$cont;?>" name="categorias[]" onchange="retornaProdutos(<?=$cont?>,this.value)">
			<?php
        $comandoCat="SELECT * FROM categorias";
        $resultadoCat=mysqli_query($conexao,$comandoCat);
        $categorias=array();

        while($cadaCategoria = mysqli_fetch_assoc($resultadoCat)){
          array_push($categorias, $cadaCategoria);
        }
        foreach($categorias as $cadaCategoria){
          if($cadaCategoria['codigo']==$cadaItem['idCat']){
        ?>
          <option selected value="<?=$cadaCategoria['codigo'];?>"><?= $cadaCategoria['nome'];?>
        <?php
        }else{
        ?>
        <option value="<?=$cadaCategoria['codigo'];?>"> <?=$cadaCategoria['nome'];?></option>
        <?php
        }
        }
      ?>
    </select></td>
    <td id="<?="colunaTabela".$cont;?>">
    <select id="<?="produtos".$cont;?>" name="produtos[]" onchange="retornaValorUnitarioProduto(<?=$cont?>)" >
		<?php
		// selecionar todos os produtos de tal categoria... selected no que for igual ao idPrd
				$comandoProd="SELECT * FROM produtos WHERE categorias_codigo=".$cadaItem['idCat'];
				$resultadoProd=mysqli_query($conexao,$comandoProd);
				$produtosArray=array();

				while($cadaProd = mysqli_fetch_assoc($resultadoProd)){
				  array_push($produtosArray, $cadaProd);
				}
				foreach($produtosArray as $cadaProd){
				  if($cadaItem['idProd']==$cadaProd['codigo']){
				?>
				  <option selected value="<?=$cadaProd['codigo'];?>"><?= $cadaProd['nome'];?>
				<?php
				}else{
				?>
				<option value="<?=$cadaProd['codigo'];?>"> <?=$cadaProd['nome'];?></option>
				<?php
				}
				}
		?>
    </select></td>
    <td id="<?="colunaTabela".$cont;?>"><input type="text" readonly name="vlUnitario[]" value="<?=$cadaItem['preco_atual'];?>" step = "any" value = "0.00" id="<?="vlUnitario".$cont;?>" class="camposForm"></td>
    <td id="<?="colunaTabela".$cont;?>"><input type="number" name="quantidade[]" id="<?="quantidade".$cont;?>" value="<?=$cadaItem['qtde'];?>" onblur="atualizaValorTotal(this.value,<?=$cont?>)"  class="camposForm" maxlength="10" onkeypress="return isNumberKey(event)"></td>
    <td id="<?="colunaTabela".$cont;?>"><input type="text" name="descricao[]" id="<?="descricao".$cont;?>" class="camposForm" value="<?=$cadaItem['descricao'];?>" onkeypress="return onlyChars(event)"></td>
    <td><button onclick="adicionaProduto()" type="button"  class="colunaBotaoMais"><img src="../img/mais.png"></button></td>
		<?php
		if($cont!=0){
		?>
		<td><button type="button" class="colunaBotaoMenos" onclick="removeProduto(<?=$cont?>)"><img src="../img/menos.png"></button></td>
		<?php
		}
		?>
	</tr>
	<?php
	$cont = $cont + 1;
	}
	?>
  </table>

	<br>

  <label for="valorTotal" class="campos" id="valorTotal">Valor total</label>
  <input type="text" readonly="readonly" name="valorTotal" id="inputValorTotal" step="any" value="<?=$clientesInfos['preco_total'];?>" value="0.00" class="camposForm" maxlength="10">
  <label for="valorTotalDesconto" class="campos" id="valorTotalDesc">Valor total com desconto</label>
  <input type="text" readonly="readonly" name="valorTotalDesconto" id="inputValorTotalDesconto" step="any" value="<?php echo $clientesInfos['preco_total'] - ($clientesInfos['preco_total'] * $clientesInfos['desconto'])/100;?>" class="camposForm" maxlength="10"><br>
	<br>
  <button type="submit" class="botoes" id="botaoEditar"><img src="../img/botao_editar.png"></button>

</form>
</fieldset>

</body>
</html>

<?php
}else{
  header("Location: ../index.php");
}
?>
