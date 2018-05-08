<?php
$solicitud=$_POST['solicitud'];

$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
		echo "conexion erronea";
		exit();
}
$base='last_solic';
$actualiza="UPDATE  $base SET solicitud='$solicitud' WHERE solicitud>0";
$result = mysqli_query($con, $actualiza);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<script type="text/javascript">
	alert('solicitud actualizada');
</script>
</body>
</html>
