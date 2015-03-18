<?php

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
    $fr_id = $_SESSION['id_emp'];       //ID do usuario que esta cadastrando nova empresa.
    // inclue o banco de dados
    include ('db.php');

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
        'photoin',
    );
     
    // Campo que seram checados
    $requiredFields = array(
        'fr_nome',
        'fr_cpf',
    );
    // Loop para pegar os campos que vem do form.
    $errors = array();
    foreach($_POST AS $key => $value)
    {
        // checando se o campo e autorizado
        if(in_array($key, $allowedFields))
        {   
            $field = $key;
            $key = $value;
     
            // Verifica os campos listados na variavel $queriedfields
            if(in_array($field, $requiredFields) && $field == 'fr_nome')
            {
                $query = "SELECT E_MAIL FROM EMPRESA WHERE E_EMPRESA = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                    while($row = mySQL_fetch_array($result)) {
                        $errors[] = "<p class=p_erro><h12>Email <b> $row[E_EMAIL] </b> ja em uso.</h12></p><br>";
                        $fremail = true;    
                    }
                } 
                
            }
            if(in_array($field, $requiredFields) && $field == 'fr_cpf')
            {
                $query = "SELECT E_CNPJ FROM EMPRESA WHERE E_CNPJ = '$key'";
                $result = mySQL_query($query);
                if ($result) {
                     while ($row = mySQL_fetch_array($result)) {
                        $errors[] = "<p class=p_erro><h13>Apelido <b> $row[E_CNPJ] </b> ja em uso.</h13></p>";
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
    if ($img_altura < $img_largura) {
        $x = 98;
        $y = 28;
    } else {
        $x = 98;
        $y = 98;
    }

    // dar um nome padrão para a miniatura
    $result = $db->query("SELECT * FROM EMPRESA ORDER BY ID DESC LIMIT 1") or die ($db->error);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $last_id = $row['ID'];

    $nome_miniatura = 'foto_'.md5(uniqid($last_id, true)).".jpg";

    // Agora sim a gente pode criar a imagem

    // definir o tamanho da nova imagem

    $nova = imagecreatetruecolor($x,$y);

    // agora é só copiar a imagem original para dentro da nova imagem

    imagecopyresampled($nova,$lerimagem,0,0,0,0,$x+1,$y+1,$img_largura,$img_altura);

    $fr_img = $nome_miniatura;

    // onde será salvo a imagen
    $nome_miniatura = "fotos_empresa/". $nome_miniatura; 
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
    $insert = "INSERT INTO EMPRESA (E_EMPRESA, E_COMENTARIO, E_IMG, E_RUA, E_NUMERO, E_UF, E_TEL, E_MAIL, E_SITE, E_CIDADE, E_CATEGORIA, E_ID, E_CNPJ, E_CEP, E_BAIRRO) VALUES ('$fr_nome', '$fr_coment', '$fr_img', '$fr_end', '$fr_num', '$fr_uf', '$fr_tel', '$fr_mail', '$fr_site', '$fr_cidade', '$fr_ctg', '$fr_id', '$fr_cpf', '$fr_cep', $fr_bairro)"; mySQL_query($insert) or die("Falha no Insert<br>". mysql_error());
    mySQL_close($link);

    echo "<script>window.location='pemp.php?p=pemplista&pag=1'</script>"; // Redireciona para pagina.php

    }   
}
?>

                 <form id="formElem" name="formElem" action="" onsubmit="validateForms()" method="post" enctype="multipart/form-data">
                     <fieldset class="step">
                        <legend>1. Logo</legend>
                            <div id="fr_error">
                                <?php
                                if (isset($_POST['cadastrar'])) {
                                    echo "$errorString";
                                }
                                ?>
                            </div>
                            <div style="width: 20%; float: left; border-right: 1px solid #d6d6d6;">
                                <label for="photo"></label>
                                <img id="photo" src="imagens/semfoto.jpg" style="width: 98px; height:98px;">
                                <div id="file1c">
                                    <input id="photoin" name="photoin" type="file" accept="image/jpeg" onchange="readURL(this);"/>
                                </div>
                                    <img src="imagens/botao.jpg" id="upfile1" style="cursor:pointer" />
                            </div>
                            <div class="row" style="width: 50%; float: left">
                                <label class="label" for="ex04">Resolução do logo</label>
                                <input type="checkbox" id="ex04" class="{labelOn: 'Opção 2', labelOff: 'Opção 1'}" />
                                <p>
                                    A imagem do logo tipo terá 2 opções:<br> opção 1 com tamanho de 98x98 pixel;<br> opção 2 com tamanho de 98x28 pixel;<br> Para que o PadrinhoOnline.com.br possa divulgar sua marca com qualidade.
                                </p>
                            </div>
                    </fieldset>
                    <fieldset class="step">
                            <legend>2. Categorias</legend>
                            <div style="width: 35%; float: left">
                            <li>
                                <input id="acessorio" name="1" type="checkbox" value="1"/>
                            	<label for="acessorio">Acessorios</label>
                            </li>
                            <li>
                            	<input id="acessoria" name="2" type="checkbox" value="2"/>
                            	<label for="acessoria">Acessoria de Eventos</label>
                            </li>
                            <li>
                            	<input id="aderecos" name="3" type="checkbox" value="3"/>
                            	<label for="aderecos">Adereços para festas</label>
                            </li>
                            <li>
                            	<input id="aliancas" name="4" type="checkbox" value="4"/>
                            	<label for="aliancas">Alianças</label>
                            </li>
                            <li>
                            	<input id="altacostura" name="5" type="checkbox" value="5"/>
                            	<label for="altacostura">Alta Costura</label>
                            </li>
                            <li>
                            	<input id="aluguem" name="6" type="checkbox" value="6"/>
                            	<label for="aluguem">Aluguel de trajes</label>
                            </li>
                            <li>
                            	<input id="bandas" name="7" type="checkbox" value="7"/>
                            	<label for="bandas">Bandas</label>
                            </li>
                            <li>
                            	<input id="banqueteiros" name="8" type="checkbox" value="8"/>
                            	<label for="banqueteiros">Banqueteiros</label>
                            </li>
                            <li>
                            	<input id="barbarman" name="9" type="checkbox" value="9"/>
                            	<label for="barbarman">Bar e Barman</label>
                            </li>
                            <li>
                            	<input id="bebidas" name="10" type="checkbox" value="10"/>
                            	<label for="bebidas">Bebidas</label>
                            </li>
                            <li>
                            	<input id="bemcasados" name="11" type="checkbox" value="11"/>
                            	<label for="bemcasados">Bem-Casados</label>
                            </li>
                            <li>
                            	<input id="bolosdoces" name="12" type="checkbox" value="12"/>
                            	<label for="bolosdoces">Bolos e Doces</label>
                            </li>
                            <li>
                            	<input id="buffet" name="13" type="checkbox" value="13"/>
                            	<label for="buffet">Buffet</label>
                            </li>
                            <li>
                                <input id="convites" name="14" type="checkbox" value="14"/>
                                <label for="convites">Convites e R.S.V.P</label>
                            </li>
                            <li>
                                <input id="carros" name="15" type="checkbox" value="15"/>
                                <label for="carros">Carros novos e antigos</label>
                            </li>
                            <li>
                                <input id="chabar" name="16" type="checkbox" value="16"/>
                                <label for="chabar">Chá Bar e Cozinha</label>
                            </li>
                            <li>
                                <input id="celebracao" name="17" type="checkbox" value="17"/>
                                <label for="celebracao">Celebração de Casamento</label>
                            </li>
                            <li>
                                <input id="coral" name="18" type="checkbox" value="18"/>
                                <label for="coral">Coral e orquestra</label>
                            </li>
                            <li>
                                <input id="decoracao" name="19" type="checkbox" value="19"/>
                                <label for="decoracao">Decoração</label>
                            </li>
                        </div>
                        <div style="width: 35%; float: left">
                            <li>
                            	<input id="design" name="20" type="checkbox" value="20"/>
                            	<label for="design">Design de Interiores</label>
                            </li>
                            <li>
                            	<input id="dianoiva" name="21" type="checkbox" value="21"/>
                            	<label for="dianoiva">Dia da Noiva</label>
                            </li>
                            <li>
                            	<input id="DJ" name="22" type="checkbox" value="22"/>
                            	<label for="DJ">DJ</label>
                            </li>
                            <li>
                            	<input id="enxoval" name="23" type="checkbox" value="23"/>
                            	<label for="enxoval">Enxoval</label>
                            </li>
                            <li>
                            	<input id="espacoseventos" name="24" type="checkbox" value="24"/>
                            	<label for="espacoseventos">Espaços para Eventos</label>
                            </li>
                            <li>
                            	<input id="filmagem" name="25" type="checkbox" value="25"/>
                            	<label for="filmagem">Filmagem e Video</label>
                            </li>
                            <li>
                            	<input id="floricultura" name="26" type="checkbox" value="26"/>
                            	<label for="floricultura">Floricultura</label>
                            </li>
                            <li>
                                <input id="foto" name="27" type="checkbox" value="27"/>
                            	<label for="foto">Foto e Video</label>
                            </li>
                            <li>
                            	<input id="fotojornalismo" name="28" type="checkbox" value="28"/>
                            	<label for="fotojornalismo">Fotojornalismo</label>
                            </li>
                            <li>
                            	<input id="lembrancinhas" name="29" type="checkbox" value="29"/>
                            	<label for="lembrancinhas">Lembrancinhas</label>
                            </li>
                            <li>
                            	<input id="presentes" name="30" type="checkbox" value="30"/>
                            	<label for="presentes">Lista de Presentes</label>
                            </li>
                            <li>
                            	<input id="luademel" name="31" type="checkbox" value="31"/>
                            	<label for="luademel">Lua-de-Mel</label>
                            </li>
                            <li>
                            	<input id="musica" name="32" type="checkbox" value="32"/>
                            	<label for="musica">Musica para Casamento</label>
                            </li>
                            <li>
                            	<input id="revistas" name="33" type="checkbox" value="33"/>
                            	<label for="revistas">Revistas e Guias</label>
                            </li>
                            <li>
                            	<input id="somluz" name="34" type="checkbox" value="34"/>
                            	<label for="somluz">Som, Luz e Imagem</label>
                            </li>
                            <li>
                            	<input id="segurancas" name="35" type="checkbox" value="35"/>
                            	<label for="segurancas">Valet Park - Seguranças</label>
                            </li>
                            <li>
                            	<input id="sitesdecasamento" name="36" type="checkbox" value="36"/>
                            	<label for="sitesdecasamento">Sites de Casamento</label>
                            </li>
                            <li>
                            	<input id="topodebolo" name="37" type="checkbox" value="37"/>
                            	<label for="topodebolo">Topo de Bolo</label>
                            </li>
                            <li>
                            	<input id="sitios" name="38" type="checkbox" value="38"/>
                            	<label for="sitios">Sítios para Casamento</label>
                            </li>
                        </div>
                    <fieldset class="step">
                        <legend>3. Perfil</legend>
                        <div id="photodiv" style="width: 45%; float: left">
                            <p class="perfildireita">
                                <label for="fr_nome">Nome:</label>
                                <input id="fr_nome" name="fr_nome"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_nome"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_email">E-mail:</label>
                                <input id="fr_email" name="fr_email"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_mail"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_site">Site:</label>
                                <input id="fr_site" name="fr_site"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_site"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_tel">Telefone:</label>
                                <input id="fr_tel" name="fr_tel"  type="text"/>
                            </p>
                            <p class="perfildireita">
                                <label for="fr_cpf">CPF/CNPJ:</label>
                                <input id="fr_cpf" name="fr_cpf"  type="text"  AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_end">Endereço:</label>
                                <input id="fr_end" name="fr_end"  type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_end"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_num">Numero:</label>
                                <input id="fr_num" name="fr_num" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_num"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_comp">Complemento:</label>
                                <input id="fr_comp" name="fr_coment" type="text" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_coment"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_bairro">Bairro:</label>
                                <input id="fr_bairro" name="fr_bairro" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_bairro"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="fr_cidade">Cidade:</label>
                                <input id="fr_cidade" name="fr_cidade" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cidade"; } ?>' AUTOCOMPLETE=OFF />
                            </p>
                            <p class="perfildireita">
                                <label for="website">Estado</label>
                                    <select id="estado" name="fr_uf" style="min-width:213px" AUTOCOMPLETE=OFF >
                                        <option selected value="0" >Selecione</option>
                                        <option value="1">Acre</option>
                                        <option value="2">Alagoas</option>
                                        <option value="3">Amapá</option>
                                        <option value="4">Amazonas</option>
                                        <option value="5">Bahia</option>
                                        <option value="6">Ceará</option>
                                        <option value="7">Distrito Federal</option>
                                        <option value="8">Espírito Santo</option>
                                        <option value="9">Goiás</option>
                                        <option value="10">Maranhão</option>
                                        <option value="11">Mato Grosso</option>
                                        <option value="12">Mato Grosso do Sul</option>
                                        <option value="13">Minas Gerais</option>
                                        <option value="14">Pará</option>
                                        <option value="15">Paraíba</option>
                                        <option value="16">Paraná</option>
                                        <option value="17">Pernambuco</option>
                                        <option value="18">Piauí</option>
                                        <option value="19">Roraima</option>
                                        <option value="20">Rondônia</option>
                                        <option value="21">Rio de Janeiro</option>
                                        <option value="22">Rio Grande do Norte</option>
                                        <option value="23">Rio Grande do Sul</option>
                                        <option value="24">Santa Catarina</option>
                                        <option value="25">São Paulo</option>
                                        <option value="26">Sergipe</option>
                                        <option value="27">Tocantins</option>
                                    </select>
                                </p>
                                <p class="perfildireita">
                                    <label for="fr_cep">Cep:</label>
                                    <input id="fr_cep" name="fr_cep" type="texto" value='<?php if (isset($_POST['cadastrar'])) { echo "$fr_cep"; } ?>' AUTOCOMPLETE=OFF />
                                </p>
                            </div>
                        </fieldset>
                                    <button id="registerButton" name="cadastrar" type="submit" value="">Registrar</button>
                        </fieldset>
                 </form>   
                

            <script type="text/javascript">
               jQuery(function($){
                   $("#fr_tel").mask("(99) 9999-9999");
                   $("#fr_cep").mask("99999-999");
                });
            </script>
