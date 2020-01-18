 <?php
function formataString($str) {
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = preg_replace('/[^a-z0-9]/i', '_', $str);
    $str = preg_replace('/_+/', '_', $str);
    return $str;
}

require_once("conexaoBanco.php");

$nomeP=$_POST['nome']; //NOME PRODUTO
$cat=$_POST['categorias']; //NÚMERO DA CATEGORIA

$comando = "SELECT nome FROM categorias WHERE codigo=".$cat; //SELECIONANDO O NOME DA CATEGROIA ONDE O CODIGO FOR INGUAL AO CATEGROIAS_CODIGO
//echo $comando;

$resultado = mysqli_query($conexao,$comando);
$nomeCat = mysqli_fetch_assoc($resultado);
//echo $nomeCat['nome'];

$categoriaNome = strtolower(formataString($nomeCat['nome'])); // TRANSFORMANDO O NÚMERO DA CATEGORIA EM STRING, OU SEJA, MUDANDO O NÚMERO PARA UM NOME
//echo $categoriaNome;

$precoUni=$_POST['precoUni'];
$precoUni= preg_replace("/,/",".", $precoUni);
$caminhoImagem = ""; //VAR PARA PEGAR O CAMINHO DA IMAGEM
$novoNome = ""; //VAR PARA DAR UM NOME NOME PARA A IMAGEM

// // echo $nomeP."<br>";
// // echo $cat."<br>";
// // echo $precoUni."<br>";
// echo $caminhoImagem."<br>";
// echo $novoNome."<br>";

if ( isset( $_FILES[ 'imagemP' ][ 'name' ] )) { // Verifica se o arquivo existe
    $arquivo_tmp = $_FILES[ 'imagemP' ][ 'tmp_name' ]; //Verifica o nome temporário com o qual o arquivo enviado foi armazenado no servidor
    $nome = $_FILES[ 'imagemP' ][ 'name' ]; //O nome original do arquivo na máquina do cliente.
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION ); // Pega a extensão
    $extensao = strtolower ( $extensao ); // Converte a extensão para minúsculo

    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {    // Somente imagens, .jpg;.jpeg;.gif;.png
        $novoNome = uniqid ( time () ) . '.' . $extensao; // Cria um nome único para esta imagem
        $caminhoImagem = "../img/".$categoriaNome."/".$novoNome; // Concatena a pasta com o nome
        if (!is_dir("../img/".$categoriaNome)) { // Verifica se tem pasta da categoria
        mkdir("../img/".$categoriaNome, 0777); //Cria pasta categoria
    }

        if ( @move_uploaded_file ( $arquivo_tmp, $caminhoImagem ) ) {
            // tenta mover o arquivo para o destino
        }else{
            header("Location: registroProdutosForm.php?retorno=3");
        }
    }else{ // Se imagem não é .jpg;.jpeg;.gif;.png volta com erro
        header("Location: registroProdutosForm.php?retorno=3");
    }

}else{ // Se tiver passado a verificação de campo da imagem
    header("Location: registroProdutosForm.php?retorno=3");
}


$comando2="INSERT INTO produtos (nome, imagem, categorias_codigo, preco_unitario) VALUES ('".$nomeP."','".$novoNome."',".$cat.",".$precoUni.")";
$resultado2=mysqli_query($conexao,$comando2);

if($resultado2){
  header("Location: registroProdutosForm.php?retorno=1");
}else{
  header("Location: registroProdutosForm.php?retorno=0");
}
?>
