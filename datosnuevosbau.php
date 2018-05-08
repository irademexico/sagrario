<?php 


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
	
	<section style="font-size: 1em">
		<form name="form" method="POST" action=''>
			<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="imprime" onclick="enviab('print.php')" value="Imprime"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="baja" onclick="enviab('baja.php')" value="Baja de USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>
</header>
<?php

$con=new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    		echo "conexion erronea";
    		exit();
		}


$fechabau=$_POST['fechabau'];
$libro=$_POST['libro'];
$foja=$_POST['foja'];
$partidan=$_POST['partidan'];
$partidaab=$_POST['partidaab'];
$ministro=$_POST['ministro'];

?>
<form action="altanuevosbau.php" method="POST">
	<table style="text-align: left;">
	<tr>
		<td>Fecha de Bautismo: </td>
		<td style="font-size: 1.3em;"><?php echo $fechabau; ?></td>
	</tr>
		<td>Libro: </td>
		<td style="font-size: 1.3em;"><?php echo $libro;?></td>
		<td>Acta: </td>
		<td style="font-size: 1.3em;"><?php echo $partidan;?> </td>
		<td style="font-size: 1.3em;"><?php echo $partidaab;?></td>

	</tr>

	<tr>
		<td>Ministro:</td><td style="font-size: 1.3em;"><?php echo $ministro;?>
	</tr>
	
</table>


<?php
$clave=$libro."-".$foja."-".$partidan."-".$partidaab;


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

$base='datosbautismos';
$sql="UPDATE $base SET libro='$libro' foja=$foja partidan=$partidan partidaab=$partidaab ministro=$ministro";

$result = mysqli_query($con, $sql);



//$sql="INSERT INTO nuevosbautismo (clave, inicial, libro, foja, partidan, partidaab, fechasacr, ministro, lugarnac, fechanac, nombre, paterno, materno, hijoa, padre, madre, padrino, madrina,  domicilio, colonia, lugarde, cpdom, parroquia, registroc, lugregciv, fecregciv) VALUES ('".$clave."', '".$inicial."', '".$libro."', '".$foja."', '".$partidan."', '".$partidaab."', '".$fechasacr."', '".$ministro."', '".$lugarnac."', '".$fechanac."', '".$nombre."', '".$paterno."', '".$materno."', '".$hijoa."', '".$padre."', '".$madre."', '".$padrino."', '".$madrina."', '".$domicilio."', '".$colonia."', '".$lugarde."', '".$cpdom."', '".$parroquia."', '".$registroc."', '".$lugregciv."', '".$fecregciv."')"
$base='nuevosbautismo';
$sql="INSERT INTO $base (clave, libro, foja, partidan, partidaab, fechasacr, ministro) VALUES ('".$clave."', '".$libro."', '".$foja."', '".$partidan."', '".$partidaab."', '".$fechabau."', '".$ministro."')";
$result = mysqli_query($con, $sql);

?>

	<input type="hidden" name="clave" value="<?php echo $clave?>">
	<article style="text-align: left;">
		Registro Civil: <input type="text" name="regCivil" maxlength="35" size="35">
		Entidad: <input type="text" name="lugarRegCivil" maxlength="50" size="50">
		Fecha de Reg.: <input type="date" name="fechaRegCivil"  size="30">
	</article>
	<article style="text-align: left;">
		Fecha Nacimiento: <input type="date" name="fecNac" size="10">
		Lugar: <textarea rows="1" cols="75" name="lugar"></textarea>
	</article>
	<article style="text-align: left;">
		Nombre: <input type="text" name="nombre" maxlength="50" size="50"><br>
		Apellido Paterno:<input type="text" name="paterno" maxlength="50" size="50"><br>
		Apellido Materno:<input type="text" name="materno" maxlength="50" size="50">	
	</article>
	<article style="text-align: left;">
		Hij:<input type="text" name="hijoa"  maxlength="1" size="1" placeholder="O/A"> 
		Padre: <input type="text" name="padre" maxlength="50" size="50">
		Madre: <input type="text" name="madre" maxlength="50" size="50">
	</article>
	<article style="text-align: left;">
		<p>Domicilio: <textarea rows="1" cols="50" name="domicilio" placeholder="calle"></textarea></p>
		Colonia: <input type="text" name="colonia" maxlength="30" size="30">   
		Entidad: <input type="text" name="lugarde" maxlength="35" size="30">
	</article>
	<article style="text-align: left;">
		Padrinos: <input type="text" name="padrino" maxlength="50" size="50">
		 y <input type="text" name="madrina" maxlength="50" size="50">
	</article>
	<article style="text-align: left; text-align: center;">
		<input type="submit" value="Continuar">
	</article>

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
