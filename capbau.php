<?php

	$solicitud=$_POST['solicitud'];
	$libro=$_POST['libro'];
	$librobis=$_POST['librobis'];
	$foja=$_POST['foja'];
	$fojac=$_POST['fojac'];
	$partidan=$_POST['partidan'];
	$partidaab=$_POST['partidaab'];
	$actualiza=0;
	$altasol=True;
	$alta=True;
	$txnotamar="";
	$txnotapie="Valida para tramitar matrimonio en la parroquia de";

	if (empty($librobis)) {
		$clave=trim(substr($libro,0)).'-';
	}else{
		$clave=trim(substr($libro,0)).'-'.trim($librobis).'-';
	}
	if (empty($fojac)) {
		$clave=$clave.trim(substr($foja,0)).'-';
	}else{
		$clave=$clave.trim(substr($foja,0)).'-'.trim($fojac).'-';
	}
	if (empty($partidaab)) {
		$clave=$clave.trim(substr($partidan,0));
	}else{
		$clave=$clave.trim(substr($partidan,0)).'-'.trim($partidaab);
	}

 ?>

<!DOCTYPE html>
<html >
	<head>
		<meta charset="utf-8">
	    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Archivo</title>
	    <meta name="description" content="Archivo Sagrario Metropolitano" />
	    <meta name="keywords" content="sagrario, metropolitano" />
	    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
	    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	    <link href="img/favicon.ico" rel="icon" type="image/png" />
	    <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<header >
			SAGRARIO METROPOLITANO<br>
			Sistema Archivo

			<form name="form" method="POST" action='busca.php'>
				<input class="submitTop" type="button" name="inicio" onclick="enviab('index.php')" value="Inicio"   >
				<input  class="submitTop"  type="button" name="archivo" onclick="enviab('archivo.php')" value="Archivo"  >

				||<input class="entradaMenu"  type="text" name="clave" placeholder="Clave L-F-A">
				<input  class="submitTop"  type="submit" name="busca" onclick="enviab('busca.php')" value="Buscar"  >||
				<input class="submitTop"   type="button" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  >
				<input class="submitTop"   type="button" name="buscara" onclick="enviab('buscara.php')" value="Busqueda"   >
				<input class="submitTop"   type="button" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib.bautismo"   >
			</form>
		</header>
		<section>
			<h2>CAPTURA DE BAUTISMO</h2>
		</section>
	<?php

		//$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}
		//$clave1=substr($clave,0,1);
		//$solic='solic_local';
		$base="bautismo";
		//$sql = "SELECT * FROM $base WHERE clave = '".$clave."'";
		$sql = "SELECT * FROM $base WHERE libro=$libro AND librobis='$librobis' AND foja=$foja AND fojac='$fojac' AND partidan=$partidan AND partidaab='$partidaab'";

		$result = mysqli_query($con, $sql ) or die(error_log('no consulto clave'));
		$regs=mysqli_num_rows(mysqli_query($con, $sql));

		$registro=mysqli_fetch_assoc($result);

		if ($regs>0) {
			$alta=False;

			$base='notas_marg';
			$sql = "SELECT * FROM $base WHERE clave='".$clave."'";
			$result = mysqli_query($con, $sql );
			@$regs=mysqli_num_rows(mysqli_query($con, $sql));
			@$notaMarginal=mysqli_fetch_assoc($result);
			if ($regs>0) {
					$txnotamar=utf8_encode($notaMarginal['txnotamar']);
			}

			$base='notas';
			$numSolant=$registro['solicitud'];

			$sql = "SELECT * FROM $base WHERE numSolicitud=$numSolant";
			$result = mysqli_query($con, $sql );
			@$regs=mysqli_num_rows(mysqli_query($con, $sql));
			@$nota=mysqli_fetch_assoc($result);
			if ($regs>0) {
					$txnotapie=utf8_encode($nota['notaPie']);
			}
		}
		$fecsacr=$registro['fechasacr'];

		//$agrega='imp_bau.php';
	?>

	<form action="imp_bau.php" method="POST">
		<table style='font-size:1.5em;'>
	<tr>
		<td width="225">Solicitud: </td><td> <?php echo $solicitud; ?> </td>
		<td width="225">Libro: </td><td><?php echo $libro."  ".$librobis; ?></td>
		<td width="225">Foja: </td><td> <?php echo $foja."  ".$fojac; ?></td>

		<td width="125">Acta: </td><td><?php echo $partidan."  ".$partidaab; ?>

	</tr>
</table>
		<?php echo "<input type='hidden' name='libro' maxlength='4' size='4' value='".$libro."'>" ."<input type='hidden' name='librobis'	maxlength='2' size='2' value='".$librobis."'>"."<input type='hidden' name='foja' maxlength='4' size='4' value='".$foja."'>"."<input type='hidden' name='fojac' maxlength='3' size='4' value='".$fojac."'><input type='hidden' name='partidan' maxlength='4' size='4' value='".$partidan."'><input type='hidden' name='partidaab' maxlength='1' size='1' value='".$partidaab."'>"."<input type='hidden' name='numSolicitud'	maxlength='2' size='2' value='".$solicitud."'>";
		?>

		<table style="background: #ccff66;">
			<tr>

			<td>Fecha de Sacramento: </td>
			<td><input class="entradatx" type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10" value="<?php echo $fecsacr;?>"></td>
			<td>Ministro: </td>
		 	<td><input class="entradatx" type="text" name="ministro" maxlength="50" size="70" value="<?php echo utf8_encode($registro['ministro']);?>"></td>
			</tr>
		</table>
	<table width="180" border="0">
			<tr>
				<td>Nombre:</td>
				<td><input class="entradatx" type="text" name="nombre" maxlength="30" size="30"  value="<?php echo utf8_encode($registro['nombre']);?>"></td>
				<td><input class="entradatx" type="text" name="paterno" maxlength="30" size="30" value="<?php echo utf8_encode($registro['paterno']);?>"></td>
				<td><input class="entradatx" type="text" name="materno" maxlength="30" size="30" value="<?php echo utf8_encode($registro['materno']);?>"></td>
			</tr>
		</table>
<table style="background: #ccff66;">
		<tr> <td>Hij</td>
			<td><input class="entradatx" type="text" name="hijo-a"  maxlength="1" size="1" placeholder="O/A" value="<?php echo $registro['hijoa'];?>"></td>
			<td>de: <td><input class="entradatx" type="text" name="padre" maxlength="50" size="50" value="<?php echo utf8_encode($registro['padre']);?>"></td>
			<td><input class="entradatx" type="text" name="madre" maxlength="50" size="50" value="<?php echo utf8_encode($registro['madre']);?>"></td>
		</tr>
		</table>
<table>
	<tr>
		<td>Padrino(s): </td>
		<td><input class="entradatx" type="text" name="padrino" maxlength="50" size="50" value="<?php echo utf8_encode($registro['padrino']);?>"></td>

		<?php
			echo "<td><input class='entradatx' type='text' name='madrina' maxlength=´50' size='50' value='".utf8_encode($registro['madrina'])."'</td>";
		?>
</table>
<table style="background: #ccff66;">
	<tr>
		<td>Nacio el: </td>
		<td><input class="entradatx" type="date" name="fechanac" size="10" value="<?php echo $registro['fechanac'];?>"></td>
		<td>en:</td>
		<td><input class="entradatx" type="text" name="lugarnac" placeholder='entidad-colonia...' size="50" value="<?php echo utf8_encode($registro['lugarnac']);?>"></td></tr>
</table>
<table><tr>
<?php
		echo "<td>Nota marginal:</td><td><input class='entradatx' type='text' name='notamar' size='1' value='".$registro['notamar']."' maxlenght='1'></td><td><textarea class='entradaarea' rows='4' cols='50' name='txnotamar'>".$txnotamar."</textarea></td>"."	<td>Nota al pie:</td><td><textarea class='entradaarea' rows='4' cols='45' name='notapie'>".$txnotapie."</textarea></td></tr></table>";
		echo "<input type='hidden' name='clave' value='".$clave."' visible='hidden'>";
		echo "<input type='hidden' name='alta' value='".$alta."' visible='hidden'>";
		echo "<input type='hidden' name='altasolcap' value='".$altasol."' visible='hidden'>";
		
?>

		<input type='submit' name='' value='Continuar'>
	</form>

	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){
		document.form.action= pag
		document.form.submit()
	}
	</script>
	<section>

	</section>
<footer>
	Derechos Reservados    José Ignacio Virgilio Ruiz Arroyo
</footer>
<section>

</section>

</body>
</html>
