<?php
require_once("db.php");
$ctg = "|2|";
$inicio = 0;
$limite = 6;
$result = $db->query("SELECT * FROM empresa WHERE E_CATEGORIA LIKE '%$ctg%' LIMIT $inicio, $limite") or die ($db->error);
			// mosta o resultado na tela
			if($result) {
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					$estado = $estados[$row['E_UF']];
					$comentario = substr($row['E_COMENTARIO'], 0, 150);
					if (!empty($row['E_IMG'])) {
						echo "<img src=$end"."$row[E_IMG] id=img1>";
					}
					echo "<label>$row[E_EMPRESA]</label></br></br>
			<li>
			$comentario
			</li>
			</br>
			<li><h16 id=endereco>$row[E_RUA], $row[E_NUMERO] - $row[E_CIDADE], $estado </h16></li>
			<li><h17 id=tel>Tel.: $row[E_TEL]</h17></li>
			<li><h18 id=email>$row[E_MAIL]</h18></li>
			<li><h19 id=site><a href=http://$row[E_SITE]>$row[E_SITE]</a></h19></li>
			</br>
			<hr class=style-two></br>";
				} 
				
			}
?>
