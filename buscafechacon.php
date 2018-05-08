<?php 
	
	echo $fechacon=$_POST['fechacon'];

	$con= new mysqli("localhost", "root", "", "sagrario");
	if ($con->connect_errno){
	    echo "conexion erronea";
	    exit();
	}
	
	$base='fechascon';

	$sql="SELECT  * FROM $base WHERE fecha = '$fechacon'";

	$result = mysqli_query($con, $sql) or die ('no hay fecha');
	$regs=mysqli_num_rows(mysqli_query($con, $sql));
	if ($regs > 0) {
		
			?> 
				<script type="text/javascript">
					alert("Si hubo fecha de confirmaciones");
					window.location.href ="cap_solicitudes.php";
				</script>


			 <?php
	
		
	 
	}else{
		?>
		<script type="text/javascript">
			alert("NO hubo confirmaciones en esa fecha");
			window.location.href ="cap_solicitudes.php";
		</script>
<?php
	}
	
 ?>