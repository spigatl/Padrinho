<?php
if(!isset($id_logo)) {
    header("location: error.php");
}
?>
<div id="peremail">
    <form id="formEmail" name="formemail" action=<?php echo "perfil.php?p=peresult&action=email&id=". $fr_id; ?> method="post" enctype="multipart/form-data">
        <legend>
            Para alterar o seu email e necessário que tenha acesso ao email antigo pois será enviado um email com link para autenticação. 
        </legend>
        <br>
        <p>
            <label for="fr_email">Email:</label>
            <input id="fr_email" name="fr_email" type="text" AUTOCOMPLETE=OFF />&nbsp;&nbsp;&nbsp;
            <button id="alterarbt" name ="alterarbt" type="submit" >Alterar</button>
        </p>
    </form>
</div>