function validarCampos(){

	var nome = document.getElementById("nomeCat").value;
	var descricao = document.getElementById("descricao").value;
	var msg = "";


	if(nome==""){
		msg = msg + "Nome \n";
	}
	if(descricao==""){
		msg = msg + "Descrição \n";
	}
	if(msg!=""){
		alert("Por favor, preencha o(s) campo(s): \n" +msg);
		return false;
	}
	else{
		alert("Categoria editada!")
		return true;
	}
}
