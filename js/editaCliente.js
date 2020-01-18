function validarCampos(){

	var nome=document.getElementById("nome").value;
	var cpfcnpj = document.getElementById("cpfcnpj").value;
	var cpfcnpjTamanho = cpfcnpj.length;
	var email = document.getElementById("email").value;
	var inscricaoEstadual = document.getElementById("inscricaoEs").value;
	var inscricaoEstadualTamanho= inscricaoEstadual.length;
	var telefone = document.getElementById("telefone").value;
	var telefoneTamanho = telefone.length;
	var telefone2 = document.getElementById("telefone2").value;
	var telefone2Tamanho = telefone2.length;
	var rua = document.getElementById("rua").value;
	var bairro = document.getElementById("bairro").value;
	var complemento = document.getElementById("complemento").value;
	var cidade = document.getElementById("cidade").value;
	var estado = document.getElementById("estado").value;
	var cep = document.getElementById("cep").value;
	var cepTamanho = cep.length;
	var aviso="";

	if (nome==""){
		aviso = aviso + "\nNome";
	}
	if (cpfcnpj=="" || cpfcnpjTamanho!=14 && cpfcnpjTamanho!=18){
		aviso = aviso + "\nCPF/CNPJ";
	}
	if (email!="" && (email.indexOf('@')==-1 || email.indexOf('.')==-1)){
		aviso = aviso + "\nE-mail";
	}
	if (inscricaoEstadualTamanho>18 && inscricaoEstadual=="") {
		aviso = aviso + "\nInscrição Estadual";
	}
	if (cpfcnpjTamanho==18 && inscricaoEstadual=="") {
		aviso = aviso + "\nInscrição Estadual";
	}
	if (cpfcnpjTamanho==14 && inscricaoEstadual!="") {
		aviso = aviso + "\nInscrição Estadual não pode estar preenchida neste caso";
	}
	if (telefone=="" || telefoneTamanho<11){
		aviso = aviso + "\nTelefone";
	}
	if (telefone2Tamanho>0 && telefone2Tamanho<11){
		aviso = aviso + "\nTelefone secundário";
	}
	if (rua==""){
		aviso = aviso + "\nRua";
	}
	if (bairro==""){
		aviso = aviso + "\nBairro";
	}
	if (complemento==""){
		aviso = aviso + "\nComplemento";
	}
	if (cidade==""){
		aviso = aviso + "\nCidade";
	}
	if (estado==0){
		aviso = aviso + "\nEstado";
	}
	if (cepTamanho>0 && cepTamanho<8){
		aviso = aviso + "\nCEP";
	}

	if(aviso!=""){
		alert("Por favor, preencha corretamente o(s) campo(s): "+ aviso);
		return false;
	}else{
		alert("Cliente editado!");
		return true;
	}

}

function mascaraMutuario(o,f){
    v_obj=o;
    v_fun=f;
    setTimeout('execmascara()',1);
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value);
}

function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"");

    if (v.length <= 13) { //CPF

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2");

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2");

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2");

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3");

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2");

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2");
    }

    return v;

}

function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)){
		return false
	}else{
	return true
	}
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

	$("#estado").append(est);
}
