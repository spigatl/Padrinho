<?php

$estado = array('Acre', 'Alagoas', 'Amapá', 'Amazonas', 'Bahia', 'Ceará', 'Distrito Federal', 'Espírito Santo', 'Goiás', 'Maranhão', 'Mato Grosso', 'Mato Grosso do Sul', 'Minas Gerais', 'Pará', 'Paraíba', 'Paraná', 'Pernambuco', 'Piauí', 'Roraima', 'Rondônia', 'Rio de Janeiro',  'Rio Grande do Norte', 'Rio Grande do Sul', 'Santa Catarina', 'São Paulo', 'Sergipe', 'Tocantins');
$vazio = array('$fr_noivo', '$fr_noiva', '$fr_email', '$senha', '$fr_cosenha', '$fr_tel', '$fr_nome', '$fr_nick', '$fr_cpf', '$fr_end', '$fr_num', '$fr_bairro', '$fr_cidade', '$fr_cep');

// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
$fr_noivo = $_POST ["fr_noivo"];    //atribuição do campo "nome do noivo" vindo do formulário para variavel 
$fr_noiva = $_POST ["fr_noiva"];    //atribuição do campo "nome do noiva" vindo do formulário para variavel 
$fr_email = $_POST ["fr_email"];    //atribuição do campo "nome do email" vindo do formulário para variavel 
$fr_senha = $_POST ["fr_senha"];    //atribuição do campo "nome do senha" vindo do formulário para variavel 
$fr_cosenha = $_POST ["fr_cosenha"];    //atribuição do campo "nome do cosenha" vindo do formulário para variavel   
$fr_tel = $_POST ["fr_tel"];    //atribuição do campo "nome do tel" vindo do formulário para variavel   
$fr_nome = $_POST ["fr_nome"];  //atribuição do campo "nome do nome" vindo do formulário para variavel  
$fr_nick = $_POST ["fr_nick"];  //atribuição do campo "nome do nick" vindo do formulário para variavel  
$fr_cpf = $_POST ["fr_cpf"];    //atribuição do campo "nome do cpf" vindo do formulário para variavel   
$fr_end = $_POST ["fr_end"];    //atribuição do campo "nome do end" vindo do formulário para variavel   
$fr_num = $_POST ["fr_num"];    //atribuição do campo "nome do num" vindo do formulário para variavel   
$fr_comp = $_POST ["fr_comp"];  //atribuição do campo "nome do comp" vindo do formulário para variavel  
$fr_bairro = $_POST ["fr_bairro"];  //atribuição do campo "nome do bairro" vindo do formulário para variavel    
$fr_cidade = $_POST ["fr_cidade"];  //atribuição do campo "nome do cidade" vindo do formulário para variavel    
$fr_cep = $_POST ["fr_cep"];  //atribuição do campo "nome do cep" vindo do formulário para variavel    
$fr_estado = $estado[$_POST['fr_estado']]; // atribuição do campo "nome do estado" vindo do formulário para variavel

// inclue o banco de dados
$link = mySQL_connect('localhost', 'root', '123456');
if (!$link) {
  die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());
}
$db_selected = mySQL_select_db('padrinhoonline', $link);
if (!$db_selected) {
  die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysql_error());
}

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
$
// Loop para pegar os campos que vem do form.
$errors = array();
foreach($_POST AS $key => $value)
{
    // checando se o campo e autorizado
    if(in_array($key, $allowedFields))
    {   
        $field =  $key;
        $key = $value;
 
        // Verifica os campos estao vazios
        if(in_array($field, $requiredFields) && $field == 'fr_email')
        {
            $query = "SELECT U_EMAIL FROM USERS WHERE U_EMAIL = '$key'";
            $result = mySQL_query($query);
            if ($result) {
                while($row = mySQL_fetch_array($result)) {
                    $errors[] = "Email <b> $row[U_EMAIL] </b> ja em uso.<br>";    
                }
            } 
            
        }
        if(in_array($field, $requiredFields) && $field == 'fr_nick')
        {
            $query = "SELECT U_NICK FROM USERS WHERE U_NICK = '$key'";
            $result = mySQL_query($query);
            if ($result) {
                 while ($row = mySQL_fetch_array($result)) {
                    $errors[] = "Apelido <b> $row[U_NICK] </b> ja em uso.<br>";
                } 
                
            }     
        }
    }
}
 
// Se acontecer algum erro
if(count($errors) > 0)
{
    $errorString = '<p>A um erro no cadastro.</p>';
    $errorString .= '<ul>';
    foreach($errors as $error)
    {
        $errorString .= "<li>$error</li>";
    }
    $errorString .= '</ul>';
 
    // mostra o formulario novamente
    echo "$errorString";
    include 'criarlista.php';
}
else
{

$query = "SELECT ID FROM users ORDER BY ID DESC LIMIT '1'";
    $result = mySQL_query($query);
    if ($result) {
        while ($row = mySQL_fetch_array($result)) {
            $num = $row[ID] + 1;
            $fr_id = str_pad($num2, 7, "0", STR_PAD_LEFT);
    }         
}

$query = "INSERT INTO users (U_NOME_NOIVO, U_NOME_NOIVA, U_EMAIL, U_SENHA, U_TEL, U_NOME, U_NICK, U_CPF, U_ENDERECO, U_COMPLEMENTO, U_CIDADE, U_BAIRRO, U_ESTADO, U_CEP, U_ID, U_IMG)
VALUES ('$fr_noivo', '$fr_noiva, $fr_email', '$fr_senha', '$fr_tel', '$fr_nome', '$fr_nick', '$fr_cpf', '$fr_end', '$fr_cidade', '$fr_bairro', '$fr_estado', '$fr_cep', '$fr_id', '$photoin')";
$mySQL_query($query);
mysql_close($link);

header("location: concluido.php");
}
?>