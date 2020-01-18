<?php

	session_start();

	if(isset($_SESSION['nivelLogado'])==true && ($_SESSION['nivelLogado']==1 || $_SESSION['nivelLogado']==2)){

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
		<title>Edição de Cliente</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/editaCliente.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="../js/editaCliente.js"></script>

		<script type="text/javascript">
		/* Máscara Telefone (XX) XXXXX-XXXX*/
		function mascara(o,f){
			v_obj=o
			v_fun=f
			setTimeout("execmascara()",1)
		}

		function execmascara(){
			v_obj.value=v_fun(v_obj.value)
		}

		function mtel(v){
			v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
			v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
			v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
			return v;
		}

		function id( el ){
			return document.getElementById( el );
		}
			window.onload = function(){
			id('telefone').onkeypress = function(){
			mascara( this, mtel );
		}
			id('telefone2').onkeypress = function(){
			mascara( this, mtel );
		}
		}
		</script>

			<!--SOMENTE NÚMEROS-->
		<script type="text/javascript">
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)){
				return false
			}else{
			return true
			}
		}
		</script>

		<!--ONCLICK DO INPUT ESCONDIDO DO ESTADO-->
		<script type="text/javascript">
			$(document).ready(function(){
				$("#inputEstadoEscondido").trigger('click');
			});
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

	<br><br>

	<main>
	<br>

	<h1 id="tituloPrincipal">Edição de Cliente</h1>

	<div>
		<?php
			//RETORNO VEIO DA PÁGINA registraCategoria.php

			//VERIFICA SE VEIO OU NÃO ALGUMA COISA
			if(isset($_GET['retorno'])==true){
				if($_GET['retorno']==1){
					include("../alertas/sucesso.php");
				}else if ($_GET['retorno']==0){
					include("../alertas/erro.php");
			}
    }
		?>
	</div>

		<fieldset class="caixa">
				<legend>Dados Pessoais</legend>

        <?php
          require_once("conexaoBanco.php");

          $codigoCliente = $_POST['codigoCliente'];

          //echo $codigoCliente;

          $comando = "SELECT * FROM clientes WHERE codigo=".$codigoCliente;

  				$resultado = mysqli_query($conexao, $comando);

  				$cliente = mysqli_fetch_assoc($resultado);

					// echo $cliente['codigo'] ."<br>";
					// echo $cliente['nome'] ."<br>";
					// echo $cliente['cpf_cnpj'] ."<br>";

					$estado = $cliente['estado'];

					//Máscaras para os values
					$montado = "";
					if(strlen($cliente['cpf_cnpj'])==11){
						//CPF-CNPJ
						$nbr_cpf = $cliente['cpf_cnpj'];

						$parte_um     = substr($nbr_cpf, 0, 3);
						$parte_dois   = substr($nbr_cpf, 3, 3);
						$parte_tres   = substr($nbr_cpf, 6, 3);
						$parte_quatro = substr($nbr_cpf, 9, 2);

						$montado = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";


					}else{
						$valor = $cliente['cpf_cnpj'];

						$cnpj_cpf = preg_replace("/\D/", '', $valor);

						$montado = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);

					}

					//TELEFONE 1
					$telefone = $cliente['telefone_1'];
					$pattern = '/(\d{2})(\d{4})(\d*)/';
					$telefoneN1 = preg_replace($pattern, '($1) $2-$3', $telefone);
					$telefoneN1;

					//TELEFONE 2
					$telefone = $cliente['telefone_2'];
					$pattern = '/(\d{2})(\d{4})(\d*)/';
					$telefoneN2 = preg_replace($pattern, '($1) $2-$3', $telefone);
					$telefoneN2;
        ?>

        <br>

				<input type="hidden" id="inputEstadoEscondido" value="<?=$estado;?>" onclick="retornaEstados(this.value)">

        <form action="editaCliente.php" method="POST" onsubmit="return validarCampos()">

          <input type="hidden" name="codigoCliente" value= "<?=$cliente['codigo'];?>">

  				<label for="nome" id="labelNome">Nome completo*</label>
  				<input type="text" name="nome" id="nome" onkeypress="return onlyChars(event)" value="<?=$cliente['nome'];?>">

  				<!--AQUIIIIIIIIII-->
					<label for="labelCpf" id="labelCpf">CPF/CNPJ*</label>
  				<input type="text" name="cpf" id="cpfcnpj" maxlength="17" value="<?=$montado;?>" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' onkeypress="return isNumberKey(event)">

  				<label for="email">E-mail</label>
  				<input type="text" name="email" id="email" value="<?=$cliente['email'];?>">

  				<br><br>

  				<label for="inscricaoEs">Inscrição Estadual</label>
  				<input type="text" name="inscricaoEs" id="inscricaoEs" maxlength="9" onkeypress="return isNumberKey(event)" value="<?=$cliente['inscricao_estadual'];?>">

  				<label for="telefone" id="labelTelefone">Telefone*</label>
  				<input type="text" name="telefone" id="telefone" onkeypress="return isNumberKey(event)" maxlength="16" value="<?=$telefoneN1;?>">

  				<label for="telefone2">Telefone 2</label>
  				<input type="text" name="telefone2" id="telefone2" onkeypress="return isNumberKey(event)" maxlength="16" value="<?=$telefoneN2;?>">

  				<br><br>

  				<label for="rua">Rua*</label>
  				<input type="text" name="rua" id="rua" value="<?=$cliente['rua'];?>">

  				<label for="bairro" id="labelBairro">Bairro*</label>
  				<input type="text" name="bairro" id="bairro" value="<?=$cliente['bairro'];?>" onkeypress="return onlyChars(event)">

  				<label for="complemento">Complemento*</label>
  				<input type="text" name="complemento" id="complemento" value="<?=$cliente['complemento'];?>">

  				<br><br>

  				<label for="cidade">Cidade*</label>
  				<input type="text" name="cidade" id="cidade" value="<?=$cliente['cidade'];?>" onkeypress="return onlyChars(event)">

  				<label id="labelEstado">Estado*</label>
  				<select name="estado" id="estado" value="<?=$cliente['estado'];?>">

  				</select>

  				<label for="cep" id="labelCep">CEP</label>
  				<input type="text" name="cep" id="cep" onkeypress="return isNumberKey(event)" maxlength="8" value="<?=$cliente['cep'];?>">

  				<br><br>

  				<button type="submit" class="botoes">
  					<img src="../img/botao_editar.png" alt="Editar">
  				</button>
  			</fieldset>
		</form>
	</main>
</body>
</html>

<?php
	}//fechamento do if
	else{
		header("Location: ../paginasSite/login.php");
	}
?>
