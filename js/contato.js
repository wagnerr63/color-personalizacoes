function validarCampos(){
	var assunto = document.getElementById("assuntos").value;
	var nome = document.getElementById("campoNome").value;
	var telefone = document.getElementById("campoTelefone").value;
	var telefoneTamanho = telefone.length;
	var email = document.getElementById("campoEmail").value;
	var mensagem = document.getElementById("caixaMensagem").value;

var aviso="";

if(assunto==0){
	aviso = aviso+"\nAssunto";
}
if(nome==""){
	aviso = aviso+"\nNome";
}
if (telefone=="" || telefoneTamanho<15){
	aviso = aviso + "\nTelefone";
}
if(email=="" || email.indexOf("@")==-1 || email.indexOf(".")==-1){
	aviso = aviso+"\nEmail";
}
if(mensagem==""){
	aviso = aviso+"\nMensagem";
}
if(aviso!=""){
	alert("Por favor, preencha corretamente o(s) campo(s): "+aviso);
	return false;
}
	alert("Sua mensagem foi enviada!");
	return true;
}
