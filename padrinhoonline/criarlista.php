<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/criarlista.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
		</p><div id="boxes">
<?php
include('formlista.php');
?>
</div>
<h10 id="final"></h10>
</div>
</div>
</body>
</html>
