<?php 

	CancelaSolicitud($_GET['numSol']);

	function CancelaSolicitud($n_sol){
		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
		echo "conexion erronea";
		exit();
		}
		$status=3;
		$base='solicitudes';
		$sql="UPDATE $base SET status='$status' WHERE numSolicitud = $n_sol ";
		$con->query($sql);
	}

?>
	<script type="text/javascript">
		alert("Solicitud Cancelada");
		window.location.href ="ver_solicitudes.php";
	</script>
