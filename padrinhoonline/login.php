<?php
//iniciando a sessao
session_start();
// campos do form
$requerfields = array('fr_nick', 'fr_senha');
// banco de dados
include('db.php');

 $errors = array();
    foreach($_POST AS $key => $value)
    {
    	// checando se o campo e autorizado
        if(in_array($key, $requerfields))
        {
        	$fr_nick = $_POST['fr_nick'];
        	$fr_senha = $_POST['fr_senha'];
        	$query = "SELECT U_NICK, U_SENHA, U_ID FROM USERS WHERE U_NICK = '$fr_nick' AND U_SENHA = '$fr_senha'";
        	$result = mySQL_query($query) or die("Um erro foi encontrado:<br>". mysql_error());
                if ($result) {
                     if ($row = mySQL_fetch_array($result)) {
                     	$_SESSION['id_logo'] = $row['U_ID'];
                        Header("Location: cliente/perfil.php?p=perinicio");
                    }
                    else
                    {
                    	$errors[1] = "<p class=p_erro><h13>Usuario ou Senha Invalidos</h13></p><br>";	
                    } 
                    
                } 

	    // Se acontecer algum erro
	    if(count($errors) > 0)
	    {
	        $errorString = "<div id=fr_erro2>";

	        foreach($errors as $error)
	        {
	            $errorString .= "$error";
	        }
	        $errorString .= "</div>";
	    }
	    else
	    {
	    
	    }
    }
}
mysql_close($link);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/login.css" />
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
	function resenha() {
		window.location='resenha.php';
	}
	
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
                	<form id="formElem" name="formElem" action="login.php" method="post">
	                    <fieldset class="step">
	                            <legend>Minha Conta</legend>
	                            <div id="fr_error">
	                            	<?php
                                    if (isset($_POST['acesso'])) {
                                        echo "$errorString";
                                    }
                                    ?>
                                </div>
							    <p>
						            <label for="fr_nick">Usuario:</label>
						            <input id="fr_nick" name="fr_nick" type="text" AUTOCOMPLETE=OFF />
						        </p>
						        <p>
						            <label for="fr_senha">Senha:</label>
						            <input id="fr_senha" name="fr_senha" type="password" AUTOCOMPLETE=OFF />
						        </p>
						        <p>
						          <br>
								      <button type="button" onclick="resenha()">Esqueci a senha</button>
								      <button type="submit" name='acesso'>Acessar</button>
						        </p>
	                    </fieldset>
	                </form>
                </div>
            </div>
</div>
</div>
<h10 id="final"></h10>
</div>
</div>
</body>
</html>
