function validarCampos(){
	var nome = document.getElementById("nome").value;
	var email = document.getElementById("email").value;
	var senha = document.getElementById("senha").value;
	var nivel = document.getElementById("nivel").value;

var aviso="";

if(nome==""){
	aviso = aviso+"\nNome";
}
if(email=="" || email.indexOf("@")==-1 || email.indexOf(".")==-1){
	aviso = aviso+"\nEmail";
}
if(nivel=="Selecione"){
	aviso = aviso+"\nNível";
}
if(senha==""){
	aviso = aviso+"\nSenha";
}
if(aviso!=""){
	alert("Por favor, preencha corretamente o(s) campo(s): "+aviso);
return false;
}
alert("Funcionário cadastrado!")
return true;
}

function onlyChars(e){
	var tecla=new Number();
	if(window.event) {
		tecla = e.keyCode;
	}
	else if(e.which) {
		tecla = e.which;
	}
	else {
		return true;
	}
	if((tecla >= "48") && (tecla <= "57")){
		return false;
	}
}

function confirmarExclusao(){

	var confirmacao = confirm("Deseja realmente excluir este funcionário?");
    if(confirmacao==true){
      return true;
		}else{
			return false;
	}
}
