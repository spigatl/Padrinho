<?php 
if (!isset($fr_id)) {
    header("location: ../error.php");
}
if (isset($_POST['cadastrar'])) { 
// Campos que constam no formulario
    $allowedFields = array(
        'fr_noivo',
        'fr_noiva',
        'fr_data',
        'fr_tel',
        'fr_nome',
        'fr_cpf',
        'fr_end',
        'fr_num',
        'fr_comp',
        'fr_bairro',
        'fr_cidade',
        'fr_cep',
        );
    $errors = array();
    foreach($_POST AS $key => $value)
    {
        // checando se o campo e autorizado
        if(in_array($key, $allowedFields))
        {   
            $pattern = "/^[A-Z0-9a-zá-ú\x{23}\x{2D}\x{2E}\x{40}\x{28}\x{29}\x{5F}\x{23}\x{25}\x{20}\x{2F}]+$/";
            if (!preg_match($pattern, $value)) {
                $errors[1] = "<h12> Essses caracteres não sao validos: &#33; &#34; &#35; &#37; &#39; &#42; &#43; &#44; &#47;</h12><br>";
                red($key);
            }
        }
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
        //insere os dados do form no BD
        $insert = "UPDATE users SET U_NOME_NOIVO='$_POST[fr_noivo]', U_NOME_NOIVA='$_POST[fr_noiva]', U_TEL='$_POST[fr_tel]', U_NOME='$_POST[fr_nome]', U_CPF='$_POST[fr_cpf]', U_ENDERECO='$_POST[fr_end]', U_NUMERO='$_POST[fr_num]', U_COMPLEMENTO='$_POST[fr_comp]', U_BAIRRO='$_POST[fr_bairro]', U_CIDADE='$_POST[fr_cidade]', U_ESTADO='$_POST[fr_estado]', U_CEP='$_POST[fr_cep]', U_DATA='$_POST[fr_data]' WHERE U_ID='$fr_id'";
        mySQL_query($insert) or die("Falha no Update<br>". mysql_error());
        mySQL_close($link);
        echo "<script>window.location='perfil.php?p=result&action=addados'</script>"; // Redireciona para peresult.php
    }
} else {

    $query = "SELECT * FROM users WHERE U_ID = $fr_id";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result)) {
      $fr_noivo = $row['U_NOME_NOIVO'];
      $fr_noiva = $row['U_NOME_NOIVA'];
      $fr_nome = $row['U_NOME'];
      $fr_cpf = $row['U_CPF'];
      $fr_end = $row['U_ENDERECO'];
      $fr_comp = $row['U_COMPLEMENTO'];
      $fr_num = $row['U_NUMERO'];
      $fr_cidade = $row['U_CIDADE'];
      $fr_estado = $row['U_ESTADO'];
      $fr_cep = $row['U_CEP'];
      $fr_data = $row['U_DATA'];
      $fr_bairro = $row['U_BAIRRO'];
      $fr_tel = $row['U_TEL'];
      $fr_estado = $row['U_ESTADO'];
  }
}
?>
<div id="content">
    <div id="steps">
       <form id="formElem" name="formElem" action=""  method="post" enctype="multipart/form-data">
        <fieldset class="step">
            <div id="fr_error">
                <?php
                if (isset($_POST['cadastrar'])) {
                    echo "$errorString";
                }
                ?>
            </div>
            <label class="legform">Detalhes do Casal</label>
            <p class="perfildireita">
                <label for="fr_noivo">Nome da Noivo:</label>
                <input id="fr_noivo" name="fr_noivo" type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_noivo"; } else { echo $_POST['fr_noivo']; } ?>' AUTOCOMPLETE=OFF />
            </p>
            <p class="perfildireita">
                <label for="fr_noiva">Nome do Noiva:</label>
                <input id="fr_noiva" name="fr_noiva" type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_noiva"; } else { echo $_POST['fr_noiva']; } ?>' AUTOCOMPLETE=OFF />
            </p>
            <p class="perfildireita">
                <label for="fr_data">Data de Casamento:</label>
                <input id="fr_data" name="fr_data" type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_data"; } else { echo $_POST['fr_data']; } ?>' AUTOCOMPLETE=OFF />
            </p>
            <p class="perfildireita">
                <label for="fr_tel">Tel. para Contato:</label>
                <input id="fr_tel" name="fr_tel" type="tel" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_tel"; } else { echo $_POST['fr_tel']; } ?>' AUTOCOMPLETE=OFF />
            </p>

            <fieldset class="step">
                <label class="legform">Perfil</label>
                <p class="perfildireita">
                    <label for="fr_nome">Nome:</label>
                    <input id="fr_nome" name="fr_nome"  type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_nome"; } else { echo $_POST['fr_nome']; } ?>' AUTOCOMPLETE=OFF />
                </p>
                <p class="perfildireita">
                    <label for="fr_cpf">CPF:</label>
                    <input id="fr_cpf" name="fr_cpf"  type="text" readonly="readonly" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_cpf"; } else { echo $_POST['fr_cpf']; } ?>'/>
                </p>
                <p class="perfildireita">
                    <label for="fr_end">Endereço:</label>
                    <input id="fr_end" name="fr_end"  type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_end"; } else { echo $_POST['fr_end']; } ?>' AUTOCOMPLETE=OFF />
                </p>
                <p class="perfildireita">
                    <label for="fr_num">Numero:</label>
                    <input id="fr_num" name="fr_num"  type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_num"; } else { echo $_POST['fr_num']; } ?>' AUTOCOMPLETE=OFF />
                </p>
                <p class="perfildireita">
                    <label for="fr_comp">Complemento:</label>
                    <input id="fr_comp" name="fr_comp" type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_comp"; } else { echo $_POST['fr_comp']; } ?>' AUTOCOMPLETE=OFF />
                </p>
                <p class="perfildireita">
                    <label for="fr_bairro">Bairro:</label>
                    <input id="fr_bairro" name="fr_bairro" type="text" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_bairro"; } else { echo $_POST['fr_bairro']; } ?>' AUTOCOMPLETE=OFF />
                </p>
                <p class="perfildireita">
                    <label for="fr_cidade">Cidade:</label>
                    <input id="fr_cidade" name="fr_cidade" type="texto" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_cidade"; } else { echo $_POST['fr_cidade']; } ?>' AUTOCOMPLETE=OFF />
                </p>
                <p class="perfildireita">
                    <label for="website">Estado</label>
                    <?php 
                    if (isset($_POST['cadastrar'])) { 
                        $fr_estado = $_POST['fr_estado']; 
                    }  
                    ?>
                    <select id="estado" name="fr_estado" style="min-width:213px" AUTOCOMPLETE=OFF >
                        <option <?php if($fr_estado == '0') { echo "selected"; } ?> value="0">Acre</option>
                        <option <?php if($fr_estado == '1') { echo "selected"; } ?> value="1">Alagoas</option>
                        <option <?php if($fr_estado == '2') { echo "selected"; } ?> value="2">Amapá</option>
                        <option <?php if($fr_estado == '3') { echo "selected"; } ?> value="3">Amazonas</option>
                        <option <?php if($fr_estado == '4') { echo "selected"; } ?> value="4">Bahia</option>
                        <option <?php if($fr_estado == '5') { echo "selected"; } ?> value="5">Ceará</option>
                        <option <?php if($fr_estado == '6') { echo "selected"; } ?> value="6">Distrito Federal</option>
                        <option <?php if($fr_estado == '7') { echo "selected"; } ?> value="7">Espírito Santo</option>
                        <option <?php if($fr_estado == '8') { echo "selected"; } ?> value="8">Goiás</option>
                        <option <?php if($fr_estado == '9') { echo "selected"; } ?> value="9">Maranhão</option>
                        <option <?php if($fr_estado == '10') { echo "selected"; } ?> value="10">Mato Grosso</option>
                        <option <?php if($fr_estado == '11') { echo "selected"; } ?> value="11">Mato Grosso do Sul</option>
                        <option <?php if($fr_estado == '12') { echo "selected"; } ?> value="12">Minas Gerais</option>
                        <option <?php if($fr_estado == '13') { echo "selected"; } ?> value="13">Pará</option>
                        <option <?php if($fr_estado == '14') { echo "selected"; } ?> value="14">Paraíba</option>
                        <option <?php if($fr_estado == '15') { echo "selected"; } ?> value="15">Paraná</option>
                        <option <?php if($fr_estado == '16') { echo "selected"; } ?> value="16">Pernambuco</option>
                        <option <?php if($fr_estado == '17') { echo "selected"; } ?> value="17">Piauí</option>
                        <option <?php if($fr_estado == '18') { echo "selected"; } ?> value="18">Roraima</option>
                        <option <?php if($fr_estado == '19') { echo "selected"; } ?> value="19">Rondônia</option>
                        <option <?php if($fr_estado == '20') { echo "selected"; } ?> value="20">Rio de Janeiro</option>
                        <option <?php if($fr_estado == '21') { echo "selected"; } ?> value="21">Rio Grande do Norte</option>
                        <option <?php if($fr_estado == '22') { echo "selected"; } ?> value="22">Rio Grande do Sul</option>
                        <option <?php if($fr_estado == '23') { echo "selected"; } ?> value="23">Santa Catarina</option>
                        <option <?php if($fr_estado == '24') { echo "selected"; } ?> value="24">São Paulo</option>
                        <option <?php if($fr_estado == '25') { echo "selected"; } ?> value="25">Sergipe</option>
                        <option <?php if($fr_estado == '26') { echo "selected"; } ?> value="26">Tocantins</option>
                    </select>
                </p>
                <p class="perfildireita">
                    <label for="fr_cep">Cep:</label>
                    <input id="fr_cep" name="fr_cep" type="texto" value='<?php if (!isset($_POST['cadastrar'])) { echo "$fr_cep"; } else { echo $_POST['fr_cep']; } ?>' AUTOCOMPLETE=OFF />
                </p>
            </fieldset>
            <button id="salvebt" name="cadastrar" type="submit" value="">Salvar</button>
        </fieldset>
    </form>   
</div>

<script type="text/javascript">
jQuery(function($){
 $("#fr_data").mask("99/99/9999");
 $("#fr_tel").mask("(99) 9999-9999");
 $("#fr_cpf").mask("999.999.999-99");
 $("#fr_cep").mask("99999-999");
});
</script>
</div>