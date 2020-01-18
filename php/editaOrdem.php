<?php
	require_once("conexaoBanco.php");
	$codigo=$_POST['codigo'];
	$status=$_POST['status'];
	if ($status==0){
		header("Location: aberturaOrdemServicoForm.php?retorno=0");

	}else{
		$comando="UPDATE ordens_de_servicos SET status=".$status."  WHERE codigo=".$codigo;
		$resultado=mysqli_query($conexao,$comando);
		if($resultado==true){
			header("Location: aberturaOrdemServicoForm.php?retorno=1");
		}else{
			header("Location: aberturaOrdemServicoForm.php?retorno=0");
		}
	}

?>
