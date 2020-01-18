﻿<?php
require_once('conexaoBanco.php');
include("mpdf/mpdf.php");
$relatorio=$_POST['html'];
$mpdf = new mPDF();
$mpdf->SetDisplayMode("fullpage");

  if($relatorio==""){
    $mpdf->WriteHTML("
    <style>
    h1{
      text-align: center;
      font-family: Arial;
      color: black;
    }
    </style>

    <h1>Nenhuma ordem encontrada!</h1>");
  }else{
    $mpdf->WriteHTML("
    <style>
      h1{
        color: black;
        font-family: Arial;
        text-align:center;
      }

      table, th, tr{
      	border-collapse: collapse;
      	border: 2px solid black;
      	margin-bottom: 1%;
      }

      table{
      	margin-top:1%;
      	width: 100%;
      	text-align: center;
      }

      th{
      	height: 30px;
      	background-color:black;
      	color:white;
      }

      tr{
      	height: 40px;
      	background-color:white;
      }
      td{
        border: 2px solid black;
      }

    </style>

	<h1>Relatório de Ordens</h1>

	<table>
		<tr>
			<th>Código</th>
			<th>Cliente</th>
			<th>Valor total</th>
			<th>Funcionário responsável</th>
			<th>Produtos</th>
		</tr>

		".$relatorio."

	</table>

	");
}
$mpdf->Output();
exit();


?>
