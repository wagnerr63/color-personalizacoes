function validarCampos(){

	var codigo = document.getElementById("orcamentos").value;
	var operario = document.getElementById("operarioRes").value;
	var dataE = document.getElementById("dataE").value;
	var msg = "";

	if(codigo == 0){
		msg = msg + "Código do orçamento\n";
	}
	if(dataE == ""){
		msg = msg + "Data de entrega\n";
	}
	if(operario == 0){
		msg = msg + "Operário executor\n";
	}
	if(msg!=""){
		alert("Por favor, preencha o(s) campo(s): \n" +msg);
		return false;
	}
	else{
		alert("Ordem de serviço gerada!");
		return true;
	}
}

$(document).ready(function() {
var hoje = new Date();
var dia = hoje.getDate();
var mes = hoje.getMonth()+1;
var ano = hoje.getYear()+1900;
var inputDataGerada = "#dataG";
$(inputDataGerada).val(dia+"/"+mes+"/"+ano);

var inputAtual = "#dataAtual";
$(inputAtual).val(ano+"-"+mes+"-"+dia);
});

function retornaCodigoCliente(){
  var codigoOrca = document.getElementById("orcamentos").value;
  var pagina = "retornaCodigoCliente.php";


  if(codigoOrca!=0){
    $.ajax({
      type:'POST',
      dataType:'html',
      url: pagina,
      data: {codigo:codigoOrca},
      success: function(nomeCliente){
        var inputCodigoClie = "#codigoClie";
        $(inputCodigoClie).val(nomeCliente);
      } //fechamento da funcao do success
    }); //fechamento do AJAX
  }     //fechamento do IF
}       //fechamento da função
