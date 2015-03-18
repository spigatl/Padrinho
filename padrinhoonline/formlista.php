<?php
    if (isset($_POST['cadastrar'])) {
    $vazio = array('$fr_noivo', '$fr_noiva', '$fr_email', '$senha', '$fr_cosenha', '$fr_tel', '$fr_nome', '$fr_nick', '$fr_cpf', '$fr_end', '$fr_num', '$fr_bairro', '$fr_cidade', '$fr_cep');

    // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
    $fr_noivo = $_POST ["fr_noivo"];    //atribuição do campo "nome do noivo" vindo do formulário para variavel 
    $fr_noiva = $_POST ["fr_noiva"];    //atribuição do campo "nome do noiva" vindo do formulário para variavel 
    $fr_email = $_POST ["fr_email"];    //atribuição do campo "nome do email" vindo do formulário para variavel 
    $fr_senha = $_POST ["fr_senha"];    //atribuição do campo "senha" vindo do formulário para variavel 
    $fr_cosenha = $_POST ["fr_cosenha"];    //atribuição do campo "cosenha" vindo do formulário para variavel   
    $fr_tel = $_POST ["fr_tel"];    //atribuição do campo "telefone" vindo do formulário para variavel   
    $fr_nome = $_POST ["fr_nome"];  //atribuição do campo "nome do nome" vindo do formulário para variavel  
    $fr_nick = $_POST ["fr_nick"];  //atribuição do campo "nome do nick" vindo do formulário para variavel  
    $fr_cpf = $_POST ["fr_cpf"];    //atribuição do campo "cpf" vindo do formulário para variavel   
    $fr_end = $_POST ["fr_end"];    //atribuição do campo "endereço" vindo do formulário para variavel   
    $fr_num = $_POST ["fr_num"];    //atribuição do campo "numero" vindo do formulário para variavel   
    $fr_comp = $_POST ["fr_comp"];  //atribuição do campo "comp" vindo do formulário para variavel  
    $fr_bairro = $_POST ["fr_bairro"];  //atribuição do campo "nome do bairro" vindo do formulário para variavel    
    $fr_cidade = $_POST ["fr_cidade"];  //atribuição do campo "nome da cidade" vindo do formulário para variavel    
    $fr_cep = $_POST ["fr_cep"];  //atribuição do campo "cep" vindo do formulário para variavel    
    $fr_estado = $_POST['fr_estado']; // atribuição do campo "estado" vindo do formulário para variavel
    $fr_data = $_POST['fr_data']; //atribuição do campo "data" vindo do formulário para variavel
    // inclue o banco de dados
    include ('db.php');

    // Campos que constam no formulario
    $allowedFields = array(
        'fr_noivo',
        'fr_noiva',
        'fr_email',
        'fr_senha',
        'fr_cosenha',
        'fr_tel',
        'fr_nome',
        'fr_nick',
        'fr_cpf',
        'fr_end',
        'fr_num',
        'fr_comp',
        'fr_bairro',
        'fr_cidade',
        'fr_cep',
        'photoin',
    );
     
    // Campo que seram checados
    $requiredFields = array(
        'fr_email',
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
            if(in_array($field, $requiredFields) && $field == 'fr_email')
            {
                $query = "SELECT U_EMAIL FROM USERS WHERE U_EMAIL = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                    while($row = mySQL_fetch_array($result)) {
                        $errors[] = "<p class=p_erro><h12>Email <b> $row[U_EMAIL] </b> ja em uso.</h12></p><br>";
                        $fremail = true;    
                    }
                } 
                
            }
            if(in_array($field, $requiredFields) && $field == 'fr_nick')
            {
                $query = "SELECT U_NICK FROM USERS WHERE U_NICK = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                     while ($row = mySQL_fetch_array($result)) {
                        $errors[] = "<p class=p_erro><h13>Apelido <b> $row[U_NICK] </b> ja em uso.</h13></p><br>";
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

    // gera o numero de ID da lista baseado no ultimo numero da lista
    $query = "SELECT * FROM USERS ORDER BY ID DESC LIMIT 1";
        $result = mySQL_query($query) or die("Erro ao gerar ID:<br>". mysql_error());
        if ($result) {
            while ($row = mySQL_fetch_array($result)) {
                $num = $row['ID'] + 1;
                $fr_id = str_pad($num, 7, "0", STR_PAD_LEFT);
            } 
        }

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

    $nome_miniatura = 'foto_'.md5(uniqid(rand(), true)).".jpg";

    // Agora sim a gente pode criar a imagem

    // definir o tamanho da nova imagem

    $nova = imagecreatetruecolor($x,$y);

    // agora é só copiar a imagem original para dentro da nova imagem

    imagecopyresampled($nova,$lerimagem,0,0,0,0,$x+1,$y+1,$img_largura,$img_altura);

    $fr_img = $nome_miniatura;

    // onde será salvo a imagen
    $nome_miniatura = "fotos/". $nome_miniatura; 
    // salve o arquivo

    imagejpeg($nova, $nome_miniatura);
    

    // Pronto, fim. Libera a memória usada

    imagedestroy($lerimagem);
    imagedestroy($nova);

    }
    //insere os dados do form no BD
    $insert = "INSERT INTO USERS (U_NOME_NOIVO, U_NOME_NOIVA, U_EMAIL, U_SENHA, U_TEL, U_NOME, U_NICK, U_CPF, U_ENDERECO, U_NUMERO, U_COMPLEMENTO, U_BAIRRO, U_CIDADE, U_ESTADO, U_CEP, U_ID, U_IMG, U_DATA) VALUES ('$fr_noivo', '$fr_noiva', '$fr_email', '$fr_senha', '$fr_tel', '$fr_nome', '$fr_nick', '$fr_cpf', '$fr_end', '$fr_num', '$fr_comp', '$fr_bairro', '$fr_cidade', '$fr_estado', '$fr_cep', '$fr_id', '$fr_img', '$fr_data')";
    mySQL_query($insert) or die("Falha no Insert<br>". mysql_error());
    $insert = "INSERT INTO AUTH (A_CODIGO, A_DATA, A_EMAIL, A_ID, A_HORA) VALUES ('null', 'null', 'null', '$fr_id', 'null')";
    mySQL_query($insert) or die("Falha no Insert<br>". mysql_error());
    mySQL_close($link);

    echo "<script>window.location='concluido.php?id=$fr_id'</script>"; // Redireciona para pagina.php

    }   
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Padrinho Online</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Fancy Sliding Form with jQuery" />
        <meta name="keywords" content="jquery, form, sliding, usability, css3, validation, javascript"/>
        <link rel="stylesheet" href="css/styform.css" type="text/css" media="screen"/>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script src="js/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
        <script src="js/confere.js" type="text/javascript"></script>
    </head>
    <script type="text/javascript">
    <?php
        echo "$(function(){";
        // coloca o campo email em vermelho
        if ($fremail) {
            echo "var seletor = $('#fr_email');
            seletor.css('background-color', '#FFEDEF');"; 
            }
        // coloca o campo nick em vemelho
        if ($frnick) {
            echo "var seletor = $('#fr_nick');
            seletor.css('background-color', '#FFEDEF');";    
            } 
            echo "});";
    ?>
    </script>
        <style>
            span.reference{
                position:fixed;
                left:5px;
                top:5px;
                font-size:10px;
                text-shadow:1px 1px 1px #fff;
            }
            span.reference a{
                color:#555;
                text-decoration:none;
                text-transform:uppercase;
            }
            span.reference a:hover{
                color:#000;
                
            }
    </style>
    <body>
        <div id="content">
            <div id="wrapper">
                <div id="steps">
                 <form id="formElem" name="formElem" action="criarlista.php" onsubmit="validateForms()" method="post" enctype="multipart/form-data">
                    <fieldset class="step">
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
                                    <label id="checktxt"> Aceito os termos de Uso.</label>            
                    </fieldset>
                    <fieldset class="step">
                            <legend>2. Detalhes do Casal</legend>
                            <div id="photodiv" style="width: 43%; float: left">
                                <label id="phototxt">Foto do Casal</label>
                                <img id="photo" src="imagens/semfoto.jpg">
                                <div id="file1c">
                                    <input id="photoin" name="photoin" type="file" accept="image/jpeg" onchange="readURL(this);"/>
                                </div>
                                    <img src="imagens/botao.jpg" id="upfile1" style="cursor:pointer" />
                            </div>
                             <div style="width: 57%; float: left">
                            <p>
                                <label for="fr_noivo">Nome da Noivo:</label>
                                <input id="fr_noivo" name="fr_noivo" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_noivo"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="fr_noiva">Nome do Noiva:</label>
                                <input id="fr_noiva" name="fr_noiva" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_noiva"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="fr_data">Data de Casamento:</label>
                                <input id="fr_data" name="fr_data" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_data"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="fr_email">E-mail:</label>
                                <input id="fr_email" name="fr_email" type="tel" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_email"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="fr_senha">Senha:</label>
                                <input id="fr_senha" name="fr_senha" type="password" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="fr_cosenha">Repetir Senha:</label>
                                <input id="fr_cosenha" name="fr_cosenha"  type="password" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="fr_tel">Tel. para Contato:</label>
                                <input id="fr_tel" name="fr_tel" type="tel" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_tel"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                        </div>
                    <fieldset class="step">
                        <legend>3. Perfil</legend>
                        <div id="photodiv" style="width: 45%; float: left">
                            <p class="perfildireita">
                                <label for="fr_nome">Nome:</label>
                                <input id="fr_nome" name="fr_nome"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_nome"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_nick">Apelido:</label>
                                <input id="fr_nick" name="fr_nick"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_nick"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_cpf">CPF:</label>
                                <input id="fr_cpf" name="fr_cpf"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cpf"; } ?>'/>
                            </p>
                            <p class="perfildireita">
                                <label for="fr_end">Endereço:</label>
                                <input id="fr_end" name="fr_end"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_end"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_num">Numero:</label>
                                <input id="fr_num" name="fr_num"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_num"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                        </div>
                        <div id="photodiv" style="width: 55%; float: left">
                            <p class="perfilesquerda">
                                <label for="fr_comp">Complemento:</label>
                                <input id="fr_comp" name="fr_comp" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_comp"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfilesquerda">
                                <label for="fr_bairro">Bairro:</label>
                                <input id="fr_bairro" name="fr_bairro" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_bairro"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfilesquerda">
                                <label for="fr_cidade">Cidade:</label>
                                <input id="fr_cidade" name="fr_cidade" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cidade"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfilesquerda">
                                <label for="website">Estado</label>
                                    <select id="estado" name="fr_estado" style="min-width:213px" AUTOCOMPLETE=OFF >
                                        <option selected value="all" >Selecione</option>
                                        <option value="0">Acre</option>
                                        <option value="1">Alagoas</option>
                                        <option value="2">Amapá</option>
                                        <option value="3">Amazonas</option>
                                        <option value="4">Bahia</option>
                                        <option value="5">Ceará</option>
                                        <option value="6">Distrito Federal</option>
                                        <option value="7">Espírito Santo</option>
                                        <option value="8">Goiás</option>
                                        <option value="9">Maranhão</option>
                                        <option value="10">Mato Grosso</option>
                                        <option value="11">Mato Grosso do Sul</option>
                                        <option value="12">Minas Gerais</option>
                                        <option value="13">Pará</option>
                                        <option value="14">Paraíba</option>
                                        <option value="15">Paraná</option>
                                        <option value="16">Pernambuco</option>
                                        <option value="17">Piauí</option>
                                        <option value="18">Roraima</option>
                                        <option value="19">Rondônia</option>
                                        <option value="20">Rio de Janeiro</option>
                                        <option value="21">Rio Grande do Norte</option>
                                        <option value="22">Rio Grande do Sul</option>
                                        <option value="23">Santa Catarina</option>
                                        <option value="24">São Paulo</option>
                                        <option value="25">Sergipe</option>
                                        <option value="26">Tocantins</option>
                                    </select>
                                </p>
                                <p class="perfilesquerda">
                                    <label for="fr_cep">Cep:</label>
                                    <input id="fr_cep" name="fr_cep" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cep"; } ?>' AUTOCOMPLETE=OFF />
                                </p>
                            </div>
                        </fieldset>
                                    <button id="registerButton" name="cadastrar" type="submit" value="">Registrar</button>
                        </fieldset>
                 </form>   
                </div>
            </div>

            <script type="text/javascript">
               jQuery(function($){
                   $("#fr_data").mask("99/99/9999");
                   $("#fr_tel").mask("(99) 9999-9999");
                   $("#fr_cpf").mask("999.999.999-99");
                   $("#fr_cep").mask("99999-99");
                });
            </script>
        </div>
    </body>
</html>