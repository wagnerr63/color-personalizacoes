function validarCampos(){
	var email = document.getElementById("campoEmail").value;
	var senha = document.getElementById("campoSenha").value;

var aviso="";
if(email=="" || email.indexOf("@")==-1 || email.indexOf(".")==-1){
	aviso = aviso+"\nEmail";
}
if(senha==""){
	aviso = aviso+"\nSenha";
}
if(aviso!=""){
	alert("Por favor, preencha corretamente o(s) campo(s): "+aviso);
return false;
}
return true;
}
