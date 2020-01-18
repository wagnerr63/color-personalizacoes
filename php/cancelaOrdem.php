<?php
	require_once("conexaoBanco.php");
	$codigo=$_POST['codigoOrdem'];

		echo $comando="UPDATE ordens_de_servicos SET status=4  WHERE codigo=".$codigo;
		$resultado=mysqli_query($conexao,$comando);
		if($resultado==true){
			header("Location: aberturaOrdemServicoForm.php?retorno=1");
		}else{
			header("Location: aberturaOrdemServicoForm.php?retorno=0");
		}

?>
