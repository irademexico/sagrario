<?php 
	$numSolicitud=$_GET['numSolicitud'];

	$con= new mysqli("localhost", "root", "", "sagrario");

	$basebajo='solicitudes';
	$baselocal='solic_local';

	$sql="UPDATE $basebajo SET  status='4' WHERE numSolicitud=$numSolicitud";
	$result=mysqli_query($con, $sql) or die ("no cambio el status");

	$sql="UPDATE $baselocal SET  status='4' WHERE numSolicitud=$numSolicitud";
	$result=mysqli_query($con, $sql) or die ("no cambio el status");


	$sql= "SELECT * FROM solic_local  WHERE numSolicitud=$numSolicitud";
	$listasol= mysqli_query($con, $sql) or die("no encontro solicitud");
	$consulta= mysqli_fetch_array($listasol);

	$paterno=$consulta['apPaterno'];
	$materno=$consulta['apMaterno'];
	$esposa=$consulta['esposa'];
	$esposo=$consulta['esposo'];
	$fechanac=$consulta['fecNac'];
	$fecsacr=$consulta['fecSacr'];
	$madre=$consulta['madre'];
	$madrina=$consulta['madrina'];
	$nombre=$consulta['nombre'];
	$padre=$consulta['padre'];
	$padrino=$consulta['padrino'];
	$solicitud=$consulta['solicitud'];
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
    <link href="img/favicon.png" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <header style="font-size: 1em; height: 35px;">
    <p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
    Sistema Archivo
  </header>
  <section style="font-size: 1em">
    <form name="form" method="POST" action='busca.php'>
      <input  type="submit" name="home" onclick="enviab('archivo.php')" value="Inicio"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
      
      Clave L.F.A.<input type="text" name="clave">
      <input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca Acta"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
      <input  type="submit" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
      <input  type="submit" name="buscara" onclick="enviab('buscara.php')" value="Busqueda avanzada"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
      <input  type="submit" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib. bautismo"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
    </form>
  </section>
	<?php
		$meses = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');

		$con= new mysqli("localhost", "root", "", "sagrario");

		if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}
		//$clave1=substr($clave,0,1);
		$solic='solic_local';
		if ($solicitud==1) {
			$base='bautismo';
			$titulo="NUEVA ACTA DE BAUTISMO";
		}elseif ($solicitud==2) {
			$base='confirma';
			$titulo="NUEVA ACTA DE CONFIRMACION";
		}else{
			$base="matrimonio";
			$titulo="NUEVA ACTA DE MATRIMONIO";
		}

	?>

	<form action="capnva.php" method="POST">
		<h3><?php echo $titulo;?></h3>
	<table>
	<tr>
		<td>Solicitud: </td>
		<td><strong><?php echo $numSolicitud;?></strong></td>
		<input type="hidden" name="solicitud" value="<?php echo $solicitud?>">
		<input type="hidden" name="numSolicitud" value="<?php echo $numSolicitud;?>">
		<td> - Libro: </td>
		<td><input type="number" name="libro" maxlength="4" size="4"></td>
		<td><input type="text" name="librobis"	maxlength="2" size="4" placeholder="L/N/LN/E"></td>
		<td>Foja:</td>
		<td><input type="number" name="foja" maxlength="4" size="4"></td>
		<td><input type="text" name="fojac" maxlength="3" size="4" placeholder="FTE/VTA"></td>

		<td>Acta: </td>
		<td><input type='number' name='partidan' maxlength='4' size='4'></td>
		<td><input type='text' name='partidaab' maxlength='1' size='1' placeholder='A/B'></td>
		<?php echo "<td><input type='number' name='registro' maxlength='2' size='2' placeholder='reg.'></td>";
		
		?>
		<td><input type="submit" name="" value="Continuar"></td>
	</tr>

</table>



		<table style="background: #ccff66;">
			<tr>
			<td></td>
			<td><?php echo "<input type='hidden' data-date-format='dd/mmmm/aaaa'   name='fecsacr'  size='10' value='".$fecsacr."' >"?></td>
			</tr>
		</table>
	<table width="180" border="0">
			<tr>
				<td></td>
				<td><?php echo "<input type='hidden' name='nombre' maxlength='30' size='30' value='".$nombre."' >" ?></td>
				<td><?php echo "<input type='hidden' name='paterno' maxlength='30' size='30' value='".$paterno."' >" ?></td>
				<td><?php echo "<input type='hidden' name='materno' maxlength='30' size='30' value='".$materno."' >" ?></td>
			</tr>
		</table>
<table style="background: #ccff66;">
		<tr><td></td>
			<td>  <?php echo "<input type='hidden' name='padre' maxlength='50' size='40' value='".$padre."' >" ?></td>
			<td>  <?php echo "<input type='hidden' name='madre' maxlength='50' size='40' value='".$madre."' >" ?></td>
		</tr>
		</table>
<table>
	<tr>
		<td></td>
		<td><?php echo "<input type='hidden' name='padrino' maxlength='50' size='50' value='".$padrino."' >"  ?></td>
		<td><?php echo "<input type='hidden' name='madrina' maxlength=´50' size='50' value='".$madrina."' >";	?></td>
</table>
<table style="background: #ccff66;">
	<tr>
		<td></td>
		<td><?php echo "<input type='hidden' name='fechanac' size='10' value='".$fechanac."'>";?></td>
		<td></td>
		</tr>
</table>
<table>
</form>

	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){ 
		document.form.action= pag 
		document.form.submit() 
	} 
	</script>	

</body>
</html>