<?php
$fr_id = $_GET['id'];

include('db.php');

$query = "SELECT U_ID, U_IMG, U_DATA, U_NOME_NOIVO, U_NOME_NOIVA FROM USERS WHERE U_ID = '$fr_id'";
$result = mysql_query($query) or die("Houve um erro no Banco de dados". mysql_error());
while ($row = mysql_fetch_array($result)) {
	$datavencimento = $row['U_DATA'];
	$foto = "fotos/". $row['U_IMG'];
	$noivo1 = $row['U_NOME_NOIVO'];
	$noiva1 = $row['U_NOME_NOIVA'];
	$noivo = split(' ',$noivo1);
	$noiva = split(' ',$noiva1); 
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/perfil.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Padrinho Online :. Melhor Sites de Lista de Casamento.</title>
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="js/idlocal.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<script src="js/confere2.js" type="text/javascript"></script>
<!-- Let's do the animation -->
<script type="text/javascript">
	$(function() {
		// set opacity to nill on page load
		$("#menu span").css("opacity","0");
		// on mouse over
		$("#menu span").hover(function () {
			// animate opacity to full
			$(this).stop().animate({
				opacity: 1
			}, 'slow');
		},
		// on mouse out
		function () {
			// animate opacity to nill
			$(this).stop().animate({
				opacity: 0
			}, 'slow');
		});
		$('.sombra').hide();
		$('.com-sombra').hover(function () {
			$(this).find('.sombra').animate({
				height: 'toggle'
			}); 
		}, function () {
			$(this).find('.sombra').animate({
				height: 'toggle'
			}); 
		});		
	});
	
</script>

</head>
<body>
<img class="extradiv" src="imagens/radial.png" alt="" />
<div id="corpo">
<h1 id="logo1"></h1>
<h2 id="logo2"></h2>
<h4 id="login">Bem Vindo! Visitante&nbsp;&nbsp; |</h4>
<h5 id="login2">&nbsp;Minha Conta</h5>
<ul id="menu">
<li><a href="index.php" class="inicio"><span></span></a></li>
<li><a href="#lista" class="lista"><span></span></a>
	<ul id="lista2">
		<li><a href="#lista2">Criar Lista</a></li>
		<li><a href="#lista3">Localizar Lista</a></li>
        <li><a href="comofunciona.php" class="teste2">Como Funciona</a></li>
	</ul>
 </li>
<li><a href="#guia" class="guia"><span></span></a>
     <ul id="lista3">
		<li><a href="empresa.php?id=acessorios">Acessórios</a></li>
		<li><a href="empresa.php?id=acesseventos">Assessoria de eventos</a></li>
		<li><a href="empresa.php?id=adfestas">Aderecos para festas</a></li>
		<li><a href="empresa.php?id=aliancas">Alianças</a></li>
		<li><a href="empresa.php?id=altacosturas">Alta Costura</a></li>
		<li><a href="empresa.php?id=trajes">Aluguel de trajes</a></li>
		<li><a href="empresa.php?id=bandas">Bandas</a></li>
		<li><a href="empresa.php?id=banqueteiros">Banqueteiros</a></li>
		<li><a href="empresa.php?id=design">Design de Interiores</a></li>
		<li><a href="empresa.php?id=bebidas">Bebidas</a></li>
		<li><a href="empresa.php?id=bemcasados">Bem-casados</a></li>
		<li><a href="empresa.php?id=bolos">Bolos e doces</a></li>
		<li><a href="empresa.php?id=buffet">Buffet</a></li>
	</ul>
	<ul id="lista4">
		<li><a href="empresa.php?id=eventos">Espacos para eventos</a></li>
		<li><a href="empresa.php?id=barmen">Bar e Barmen</a></li>
		<li><a href="empresa.php?id=convites">Convites e R.S.V.P.</a></li>
		<li><a href="empresa.php?id=carros">Carros novos e antigos</a></li>
		<li><a href="empresa.php?id=chabar">Chá bar e cozinha</a></li>
		<li><a href="empresa.php?id=celebcasa">Celeb. de Casamentos</a></li>
		<li><a href="empresa.php?id=coral">Coral e orquestra</a></li>
		<li><a href="empresa.php?id=decoracao">Decoração</a></li>
		<li><a href="empresa.php?id=diadanoiva">Dia da noiva</a></filmagem>
		<li><a href="empresa.php?id=dj">DJ</a></li>
		<li><a href="empresa.php?id=enxoval">Enxoval</a></li>
		<li><a href="empresa.php?id=filmagem">Filmagem e vídeo</a></li>
		<li><a href="empresa.php?id=floriculturas">Floriculturas</a></li>
		</ul>
		<ul id="lista5">
		<li><a href="empresa.php?id=fotos">Foto e vídeo</a></li>
		<li><a href="empresa.php?id=fotojornalismo">Fotojornalismo</a></li>
		<li><a href="empresa.php?id=lembrancinhas">Lembrancinhas</a></li>
		<li><a href="empresa.php?id=listapresentes">Lista de Presentes</a></li>
		<li><a href="empresa.php?id=luademel">Lua-de-mel</a></li>
		<li><a href="empresa.php?id=musicacasamento">Musica para casamento</a></li>
		<li><a href="empresa.php?id=revista">Revistas e Guias</a></li>
		<li><a href="empresa.php?id=somluzimagem">Som, Luz e Imagem</a></li>
		<li><a href="empresa.php?id=segurancas">Valet Park - Seguranças</a></li>
		<li><a href="empresa.php?id=sitesdecasamento">Sites de Casamento</a></li>
		<li><a href="empresa.php?id=topodebolo">Topo de Bolo</a></li>
		<li><a href="empresa.php?id=sitioscasamentos">Sítios para casamento</a></li>
		<li><a disable href="#" class="linkdisa"><h16>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h16></a></li>
	</ul>
</li>
<li><a href="#quem" class="quem"><span></span></a>
	<ul id="lista2">
		<li><a href="#lista2">Sobre</a></li>
		<li><a href="#lista3">Midias</a></li>
        <li><a href="comofunciona.php" class="teste2">Parceirias</a></li>
	</ul>
</li>
<li><a href="#contato" class="contato"><span></span></a></li>
<li><a href="#face" class="face"><span></span></a></li>
<li><a href="#twi" class="twi"><span></span></a></li>
</ul>
<div id="boxes">
  <div id="content">
            <div id="wrapper">
                <div id="steps">
                    <fieldset class="step">
                        <legend><?php echo "$noivo[0] $noivo[1] &amp; $noiva[0] $noiva[1]"; ?></legend>
                        	<div id="photodiv" style="width: 230px; float: left">
                        		<p>
                        			<div id="estado">
                        				<div>
                        					<div style="position: relative" class="com-sombra">
	                        					<img src=<?php echo "$foto"; ?> class="img">
	                        					<div class="sombra" style="position: absolute; bottom: 0; left: 0; right: 0;">
		                        						</p>
		                        							<li><a id="alterar" href="perfil.php?p=pereditar<?php echo '&id='. $fr_id; ?>">Alterar Foto do Perfil</a></li>
		                        						</p>
	                        					</div>
	                        				</div>
	                        			</div>
	                        			<ul>
		                        			<label>Minha Conta</label>
		                        			<li>
		                        				<a href="?p=perdados<?php echo '&id='. $fr_id; ?>">Alterar Dados Pessoais</a>
		                        			</li>
		                        			<li>
		                        				<a href="?p=persenha<?php echo '&id='. $fr_id; ?>">Alterar Senha</a>
		                        			</li>
		                        			<li>
		                        				<a href="?p=peremail<?php echo '&id='. $fr_id; ?>">Alterar E-mail</a>
		                        			</li>
		                        				<label>Minha Lista</label>
		                        			<li>
		                        				<a href="#">Buscar Produtos</a>
		                        			</li>
		                        			<li>
		                        				<a href="#">Gerenciar Lista</a>
		                        			</li>
		                        			<li>
		                        				<a href="#">Finalizar</a>
		                        			</li>
	                        			</ul>
	                        		</div>
                        		</p>
                       		</div>
                       		<div id="photodiv" style="width: 480px; float: left">
                       			<?php
                       			$page = $_GET['p'];
								$pages = array('perinicio', 'perdados', 'persenha', 'peresult', 'pereditar', 'peremail');
								if (!empty($page)) {
									if(in_array($page,$pages)) {
										$page .= '.php';
										include($page);
									}
									else {
										echo 'Page not found. Return to
										<a href="index.php">index</a>';
									}
								}
								else {
									include('page1.php');
								}
                       			?>  
                       		</div>
                    </fieldset>
                </div>
            </div>
	</div>
</div>
<h10 id="final"></h10>
</div>
</div>
</body>
</html>
