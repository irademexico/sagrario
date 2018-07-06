<?php
		$actualizar=$_POST['actualizar'];
		$clave=$_POST['clave'];
		$solicitud=$_POST['solicitud'];
		$libro=$_POST['libro'];
		$librobis=$_POST['librobis'];
		$foja=$_POST['foja'];
		$fojac=$_POST['fojac'];
		$acta=$_POST['acta'];
		$reg=$_POST['reg'];
		$actaab=$_POST['actaab'];
		$fechasacr=$_POST['fecsacr'];
		$ministro=$_POST['ministro'];
		$nombre=$_POST['nombre'];
		$paterno=$_POST['paterno'];
		$materno=$_POST['materno'];
		$hijoa=$_POST['hijoa'];
		$padre=$_POST['padre'];
		$madre=$_POST['madre'];
		$padrino=$_POST['padrino'];
		$fechanac=$_POST['fechanac'];
		$lugarnac=$_POST['lugarnac'];
		$fechabau=$_POST['fechabau'];
		$parrbau=$_POST['parrbau'];
		$lugarbau=$_POST['lugarbau'];
		$librobau=$_POST['librobau'];
		$xdiacon=$_POST['xdiacon'];
		$xmescon=$_POST['xmescon'];
		$xanocon=$_POST['xanocon'];
		echo "sol:".$solicitud;
?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
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

	</section>
	<?php
		$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

		$con= new mysqli("localhost", "root", "", "sagrario");

		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}
		$clave1=substr($clave,0,1);
		$solic='solic_local';
		$base="confirma";

		if ($actualizar==0) {
			$sql = "INSERT INTO confirma (clave, solicitud, libro, librobis, foja, fojac, acta, reg, actaab, fechaconf, ministro, nombre, paterno, materno, hijoa, padre, madre, padrino, fechanac, lugarnac, fechabau, parrbau, lugarbau, librobau, xdiacon, xmescon, xanocon ) VALUES ('".$clave."', '".$solicitud."', '".$libro."', '".$librobis."', '".$foja."', '".$fojac."', '".$acta."', '".$reg."', '".$actaab."', '".$fechasacr."', '".$ministro."', '".$nombre."', '".$paterno."', '".$materno."', '".$hijoa."', '".$padre."', '".$madre."', '".$padrino."', '".$fechanac."', '".$lugarnac."', '".$fechabau."', '".$parrbau."', '".$lugarbau."', '".$librobau."', '".$xdiacon."', '".$xmescon."', '".$xanocon."')";

			$agrega = mysqli_query($con, $sql) or die( "no agrega") ;
		}


		$sql = "SELECT * FROM $base WHERE clave = '".$clave."'";
		$result = mysqli_query($con, $sql) or die(error_log('no encontro registro agregado'));
		$regs=mysqli_num_rows(mysqli_query($con, $sql));
		$registro=mysqli_fetch_assoc($result);


		$fecsacr=$registro['fechaconf'];

		$diasacr=substr($fecsacr, 8, 2);
		$messacr=substr($fecsacr, 5, 2);
		@ $txmessacr=$meses[$messacr-1];
		$anosacr=substr($fecsacr, 0, 4);
		$fecsacr=$diasacr." de ".$txmessacr." de ".$anosacr;

		$diabau=substr($registro['fechabau'], 8, 2);
		$mesbau=substr($registro['fechabau'], 5, 2);
		@ $txmesbau=$meses[$mesbau-1];
		$anobau=substr($registro['fechabau'], 0, 4);
		$fecbau=$diabau." de ".$txmesbau." de ".$anobau;

		$dianac=substr($registro['fechanac'], 8, 2);
		$mesnac=substr($registro['fechanac'], 5, 2);
		@ $txmesnac=$meses[$mesnac-1];
		$anonac=substr($registro['fechanac'], 0, 4);
		$fechanac=$dianac." de ".$txmesnac." de ".$anonac;
		$xdiacon=$registro['xdiacon'];
		$xmescon=$registro['xmescon'];
		$xanocon=$registro['xanocon'];
	?>

	<form action="imp_con.php" method="POST">

		<table>
			<tr>
				<td>Solicitud: </td>
				<td> <?php echo "<input type='number' name='solicitud' maxlength='7' width='5' size='5' step='.01'	 value='".$solicitud."' >" ?> </td>
				<td>Libro: </td>
				<td><?php echo "<input type='number' name='libro' maxlength='4' size='4' value='".$libro."' >" ?></td>
				<td><?php echo "<input type='text' name='librobis'	maxlength='2' size='2' value='".$librobis."' >" ?></td>
				<td>Foja:</td>
				<td><?php echo "<input type='number' name='foja' maxlength='4' size='4' value='".$foja."' >" ?></td>
				<td><?php echo "<input type='text' name='fojac' maxlength='3' size='4' value='".$fojac."' >" ?></td>

				<td>Acta: </td>
				<td><?php echo "<input type='number' name='acta' maxlength='4' size='4' value='".$acta."' ></td>" ?>
				<td><?php echo "<input type='number' name='reg' maxlength='4' size='4' value='".$reg."' ></td>" ?>
				<td><?php echo "<input type='text' name='actaab' maxlength='1' size='1' value='".$actaab."' ></td>" ?>
			</tr>
		</table>

		<table style="background: #ccff66;">
			<tr>
				<td>Fecha de Sacramento:</td>
				<td><?php echo "<input type='date' data-date-format='dd/mmmm/aaaa'   name='fecsacr'  size='10' value='".$fechasacr."' >"?></td>
				<td>Ministro: </td>
			 	<td><?php echo "<input type='text' name='ministro' maxlength='30' size='70' value='".$registro['ministro']."' '>" ?></td>
				<td><label><input type="checkbox" name="imprApellidos" checked> Imprimir Apellidos</label></td>
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
			<tr>
				<td>Hij:</td>
				<td><?php echo "<input type='text' name='hijo-a'  maxlength='1' size='1' value='".$registro['hijoa']."' >" ?></td>
				<td> de: <?php echo "<input type='text' name='padre' maxlength='30' size='30' value='".$registro['padre']."' >" ?></td>
				<td> y <?php echo "<input type='text' name='madre' maxlength='30' size='30' value='".$registro['madre']."' >" ?></td>
			</tr>
		</table>

		<table>
			<tr>
				<td>Padrino(s): </td>
				<td><?php echo "<input type='text' name='padrino' maxlength='50' size='50' value='".$registro['padrino']."' >"  ?></td>
			</tr>
		</table>

		<table style="background: #ccff66;">
			<tr>
				<td>Nacio el: </td>
				<td><?php echo "<input type='date' name='fechanac' size='10' value='".$fechanac."''> "; ?></td>
				<td>en:</td>
				<td><?php echo "<input type='text' name='lugarnac' placeholder='entidad-colonia...' size='50' value='".$registro['lugarnac']."'>"; ?></td>
			</tr>
		</table>

		<table>
			<tr>
				<td>Bautizado: </td>
				<td><?php echo "<input type='date' name='fechabau' size='10' value=".$fechabau."> <input type='text' name='xdiacon' size='2' value=".$xdiacon."> <input type='text' name='xmescon' size='5' value=".$xmescon." > <input type='text' name='xanocon' size='2' value=".$xanocon." > "; ?></td>
				<td>en:</td>
				<td><?php echo "<input type='text' name='parrbau' placeholder='parroquia' maxlength='50' size='50' value=".$registro['parrbau'].">"; ?></td>
				<td>en:</td>
				<td><?php echo "<input type='text' name='lugarbau' maxlength='50' placeholder='entidad-colonia...' size='50' value=".$registro['lugarbau'].">"; ?></td>
			</tr>
		</table>

		<?php echo "<input type='hidden' name='clave' value='".$clave."'>"; ?>

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
