function validarCampos(){

	var nome = document.getElementById("nomeProd").value;
	var precoUni = document.getElementById("preco").value;
	var categoria = document.getElementById("categoria").value;
	var msg = "";

	if(nome==""){
		msg = msg + "Nome \n";
	}

	if(precoUni == ""){
		msg = msg + "Preço unitário \n";
	}

	if(msg!=""){
		alert("Por favor, preencha o(s) campo(s): \n" +msg);
		return false;
	}else{
		alert("Produto editado!");
		return true;
	}
}
