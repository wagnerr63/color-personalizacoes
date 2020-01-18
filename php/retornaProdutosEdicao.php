<?php

    require_once("conexaoBanco.php");
	  $options="";
    $id=$_POST['idCat'];

    $comando = "SELECT * FROM produtos WHERE categorias_codigo=".$id;
    $resultado=mysqli_query($conexao, $comando);
    $categorias=array();

    while($cadaProd = mysqli_fetch_assoc($resultado)) {
       array_push($categorias, $cadaProd);
    }

    foreach ($categorias as $cadaProd) {

        $options.="<option value='".$cadaProd['codigo']."'>".$cadaProd['nome']."</option>";
    }
echo $options;

?>
