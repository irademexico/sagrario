<?php 
$clave
$clavevalida
$clavenueva

if ($clave==$clavevalida) {
	$sql = "UPDATE users set pasword='$clavenueva'";
}else{
	echo "no es correcta su contraseña"
	header('Location: index.php');
}

 ?>