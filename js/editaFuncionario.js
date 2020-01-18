function validarCampos(){
	var nome = document.getElementById("nome").value;
	var email = document.getElementById("email").value;
	var senha = document.getElementById("senha").value;
	var nivel = document.getElementById("nivel").value;

var aviso="";

if(nome==""){
	aviso = aviso+"\nNome";
}
if(nivel=="Selecione"){
	aviso = aviso+"\nNível";
}
if(email=="" || email.indexOf("@")==-1 || email.indexOf(".")==-1){
	aviso = aviso+"\nEmail";
}
if(aviso!=""){
	alert("Por favor, preencha corretamente o(s) campo(s): "+aviso);
return false;
}
alert("Funcionário editado!")
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

function retornaNiveis(nivel){

	var niveis = ['1', '2', '3', '4'];
	var niveisEscrito = ['Gerente', 'Atendente', 'Operário', 'Administrador'];
	var niv = "";

	for(var i=0; i<niveis.length; i++){
		if(niveis[i]==nivel){
			niv += "<option value="+(i+1)+" selected>"+niveisEscrito[i]+"</option>";
		}else{
			niv += "<option value="+(i+1)+">"+niveisEscrito[i]+"</option>";
		}
	}

	$("#nivel").append(niv);
}
