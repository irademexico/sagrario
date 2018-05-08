<?php 
//	$Sol=$_POST['numSol'];
$numSol=$_GET['numSol'];
//	echo $sol2;

	$consulta=ConsultarSolicitud($_GET['numSol']);
	$hoy=date('Y-m-d');
	$nn=$consulta['2'];
//	echo $hoy.$nn;

	function ConsultarSolicitud($n_sol){
		$con= new mysqli("localhost", "root", "", "sagrario");
		if ($con->connect_errno){
		echo "conexion erronea";
		exit();
		}

		$base='solicitudes';
		$sql="SELECT * FROM $base WHERE numSolicitud = $n_sol ";
		$resul = mysqli_query($con, $sql);
		$solicitud=$resul->fetch_assoc();
		return[
			$solicitud['numSolicitud'],
			$solicitud['fecaSolicitud'],
			
			$solicitud['nombre'],
			$solicitud['apPaterno'],
			$solicitud['apMaterno'],
			
			$solicitud['esposa'],
			$solicitud['esposo'],

			$solicitud['padre'],
			$solicitud['madre'],

			$solicitud['padrino'],
			$solicitud['madrina'],

			$solicitud['fecSacr'],
			$solicitud['fecNac'],
			
			$solicitud['solicitud']
		];
	}

?>
<html>
<head>
	<meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Solicitudes</title>

    <meta name="description" content="Archivo Sagrario Metropolitano" />
    <meta name="keywords" content="sagrario, metropolitano" />

    <link href="css/normalize.css" rel="stylesheet" type="text/css" />

    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="img/favicon.png" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css">-->
</head>

<body>
	<CENTER>
	<header style="font-size: 1em; height: 35px;">
		<p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
	</header>
	</CENTER>
	<section style="font-size: 1em">
		<form name="form" method="POST" action=''>
			<input type="text" name="clave">
            		
			<input  type="submit" name="busca" onclick="enviab('buscasol.php')" value="Busca"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="versol" onclick="enviab('ver_solicitudes.php')" value="Solicitudes"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="sube" onclick="enviab('envia.php')" value="Envia a USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>

	</section>
<section>
<?php
	if ($consulta[13]==1) {
		$solDe='Bautismo';
	}elseif ($consulta[13]==2) {
		$solDe='Confirmación';
	}else{
		$solDe='Matrimonio';
	}
?>	
	
<form action="actualiza_solicitud.php" method="POST">
	
	<article>
			<p style="height: 10px">SOLICITUDES</p>
			<p>Solicitud num.: <?php echo $consulta[0]." de ".$solDe."   Fecha: ".$consulta[1]; ?></p>
			<input type="hidden" name="numSol" value="<?php echo $consulta[0]?>">
	</article>
	<article id="fNombre" style="white-space: wrap; overflow: hidden;visibility: visible; align-content: left;">
		<table>
			<tr width="600">
				<td style="padding: 10 10 10 10;">
					Nombre:<input type="text" name="nombre" value="<?php echo $consulta[2] ?>" width="25" >
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Paterno:<input type="text" name="apPaterno" value="<?php echo $consulta[3] ?>" size="25">
				</td>
				<td style="padding: 10 10 10 10;">
					Apellido Materno:<input type="text" name="apMaterno" value="<?php echo $consulta[4] ?>" size="25">
				</td>

			</tr>
		</table>
	</article>
	<?php echo $consulta[4] ?>
	<article id="fEsposos" style="white-space: wrap; overflow: hidden;visibility: visible;">
		
		<table>
			<tr>
				<td style="padding: 10 10 10 10;">
					Esposo:<input type="text" name="esposo" value="<?php echo $consulta[6] ?>" size="50">
				</td>
				<td style="padding: 10 10 10 10;">
					Esposa:<input type="text" name="esposa" value="<?php echo $consulta[5] ?>" size="50">
				</td>
			</tr>
		</table>
	</article>
	<article id="fPadres" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 20 20 20 20;">
				Padre:<input type="text" name="padre" value="<?php echo $consulta[7] ?>" size="50" >
			</td>
			<td style="padding: 10 10 10 10;">
				Madre:<input type="text" name="madre" value="<?php echo $consulta[8] ?>" size="50">					
			</td>
		</tr>
	</table>
	</article>
	<article id="fPadrinos" style="white-space: wrap; overflow: hidden;visibility: visible;">
		<table>
		<tr>
			<td style="padding: 10 10 10 10;">
				Padrino:<input type="text" name="padrino" value="<?php echo $consulta[9] ?>" size="50">
			</td>
			<td style="padding: 10 10 10 10;">
				Madrina:<input type="text" name="madrina" value="<?php echo $consulta[10] ?>" size="50">					
			</td>
		</tr>
			<tr >
				<td>
					Fecha del Sacramento: <input type="date" name="fecSacr" value="<?php echo $consulta[11] ?>">
				</td>
				
				<td> de Nacimiento: <input type="date" name="fecNac" value="<?php echo $consulta[12] ?>">
				</td>
			<td>Nota:</td><td><textarea rows='4' cols='50' name='notaPie'></textarea></td></tr>
		</table>
	</article>
	
	<p align="center">
	<tr>
		<input type="submit" name="" value="Actualizar">
	</tr>
	</p>
</form>
</section>
	<script type="text/javascript">
			
			function myVisible(){
				document.getElementById("fBautismo").style.visibility = 'visible';
				document.getElementById("fNombre").style.visibility = 'visible';
				document.getElementById("fEsposos").style.visibility = 'hidden';
				document.getElementById("fConfirma").style.visibility = 'hidden';
				document.getElementById("fMatrimonio").style.visibility = 'hidden';
				document.getElementById("fMatri").style.visibility = 'visible';
				document.getElementById("fPadres").style.visibility = 'visible';
				document.getElementById("fNacimiento").style.visibility = 'visible';
				document.getElementById("fPadrinos").style.visibility = 'visible';
			}
			function myVisible2(){
				document.getElementById("fBautismo").style.visibility = 'hidden';
	   			document.getElementById("fConfirma").style.visibility = 'visible';
	   			document.getElementById("fMatrimonio").style.visibility = 'hidden';
	   			document.getElementById("fMatri").style.visibility = 'hidden';
				document.getElementById("fNombre").style.visibility = 'visible';
				document.getElementById("fEsposos").style.visibility = 'hidden';
				document.getElementById("fPadres").style.visibility = 'visible';
				document.getElementById("fNacimiento").style.visibility = 'hidden';
				document.getElementById("fPadrinos").style.visibility = 'visible';
			}
			function myVisible3(){
				document.getElementById("fBautismo").style.visibility = 'hidden';
	   			document.getElementById("fConfirma").style.visibility = 'hidden';
	   			document.getElementById("fMatrimonio").style.visibility = 'visible';
	   			document.getElementById("fMatri").style.visibility = 'hidden';
	   			document.getElementById("fNombre").style.visibility = 'hidden';
				document.getElementById("fEsposos").style.visibility = 'visible';
				document.getElementById("fPadres").style.visibility = 'hidden';
				document.getElementById("fPadrinos").style.visibility = 'hidden';
				document.getElementById("fNacimiento").style.visibility = 'hidden';
			}
			function verAprox(){
				if(document.getElementById("original").checked){
					document.getElementById("hasta").style.visibility = 'hidden'
				}
				else{
					document.getElementById("hasta").style.visibility = 'visible'
				}
			}
	</script>
	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){ 
		document.form.action= pag 
		document.form.submit() 
	} 
	</script>
	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>
</body>
</html>