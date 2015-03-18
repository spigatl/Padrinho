<?php
$fr_id = $_SESSION['id_emp'];       //ID do usuario que esta cadastrando nova empresa.
// inclue o banco de dados
if(!isset($id_logo)) {
    echo "<script>window.location = '../error.php'</script>";
}
//Include do BD
require_once('../db.php');

if (isset($_POST['cadastrar'])) {

    $vazio = array('$fr_nome', '$fr_coment', '$fr_img', '$fr_rua', '$fr_num', '$fr_uf', '$fr_tel', '$fr_mail', '$fr_site', '$fr_cidade', '$fr_ctg', '$fr_user', '$fr_id');

    // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
    $fr_nome = $_POST ["fr_nome"];      //atribuição do campo "nome do nome" vindo do formulário para variavel 
    $fr_mail = $_POST ["fr_email"];     //atribuição do campo "nome do email" vindo do formulário para variavel 
    $fr_site = $_POST ["fr_site"];      //atribuição do campo "site" vindo do formulário para variavel 
    $fr_tel = $_POST ["fr_tel"];        //atribuição do campo "telefone" vindo do formulário para variavel   
    $fr_cpf = $_POST ["fr_cpf"];        //atribuição do campo "cpf" vindo do formulário para variavel   
    $fr_end = $_POST ["fr_end"];        //atribuição do campo "endereço" vindo do formulário para variavel   
    $fr_num = $_POST ["fr_num"];        //atribuição do campo "numero" vindo do formulário para variavel    
    $fr_bairro = $_POST ["fr_bairro"];  //atribuição do campo "nome do bairro" vindo do formulário para variavel    
    $fr_cidade = $_POST ["fr_cidade"];  //atribuição do campo "nome da cidade" vindo do formulário para variavel    
    $fr_cep = $_POST ["fr_cep"];        //atribuição do campo "cep" vindo do formulário para variavel    
    $fr_coment = $_POST['fr_coment'];   // atribuição do campo "comentario" vindo do formulário para variavel
    $fr_uf = $_POST['fr_uf'];           // atribuição do campo "uf" vindo do formulário para variavel

    // Campos que constam no formulario
    $allowedFields = array(
        'fr_nome',
        'fr_email',
        'fr_tel',
        'fr_nome',
        'fr_site',
        'fr_cpf',
        'fr_end',
        'fr_num',
        'fr_comp',
        'fr_bairro',
        'fr_cidade',
        'fr_cep',
        'fr_uf',
        );
    
    // Campo que seram checados
    $requiredFields = array(
        'fr_nome',
        'fr_cpf',
        );
    
    // pega ID que sera editado
    $id_edit = $_GET['code'];
    $result = $db->query("SELECT * FROM empresa WHERE E_ID = '$fr_id'") or die ($db->error);
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $id_edit_bd = md5($row['ID']);
        if ($id_edit == $id_edit_bd) {
            $id_edit = $row['ID'];
            // print da img
            $p_folder = "../fotos_empresa/". $row['E_IMG'];
            $p_img = imagecreatefromjpeg($p_folder);
        }
    }

    // Loop para pegar os campos que vem do form.
    $errors = array();
    foreach($_POST AS $key => $value)
    {
        // checando se o campo e autorizado
        if(in_array($key, $allowedFields))
        {   
            if (!ereg("^[a-z,A-Z,0-9,_,@,&,$,á-ú,ç,Ç,â-û,(,),[:space:],.,-]+$", $value)) {
                $errors[1] = "<p><h12> Essses caracteres não sao validos: &#33; &#34; &#35; &#37; &#39; &#42; &#43; &#44; &#47;</h12></p>";
                red($key);
            }
            $field = $key;
            $key = $value;
            
            // Verifica os campos listados na variavel $queriedfields
            if(in_array($field, $requiredFields) && $field == 'fr_nome')
            {   

                $query = "SELECT E_EMPRESA FROM empresa WHERE E_EMPRESA = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                    while($row = mySQL_fetch_array($result)) {
                        if ($row['E_EMPRESA'] != $_POST[$field]) {
                            $errors[] = "<p><h12>Email <b> $row[E_EMAIL] </b> ja em uso.</h12></p>";
                            red($field);
                        }    
                    }
                } 
                
            }
            if(in_array($field, $requiredFields) && $field == 'fr_cpf')
            {
                $query = "SELECT E_CNPJ FROM empresa WHERE E_CNPJ = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                   while ($row = mySQL_fetch_array($result)) {
                    if ($row['E_CNPJ'] != $_POST[$field]) {
                        $errors[] = "<p><h13>Apelido <b> $row[E_CNPJ] </b> ja em uso.</h13></p>";
                        red($field);
                    }
                } 
            }     
        }
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

    // pega a foto no input file
    $arquivo = $_FILES['photoin'];
    $nome = $arquivo['name'];
    $imagem = $arquivo['tmp_name'];

    // verifica se o arquivo existe
    if (file_exists($imagem))
    {

    // vamos ler a imagem

        $lerimagem = imagecreatefromjpeg($imagem);

    // pegar a largura da imagem
        $img_largura = imagesx($lerimagem);

    // pegar a altura da imagem
        $img_altura = imagesy($lerimagem);

    // declara os tamanhos
        if (isset($_POST["fr_tal"])) {
            $x = 98;
            $y = 28;
        } else {
            $x = 98;
            $y = 98;
        }

    // dar um nome padrão para a miniatura
        $result = $db->query("SELECT * FROM empresa WHERE ID = '$id_edit'") or die ($db->error);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $last_id = $row['E_IMG'];

        $nome_miniatura = $last_id;

    // Agora sim a gente pode criar a imagem
    // definir o tamanho da nova imagem

        $nova = imagecreatetruecolor($x,$y);

    // agora é só copiar a imagem original para dentro da nova imagem

        imagecopyresampled($nova,$lerimagem,0,0,0,0,$x+1,$y+1,$img_largura,$img_altura);

        $fr_img = $nome_miniatura;

    // onde será salvo a imagen
        $nome_miniatura = "../fotos_empresa/". $nome_miniatura; 
    // salve o arquivo

        imagejpeg($nova, $nome_miniatura);
        

    // Pronto, fim. Libera a memória usada

        imagedestroy($lerimagem);
        imagedestroy($nova);

    } else {

    // dar um nome padrão para a miniatura
        $result = $db->query("SELECT * FROM empresa WHERE ID = '$id_edit'") or die ($db->error);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $last_id = $row['E_IMG'];
        $imagem = "../fotos_empresa/". $last_id;
    // vamos ler a imagem
        $lerimagem = imagecreatefromjpeg($imagem);

    // pegar a largura da imagem
        $img_largura = imagesx($lerimagem);

    // pegar a altura da imagem
        $img_altura = imagesy($lerimagem);

    // declara os tamanhos
        if (isset($_POST["fr_tal"])) {
            $x = 98;
            $y = 28;
        } else {
            $x = 98;
            $y = 98;
        }

        $nome_miniatura = $last_id;

    // Agora sim a gente pode criar a imagem
    // definir o tamanho da nova imagem

        $nova = imagecreatetruecolor($x,$y);

    // agora é só copiar a imagem original para dentro da nova imagem

        imagecopyresampled($nova,$lerimagem,0,0,0,0,$x+1,$y+1,$img_largura,$img_altura);

        $fr_img = $nome_miniatura;

    // onde será salvo a imagen
        $nome_miniatura = "../fotos_empresa/". $nome_miniatura; 
    // salve o arquivo

        imagejpeg($nova, $nome_miniatura);
        

    // Pronto, fim. Libera a memória usada

        imagedestroy($lerimagem);
        imagedestroy($nova);
    }
    //Faz contagem das Categorias selecionadas
    $fr_ctg = "";
    for ($i=0; $i < 38; $i++) {
        if (isset($_POST[$i])) {    
            $fr_ctg .= $i .",";
        }
    }
    
    //insere os dados do form no BD
    if ($fr_img == '') {
        $db->query("UPDATE empresa SET E_EMPRESA = '$fr_nome', E_COMENTARIO = '$fr_coment', E_RUA = '$fr_end', E_NUMERO = '$fr_num', E_UF = '$fr_uf', E_TEL = '$fr_tel', E_MAIL = '$fr_mail', E_SITE = '$fr_site', E_CIDADE = '$fr_cidade', E_CATEGORIA = '$fr_ctg', E_ID = '$fr_id', E_CNPJ = '$fr_cpf', E_CEP = '$fr_cep', E_BAIRRO = '$fr_bairro' WHERE ID = '$id_edit'") or die($db->error);
    } else {
        $db->query("UPDATE empresa SET E_EMPRESA = '$fr_nome', E_COMENTARIO = '$fr_coment', E_RUA = '$fr_end', E_NUMERO = '$fr_num', E_UF = '$fr_uf', E_TEL = '$fr_tel', E_MAIL = '$fr_mail', E_SITE = '$fr_site', E_CIDADE = '$fr_cidade', E_CATEGORIA = '$fr_ctg', E_ID = '$fr_id', E_CNPJ = '$fr_cpf', E_CEP = '$fr_cep', E_BAIRRO = '$fr_bairro', E_IMG = '$fr_img' WHERE ID = '$id_edit'") or die($db->error);   
    }

    echo "<script>window.location='pemp.php?p=pemplista&pag=1'</script>"; // Redireciona para pagina.php
}
} else {
    // pega ID que sera editado
    $id_edit = $_GET['code'];
    $result = $db->query("SELECT * FROM empresa WHERE E_ID = '$fr_id'") or die ($db->error);
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $id_edit_bd = md5($row['ID']);
        if ($id_edit == $id_edit_bd) {
            $id_edit = $row['ID'];
        }
    }
    // busca no banco de dados 
    $result = $db->query("SELECT * FROM empresa WHERE ID = '$id_edit'") or die ($db->error);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $last_id = $row['E_ID'];
    // confere usuario esta ligado ao editor
    if ($fr_id != $last_id) {
        echo "<script type=\"text/javascript\">window.location = ../error.html</script>";

    }
    $p_folder = "../fotos_empresa/". $row['E_IMG'];
    $p_img = imagecreatefromjpeg($p_folder);
}

?>

<form id="formElem" name="formElem" action="" onsubmit="validateForms()" method="post" enctype="multipart/form-data">
    <div id="fr_error">
        <?php
        if (isset($_POST['cadastrar'])) {
            echo "$errorString";
        }
        ?>
    </div>
    <legend>1. Logo</legend>
    <div style="width: 30%; float: left; border-right: 1px solid #d6d6d6;">
        <label for="photo"></label>
        <img id="photo" src=<? if (empty($p_folder)) { echo "../imagens/semfoto.jpg"; } else { echo "$p_folder"; } ?> style="width: 98px; height: <?php echo imagesy($p_img); ?>;">
        <div id="file1c">
            <input id="photoin" name="photoin" type="file" accept="image/jpeg" onchange="readURL(this);"/>
        </div>
        <img src="../imagens/botao.jpg" id="upfile1" style="cursor:pointer" />
    </div>
    <div class="row" style="width: 64%; float: left">
        <label class="label" for="ex04">Resolução do logo</label>
        <input type="checkbox" name="fr_tal" <?php if (imagesy($p_img) == 28 ) { echo "checked=yes"; } ?> id="ex04" class="{labelOn: 'Opção 2', labelOff: 'Opção 1'}" />
        <p>
            A imagem do logo tipo terá 2 opções:<br> opção 1 com tamanho de 98x98 pixel;<br> opção 2 com tamanho de 98x28 pixel;<br> Para que o PadrinhoOnline.com.br possa divulgar sua marca com qualidade.
        </p>
    </div>
    <legend>2. Categorias</legend>
    <div style="width: 50%; float: left">
        <?php 
        $c_array = array('Acessorios', 
           'Acessoria de Eventos', 
           'Adereços para festas',
           'Alianças',
           'Alta Costura',
           'Aluguel de Trajes',
           'Bandas',
           'Banqueteiros',
           'Bar e Barman',
           'Bebidas',
           'Bem-Casados',
           'Bolos e Doces',
           'Buffet',
           'Convites e R.S.V.P',
           'Carros Novos e Antigos',
           'Chá Bar e Cozinha',
           'Celebração de Casamento',
           'Coral e Orquestra',
           'Decoração',
           'Design de Interiores',
           'Dia da Noiva',
           'DJ',
           'Enxoval',
           'Espaços para Eventos',
           'Filmagem e Video',
           'Floricultura',
           'Foto e Video',
           'Fotojornalismo',
           'Lembrancinhas',
           'Lista de Presentes',
           'Lua-de-Mel',
           'Musica para Casamento',
           'Revistas e Guias',
           'Som, Luz e Imagem',
           'Valet Park - Seguranças',
           'Sites de Casamento',
           'Topo de Bolo',
           'Sítios para Casamento',
           );

$b_array = explode(',', $row['E_CATEGORIA']);
foreach ($c_array as $key => $value) {
    if ($key > 18) continue;
    if (in_array($key, $b_array)) {
      echo  "<li>
      <input id=\"$key\" checked=\"yes\" name=\"$key\" type=\"checkbox\" value=\"$key\" />
      <label for=\"$key\">$value</label>
      </li>";  
  } else {
    echo  "<li>
    <input id=\"$key\" name=\"$key\" type=\"checkbox\" value=\"$key\" /x>
    <label for=\"$key\">$value</label>
    </li>";
}
}    
?>
</div>
<div style="width: 50%; float: left">
    <?php 
    $b_array = explode(',', $row['E_CATEGORIA']);
    foreach ($c_array as $key => $value) {
        if ($key < 19) continue;
        if (in_array($key, $b_array)) {
          echo  "<li>
          <input id=\"$key\" checked=\"yes\" name=\"$key\" type=\"checkbox\" value=\"$key\"/>
          <label for=\"$key\">$value</label>
          </li>";  
      } else {
        echo  "<li>
        <input id=\"$key\" name=\"$key\" type=\"checkbox\" value=\"$key\"/>
        <label for=\"$key\">$value</label>
        </li>";
    }
}    
?>
</div>
<legend>3. Perfil</legend>
<div id="photodiv" style="width: 50%; float: left">
    <p class="perfildireita">
        <label for="fr_nome">Nome:</label>
        <input id="fr_nome" name="fr_nome"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_nome"; } else { echo $row['E_EMPRESA']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_email">E-mail:</label>
        <input id="fr_email" name="fr_email"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_mail"; } else { echo $row['E_MAIL']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_site">Site:</label>
        <input id="fr_site" name="fr_site"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_site"; } else { echo $row['E_SITE']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_tel">Telefone:</label>
        <input id="fr_tel" name="fr_tel" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_tel"; } else { echo $row['E_TEL']; } ?>'  type="text"/>
    </p>
    <p class="perfildireita">
        <label for="fr_cpf">CPF/CNPJ:</label>
        <input id="fr_cpf" name="fr_cpf"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cpf"; } else { echo $row['E_CNPJ']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_end">Endereço:</label>
        <input id="fr_end" name="fr_end"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_end"; } else { echo $row['E_RUA']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_num">Numero:</label>
        <input id="fr_num" name="fr_num" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_num"; } else { echo $row['E_NUMERO']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_comp">Complemento:</label>
        <input id="fr_comp" name="fr_coment" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_coment"; } else { echo $row['E_COMENTARIO']; }?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_bairro">Bairro:</label>
        <input id="fr_bairro" name="fr_bairro" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_bairro"; } else { echo $row['E_BAIRRO']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="fr_cidade">Cidade:</label>
        <input id="fr_cidade" name="fr_cidade" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cidade"; } else { echo $row['E_CIDADE']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <label for="website">Estado</label>
        <select id="estado" name="fr_uf" style="min-width:213px" AUTOCOMPLETE=OFF >
            <?php 
            $slEstados = array("0"=>"Selecione", "1"=>"Acre", "2"=>"Alagoas", "3"=>"Amazonas", "4"=>"Amapá","5"=>"Bahia","6"=>"Ceará","7"=>"Distrito Federal","8"=>"Espírito Santo","9"=>"Goiás","10"=>"Maranhão","11"=>"Mato Grosso","12"=>"Mato Grosso do Sul","13"=>"Minas Gerais","14"=>"Pará","15"=>"Paraíba","16"=>"Paraná","17"=>"Pernambuco","18"=>"Piauí","19"=>"Rio de Janeiro","20"=>"Rio Grande do Norte","21"=>"Rondônia","22"=>"Rio Grande do Sul","23"=>"Roraima","24"=>"Santa Catarina","25"=>"Sergipe","26"=>"São Paulo","27"=>"Tocantins");
            for($i=0; $i < count($slEstados); $i++) {
                if ($i == $row['E_UF']) {
                    echo "<option selected value=$i>$slEstados[$i]</option>";
                } else {
                    echo "<option value=$i>$slEstados[$i]</option>";        
                }
            }
            ?>
        </select>
    </p>
    <p class="perfildireita">
        <label for="fr_cep">Cep:</label>
        <input id="fr_cep" name="fr_cep" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cep"; } else { echo $row['E_CEP']; } ?>' AUTOCOMPLETE=OFF />
    </p>
    <p class="perfildireita">
        <button id="registerButton" name="cadastrar" type="submit" value="">Registrar</button>
    </p>
</div>

</form>   


<script type="text/javascript">
jQuery(function($){
 $("#fr_tel").mask("(99) 9999-9999");
 $("#fr_cep").mask("99999-999");
});
</script>