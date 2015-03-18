<?php
$end = "http://". $_SERVER['HTTP_HOST'] ."/padrinhoonline/";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://localhost/padrinhoonline">
	<link rel="stylesheet" href="<?php echo $end; ?>css/menu.css" />
	<link rel="stylesheet" href="<?php echo $end; ?>css/inicial.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>.: Padrinho Online :. Melhor Sites de Lista de Casamento.</title>
	<script src="<?php echo $end; ?>css/jquery.js" type="text/javascript"></script>
	<script src="<?php echo $end; ?>js/idlocal.js" type="text/javascript"></script>
	<script src="<?php echo $end; ?>js/event.js" type="text/javascript"></script>
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
		<div class="meio3"></div>
		<div class="meio4"></div>
		<div class="dica">
			<p class="dicamsg">
				Antes de tomar qualquer providência faça sua lista de convidados pois essa informação será fundamental na escolha  do local para cerimônia e recepção. Além de facilitar na hora de solicitar...
			</p>
			<p class="dicamsg1">
				dicas
			</p>
		</div>
		<div class="dica">
			<p class="dicamsg">
				Antes de tomar qualquer providência faça sua lista de convidados pois essa informação será fundamental na escolha  do local para cerimônia e recepção. Além de facilitar na hora de solicitar...
			</p>
			<p class="dicamsg1">
				propagandas
			</p>
		</div>
		<div class="dica">
			<form id="form1" name="form1" method="post" action="">
				<legend>Localizar lista</legend>
				<p>
					<input style="text-transform: uppercase" name="numero" type="text" id="textfield" maxlength="7" />
				</p>
				<p>
					<button type="submit" name="Localizar" id="local" value="Localizar" />Localizar</button>
				</p>
			</form>
		</div>
		<div class="bottom"></div>
<script type="text/javascript">
//<![CDATA[

var f = document.forms[0];
MaskInput(f.numero, "9^abc");

//]]>
</script>
</div>
</body>
</html>
