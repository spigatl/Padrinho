<?php
$end = "http://". $_SERVER['HTTP_HOST'] ."/padrinhoonline/";
$teste = explode("/", $_SERVER['REQUEST_URI']);
include('db.php');
	$ctg = ",$teste[3],";
	$uf = $teste[4];
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="<?php echo $end; ?>css/menu.css" />
<link rel="stylesheet" href="<?php echo $end; ?>css/empresa.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.: Padrinho Online :. Melhor Sites de Lista de Casamento.</title>
<script src="<?php echo $end; ?>css/jquery.js" type="text/javascript"></script>
<script src="<?php echo $end; ?>js/idlocal.js" type="text/javascript"></script>
<script src="<?php echo $end; ?>js/event.js" type="text/javascript"></script>
<!-- Let's do the animation -->
<script type="text/javascript">
	$(function() {
		// set opacity to nill on page load
		$("#menu span").css("opacity","0");
		// on mouse over
		$("#menu span").hover(function () {
			// animate opacity to full
			$(this).stop().animate({
				opacity: 1
			}, 'slow');
		},
		// on mouse out
		function () {
			// animate opacity to nill
			$(this).stop().animate({
				opacity: 0
			}, 'slow');
		});
	});
	function estadoURL() {
		var pathname = window.location.href.split("&");
		var estado = pathname[2].split("=");
		var cat = pathname[1].split("=");
		var estadoCB = $('select').val();
		if ((estado[0] == "estado") && (cat[0] = "ctg")) {
			var link = "empresa?pag=1&" + pathname[1] + "&estado=" + estadoCB;
			window.location=link;
				
		} else {
			window.location="error.php";
		}
	}
</script>

</head>
<body>
<div id="corpo">
<p class="menulogo">
			<?php
			require_once("menu.php");
			?>
		</p>
<div id="boxes">
	<div id="content">
	            <div id="wrapper">
	                <div id="steps">
	                    <fieldset class="step">
	                        <legend>Empresas</legend>
	                        	<div id="photodiv" style="width: 170px; float: left">
	                        	<p>	
	                        	<div id="estado">
	                        	<form id="formElem" name="formElem" action="" method="post">
								<label id="titulo">Selecione o Estado</label>
								<select onChange="estadoURL()" size="1" name="D1">
									<?php 
									$slEstados = array("0"=>"Todos", "1"=>"Acre", "2"=>"Alagoas", "3"=>"Amazonas", "4"=>"Amapá","5"=>"Bahia","6"=>"Ceará","7"=>"Distrito Federal","8"=>"Espírito Santo","9"=>"Goiás","10"=>"Maranhão","11"=>"Mato Grosso","12"=>"Mato Grosso do Sul","13"=>"Minas Gerais","14"=>"Pará","15"=>"Paraíba","16"=>"Paraná","17"=>"Pernambuco","18"=>"Piauí","19"=>"Rio de Janeiro","20"=>"Rio Grande do Norte","21"=>"Rondônia","22"=>"Rio Grande do Sul","23"=>"Roraima","24"=>"Santa Catarina","25"=>"Sergipe","26"=>"São Paulo","27"=>"Tocantins");
									for($i=0; $i < count($slEstados); $i++) {
										if ($i == $uf) {
											echo "<option selected value=$i>$slEstados[$i]</option>";
										} else {
											echo "<option value=$i>$slEstados[$i]</option>";		
										}
									}
									?>
								</select>
							</form>
						</div>
					</p>
						<div id="menuguia">
							<label id="titulo">Categorias</label>
							<ul>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=1&estado=$uf"; ?>">Acessórios</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=2&estado=$uf"; ?>">Assessoria de eventos</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=3&estado=$uf"; ?>">Aderecos para festas</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=4&estado=$uf"; ?>">Alianças</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=5&estado=$uf"; ?>">Alta Costura</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=6&estado=$uf"; ?>">Aluguel de trajes</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=7&estado=$uf"; ?>">Bandas</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=8&estado=$uf"; ?>">Banqueteiros</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=9&estado=$uf"; ?>">Bar e Barmen</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=10&estado=$uf"; ?>">Bebidas</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=11&estado=$uf"; ?>">Bem-casados</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=12&estado=$uf"; ?>">Bolos e doces</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=13&estado=$uf"; ?>">Buffet</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=14&estado=$uf"; ?>">Convites e R.S.V.P.</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=15&estado=$uf"; ?>">Carros novos e antigos</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=16&estado=$uf"; ?>">Chá bar e cozinha</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=17&estado=$uf"; ?>">Celebração de Casamentos</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=18&estado=$uf"; ?>">Coral e orquestra</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=19&estado=$uf"; ?>">Decoração</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=20&estado=$uf"; ?>">Design de Interiores</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=21&estado=$uf"; ?>">Dia da noiva</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=22&estado=$uf"; ?>">DJ</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=23&estado=$uf"; ?>">Enxoval</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=24&estado=$uf"; ?>">Espacos para eventos</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=25&estado=$uf"; ?>">Filmagem e vídeo</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=26&estado=$uf"; ?>">Floriculturas</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=27&estado=$uf"; ?>">Foto e vídeo</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=28&estado=$uf"; ?>">Fotojornalismo</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=29&estado=$uf"; ?>">Lembrancinhas</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=30&estado=$uf"; ?>">Lista de Presentes</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=31&estado=$uf"; ?>">Lua-de-mel</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=32&estado=$uf"; ?>">Musica para casamento</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=33&estado=$uf"; ?>">Revistas e Guias</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=34&estado=$uf"; ?>">Som, Luz e Imagem</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=35&estado=$uf"; ?>">Valet Park - Seguranças</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=36&estado=$uf"; ?>">Sites de Casamento</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=37&estado=$uf"; ?>">Topo de Bolo</a></li>
								<li><a href="<?php echo "empresa.php?pag=1&ctg=38&estado=$uf"; ?>">Sítios para casamento</a></li>
							</ul>
						</div>
						<p>
							<div id="empguia">
								<label id="titulo">Cadastre aqui!</label>
								<ul>
									<li><a href="empresacadastro.php">Cadstre sua empresa em nossa lista.</a></li>
								</ul>
							</div>
						</p>
					</div>
				<div id="photodiv" style="width: 540px; float: left; border: 1px solid #000;">
			<div id="listacorpo">
		<ul id="lista">
			<?php
			$estados = array("0"=>"", "1"=>"AC", "2"=>"AL", "3"=>"AM", "4"=>"AP","5"=>"BA","6"=>"CE","7"=>"DF","8"=>"ES","9"=>"GO","10"=>"MA","11"=>"MT","12"=>"MS","13"=>"MG","14"=>"PA","15"=>"PB","16"=>"PR","17"=>"PE","18"=>"PI","19"=>"RJ","20"=>"RN","21"=>"RO","22"=>"RS","23"=>"RR","24"=>"SC","25"=>"SE","26"=>"SP","27"=>"TO");
			$limite = 20;
			$inicio = 0;
			$pag = $teste[2];
			$pag = filter_var($pag, FILTER_VALIDATE_INT);
			//faz alteração do limit conforme a pagina.
			if ($pag != ""){
				$inicio = ($pag - 1) * $limite;
			}
			if ($uf == 0){
				$result = $db->query("SELECT * FROM empresa WHERE E_CATEGORIA LIKE '%$ctg%' LIMIT $inicio, $limite") or die ($db->error);
			} else {
				$result = $db->query("SELECT * FROM empresa WHERE E_CATEGORIA LIKE '%$ctg%' AND E_UF='$uf' LIMIT $inicio, $limite") or die ($db->error);
			}
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
		</ul>
	</div>
	<br>
</div>
<div id="pages" style="border: 1px solid #000;">
<ul>
	<?php
	if ($uf == 0){
		$result = $db->query("SELECT * FROM empresa WHERE E_CATEGORIA LIKE '%$ctg%'") or die($db->error);
	} else {
		$result = $db->query("SELECT * FROM empresa WHERE E_CATEGORIA LIKE '%$ctg%' AND E_UF='$uf'") or die($db->error);
	}
	$row_cnt = $result->num_rows;
	$quantidade = ceil($row_cnt / $limite);
	$ant = $pag - 1;
	$prox = $pag + 1;

		if (($pag < 2)) {
			echo "<li class=nolink>« Anterior</li>";
		} else {
			echo "<li><a href=empresa.php?pag=$ant&ctg=$ctg&estado=$uf>« Anterior</a></li>";
		}
		 
	$offset = 2; 
	$piso = ($pag - $offset) < 1 ? 1 : ($pag - $offset); 
	$teto = ($pag + $offset) > $quantidade ? $quantidade : ($pag + $offset); 
	 for ($i = $piso; $i <= $teto; $i++) { 
	     if($pag==$i){ 
	  echo "<li class=current>$i</li>"; 
	  } else {
	  echo "<li><a href=empresa.php?pag=$i&ctg=$ctg&estado=$uf>$i</a></li>";
	 } 
	}
		if (($pag >= $quantidade)) {
			echo "<li class=nolink>Proxima »</li>";
		} else {
			echo "<li><a href=empresa.php?pag=$prox&ctg=$ctg&estado=$uf>Proxima »</a></li>";
		}
	?>
</ul>
</div>
</fieldset>
</div>
</div>
</div>
<h10 id="final"></h10>
</div>
</div>
</body>
</html>
<?php
$result->close();
$db->close();
?>