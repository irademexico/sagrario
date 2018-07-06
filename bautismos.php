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


$fechabau=$datos['fechabau'];
$libro=$datos['libro'];
$foja=$datos['foja'];
$partidan=$datos['partida'];
$partidaab=$datos['partidaab'];
$ministro=$datos['ministro'];

?>
	<form action="altabaunvo.php" method="POST">
	<table style="text-align: left;">
	<tr>
		<td>Fecha de Bautismos: </td>
		<td><input type="date" name="fecBau" maxlength="7" ></td>
	</tr>
		<td>Libro: </td>
		<td><input type="number" name="libro" maxlength="4" size="4" value="<?php echo $datos['libro'];?>"></td>
		<td>Foja:</td>
		<td><input type="number" name="foja" maxlength="4" size="4" value="<?php echo $datos['foja'];?>"> </td>
		<td>Acta: </td>
		<td><input type='number' name='partidan' maxlength='4' size='4' value="<?php echo $datos['partidan'];?>"> </td>
		<td><input type='text' name='partidaab' maxlength='1' size='1'  value="<?php echo $datos['partidaab'];?>"> </td>

	</tr>

	<tr>
		<td>Ministro:</td><td><input type="text" name="ministro" maxlength="50" size="50" value="<?php echo $datos['ministro'];?>"></td>
	</tr>
	<input type="submit" value="Continuar">
</table>
</form>
</body>
</html>


<?php
$clave="";


if ($partidaab=='A') {
	$partidaab='B';
}else{
	$partidaab='A';
	$partida=$partida+1;
	$foja=$partida;
	if ($partida==501) {
		$libro=$libro+1;
		$foja=1;
		$partida=1
		$partidaab='A';
	}
}


$sql="UPDATE $base SET libro='$libro' foja=$foja partida=$partida partidaab=$partidaab ministro=$ministro";

$result = mysqli_query($con, $sql);



//$sql="INSERT INTO nuevosbautismo (clave, inicial, libro, foja, partidan, partidaab, fechasacr, ministro, lugarnac, fechanac, nombre, paterno, materno, hijoa, padre, madre, padrino, madrina,  domicilio, colonia, lugarde, cpdom, parroquia, registroc, lugregciv, fecregciv) VALUES ('".$clave."', '".$inicial."', '".$libro."', '".$foja."', '".$partidan."', '".$partidaab."', '".$fechasacr."', '".$ministro."', '".$lugarnac."', '".$fechanac."', '".$nombre."', '".$paterno."', '".$materno."', '".$hijoa."', '".$padre."', '".$madre."', '".$padrino."', '".$madrina."', '".$domicilio."', '".$colonia."', '".$lugarde."', '".$cpdom."', '".$parroquia."', '".$registroc."', '".$lugregciv."', '".$fecregciv."')"
$base='nuevosbautismo';
$sql="INSERT INTO $base (clave, libro, foja, partidan, partidaab, fechasacr, ministro) VALUES ('".$clave."', '".$libro."', '".$foja."', '".$partidan."', '".$partidaab."', '".$fechabau."', '".$ministro."')"
$result = mysqli_query($con, $sql);

?>


	

	<tr><td>Nombre:</td><td><input type="text" name="nombre" maxlength="50" size="50"></td>
		<td>Apellido Paterno:</td><td><input type="text" name="paterno" maxlength="50" size="50"></td>
		<td>Apellido Matrno:</td><td><input type="text" name="materno" maxlength="50" size="50"></td>
	</tr>
</table>
<article style="text-align: left;">
		Hij:<input type="text" name="hijoa"  maxlength="1" size="1" placeholder="O/A"> 
		Padre: s<input type="text" name="padre" maxlength="50" size="50">
		Madre: <input type="text" name="madre" maxlength="50" size="50">
</article>
<article style="text-align: left;">
	
		Padrino: <input type="text" name="padrino" maxlength="50" size="50">
		Madrina: <input type="text" name="madrina" maxlength="50" size="50">
</article>
<article style="text-align: left;">
	
		Fecha Nacimiento: <input type="date" name="fecNac" size="10">
		Lugar: <textarea rows="1" cols="75" name="lugar"></textarea>

</article>
<article style="text-align: left;">
		Domicilio: <textarea rows="1" cols="50" name="domicilio" placeholder="calle"></textarea>
</article>
<article style="text-align: left;">
	
		Colonia: <input type="text" name="colonia" maxlength="30" size="30">   
		Entidad: <input type="text" name="lugarde" maxlength="35" size="30">
		CP:  <input type="number" name="cpDom" maxlength="5" size="5">
</article>
<article style="text-align: left;">
	
		Parroquia: <input type="text" name="parroquiaDom"  maxlength="50" size="50">
</article>
<article style="text-align: left;">
	

		Registro Civil: <input type="text" name="regCivil" maxlength="35" size="35">
		Entidad: <input type="text" name="lugarRegCivil" maxlength="50" size="50">
		Fecha de Reg.: <input type="date" name="fechaRegCivil"  size="30">
</article>


		<input type="submit" value="Continuar">

</table>
</form>
	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>

	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){ 
		document.form.action= pag 
		document.form.submit() 
	} 
	</script>	
</body>
</html>
