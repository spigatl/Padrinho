<?php
session_start();
if (isset($_POST['entrar'])) {
	require_once('db.php');

	$login = $_POST['fr_login'];
	$senha = $_POST['fr_senha'];

	//verificando caracteres invalidos
	function verifica_login($e) {
		$pattern = "/^[A-Z0-9a-z\x{23}\x{2D}\x{2E}\x{40}\x{5F}\x{23}\x{24}\x{25}]+$/";
		if (preg_match($pattern, $e)) {
			return true;
		} else {
			return false;
		}
	}

		//verifica no banco de dados as infos do form
		$result = $db->query("SELECT * FROM userempresa WHERE UE_USER='$login' AND UE_SENHA='$senha'") or die ($db->error);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$login_bd = $row['UE_USER'];
		$senha_bd = $row['UE_SENHA'];
		$id_bd =  $row['ID'];
		$aut_bd = $row['UE_ATIVO'];

		// compara se as senhas estao corretas.
		if (verifica_login($_POST['fr_login']) == true && verifica_login($_POST['fr_senha']) == true) {
			if (($login == $login_bd) && ($senha == $senha_bd)) {
				if ($aut_bd == "AUTH") {
				$_SESSION['id_emp'] = $id_bd;
				header("Location: empresa/pemp.php?p=pemplista&pag=1");
				} else {
					$errorString = "<div id=fr_erro2><p>Verifique seu email pois sua conta ainda nao está ativa</p></div>";
				}
			} else {
				$errorString = "<div id=fr_erro2><p>Login ou Senha incorretos</p></div>";
			}
		} else {
			$errorString = "<div id=fr_erro2><p>Login ou Senha incorretos</p></div>";
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/empresacadastro.css" />
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
	function formEmpresa() {
		window.location="formempresa.php";
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
                    <fieldset class="step">
                            <legend>Cadastro de Empresas</legend>
                        	<div style="width: 48%; float: left">
                        		<div id="fr_error">
                                    <?php
                                    if (isset($_POST['entrar'])) {
                                        echo "$errorString";
                                    }
                                    ?>
                                </div>
                        		<form id="formElem" name="formElem" action="" onsubmit="validateForms()" method="post" enctype="multipart/form-data">
                        			<p class="p1">
                        				<label class="titulo">Já sou Cadastrado</label>
                        			</p>
                        			<p class="p1">
                                		<label for="fr_noivo">Login:</label>
                                		<input id="fr_noivo" name="fr_login" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_noivo"; } ?>' AUTOCOMPLETE=OFF />
                            		</p>
                            		<p class="p1">
                                		<label for="fr_noivo">Senha:</label>
                                		<input id="fr_noivo" name="fr_senha" type="password" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_noivo"; } ?>' AUTOCOMPLETE=OFF />
                            		</p>
                            		<p class="p2">
                            		<label for="fr_noivo"><a href="#">Esqueci minha Senha</a></label>
                            		</p>
                            		<button id="registerButton" name="entrar" type="submit" value="">Entrar</button>
                        		</form>
                        	</div>
                        	<div style="width: 1%; float: left; height: 240px; border-right: 1px solid #d8d8d8;">
                        		
                        	</div>
                        	<div style="width: 49%; float: left; height: 220px;">
                        		<p class="p1">
                        			<label class="titulo">Não sou Cadastrado</label>
                        		</p>
                        		<p class="p3">
                        			<button id="registerButton" onclick="formEmpresa();" name="cadastrar" type="submit" value="">Criar Cadastro</button>
                        		</p>
                        	</div>
                        </fieldset>
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
