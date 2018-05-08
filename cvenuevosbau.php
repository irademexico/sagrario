<?php 
header("Content-type: text/html;charset=utf-8");
header("mime-content-type: text/html;charset=utf-8");
header("mime_content-type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City')

 ?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="u
	tf-8">
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
</head>
<body>
	<header style="font-size: 1em; height: 35px;">
		<p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
	</header>
	<section style="font-size: 1em">
		<form name="form" method="POST" action=''>
			<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="imprime" onclick="enviab('print.php')" value="Imprime"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="baja" onclick="enviab('baja.php')" value="Baja de USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>
<?php

$con=new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}

$base='datosbautismos';
$sql="SELECT * FROM $base";

$result = mysqli_query($con, $sql) or die(error_log('no encontro registro agregado'));

$datos=mysqli_fetch_assoc($result);
$hoy=date('Y-m-d');

$fechabau=$hoy;
$libro=$datos['libro'];
$foja=$datos['foja'];
$partidan=$datos['partida'];
$partidaab=$datos['partidaab'];
$ministro=$datos['ministro'];

?>
	<form action="datosnuevosbau.php" method="POST">
	<table style="text-align: left;">
	<tr>
		<td>Fecha de Bautismos: 
		<input type="date" name="fechabau" maxlength="7" value="<?php echo $hoy ?>"></td>
	</tr>
	<tr><td>
		Libro: 
		<input type="number" name="libro" maxlength="4" size="4" value="<?php echo $datos['libro'];?>">
		
		Acta: 
		<input type='number' name='partidan' maxlength='4' size='4' value="<?php echo $datos['partida'];?>">
		<input type='text' name='partidaab' maxlength='1' size='1'  value="<?php echo $datos['partidaab'];?>">
</td>
	</tr>

	<tr><td>
		Ministro:<input type="text" name="ministro" maxlength="50" size="50" value="<?php echo $datos['ministro'];?>"></td>
	</tr>
	<tr><td>
		<input type="submit" value="Continuar"></td>
	</tr>
	
</table>
</form>
</body>
</html>


