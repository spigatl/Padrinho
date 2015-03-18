<?php
	//inclue acesso ao BD
	include('db.php');
    $comparar = $_GET['action'];

if ($comparar == "addados") {
	//insere os dados do form no BD
	$insert = "UPDATE USERS SET U_NOME_NOIVO='$_POST[fr_noivo]', U_NOME_NOIVA='$_POST[fr_noiva]', U_TEL='$_POST[fr_tel]', U_NOME='$_POST[fr_nome]', U_CPF='$_POST[fr_cpf]', U_ENDERECO='$_POST[fr_end]', U_NUMERO='$_POST[fr_num]', U_COMPLEMENTO='$_POST[fr_comp]', U_BAIRRO='$_POST[fr_bairro]', U_CIDADE='$_POST[fr_cidade]', U_ESTADO='$_POST[fr_estado]', U_CEP='$_POST[fr_cep]', U_DATA='$_POST[fr_data]' WHERE U_ID='$_GET[id]'";
	mySQL_query($insert) or die("Falha no Update<br>". mysql_error());
	mySQL_close($link);
	echo "<div>Sua auteração foi realizada com sucesso</div>";
}

if ($comparar == "salveed") {
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

    //busca o nome do arquivo no BD
    $insert = "SELECT * FROM USERS WHERE U_ID = $fr_id";
    $result = mysql_query($insert);
    while ($row = mysql_fetch_array($result)) {
    // dar um nome padrão para a miniatura
    $nome_miniatura = $row['U_IMG'];
    $nome_arquivo = $row['U_IMG'];    
    }
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
    $insert = "UPDATE USERS SET U_IMG='$nome_arquivo' WHERE U_ID='$_GET[id]'";
    mySQL_query($insert) or die("Falha no Update<br>". mysql_error());
    mySQL_close($link);

    echo "<div>Sua auteração foi realizada com sucesso</div>";
	
}
if ($comparar == "senha") {
        echo "<div>Sua auteração foi realizada com sucesso</div>";
}

if ($comparar ==  "email") {
    $email = $_POST['fr_email'];
    //busca o email BD
    $insert = "SELECT * FROM USERS WHERE U_ID = $fr_id";
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
    $insert = "UPDATE AUTH SET A_CODIGO='$codigo', A_DATA='$data', A_EMAIL='$email', A_HORA='$hora' WHERE A_ID='$fr_id'";
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