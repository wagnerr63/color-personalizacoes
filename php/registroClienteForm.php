<?php

	session_start();

	if(isset($_SESSION['nivelLogado'])==true && ($_SESSION['nivelLogado']==1 || $_SESSION['nivelLogado']==2)){

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
		<title>Registro de Cliente</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/registroCliente.css">
		<script src="../js/registroCliente.js"></script>

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

	<h1 id="tituloPrincipal">Registro de Cliente</h1>

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
					include("../alertas/erroExclusaoCliente.php");
				}
			}
		?>
	</div>

		<form action="registroCliente.php" method="POST" onsubmit="return validarCampos()">

		<fieldset class="caixa">
				<legend>Dados Pessoais</legend>

				<br>

				<label for="nome" id="labelNome">Nome completo*</label>
				<input type="text" name="nome" id="nome" onkeypress="return onlyChars(event)" size="21">

				<label for="labelCpf" id="labelCpf">CPF/CNPJ*</label>
				<input type="text" name="cpf" id="cpfcnpj" maxlength="17" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' onkeypress="return isNumberKey(event)">

				<label for="email">E-mail</label>
				<input type="text" name="email" id="email" size="24">

				<br><br>

				<label for="inscricaoEs">Inscrição Estadual</label>
				<input type="text" name="inscricaoEs" id="inscricaoEs" maxlength="9" onkeypress="return isNumberKey(event)">

				<label for="telefone" id="labelTelefone">Telefone*</label>
				<input type="text" name="telefone" id="telefone" maxlength="15" onkeypress="return isNumberKey(event)">

				<label for="telefone2">Telefone 2</label>
				<input type="text" name="telefone2" id="telefone2" maxlength="15" onkeypress="return isNumberKey(event)">

				<br><br>

				<label for="rua">Rua*</label>
				<input type="text" name="rua" id="rua" size="23">

				<label for="bairro" id="labelBairro">Bairro*</label>
				<input type="text" name="bairro" id="bairro" onkeypress="return onlyChars(event)">

				<label for="complemento">Complemento*</label>
				<input type="text" name="complemento" id="complemento">
				<br>
				<br>
				<label for="cidade">Cidade*</label>
				<input type="text" name="cidade" id="cidade" onkeypress="return onlyChars(event)">

				<label id="labelEstado">Estado*</label>
				<select name="estado" id="estado">
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

				<label for="cep" id="labelCep">CEP</label>
				<input type="text" name="cep" id="cep" onkeypress="return isNumberKey(event)" maxlength="8" size="21.7">

				<br><br>

				<button type="reset" class="botoes" id="botao2">
					<img src="../img/limpar_campos.png" alt="Limpar Campos">
				</button>
				<button type="submit" class="botoes">
					<img src="../img/cadastrar.png" alt="Cadastrar">
				</button>
			</fieldset>
		</form>

			<fieldset class="caixa">
				<legend>Consulta de Clientes</legend>

				<table id="tabelaConsulta" >

				<tr>
					<form action="#" method="GET">
						<td>
							<label for="consultaNomeCliente" id="consultaNome">Nome do Cliente</label>
							<input type="text" id="consultaNomeCliente" name="consultaNomeCliente" class="camposForm" onkeypress="return onlyChars(event)" size="25px">
						</td>
						<td>
							<button type="submit" class="botoes" id="botaoConsultar">
							<img src="../img/consultar.png"></button>
						</td>
					</form>
				</tr>
				</table>

				<table>
					<tr>
						<th>Código</th>
						<th>CPF/CNPJ</th>
						<th>Nome do Cliente</th>
						<th>Ações</th>
					</tr>

					<?php

					require_once("conexaoBanco.php");

					//Acesso a página
					if(isset($_GET['consultaNomeCliente'])==false){
						$comando = "SELECT * FROM clientes";

					//Busca na lupa
					}else if(isset($_GET['consultaNomeCliente'])==true &&
					$_GET['consultaNomeCliente']==""){
					$comando = "SELECT * FROM clientes";

					//Pesquisa algo
					}else if(isset($_GET['consultaNomeCliente'])==true && $_GET['consultaNomeCliente']!=""){
						$busca = $_GET['consultaNomeCliente'];
						$comando = "SELECT * FROM clientes WHERE nome LIKE '".$busca."%'";
					}
					//echo $comando;

					$resultado = mysqli_query($conexao, $comando);

					//$linhas quantas foram inseridas
					//0 linhas é porque nenhum nome foi encontrado
					$linhas = mysqli_num_rows($resultado);

					if($linhas==0){
					?>
						<tr>
							<!--Ocupar as 4 colunas-->
							<td colspan="4">Nenhum cliente foi encontrado</td>
						</tr>
					<?php
					}//fechamento do if
					//+ de 1 linha
					else{
						//Array para guardar as linhas
						$clientesRetornados = array();

						//Cada linha vai ser guardada na var $cadaCliente e adicionada no array array_push

						//O mysqli_fetch_assoc organiza cada linha
						while($cadaLinha = mysqli_fetch_assoc($resultado)){
							array_push($clientesRetornados, $cadaLinha);
						}

						//Um for que no caso é o foreach, a var $cadaCliente vai assumir $clientesRetornados
						foreach ($clientesRetornados as $cadaCliente){
						//Criando uma linha da tabela para cada cliente
						?>

						<tr>
							<td> <?php echo $cadaCliente['codigo'] ?></td>
							<td> <?php
							$montado = "";

							if(strlen($cadaCliente['cpf_cnpj'])==11){
								//CPF-CNPJ
								$nbr_cpf = $cadaCliente['cpf_cnpj'];

								$parte_um     = substr($nbr_cpf, 0, 3);
								$parte_dois   = substr($nbr_cpf, 3, 3);
								$parte_tres   = substr($nbr_cpf, 6, 3);
								$parte_quatro = substr($nbr_cpf, 9, 2);

								$montado = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

						 		echo $montado;
							}else{
								$valor = $cadaCliente['cpf_cnpj'];

								$cnpj_cpf = preg_replace("/\D/", '', $valor);

								$montado = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);

								echo $montado;
							}
							 ?>
							</td>
							<td> <?php echo $cadaCliente['nome'] ?></td>

							<td id="acoes">
								<form action="editaClienteForm.php" method="POST">
									<input type="hidden" value="<?=$cadaCliente['codigo'];?>" name="codigoCliente">
									<button type="submit" class="botoes">
										<img src="../img/editar.png">
									</button>
								</form>

								<form action="excluiCliente.php" method="POST" onsubmit="return confirmarExclusao()">
									<input type="hidden" value="<?=$cadaCliente['codigo'];?>" name="codigoCliente">
									<button type="submit" class="botoes">
										<img src="../img/excluir.png">
									</button>
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
	</body>
</html>

<?php
	}//fechamento do if
	else{
		header("Location: ../paginasSite/login.php");
	}
?>
