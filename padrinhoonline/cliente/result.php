<?php
if (!isset($fr_id)) {
    header("location: ../error.php");
}
	//inclue acesso ao BD
include('../db.php');
$comparar = $_GET['action'];

// editar cadastro usuario
if ($comparar == "addados") {
    echo "<div>Sua auteração foi realizada com sucesso</div>";
}

// troca a img.
if ($comparar == "img") {

        echo "<div>Sua auteração foi realizada com sucesso</div>";    
}

// exibi msg de trocar senha
if ($comparar == "senha") {
    echo "<div>Sua auteração foi realizada com sucesso</div>";
}

// validação de e-mail
if ($comparar ==  "email") {
    $email = $_POST['fr_email'];
    //busca o email BD
    $insert = "SELECT * FROM users WHERE U_ID = $fr_id";
    $result = mysql_query($insert);
    while ($row = mysql_fetch_array($result)) {
        $para = $row['U_EMAIL'];
    }
    //gera o link de confirmação.
    $codigo = md5(uniqid($para), true);
    $link_messagem = "http://www.padrinhoonline.com.br/peresult.php?action=trocaremail&codigo=". $codigo ."&id=". $fr_id ."&email=". $email;
    $data = date("dmY");
    $hora = date("Hi");
    //insere tudo no banco de dados
    $insert = "UPDATE auth SET A_CODIGO='$codigo', A_DATA='$data', A_EMAIL='$email', A_HORA='$hora' WHERE A_ID='$fr_id'";
    mySQL_query($insert) or die("Falha no Insert<br>". mysql_error());
    mySQL_close($link);
    //informaçoes para email
    $de = "suporte@padrinhoonline.com.br";
    $mensagem = "Mensagem";
    $assunto = "Confirmação da troca de Email";
    // msg de confirmação 
    echo "Um email foi enviado para <b> $para </b>com um link para confirmar a ateração";
    // chama a função 
    // sendMail($para,$de,$mensagem,$assunto); 
}

if ($comparar == "trocaremail") {
    $fr_id = $_GET['id'];
    $codigo = $_GET['codigo'];
    $data_atual = date("dmY");
    $hora_atual = date("Hi");
    // buscar info no BD
    $insert = "SELECT * FROM AUTH WHERE A_ID='$fr_id' AND A_CODIGO='$codigo'";
    $result = mysql_query($insert);
    while ($row = mysql_fetch_array($result)) {
        $codigo2 = $row['A_CODIGO']; 
        $email = $row['A_EMAIL'];
        $data = $row['A_DATA'];
        $hora = $row['A_HORA'];
        $fr_id2 = $row['A_ID'];
    }
    //valida se as informações estao corretas e aplica
    $data_fechamento = str_pad((substr($data, 0, 2) + 1), 2, "0", STR_PAD_LEFT);
    $data_fechamento .= substr($data, 2, 8);
    if (($codigo ==  $codigo2) && ($fr_id == $fr_id2)) {
        if (($data_atual <= $data_fechamento)) {
            $insert = "UPDATE USERS SET U_EMAIL='$email' WHERE U_ID='$fr_id'";
            mySQL_query($insert) or die("Falha no Update<br>". mysql_error());
            mySQL_close($link);
            echo "Auteração realizada com sucesso";
        } else {
            echo "O tempo limite para esta operação foi excedido";
        }
    }
}

function sendMail($para,$de,$mensagem,$assunto) {

    //DADOS SMTP
    $smtp = "mail.dominio.com.br";
    $usuario = "contato@dominio.com.br";
    $senha = "senha";

    require_once 'smtp.php';

    $mail = new SMTP;

    $mail->Delivery('relay');
    $mail->Relay($smtp, $usuario, $senha, 25, 'login', false);
    $mail->TimeOut(10);
    $mail->Priority('high');
    $mail->From($de);
    $mail->AddTo($para);
    $mail->Html($mensagem);
    
    if($mail->Send($assunto))
        return true;
    else
        return false;
} 

?>