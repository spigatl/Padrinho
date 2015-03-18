<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/concluido.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Padrinho Online :. Melhor Sites de Lista de Casamento.</title>
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
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
                    <fieldset class="step">
                            <legend>Cadastro Concluido</legend>
                        	<p>
                        		<label>Parabens! seu cadastro foi concluido com sucesso.</label>
                        	</p>
                        	<p>
                        		<label><?php echo "O ID da sua lista de casamento é<br><br><font size=11>". $_GET['id'] ."</font>"; ?></label>
                        	</p>
                        	<p>
                        		<button id="registerButton" name="cadastrar" onclick="window.location='index.php'">Voltar</button>
                        		<button id="registerButton" name="cadastrar" onclick="window.location='login.php'">Minha Conta</button>
                        	</p>
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
