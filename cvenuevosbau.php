<?php 
header("Content-type: text/html;charset=utf-8");
header("mime-content-type: text/html;charset=utf-8");
header("mime_content-type: text/html;charset=utf-8");
date_default_timezone_set('America/Mexico_City')

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
	<header style="font-size: 1em; height: 35px;">
		<p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
	</header>
	<section style="font-size: 1em">
		<form name="form" method="POST" action=''>
			<input  type="submit" name="nuevo" onclick="enviab('cvenuevosbau.php')" value="Nueva Tanda"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="siguiente" onclick="enviab('signvosbau.php')" value="Sig. Acta"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			
			<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="imprime" onclick="enviab('print.php')" value="Imprimir"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="baja" onclick="enviab('baja.php')" value="Enviar a USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
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

$result = mysqli_query($con, $sql);

$datos=mysqli_fetch_assoc($result);
$hoy=date('Y-m-d');

$fechabau=$hoy;
$libro=$datos['libro'];
$foja=$datos['foja'];
$partidan=$datos['partida'];
$partidaab=$datos['partidaab'];
$ministro=$datos['ministro'];

if ($partidaab=='A') {
	$partidaab='B';
}else{
	$partidaab='A';
	$partidan=$partidan+1;
	$foja=$partidan;
	if ($partidan==501) {
		$libro=$libro+1;
		$foja=1;
		$partidan=1;
		$partidaab='A';
	}
}

?>
	<form action="datosnuevosbau.php" >
	<table style="text-align: left;">
	<tr>
		<td>Fecha de Bautismos: 
		<input class="entrada" type="date"  name="fechabau" maxlength="7" value="<?php echo $hoy ?>"></td>
	</tr>
	

	<tr><td>
		Ministro:<input class="entradatx" type="text" name="ministro" maxlength="50" size="50" value="<?php echo $ministro;?>"></td>
	</tr>
	<tr><td>
		<input class="submitDown" type="submit" value="Continuar"></td>
	</tr>
	
</table>
</form>
</body>
</html>


