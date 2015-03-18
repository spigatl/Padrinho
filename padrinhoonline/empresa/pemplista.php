
<div id="listacorpo">
	<ul>
		<?php
		if(!isset($id_logo)) {
			header("location: error.php");
		}
		include('../db.php');
		$id = $id_logo;
		$estados = array("0"=>"", "1"=>"AC", "2"=>"AL", "3"=>"AM", "4"=>"AP","5"=>"BA","6"=>"CE","7"=>"DF","8"=>"ES","9"=>"GO","10"=>"MA","11"=>"MT","12"=>"MS","13"=>"MG","14"=>"PA","15"=>"PB","16"=>"PR","17"=>"PE","18"=>"PI","19"=>"RJ","20"=>"RN","21"=>"RO","22"=>"RS","23"=>"RR","24"=>"SC","25"=>"SE","26"=>"SP","27"=>"TO");
		$limite = 6;
		$inicio = 0;
		$pag = $_GET['pag'];
		$pag = filter_var($pag, FILTER_VALIDATE_INT);
			//faz alteração do limit conforme a pagina.
			if ($pag != ""){
				$inicio = ($pag - 1) * $limite;
			}
		//busca no banco de dados		
		$result = $db->query("SELECT * FROM empresa WHERE E_ID='$id' LIMIT $inicio, $limite") or die ($db->error);
		
		//Novo Cadastro
		echo "<div id=editar>
				<ul>
					<input type=submit name=novo onclick=\"window.location = 'pemp.php?p=pempcadastro' \" value=Cadastrar>
				</ul><br>
				<hr class=style-two></br>
			</div>";

		// mosta o resultado na tela
		if($result) { 
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
				
				$estado = $estados[$row['E_UF']];
				$comentario = substr($row['E_COMENTARIO'], 0, 150);
				if (!empty($row['E_IMG'])) {
					echo "<img src=../fotos_empresa/$row[E_IMG] id=img1>";
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
					<li><h19 id=site><a href=http://$row[E_SITE]>$row[E_SITE]</a></h19></li>
					<div id=editar>
					<ul>
    				<input type=submit id=edit onclick=\"editar('$crp')\"; name=edit value=Editar>
    				<input type=submit name=delet onclick=\"deletar('$crp')\"; value=Deletar>
    				</ul>
					</div>
					</br>
					<hr class=style-two></br>";
			} 			
		}

echo "</ul>
</div>
<div id=pages>
<ul>";

$result = $db->query("SELECT * FROM empresa WHERE E_ID='$id'") or die ($db->error);

$row_cnt = $result->num_rows;
$quantidade = ceil($row_cnt / $limite);
$ant = $pag - 1;
$prox = $pag + 1;

	if (($pag < 2)) {
		echo "<li class=nolink>« Anterior</li>";
	} else {
		echo "<li><a href=pemp.php?p=pemplista&pag=$ant>« Anterior</a></li>";
	}
	 
$offset = 2; 
$piso = ($pag - $offset) < 1 ? 1 : ($pag - $offset); 
$teto = ($pag + $offset) > $quantidade ? $quantidade : ($pag + $offset); 
 for ($i = $piso; $i <= $teto; $i++) { 
     if($pag==$i){ 
  echo "<li class=current>$i</li>"; 
  } else {
  echo "<li><a href=pemp.php?p=pemplista&pag=$i>$i</a></li>";
 } 
}
	if (($pag >= $quantidade)) {
		echo "<li class=nolink>Proxima »</li>";
	} else {
		echo "<li><a href=pemp.php?p=pemplista&pag=$prox>Proxima »</a></li>";
	}
?>
</ul>
</div>