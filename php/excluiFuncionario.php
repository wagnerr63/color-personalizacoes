<?php

require_once("conexaoBanco.php");

$codigo=$_POST['codigoUsuario'];

// echo $codigo;

//COMANDO PARA VERIFICAR SE HÁ ALGUM ORÇAMENTO REGISTRADO COM O FUNCIONARIO QUE VAI SER EXCLUIDO
$comando="SELECT codigo FROM orcamentos WHERE usuarios_codigo=".$codigo;

//COMANDO PARA VERIFICAR SE HÁ ALGUMA ORDEM DE SERVIÇO REGISTRADA COM O FUNCIONARIO QUE VAI SER EXCLUIDO
$comando2="SELECT codigo FROM ordens_de_servicos WHERE usuarios_codigo=".$codigo;
 // echo $comando."<br>".$comando2;

$resultado=mysqli_query($conexao,$comando);
$linhas=mysqli_num_rows($resultado);

$resultado2=mysqli_query($conexao,$comando2);
$linhas2=mysqli_num_rows($resultado2);

if($linhas==0 AND $linhas2==0){
	$comando3="DELETE FROM usuarios WHERE
	codigo=".$codigo;
	$resultado3 = mysqli_query($conexao,$comando3);
	if($resultado3==true){
		header("Location: registroFuncionarioForm.php?retorno=1");
	}else{
		header("Location: registroFuncionarioForm.php?retorno=0");
	}

}else{
	header("Location: registroFuncionarioForm.php?retorno=2");
}


?>
