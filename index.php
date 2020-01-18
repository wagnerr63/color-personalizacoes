<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Color Personalizações</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="text/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="js/contato.js"></script>

<script type="text/javascript">
	/* Máscara Telefone (XX) XXXXX-XXXX*/
	function mascara(o,f){
		v_obj=o
		v_fun=f
		setTimeout("execmascara()",1)
	}
	function execmascara(){
		v_obj.value=v_fun(v_obj.value)
	}
	function mtel(v){
		v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
		v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
		v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
		return v;
	}
	function id( el ){
		return document.getElementById( el );
	}
	window.onload = function(){
		id('campoTelefone').onkeypress = function(){
			mascara( this, mtel );
		}
	}
</script>

<script type="text/javascript">
	function onlyChars(e)
	{
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
</script>
</head>

<body>

<nav class="botoesMenu">
	<label for="rd_home"><img src="img/icon.png" alt="Logo Color Personalizações" id="logoHome"></label>
	<label for="rd_sobre">SOBRE</label>
	<label for="rd_trabalhos">TRABALHOS</label>
	<label for="rd_contato">CONTATO</label>
	<a href="paginasSite/login.php">LOGIN</a>
</nav>

<div class="scroll">
	<input type="radio" name="grupo" id="rd_home">
	<input type="radio" name="grupo" id="rd_sobre">
	<input type="radio" name="grupo" id="rd_contato">
	<input type="radio" name="grupo" id="rd_trabalhos">
	<input type="radio" name="grupo" id="rd_login">

<section class="sections">
	<section class="bloco" id="home">
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/agendaP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Agenda<br><span>de Anotações</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/sacolaP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Sacola<br><span>Ecológica</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/canecaP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Caneca<br><span>Floral</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/tacaP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Taça<br><span>Colorida</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/cadernoP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Caderno<br><span>Ecológico</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/boneP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Boné<br><span>Personalizado</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/camisetaP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Camiseta<br><span>Estampada</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/chaveiroP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Chaveiro<br><span>e Broches</span></h3>
				</div>
			</div>
			<div class="swiper-slide">
				<div class="imagemPrincipal">
					<img src="img/adesivoP.jpg" alt="foto">
				</div>
				<div class="detalhes">
					<h3>Adesivos<br><span>Personalizado</span></h3>
				</div>
			</div>

		</div>
		<div class="swiper-pagination"></div>
		<script type="text/javascript" src="text/swiper.min.js"></script>
		 <script>
			var swiper = new Swiper('.swiper-container', {
				effect: 'coverflow',
				grabCursor: true,
				centeredSlides: true,
				slidesPerView: 'auto',
				coverflowEffect: {
				rotate: 50,
				stretch: 0,
				depth: 200,
				modifier: 1,
				slideShadows : true,

			  },
			  pagination: {
				el: '.swiper-pagination',
			  },
			});
		</script>
	</section>

	<section class="bloco" id="sobre">
		<div>
			<div id="divDireitaSobre">
			<h2 class="subtitulosSobre">Quem somos?</h2>
			<p class="textosSobre">Somos a empresa Color Personalizações, fundada em 2004, com o objetivo de atender a demanda de estampagem presente no
			mercado e utilizamos todo o nosso esforço para proporcionar a realização dos desejos dos nossos clientes.</p>
			<h2 class="subtitulosSobre" id="oQueFazemos">O que fazemos?</h2>
			<p class="textosSobre">A nossa principal função é realizar a personalização de produtos, como camisetas, canecas, chaveiros, entre outros objetos
			do nosso catálogo.</p>
			</div>
		</div>
	</section>

	<section class="bloco" id="trabalhos">
	<div id="blocoTrabalhos">
		<div id="divTrabalhos"><h1 id="tituloTrabalhos">Categorias</h1></div><br>

		<div id="categorias">

			<div id="vestuario" class="imagemCategoria">
				<div class="categoriaImagem">
					<a href="paginasSite/cateVestuario.html"><img src="img/vestuario2.png" alt="Imagem Vestuário"></a>
				</div>

				<div class="escritoCategorias">
					<h2 class="detalhesTrabalho">Vestuário</h2>
				</div>
			</div>

			<div id="ecologia" class="imagemCategoria">
				<div class="categoriaImagem">
					<a href="paginasSite/cateEcologico.html"><img src="img/ecologico.png" alt="Imagem Ecológico"></a>
				</div>

				<div class="escritoCategorias">
					<h2 class="detalhesTrabalho">Ecológico</h2>
				</div>
			</div>

			<div id="festa" class="imagemCategoria">
				<div class="categoriaImagem">
					<a href="paginasSite/cateFestas.html"><img src="img/festa.jpg" alt="Imagem Festa"></a>
				</div>

				<div class="escritoCategorias">
					<h2 class="detalhesTrabalho">Festa</h2>
				</div>
			</div>

			<div id="escritorio" class="imagemCategoria">
				<div class="categoriaImagem">
					<a href="paginasSite/cateEscritorio.html"><img src="img/escritorio.png" alt="Imagem Ecritório"></a>
				</div>

				<div class="escritoCategorias">
					<h2 class="detalhesTrabalho">Escritório</h2>
				</div>
			</div>
		</div>
	</div>

	</section>

	<section class="bloco" id="contato">
		<div id="divContato"><h1 id="tituloContato">Contato</h1></div>

			<div id="divEsquerda">
			<h2 class="subtitulosContato" id="tituloFaleConosco">Fale conosco!</h2>

			<form id="formularioMensagem" action="php/enviaMensagem.php" method="POST" onsubmit="return validarCampos()">
			<label for="assunto" class="titulosCamposFaleConosco">Assunto</label>
			<select id="assuntos" name="assuntos">
			<option value="0">Selecione</option>
			<option value="1">Orçamento</option>
			<option value="2">Reclamação</option>
			<option value="3">Sugestão</option>
			</select>
			<br>

			<label for="nome" class="titulosCamposFaleConosco" id="nome">Nome</label>
			<input type="text" name="campoNome" onkeypress="return onlyChars(event)" id="campoNome" class="camposFaleConosco" size="25" placeholder="Digite seu nome completo">
			<br>

			<label for="telefone" class="titulosCamposFaleConosco" id="telefone">Telefone</label>
			<input type="text" name="campoTelefone" id="campoTelefone" class="camposFaleConosco" size="25" maxlength="15" placeholder="Digite seu telefone">
			<br>

			<label for="email" class="titulosCamposFaleConosco">E-mail</label>
			<input type="text" name="campoEmail" id="campoEmail" class="camposFaleConosco" size="25" placeholder="Digite seu e-mail">
			<br><br><br>

			<div id="divMensagem">
			<label for="mensagem" id="mensagem">Mensagem</label><br>
			<textarea rows="5" cols="40" maxlength="500" name="caixaMensagem" id="caixaMensagem"></textarea></div>

			<button type="reset" class="botoesMensagem" id="botaoLimparCampos"><img src="img/button_limpar-campos.png" alt="Limpar campos" title="Limpar campos"></button>
			<button type="submit" class="botoesMensagem"><img src="img/button_enviar.png" alt="Enviar" title="Enviar"></button>

			</form>
			</div>

			<div id="linhaVerticalContato"></div>

			<div id="divDireita">
			<h2 class="subtitulosContato" id="subtituloContatos">Contatos</h2>
			<p class="textosContatos"><b>Fone</b>: (47) 3441-7700</p><br>
			<p class="textosContatos"><b>Celular</b>: (47) 98876-0000</p><br>
			<p class="textosContatos" id="emailColor"><b>E-mail</b>: colorpersonalizacoes@gmail.com</p><br><br>
			<a href="http://www.facebook.com" target="_blank"><img src="img/facebookLogo.png"  alt="Logo do Facebook" height="30" width="30" class="redesSociaisLogos"
			id="empurrarDireita"></a>
			<a href="http://www.instagram.com" target="_blank"><img src="img/instagramLogo.png" alt="Logo do Instagram" height="30" width="30" class="redesSociaisLogos"></a>
			<a href="https://web.whatsapp.com/" target="_blank"><img src="img/whatsappLogo.png" alt="Logo do Whatsapp" height="33" width="33" class="redesSociaisLogos"></a>
			<a href="http://www.twitter.com" target="_blank"><img src="img/twitterLogo.png" alt="Logo do Twitter" height="28" width="30" class="redesSociaisLogos"></a><br><br>
			<p class="textosContatos"><b>Endereço</b>: Rua Arno Waldemar Dohler, 957 -<br> Santo Antônio - CEP 89218-155 - Joinville/SC</p>
			<br><br>
			<iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1789.032296895571!2d-48.85362537715384!3d-26.259566924576248!3m2!1i1024!2i768!4f13.1!3
			m3!1m2!1s0x94deafbe3ebf0c05%3A0x624c0303ba7bf8a7!2sSENAI+Joinville+Norte+I!5e0!3m2!1spt-BR!2sbr!4v1559065428365!5m2!1spt-BR!2sbr"
			width="425" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>

		</div>
	</section>

</section>
</div>

</body>
</html>
