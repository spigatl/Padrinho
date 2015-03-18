<?php
if (!isset($fr_id)) {
    header("location: ../error.php");
}
if (isset($_POST['salveed'])) {

// pega a foto no input file
    $arquivo = $_FILES['photoin'];
    $nome = $arquivo['name'];
    $imagem = $arquivo['tmp_name'];

// declara os tamanhos
    $x = 280;
    $y = 210;

// verifica se o arquivo existe

    if (file_exists($imagem))
    {

// vamos ler a imagem

        $lerimagem = imagecreatefromjpeg($imagem);

// pegar a largura da imagem
        $img_largura = imagesx($lerimagem);

// pegar a altura da imagem
        $img_altura = imagesy($lerimagem);

// dar um nome padrão para a miniatura
        $result = $db->query("SELECT * FROM users WHERE U_ID = $fr_id") or die ($db->error);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (!empty($row['U_IMG'])) {
            $nome_miniatura = $row['U_IMG'];
        } else {
            $nome_miniatura = 'foto_'.md5(uniqid($fr_id, true)).".jpg";
        }

// Agora sim a gente pode criar a imagem
// definir o tamanho da nova imagem

        $nova = imagecreatetruecolor($x,$y);

// agora é só copiar a imagem original para dentro da nova imagem

        imagecopyresampled($nova,$lerimagem,0,0,0,0,$x+1,$y+1,$img_largura,$img_altura);


// onde será salvo a imagen
        $nome_miniatura2 = "../fotos/". $nome_miniatura; 

// salve o arquivo
        imagejpeg($nova, $nome_miniatura2);

// Pronto, fim. Libera a memória usada

        imagedestroy($lerimagem);
        imagedestroy($nova);

    }

    if (!empty($nome_miniatura)) {
//insere os dados do form no BD
        $insert = "UPDATE users SET U_IMG='$nome_miniatura' WHERE U_ID='$fr_id'";
        mySQL_query($insert) or die("Falha no Update<br>". mysql_error());
        mySQL_close($link);
        echo "<script>window.location='perfil.php?p=result&action=img'</script>"; // Redireciona para peresult.php
    } else {
        $error = true;
        $errorString = "<div id=fr_erro2><p class=p_erro><h11>Ocorreu um erro! Por favor! Entre em contato com nossa equipe para resolver seu problema.</h11></p></div>";
    }
} else {
    $query = "SELECT U_IMG FROM users WHERE U_ID = $fr_id";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        $image = $row['U_IMG'];
    }
}
?>
<div id="fr_error">
<?php
  if (isset($error)) {
    $query = "SELECT U_IMG FROM users WHERE U_ID = $fr_id";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
        $image = $row['U_IMG'];
    }
    echo "$errorString";
  }
?>
</div>
<div id="photodived">
    <form id="formfoto" name="formfoto" action="" method="post" enctype="multipart/form-data">
        <label class="fr_edit">Foto do Casal</label><br>
        <img id="photo" src="<?php if ($image == "") { echo '../imagens/semfoto.jpg'; } else { echo '../fotos/'. $image; } ?>">
        <div id="file1c">
            <input id="photoin" name="photoin" type="file" accept="image/jpeg" onchange="readURL(this);"/>
        </div>
        <br>
        <button id="upfile1" name="upfile1" value="">Escolher Arquivo</button>
        <button id="salveed" name="salveed" type="submit" value="">Salvar</button>
    </div>