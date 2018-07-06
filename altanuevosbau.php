<?php 
	$fechasacr=$_POST['fechabau'];
	$ministro=$_POST['ministro'];
	$regCivil=$_POST['regCivil'];
	$lugarRegCivil=$_POST['lugarRegCivil'];
	$fechaRegCivil=$_POST['fechaRegCivil'];
	$fecNac=$_POST['fecNac'];
	$lugarNac=$_POST['lugarNac'];
	$nombre=$_POST['nombre'];
	$paterno=$_POST['paterno'];
	$materno=$_POST['materno'];
	$hijoa=$_POST['hijoa'];
	$padre=$_POST['padre'];
	$madre=$_POST['madre'];
	$domicilio=$_POST['domicilio'];
	$colonia=$_POST['colonia'];
	$lugarde=$_POST['lugarde'];
	$padrino=$_POST['padrino'];
	$madrina=$_POST['madrina'];
	$clave=$_POST['clave'];
	
	$con=new mysqli("localhost", "root", "", "sagrario");
	if (!empty($nombre)) {
		$sql="INSERT INTO nuevosbautismo (id, fechasacr, ministro, lugarnac, fechanac, nombre, paterno, materno, padre, madre, padrino, madrina, hijoa, domicilio, colonia, lugarde, registroc, lugregciv, fecregciv) VALUES (null, '$fechasacr', '$ministro', '$lugarNac', '$fecNac', '$nombre', '$paterno', '$materno', '$padre', '$madre', '$padrino', '$madrina', '$hijoa', '$domicilio', '$colonia', '$lugarde', '$regCivil', '$lugarRegCivil',  '$fechaRegCivil')";
		$result=mysqli_query($con, $sql);
	}
	header("Location: http://localhost/archivo/datosnuevosbau.php?fechabau=$fechasacr&ministro=$ministro");
 ?>