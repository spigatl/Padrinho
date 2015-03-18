<?php
    // inclue o banco de dados
    include ('db.php');

if (isset($_POST['cadastrar'])) {

    // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
    $fr_nome = $_POST ["fr_nick"];    //atribuição do campo "nome do noivo" vindo do formulário para variavel 
    $fr_mail = $_POST ["fr_mail"];    //atribuição do campo "nome do email" vindo do formulário para variavel 
    $fr_senha = $_POST ["fr_senha"];    //atribuição do campo "senha" vindo do formulário para variavel     

    // Campos que constam no formulario
    $allowedFields = array(
        'fr_nick',
        'fr_mail',
        'fr_senha',
        'fr_resenha',
    );
     
    // Campo que seram checados
    $requiredFields = array(
        'fr_mail',
        'fr_nick',
    );
    // Loop para pegar os campos que vem do form.
    $errors = array();
    foreach($_POST AS $key => $value)
    {
        // checando se o campo e autorizado
        if(in_array($key, $allowedFields))
        {   
            $field =  $key;
            $key = $value;
     
            // Verifica os campos listados na variavel $queriedfields
            if(in_array($field, $requiredFields) && $field == 'fr_mail')
            {
                $query = "SELECT UE_EMAIL FROM USEREMPRESA WHERE UE_EMAIL = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                    while($row = mySQL_fetch_array($result)) {
                        $errors[] = "<p class=p_erro><h12>E-mail <b> $row[UE_EMAIL] </b> ja em uso.</h12></p><br>";
                        $fremail = true;    
                    }
                } 
                
            }
            if(in_array($field, $requiredFields) && $field == 'fr_nick')
            {
                $query = "SELECT UE_USER FROM USEREMPRESA WHERE UE_USER = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                     while ($row = mySQL_fetch_array($result)) {
                        $errors[] = "<p class=p_erro><h13>Apelido <b> $row[UE_USER] </b> ja em uso.</h13></p><br>";
                        $frnick = true;
                    } 
                    
                }     
            }
        }
    }
     
    // Se acontecer algum erro
    if(count($errors) > 0)
    {
        $errorString = "<div id=fr_erro2>";
        $errorString .= "<p class=p_erro><h11>A um erro no cadastro.</h11></p>";

        foreach($errors as $error)
        {
            $errorString .= "$error";
        }
        $errorString .= "</div>";
    }
    else
    {

    //insere os dados do form no BD
    $result = $db->query("INSERT INTO USEREMPRESA (UE_USER, UE_EMAIL, UE_SENHA, UE_ATIVO) VALUES ('$fr_nome', '$fr_mail', '$fr_senha', 'AUTH')") or die ($db->error);

    //gerar token de autenticacao
    $result = $db->query("SELECT * FROM USEREMPRESA ORDER BY ID DESC LIMIT 1") or die ($db->error);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $codigoempresa = $row['ID'];
    $token = "c_empresa";
    $n_token = md5(uniqid($codigoempresa, true));
    $result = $db->query("INSERT INTO AUTH (A_CODIGO, A_DATA, A_EMAIL, A_ID, A_HORA, A_TIPO) VALUES ('$n_token', 'null', '$fr_mail', '$codigoempresa', 'null', 'EMPRESA')") or die ($db->error);
    
    //munda para janela de cadastros concluidos
    echo "<script>window.location='concluido.php?id=$fr_id'</script>"; // Redireciona para pagina.php
    
    //fecha a conexao com banco de dados
    $db->close();
    }   
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="css/menu.css" />
<link rel="stylesheet" href="css/formempresa.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Padrinho Online :. Melhor Sites de Lista de Casamento.</title>
<script src="css/jquery.js" type="text/javascript"></script>
<script src="js/idlocal.js" type="text/javascript"></script>
<script src="js/event.js" type="text/javascript"></script>
<script src="js/confere3.js" type="text/javascript"></script>
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
                 <form id="formElem" name="formElem" action="formempresa.php" onsubmit="" method="post" enctype="multipart/form-data">
                            <legend>1. Termos de Uso</legend>
                                <div id="fr_error">
                                    <?php
                                    if (isset($_POST['cadastrar'])) {
                                        echo "$errorString";
                                    }
                                    ?>
                                </div>
                                <div id="contform">
                                       <?php include('texto.txt'); ?>
                                </div>    
                                    <input id="check" type="checkbox"> 
                                    <label for="check" id="checktxt"> Aceito os termos de Uso.</label>            
                        <legend>2. Usuario</legend>
                            <div id="user">
                                 <p class="perfildireita">
                                    <label for="fr_mail">E-mail:</label>
                                    <input id="fr_mail" name="fr_mail"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_mail"; } ?>' AUTOCOMPLETE=OFF />
                                </p>
                                 <p class="perfildireita">
                                    <label for="fr_nick">Usuario:</label>
                                    <input id="fr_nick" name="fr_nick"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_nome"; } ?>' AUTOCOMPLETE=OFF />
                                </p>
                                <p class="perfildireita">
                                    <label for="fr_senha">Senha:</label>
                                    <input id="fr_senha" name="fr_senha"  type="password"/>
                                </p>
                                <p class="perfildireita">
                                    <label for="fr_resenha">Repetir Senha:</label>
                                    <input id="fr_resenha" name="fr_resenha"  type="password"/>
                                </p>
                                <p class="perfilesquerda">
                        <button id="registerButton" name="cadastrar" type="submit" value="">Registrar</button>
                    </p>
                            </div>
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
