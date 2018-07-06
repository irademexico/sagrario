<?php
	$numSolicitud=$_GET['numsol'];

	$con= new mysqli("localhost", "root", "", "sagrario");

	$basebajo='solicitudes';
	$baselocal='solic_local';

	$sql="UPDATE $basebajo SET  status='1' WHERE numSolicitud=$numSolicitud";
	$result=mysqli_query($con, $sql) or die ("no cambio el status");

	$sql="UPDATE $baselocal SET  status='1' WHERE numSolicitud=$numSolicitud";
	$result=mysqli_query($con, $sql) or die ("no cambio el status");
	header("Location: baja.php");
?>
