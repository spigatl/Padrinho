<?php
include('../db.php');
if(!isset($id_logo)) {
    header("location: error.php");
}
$id_edit = $_GET['code'];
if (isset($_POST['excluir'])) {
	// pega ID que sera Deletado
    $result = $db->query("SELECT * FROM empresa WHERE E_ID = '$id_logo'") or die ($db->error);
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $id_edit_bd = md5($row['ID']);
        if ($id_edit == $id_edit_bd) {
            $id_edit = $row['ID'];
        }
    }
    // deleta o boneco do BD
    $result = $db->query("DELETE FROM empresa WHERE ID = '$id_edit'") or die ($db->error);
    //echo volta a pagina de lista
    echo "<script>window.location='pemp.php?p=pemplista&pag=1'</script>";
} else {
	// pega ID que sera Deletado
    $result = $db->query("SELECT * FROM empresa WHERE E_ID = '$id_logo'") or die ($db->error);
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $id_edit_bd = md5($row['ID']);
        if ($id_edit == $id_edit_bd) {
            $id_edit = $row['ID'];
        }
    }
    $estados = array("0"=>"", "1"=>"AC", "2"=>"AL", "3"=>"AM", "4"=>"AP","5"=>"BA","6"=>"CE","7"=>"DF","8"=>"ES","9"=>"GO","10"=>"MA","11"=>"MT","12"=>"MS","13"=>"MG","14"=>"PA","15"=>"PB","16"=>"PR","17"=>"PE","18"=>"PI","19"=>"RJ","20"=>"RN","21"=>"RO","22"=>"RS","23"=>"RR","24"=>"SC","25"=>"SE","26"=>"SP","27"=>"TO");
    // Pega o dados que serao deletados
    $result = $db->query("SELECT * FROM empresa WHERE ID = '$id_edit'") or die ($db->error);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //print do resultado
    $estado = $estados[$row['E_UF']];
    $comentario = substr($row['E_COMENTARIO'], 0, 150);
}
?>
<div id="listacorpo">
	<ul id="lista">
		<form id="formElem" name="formElem" action="" method="post" enctype="multipart/form-data">
	<?php
		if (!empty($row['E_IMG'])) {
					echo "<img src=fotos_empresa/$row[E_IMG] id=img1>";
				}	
					$crp = md5($row['ID']);
					echo "<label>$row[E_EMPRESA]</label></br></br>
					<li>
					$comentario
					</li>
					</br>
					<li><h16 id=endereco>$row[E_RUA], $row[E_NUMERO] - $row[E_CIDADE], $estado </h16></li>
					<li><h17 id=tel>Tel.: $row[E_TEL]</h17></li>
					<li><h18 id=email>$row[E_MAIL]</h18></li>
					<li><h19 id=site><a href=http://$row[E_SITE]>$row[E_SITE]</a></h19></li></br>
					</br>
					<ul style=\"text-align: right;\">
    				<button id=\"alterarbt\" name=\"excluir\" type=\"submit\">Excluir</button>
    				<button id=\"alterarbt\" name=\"cancelar\" onClick=\"window.history.back(); return false\" type=\"submit\">Cancelar</button>
					</ul>";
	?>
		</form>
	</ul>
</div>