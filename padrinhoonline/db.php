<?php
$link = mySQL_connect('localhost', 'root', '24290emi');
if (!$link) {
  die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());
}
$db_selected = mySQL_select_db('padrinhoonline', $link);
if (!$db_selected) {
  die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysql_error());
}
$db = mysqli_connect("localhost", "root", "24290emi", "padrinhoonline");
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
?>