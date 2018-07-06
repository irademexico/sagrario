<?php
$numSolicitud=$_POST['numSolicitud'];
$libro=$_POST['libro'];
@$librobis=$_POST['librobis'];
@$foja=$_POST['foja'];
@$fojac=$_POST['fojac'];
$partidan=$_POST['partidan'];
@$partidaab=$_POST['partidaab'];
@$reg=$_POST['registro'];
$solicitud=$_POST['solicitud'];
@$para=$_POST['para'];

if ($solicitud==1) {
		$clave="";
		$base='bautismo';
		$titulo='BAUTISMO';
		$imprime='imp_bau.php';
	}elseif ($solicitud==2) {
		$clave='c';
		$base='confirma';
		$titulo='CONFIRMACION';
		$imprime='imp_con.php';
	}else{
		$clave='m';
		$base='matrimonios';
		$titulo='MATRIMONIO';
		$imprime='imp_mat.php';
	}
if (empty($librobis)) {
	$clave=$clave.trim(substr($libro,0)).'-';
}else{
	$clave=trim(substr($libro,0)).'-'.trim($librobis).'-';
}
if (empty($fojac)) {
	$clave=$clave.trim(substr($foja,0)).'-';
}else{
	$clave=$clave.trim(substr($foja,0)).'-'.trim($fojac).'-';
}
if (empty($reg)||$reg==0) {
	if (empty($partidaab)) {
		$clave=$clave.trim(substr($partidan,0));
	}else{
		$clave=$clave.trim(substr($partidan,0)).'-'.trim($partidaab);
	}
}else{
	$clave=$clave.trim(substr($reg,0));
}


		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}
		$clave1=substr($clave,0,1);
		$solic='solic_local';
		//$base="confirma";

		$sql = "SELECT * FROM $base WHERE clave = '".$clave."'";

		$result = mysqli_query($con, $sql);
		$regbase=mysqli_num_rows(mysqli_query($con, $sql));

		if ($regbase==0) {

			if ($solicitud==2) {

			$sql = "INSERT INTO $base (clave, solicitud, libro, librobis, foja, fojac, acta, reg, actaab ) VALUES ('".$clave."', '".$numSolicitud."', '".$libro."', '".$librobis."', '".$foja."', '".$fojac."', '".$partidan."', '".$reg."', '".$partidaab."')";
			}elseif ($solicitud==1) {
				$sql="INSERT INTO $base(clave, solicitud, libro, librobis, foja, fojac, partidan, partidaab) VALUES('".$clave."', '".$numSolicitud."', '".$libro."', '".$librobis."', '".$foja."', '".$fojac."', '".$partidan."', '".$partidaab."')";
			}else{
				$sql="INSERT INTO $base (clave, numSolicitud, libro, foja, fojac, partida)  VALUES ('".$clave."', '".$numSolicitud."', '".$libro."', '".$foja."', '".$fojac."', '".$partidan."')";
			}

		$agrega = mysqli_query($con, $sql) or die( "no agrega") ;
		}
 ?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title></title>
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
		<p><?php echo "ACTA DE ".$titulo;?></p>
	</section>
	<?php

		$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}

		$solic='solic_local';


		if ($regbase==0){
			$sql = "SELECT * FROM $solic WHERE numSolicitud = $numSolicitud ";
			$result = mysqli_query($con, $sql);
			$regsol=mysqli_num_rows(mysqli_query($con, $sql));
			if ($regsol==0) {
				echo "HA OCURRIDO UN ERROR DE CONSULTA A SOLICITUDES";
				exit();
			}else{
				$registro		=	mysqli_fetch_assoc($result);
				$apMaterno	=	utf8_encode($registro['apMaterno']);
				$apPaterno	=	utf8_encode($registro['apPaterno']);
				$esposa			=	utf8_encode($registro['esposa']);
				$esposo			=	utf8_encode($registro['esposo']);
				$fecNac			=	$registro['fecNac'];
				$fecSacr		=	$registro['fecSacr'];
				$madre			=	utf8_encode($registro['madre']);
				$madrina		=	utf8_encode($registro['madrina']);
				$nombre			=	utf8_encode($registro['nombre']);
				$padre			=	utf8_encode($registro['padre']);
				$padrino		=	utf8_encode($registro['padrino']);
				//$solicitud=$registro['solicitud'];
			}
		}else{
			$registro=mysqli_fetch_assoc($result);
			if ($solicitud==1) {
				$apMaterno=utf8_encode($registro['materno']);//bau
				$apPaterno=utf8_encode($registro['paterno']);//bau
				$esposa="";
				$esposo="";
				$fecNac=utf8_encode($registro['fechanac']);//bau
				$fecSacr=utf8_encode($registro['fechasacr']);//bau
				$madre=utf8_encode($registro['madre']);
				$madrina=utf8_encode($registro['madrina']);
				$nombre=utf8_encode($registro['nombre']);
				$padre=utf8_encode($registro['padre']);
				$padrino=utf8_encode($registro['padrino']);
				$colonia=utf8_encode($registro['colonia']);//bau
				$cpdom=$registro['cpdom'];//bau
				$domicilio=utf8_encode($registro['domicilio']);//bau
				$fecregciv=$registro['fecregciv'];//bau
				$hijoa=$registro['hijoa'];//bau
				$lugarde=utf8_encode($registro['lugarde']);//bau
				$lugarnac=utf8_encode($registro['lugarnac']);//bau
				$lugregciv=utf8_encode($registro['lugregciv']);//bau
				$ministro=utf8_encode($registro['ministro']);//bau
				$notamar=$registro['notamar'];
				$parroquia=utf8_encode($registro['parroquia']);//bau
				$registroc=utf8_encode($registro['registroc']);//bau
				$fechabau="";//con
				$librobau="";//con
				$parrbau="";//con
				$xanocon="";//con
				$xdiacon="";//con
				$xmescon="";//con
			}elseif ($solicitud==2) {
				$apMaterno=utf8_encode($registro['materno']);//con

				$apPaterno=utf8_encode($registro['paterno']);//con
				$esposa="";
				$esposo="";
				$fecNac="";//con
				$fecSacr=$registro['fechaconf'];//con
				$madre=utf8_encode($registro['madre']);//con
				$madrina="";
				$nombre=utf8_encode($registro['nombre']);//con
				$padre=utf8_encode($registro['padre']);//con
				$padrino=utf8_encode($registro['padrino']);//con
				$colonia="";
				$cpdom="";
				$domicilio="";
				$fecregciv="";
				$hijoa="";//con
				$lugarde="";
				$lugarnac="";//con
				$lugregciv="";
				$ministro="";//con
				$parroquia="";
				$registroc="";
				$fechabau="";//con
				$librobau="";//con
				$lugarnac="";//con
				$parrbau="";//con
				$xanocon="";//con
				$xdiacon="";//con
				$xmescon="";//con

			}else{
				$apMaterno="";//con

				$apPaterno="";//con
				$esposa=utf8_encode($registro['esposa']);
				$esposo=utf8_encode($registro['esposo']);
				$fecNac="";//con
				$fecSacr=$registro['fecSacr'];//con
				$madre="";//con
				$madrina="";
				$nombre="";//con
				$padre="";//con
				$padrino="";//con
				$colonia="";
				$cpdom="";
				$domicilio="";
				$fecregciv="";
				$hijoa="";//con
				$lugarde="";
				$lugarnac="";//con
				$lugregciv="";
				$ministro="";//con
				$parroquia="";
				$registroc="";
				$fechabau="";//con
				$librobau="";//con
				$lugarnac="";//con
				$parrbau="";//con
				$xanocon="";//con
				$xdiacon="";//con
				$xmescon="";//con
				echo $esposa.$esposo.$fecSacr."esposa $esposa , esposo $esposo, fec boda $fecSacr";
			}

		}
	//echo "datos".$nombre.$apPaterno.$apMaterno;
	?>

	<form action="<?php echo $imprime; ?>" method="POST">

		<table style='font-size:1.2em;'>
			<tr>
				<td width="225">Solicitud:  <?php echo $numSolicitud; ?> </td>
				<td width="225">Libro: <?php echo $libro."  ".$librobis; ?></td>
				<td width="225">Foja: <?php echo $foja."  ".$fojac; ?></td>
				<td width="225">Acta o registro: <?php echo $partidan."  ".$partidaab." ",$reg ; ?></td>
			</tr>
		</table>


		<?php
			echo "<input type='hidden' name='solicitud'  value='".$solicitud."'>"."<input type='hidden' name='numSolicitud'  value='".$numSolicitud."'>"."<input type='hidden' name='libro' maxlength='4' size='4' value='".$libro."'>" ."<input type='hidden' name='librobis'	maxlength='2' size='2' value='".$librobis."'>"."<input type='hidden' name='foja' maxlength='4' size='4' value='".$foja."'>"."<input type='hidden' name='fojac' maxlength='3' size='4' value='".$fojac."'><input type='hidden' name='acta' maxlength='4' size='4' value='".$partidan."'><input type='hidden' name='actaab' maxlength='1' size='1' value='".$partidaab."'><input type='hidden' name='partidan' maxlength='4' size='4' value='".$partidan."'><input type='hidden' name='partidaab' maxlength='1' size='1' value='".$partidaab."'><input type='hidden' name='reg' maxlength='2' size='1' value='".$reg."'>";
			echo "<input type='hidden' name='clave' value='".$clave."' visible='hidden'>";
		?>

		<table style="background: #ccff66;">
			<tr>
				<td>Fecha de Sacramento:</td>
				<td><input  class="entradatx" type="date" data-date-format="dd/mmmm/aaaa"   name="fecsacr"  size="10" value="<?php echo $fecSacr;?>"></td>
				<td>Ministro: </td>
			 	<td><input class="entradatx" type="text" name="ministro" maxlength="70" size="70"></td>
				<td><label><input type="checkbox" name="imprApellidos" checked> Imprimir Apellidos</label></td>
			</tr>
		</table>
		<?php
			if ($solicitud==3) {
				?>
					<table width="180" border="0">
						<tr>
							<td>Esposo:</td>
							<td><input class="entradatx" type="text" name="esposo" maxlength="50" size="50" value="<?php echo $esposo;?>"></td>
						</tr>
						<tr>
							<td>Esposa:</td>
							<td><input class="entradatx" type="text" name="esposa" maxlength="50" size="50" value="<?php echo $esposa;?>"></td>
						</tr>
					</table>
					<table width="180" border="0">
						<tr>
							<td>Testigos:</td>
							<td><input class="entradatx" type="text" name="testigo1" maxlength="50" size="50" ></td>
						</tr>
						<tr>
							<td>Y</td>
							<td><input class="entradatx" type="text" name="testigo2" maxlength="50" size="50"></td>
						</tr>
					</table>
					<table width="180" border="0">
						<tr>
							<td>Parroquia de presentación:</td>
							<td><input class="entradatx" type="text" name="parrPresento" maxlength="50" size="50" ></td>
						</tr>
						<tr>
							<td>Colonia:</td>
							<td><input class="entradatx" type="text" name="colParrPresenta" maxlength="50" size="50"></td>
						</tr>
						<tr>
							<td>Entidad:</td>
							<td><input class="entradatx" type="text" name="entidadParrPresenta" maxlength="50" size="50"></td>
						</tr>
					</table>

				<?php
				} else{
		?>
		<table width="180" border="0">
			<tr>
				<td>Nombre:</td>
				<td><input class="entradatx" type="text" name="nombre" maxlength="30" size="30" value="<?php echo $nombre;?>"></td>
				<td><input class="entradatx" type="text" name="paterno" maxlength="30" size="30" value="<?php echo $apPaterno;?>"></td>
				<td><input class="entradatx" type="text" name="materno" maxlength="30" size="30" value="<?php echo $apMaterno;?>"></td>
			</tr>
		</table>

		<table style="background: #ccff66;">
			<tr>
				<td>Hij:</td>
				<td><input class="entradatx" type="text" name="hijo-a"  maxlength="1" size="1" placeholder="O/A"></td>
				<td> de </td>
				<td><input class="entradatx" type="text" name="padre" maxlength="50" size="50" value="<?php echo $padre?>"></td>
				<td><input class="entradatx" type="text" name="madre" maxlength="50" size="50" value="<?php echo $madre?>"></td>
			</tr>
		</table>

		<table>
	<tr>
		<td>Padrino(s): </td>
		<td><input class="entradatx" type="text" name="padrino" maxlength="50" size="50" value="<?php echo $padrino?>"></td>

		<?php
		if ($solicitud==1) {
			echo "<td><input class='entradatx' type='text' name='madrina' maxlength='50' size='50' value='".$madrina."'></td>";
		}

		?>
</table>
<table style="background: #ccff66;">
	<tr>
		<td>Nacio el: </td>
		<td><input class="entradatx" type="date" name="fechanac" size="10" value="<?php echo $fecNac;?>"></td>
		<td>en:</td>
		<td><input class="entradatx" type="text" name="lugarnac" placeholder='entidad-colonia...' size="50"></td></tr>
</table>
<table><tr>
<?php
	if ($para==1) {
		$notaPie="Valida para tramitar matrimonio en la parroquia de";
	}else{
		$notaPie="";
	}


	if ($solicitud==1) {
		echo "<td>Nota marginal:</td><td></td><td><input  class='entradatx' type='text' name='notamar' size='1'  maxlenght='1'></td><td><textarea class='entradaarea' rows='4' cols='50' name='txnotamar'></textarea></td>"."	<td>Nota al pie:</td><td><textarea class='entradaarea' rows='4' cols='50' name='notapie'>".$notaPie."</textarea></td></tr></table>";
		echo "<input type='hidden' name='clave' value='".$clave."' visible='hidden'>";
	}elseif ($solicitud==2) {

		?>
	<table >
	<tr>
		<td>Bautizado el: </td>
		<td><input class='entradatx' type="date" name="fechabau" size="10">
			<br><input class='entradatx' type="text" name="xdiacon" size="2" placeholder="xdia"><input class='entradatx' type="text" name="xmescon" size="10" placeholder="xmes"><input class='entradatx' type="text" name="xanocon" size="2" placeholder="xaño"></td>
		<td>en:</td>
		<td><input class='entradatx' type="text" name="parrbau" maxlength="50" size="50"></td>
		<td>de:</td>
		<td><input class='entradatx' type="text" name="lugarbau" maxlength="50" size="50"></td>
	</tr>
	<tr>
		<td>datos:</td>
		<td><input class='entradatx' type="text" name="librobau" size="20" placeholder="l.a. de bau"></td>
	</tr>
</table>

<?php
	}
}
?>

		<input type='submit' name='' value='Imprimir'>
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
