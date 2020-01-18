function validarCampos(){

	var nome = document.getElementById("nome").value;
	var precoUni = document.getElementById("precoUni").value;
	var categoria = document.getElementById("categoriaProd").value;
	var msg = "";

	if(nome==""){
		msg = msg + "Nome \n";
	}
	if(precoUni == ""){
		msg = msg + "Preço unitário \n";
	}
	if(categoria=="0"){
		msg = msg + "Categoria \n";
	}
	if(msg!=""){
		alert("Por favor, preencha o(s) campo(s): \n" +msg);
		return false;
	}else{
		alert("Produto cadastrado!");
		return true;
	}
}

function confirmarExclusao(){

	var confirmacao = confirm("Deseja realmente excluir este produto?");
    if(confirmacao==true){
      return true;
		}else{
			return false;
	}
}
