<?php
if (!isset($fr_id)) {
    header("location: ../error.php");
}
 if (isset($_POST['alterarbt'])) {
    $senha =  $_POST['fr_senha'];
    $senhaantiga =  $_POST['fr_antiga'];

    // pega a senha antiga
    $insert = "SELECT * FROM users WHERE U_ID = $fr_id";
    $result = mysql_query($insert);
    while ($row = mysql_fetch_array($result)) {
        $senhaantiga2 =  $row['U_SENHA']; 
    }

    // Campos que constam no formulario
    $allowedFields = array(
        'fr_antiga',
        'fr_senha',
        'fr_resenha',
        );
    $errors = array();
    foreach($_POST AS $key => $value)
    {
        // checando se o campo e autorizado
        if(in_array($key, $allowedFields))
        {   
            $pattern = "/^[A-Z0-9a-zá-ú\x{0}\x{23}\x{2D}\x{2E}\x{40}\x{28}\x{29}\x{5F}\x{23}\x{25}\x{20}\x{2F}]+$/";
            if (!preg_match($pattern, $value)) {
                $errors[1] = "<p><h11> Essses caracteres não sao validos: &#33; &#34; &#35; &#37; &#39; &#42; &#43; &#44; &#47;</h11></p>";
            }
        }
    }
    //verifica se a senhas sao compativeis
    if ($senhaantiga != $senhaantiga2) {
        $errors[] = "<p><h12>A Senha Antiga esta errada</h12></p>";
    }

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
        //troca a senha do usuario
        $insert = "UPDATE users SET U_SENHA='$senha' WHERE U_ID='$fr_id'";
        mySQL_query($insert) or die("Falha no Update<br>". mysql_error());
        mySQL_close($link);

        echo "<script>window.location='perfil.php?p=result&action=senha'</script>"; // Redireciona para peresult.php
    }
}
?>
<div id="fr_error">
<?php
  if (isset($_POST['alterarbt'])) {
    echo "$errorString";
  }
?>
</div>
<div id="pertuto">
  	<form id="formSenha" name="formSenha" action=<? echo "perfil.php?p=senha" ?> method="post" enctype="multipart/form-data">
  		<p class="perfildireita">
            <label for="fr_antiga">Senha Antiga:</label>
            <input id="fr_antiga" name="fr_antiga" type="password" AUTOCOMPLETE=OFF />
        </p>
        <p class="perfildireita">
            <label for="fr_senha">Senha Nova:</label>
            <input id="fr_senha" name="fr_senha" type="password" AUTOCOMPLETE=OFF />
        </p>
        <p class="perfildireita">
            <label for="fr_resenha">Repetir Senha:</label>
            <input id="fr_resenha" name="fr_resenha" type="password" AUTOCOMPLETE=OFF />
        </p>
        <p class="perfildireita">
          <br>
		      <button id="alterarbt" name ="alterarbt" type="submit" >Alterar</button>
        </p>
  	</form>
</div>