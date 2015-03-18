<?php
$array = explode("+", $_GET['token']);

$token = $array[0];
$codigoempresa = $array[1];

echo $token ."<br><br>";

$codigoempresa = $_GET['codigoempresa'];

if ($token == c_empresa) {

$n_token = md5(uniqid($codigoempresa, true));
$result = $db->query("INSERT INTO auth (A_CODIGO, A_DATA, A_EMAIL, A_ID, A_HORA, A_TIPO) VALUES ('$n_token', 'null', '$fr_mail', '$codigoempresa', 'null', 'EMPRESA')") or die ($db->error);
}
if ($token == c_pessoa) {

$n_token = md5(uniqid($codigoempresa, true));
$result = $db->query("INSERT INTO auth (A_CODIGO, A_DATA, A_EMAIL, A_ID, A_HORA, A_TIPO) VALUES ('$n_token', 'null', '$fr_mail', '$codigoempresa', 'null', 'PESSOA')") or die ($db->error);
}
?>