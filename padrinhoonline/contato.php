<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/contato.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Padrinho Online :. Melhor Sites de Lista de Casamento.</title>
<script src="css/jquery.js" type="text/javascript"></script>
<script src="js/idlocal.js" type="text/javascript"></script>
<script src="js/event.js" type="text/javascript"></script>
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
	});
	
</script>

</head>
<body>
<div id="corpo">
<p class="menulogo">
			<?php
			require_once("menu.php");
			?>
		</p>
<div id="boxes">
  <div id="content">
            <div id="wrapper">
                <div id="steps">
                 <form id="formElem" name="formElem" action="" method="post">
                    <fieldset class="step">
                            <legend>Contato</legend>
                        	 <p class="p2">
                                <label for="name">Nome:</label>
                                <input id="name" name="name" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p class="p2">
                                <label for="country">E-mail:</label>
                                <input id="country" name="country" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p class="p2">
                                <label for="fone">Telefone:</label>
                                <input id="fone" name="fone" placeholder="(xx) xxxx-xxxx" type="tel" AUTOCOMPLETE=OFF />
                            </p>
                             <p  class="p2">
                                <label for="website">Assunto:</label>
                                    <select id="newsletter" name="newsletter" style="min-width:213px" AUTOCOMPLETE=OFF >
                                        <option selected value="Todos">Escolha a Opção</option>
                                        <option value="1">Duvidas Geral</option>
                                        <option value="2">Reclamação</option>
                                        <option value="3">Sugestao</option>
                                    </select>
                                </p>
                            <p>
                                <label id="msg">Digite sua menssagem:</label>
                                <textarea id="textearea" name="website" col="500" rows="7" style="width:310px;"/></textarea>
                            </p>
                        	<button id="registerButton" type="submit">Enviar</button>
                        </fieldset>
                 </form>   
                </div>
            </div>
<script type="text/javascript">
//<![CDATA[

var f = document.forms[0];
MaskInput(f.fone, "(99) 9999-9999");

//]]>
</script>
</div>
</div>
<h10 id="final"></h10>
</div>
</div>
</body>
</html>
