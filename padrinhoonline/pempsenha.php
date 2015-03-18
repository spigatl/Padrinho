<?php
 if (isset($_POST['alterarbt'])) {
    $senha =  $_POST['fr_senha'];
    $senhaantiga =  $_POST['fr_antiga'];

    // pega a senha antiga
    $insert = "SELECT * FROM USERS WHERE U_ID = $fr_id";
    $result = mysql_query($insert);
    while ($row = mysql_fetch_array($result)) {
        $senhaantiga2 =  $row['U_SENHA']; 
    }

    //verifica se a senhas sao compativeis
    $errors = array();
    if ($senhaantiga != $senhaantiga2) {
        $errors[] = "<p class=p_erro><h12>A Senha Antiga esta errada</h12></p>";
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
        $insert = "UPDATE USERS SET U_SENHA='$senha' WHERE U_ID='$_GET[id]'";
        mySQL_query($insert) or die("Falha no Update<br>". mysql_error());
        mySQL_close($link);

        echo "<script>window.location='perfil.php?p=peresult&action=senha&id=$fr_id'</script>"; // Redireciona para peresult.php
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
  	<form id="formSenha" name="formSenha" action=<? echo "perfil.php?p=persenha&id=". $fr_id; ?> method="post" enctype="multipart/form-data">
  		<p>
            <label for="fr_antiga">Senha Antiga:</label>
            <input id="fr_antiga" name="fr_antiga" type="password" AUTOCOMPLETE=OFF />
        </p>
        <p>
            <label for="fr_senha">Senha Nova:</label>
            <input id="fr_senha" name="fr_senha" type="password" AUTOCOMPLETE=OFF />
        </p>
        <p>
            <label for="fr_resenha">Repetir Senha:</label>
            <input id="fr_resenha" name="fr_resenha" type="password" AUTOCOMPLETE=OFF />
        </p>
        <p>
          <br>
		      <button id="alterarbt" name ="alterarbt" type="submit" >Alterar</button>
        </p>
  	</form>
</div>