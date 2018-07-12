<?php

$solicitud=$_POST['solicitud'];
$libro=$_POST['libro'];
$librobis=$_POST['librobis'];
$foja=$_POST['foja'];
$fojac=$_POST['fojac'];
$partidan=$_POST['partidan'];
$partidaab=$_POST['partidaab'];
$clave=$_POST['clave'];
$fecsacr=$_POST['fecsacr'];
$ministro=utf8_decode($_POST['ministro']);
$nombre=utf8_decode($_POST['nombre']);
$paterno=utf8_decode($_POST['paterno']);
$materno=utf8_decode($_POST['materno']);
$hijoa=$_POST['hijo-a'];
$padre=utf8_decode($_POST['padre']);
$madre=utf8_decode($_POST['madre']);
$padrino=utf8_decode($_POST['padrino']);
$madrina=utf8_decode($_POST['madrina']);
$fechanac=$_POST['fechanac'];
$lugarnac=utf8_decode($_POST['lugarnac']);
$notamar=$_POST['notamar'];
$txnotamar=utf8_decode($_POST['txnotamar']);
$notapie=utf8_decode($_POST['notapie']);
$alta=True;

?>

<!DOCTYPE html>
<html >
<head>

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title></title>
    <meta name="description" content="Archivo Sagrario Metropolitano" />
    <meta name="keywords" content="sagrario, metropolitano" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="img/favicon.png" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
</head>
<body>
	<header >
		SAGRARIO METROPOLITANO<br>
		Sistema Archivo

		<form name="form" method="POST" action='busca.php'>
			<input class="submitTop" type="button" name="inicio" onclick="enviab('index.php')" value="Inicio"   >
			<input  class="submitTop"  type="button" name="archivo" onclick="enviab('archivo.php')" value="Archivo"  >

			||<input class="entradaMenu"  type="text" name="clave" placeholder="L-F-A">
			<input  class="submitTop"  type="submit" name="busca" onclick="enviab('busca.php')" value="Buscar"  >||
			<input class="submitTop"   type="button" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  >
			<input class="submitTop"   type="button" name="buscara" onclick="enviab('buscara.php')" value="Busqueda"   >
			<input class="submitTop"   type="button" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib.bautismo"   >
		</form>
	</header>
	<?php

		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}

		$clave1=substr($clave,0,1);
		$solic='solic_local';
		$base="bautismo";
		if ($alta) {
				$sql = "INSERT INTO bautismo (clave, solicitud, libro, librobis, foja, fojac, partidan, partidaab, fechasacr, ministro, nombre, paterno, materno, hijoa, padre, madre, padrino, madrina, fechanac, lugarnac, notamar) VALUES ('".$clave."', '".$solicitud."', '".$libro."', '".$librobis."', '".$foja."', '".$fojac."', '".$partidan."', '".$partidaab."', '".$fecsacr."', '".$ministro."', '".$nombre."', '".$paterno."', '".$materno."', '".$hijoa."', '".$padre."', '".$madre."', '".$padrino."', '".$madrina."', '".$fechanac."', '".$lugarnac."', '".$notamar."')";

		}else{
				$sql = "UPDATE bautismo SET solicitud=$solicitud, ministro=$ministro, nombre=$nombre, paterno=$paterno, materno=$materno, hijoa=$hijoa, padre=$padre, madre=$madre, padrino=$padrino, madrina=$madrina, fechanac=$fechanac, lugarnac=$lugarnac, notamar=$notamar
		}
		
		$agrega = mysqli_query($con, $sql) or die( 'no agrega') ;

		$sql = "SELECT * FROM $base WHERE clave = '".$clave."'";
		$result = mysqli_query($con, $sql) or die(error_log('no encontro registro agregado'));
		$regs=mysqli_num_rows(mysqli_query($con, $sql));
		$registro=mysqli_fetch_assoc($result);


		$fecsacr=$registro['fechasacr'];

		$diasacr=substr($fecsacr, 8, 2);
		$messacr=substr($fecsacr, 5, 2);
		@ $txmessacr=$meses[$messacr-1];
		$anosacr=substr($fecsacr, 0, 4);
		$txfecsacr=$diasacr." de ".$txmessacr." de ".$anosacr;

		$diabau=substr($registro['fechasacr'], 8, 2);
		$mesbau=substr($registro['fechasacr'], 5, 2);
		@ $txmesbau=$meses[$mesbau-1];
		$anobau=substr($registro['fechasacr'], 0, 4);
		$fecbau=$diabau." de ".$txmesbau." de ".$anobau;

		$fechanac=$registro['fechanac'];
		$dianac=substr($registro['fechanac'], 8, 2);
		$mesnac=substr($registro['fechanac'], 5, 2);
		@ $txmesnac=$meses[$mesnac-1];
		$anonac=substr($registro['fechanac'], 0, 4);
		$txfechanac=$dianac." de ".$txmesnac." de ".$anonac;

	?>

	<form action="imp_bau.php" method="POST">
	<table style='font-size:1.5em;'>
	<tr>
		<td width="225">Solicitud:  <?php echo $solicitud; ?> </td>
		<td width="225">Libro: <?php echo $libro."  ".$librobis; ?></td>
		<td width="225">Foja: <?php echo $foja."  ".$fojac; ?></td>

		<td width="125">Acta: <?php echo $partidan."  ".$partidaab; ?>

	</tr>
	</table>
		<?php echo "<input type='hidden' name='numSolicitud' maxlength='7' width='5' size='5' value='".$solicitud."'>"."<input type='hidden' name='libro' maxlength='4' size='4' value='".$libro."'>" ."<input type='hidden' name='librobis'	maxlength='2' size='2' value='".$librobis."'>"."<input type='hidden' name='foja' maxlength='4' size='4' value='".$foja."'>"."<input type='hidden' name='fojac' maxlength='3' size='4' value='".$fojac."'><input type='hidden' name='partidan' maxlength='4' size='4' value='".$partidan."'><input type='hidden' name='partidaab' maxlength='1' size='1' value='".$partidaab."'>"
		?>


		<table style="background: #ccff66;">
			<tr>
			<td>Fecha de Sacramento:</td>
			<td><?php echo "<input type='date' data-date-format='dd/mmmm/aaaa'   name='fecsacr'  size='10' value='".$fecsacr."' >"?></td>
			<td>Ministro: </td>
		 	<td><?php echo "<input type='text' name='ministro' maxlength='30' size='70' value='".$registro['ministro']."' '>" ?></td>
			</tr>
		</table>
	<table width="180" border="0">
			<tr>
				<td>Nombre:</td>
				<td><?php echo "<input type='text' name='nombre' maxlength='30' size='30' value='".$registro['nombre']."' >" ?></td>
				<td><?php echo "<input type='text' name='paterno' maxlength='30' size='30' value='".$registro['paterno']."' >" ?></td>
				<td><?php echo "<input type='text' name='materno' maxlength='30' size='30' value='".$registro['materno']."' >" ?></td>
			</tr>
		</table>
<table style="background: #ccff66;">
		<tr> <td>Hij:</td>
			<td><?php echo "<input type='text' name='hijo-a'  maxlength='1' size='1' placeholder='O/A' ".$registro['hijoa']."' >" ?></td>
			<td> de: <?php echo "<input type='text' name='padre' maxlength='50' size='40' value='".$registro['padre']."' >" ?></td>
			<td> y <?php echo "<input type='text' name='madre' maxlength='50' size='40' value='".$registro['madre']."' >" ?></td>
		</tr>
		</table>
<table>
	<tr>
		<td>Padrino(s): </td>
		<td><?php echo "<input type='text' name='padrino' maxlength='50' size='50' value='".$registro['padrino']."' >"  ?></td>
		<td><?php echo "<input type='text' name='madrina' maxlength=´50' size='50' value='".$registro['madrina']."' >";	?></td>
</table>
<table style="background: #ccff66;">
	<tr>
		<td>Nacio el: </td>
		<td><?php echo "<input type='date' name='fechanac' size='10' value='".$fechanac."'>";?></td>
		<td>en:</td>
		<td><?php echo "<input type='text' name='lugarnac' placeholder='entidad-colonia...' size='50' value='".$registro['lugarnac']."'>";?></td></tr>
</table>
<table><tr>
<?php
		echo "<td>Nota marginal:</td><td><strong>"." ".$registro['notamar']."</td><td><input type='text' name='notamar' size='1' value='".$registro['notamar']."'maxlenght='1'></td><td><textarea rows='4' cols='50' name='txnotamar'>".$txnotamar."</textarea></td>"."	<td>Nota al pie:</td><td><textarea rows='4' cols='50' name='notapie'>".$notapie."</textarea></td></tr></table>";
		echo "<input type='hidden' name='clave' value='".$clave."'  >";

?>


		<input type='submit' name='' value='IMPRIMIR'>
	</form>

	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){
		document.form.action= pag
		document.form.submit()
	}
	</script>
  <footer>
    Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
  </footer>


</body>
</html>
