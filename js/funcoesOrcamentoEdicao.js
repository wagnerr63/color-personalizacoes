function validarCampos(){

	var nomeCliente = document.getElementById("nomeCli").value;
	var ruaEntrega = document.getElementById("ruaEntrega").value;
	var bairroEntrega = document.getElementById("bairroEntrega").value;
	var complementoEntrega = document.getElementById("complementoEntrega").value;
	var cidadeEntrega = document.getElementById("cidadeEntrega").value;
	var estadoEntrega = document.getElementById("estadoEntrega").value;
	var cepEntrega = document.getElementById("cepEntrega").value;
	var dataEmissao = document.getElementById("dataEmissao").value;
	var categoria = document.getElementById("categorias0").value;
	var produto = document.getElementById("produtos0").value;
	var descricao = document.getElementById("descricao0").value;
	var quantidade = document.getElementById("quantidade0").value;
	var msg = "";

	if(nomeCliente==0){
		msg = msg + "Nome \n";
	}
	if(ruaEntrega==""){
		msg = msg + "Rua \n";
	}
	if(bairroEntrega==""){
		msg = msg + "Bairro \n";
	}
	if(complementoEntrega==""){
		msg = msg + "Complemento \n";
	}
	if(cidadeEntrega==""){
		msg = msg + "Cidade \n";
	}
	if(estadoEntrega==0){
		msg = msg + "Estado \n";
	}
	if(cepEntrega.length>0 && cepEntrega.length<8){
		msg = msg + "CEP \n";
	}
	if(dataEmissao==""){
		msg = msg + "Data de emissão \n";
	}
	if(categoria==0){
		msg = msg + "Categoria \n";
	}
	if(produto==0){
		msg = msg + "Produto \n";
	}
	if(quantidade==""){
		msg = msg + "Quantidade \n";
	}
	if(msg!=""){
		alert("Por favor, preencha o(s) campo(s): \n" +msg);
		return false;
	}else{
		return true;
	}
}

var cont;
var categorias = $("#todasAsCategorias").val();
var valoresJaAdicionadosAoTotal = [];

$(document).ready(function(){
  var precosUnitarios = document.getElementsByName("vlUnitario[]");
  var quantidades = document.getElementsByName("quantidade[]");
  var contJaAdicionado = 0;

  for(var i=0; i<precosUnitarios.length; i++){

    contJaAdicionado = precosUnitarios[i].parentElement.id;
    contJaAdicionado = contJaAdicionado.substring(12);
    contJaAdicionado = parseInt(contJaAdicionado);

    valoresJaAdicionadosAoTotal[contJaAdicionado]=(parseFloat(precosUnitarios[i].value) * parseFloat(quantidades[i].value));
  }
  cont=contJaAdicionado+1;
  console.log("Cont inicial"+cont);

});

function adicionaProduto(){

  $("#tabelaProdutos").append(
    '<tr id="linhaTabela'+cont+'">'+
		'<td id="colunaTabela'+cont+'"><select id="categorias'+cont+'" required name="categorias[]" onchange="retornaProdutos('+cont+',this.value)">'+
			'<option value="0">Selecione</option>'+categorias+
      '</select></td>'+

      '<td id="colunaTabela'+cont+'"><select id="produtos'+cont+'" required name="produtos[]" onchange="retornaValorUnitarioProduto('+cont+')">'+
      '<option value="0">Selecione</option>'+
      '</select></td>'+

      '<td id="colunaTabela'+cont+'"><input type="text" name="vlUnitario[]" id="vlUnitario'+cont+'" step = "any" value = "0.00" required readonly class="camposForm" name = "valorTotal"></td>'+
      '<td id="colunaTabela'+cont+'"><input type="number" name="quantidade[]" id="quantidade'+cont+'" onblur = "atualizaValorTotal(this.value,'+cont+')" required class="camposForm"  maxlength="10" onkeypress="return isNumberKey(event)"></td>'+
      '<td id="colunaTabela'+cont+'"><input type="text" name="descricao[]" id="descricao'+cont+'" class="camposForm" onkeypress="return onlyChars(event)"></td>'+

      '<td><button class="colunaBotaoMais1" type="button" onclick="adicionaProduto()"><img src="../img/mais.png"></button></td>'+
      '<td><button class="colunaBotaoMenos" type="button" onclick="removeProduto('+cont+')"><img src="../img/menos.png"></button></td>'+

    '</tr>'

  );

  cont = cont + 1;

}

function removeProduto(cont){

  var valorTotalAtualPedido = $("#inputValorTotal").val();
  var produtoSelecionado = $("#produtos"+cont).val();
  var desconto = $("#desconto").val();
  var valorTotal = $("#inputValorTotal").val();

  if((valorTotalAtualPedido!=0.00) && (produtoSelecionado!=0)){
    var valorUnitario = $("#vlUnitario"+cont).val();
    var qtde = $("#quantidade"+cont).val();
    var valorAReduzir = parseFloat(valorUnitario) * parseInt(qtde);
    $("#inputValorTotal").val(valorTotalAtualPedido-valorAReduzir);

    atualizaValorTotalDesconto();
}

  $("#linhaTabela"+cont).remove();
    atualizaValorTotalDesconto();
}

function retornaEstados(estado){

	var estados = ['AC', 'AL', 'AM', 'BA', 'CE', 'DF',	'ES',	'GO',	'MA',	'MT',	'MS',	'MG',	'PA',	'PB',	'PR',	'PE', 'PI',	'RJ',	'RN',
	'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
	var est = "";

	for(var i=0; i<estados.length; i++){
		if(estados[i]==estado){
			est += "<option value="+estados[i]+" selected>"+estados[i]+"</option>";
		}else{
			est += "<option value="+estados[i]+">"+estados[i]+"</option>";
		}
	}

	$("#estadoEntrega").append(est);
}

function atualizaValorTotal(qtde,cont){
  var produtoSelecionado = $("#produtos"+cont).val();
  var valorJaAdicionado = valoresJaAdicionadosAoTotal[cont];
  var valorTotalAtual = document.getElementById("inputValorTotal").value;
  var valorUnitarioProduto = document.getElementById("vlUnitario"+cont).value;
  var desconto = $("#desconto").val();

  if((produtoSelecionado != 0) && (valorJaAdicionado == null)){

    valorTotalAtual = parseFloat(valorTotalAtual);
    valorUnitarioProduto = parseFloat(valorUnitarioProduto);
    var valorAtualizado = (valorUnitarioProduto * qtde)+valorTotalAtual;
    $("#inputValorTotal").val(valorAtualizado);

  }else if((produtoSelecionado != 0) && (valorJaAdicionado != null)){

    valorTotalAtual = parseFloat(valorTotalAtual);
    valorUnitarioProduto = parseFloat(valorUnitarioProduto);
    $("#inputValorTotal").val((valorTotalAtual-valorJaAdicionado)+valorUnitarioProduto * qtde);

  }

  valoresJaAdicionadosAoTotal[cont]=(valorUnitarioProduto * qtde);
  atualizaValorTotalDesconto();
}

function atualizaValorTotalDesconto(){
  var desconto = $("#desconto").val();
  var valorTotal = $("#inputValorTotal").val();

  if (desconto!=""){
    desconto = parseFloat(desconto);
    valorTotal = valorTotal - (valorTotal*desconto)/100;
  }

  $("#inputValorTotalDesconto").val(valorTotal);

}

function retornaValorUnitarioProduto(cont){
    var campo = "#produtos"+cont;
    var idProduto = document.getElementById("produtos"+cont).value;
    var pagina = "retornaValorUnitario.php";

    if(idProduto!=0){
        $.ajax({
            type:'POST',
            dataType:'html',
            url: pagina,
            data: {codigo:idProduto},
            success: function(valorUnitario) {
                var inputVlUnitario = ("#vlUnitario"+cont);
                $(inputVlUnitario).val(valorUnitario);

            }
        });
    }
}

function retornaProdutos(cont,idCat){

    var pagina="retornaProdutosEdicao.php";

    if(idCat!=0){
      $.ajax({
        type:'POST',
        dataType:'html',
        url: pagina,
        data: {idCat:idCat},
        success: function(produtos){
          var inputValorUnit = ("#vlUnitario"+cont);
          var quantidade = ("#quantidade"+cont);
          var descricao = ("#descricao"+cont);
          $(inputValorUnit).val("");
          $(quantidade).val("");
          $(descricao).val("");
					var selectProdutos = ("#produtos"+cont);
					$(selectProdutos).empty();
					$(selectProdutos).append("<option value='0'>Selecione</option>");
					$(selectProdutos).append(produtos);

        }//fechamento da função do SUCCESS
      });//FECHAMENTO DO AJAX
    }//FECHAMENTO DO IF

}//FECHAMENTO DA FUNCAO
