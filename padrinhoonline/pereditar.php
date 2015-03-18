<?php
$query = "SELECT U_IMG FROM USERS WHERE U_ID = $fr_id";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
  $image = $row['U_IMG'];
}
?>
<div id="photodived">
	<form id="formElem" name="formElem" action=<?php echo "perfil.php?p=peresult&action=salveed&id=". $fr_id; ?> onsubmit="" method="post" enctype="multipart/form-data">
    <label class="fr_edit">Foto do Casal</label><br>
    <img id="photo" src="<?php if ($image == "") { echo 'imagens/semfoto.jpg'; } else { echo 'fotos/'. $image; } ?>">
    <div id="file1c">
        <input id="photoin" name="photoin" type="file" accept="image/jpeg" onchange="readURL(this);"/>
    </div>
    <br>
    <button id="upfile1" name="escolher" value="">Escolher Arquivo</button>
    <button id="salveed" name="salveed" type="submit" value="">Salvar</button>
</div>