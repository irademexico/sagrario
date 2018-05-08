<?php 
	date_default_timezone_set('America/Mexico_City');
	$hoy=date('Y-m-d');
?>
<!DOCTYPE html>
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
    
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="img/favicon.ico" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css">-->
</head>

<body>
	
	<header >
		<p style="font-size: 1.3em; height: 10px; padding-top: 0px; margin-top: 1px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
		<form name="form" method="POST" action=''>
			<input type="text" name="solini">
            		
			<input  type="submit" name="busca" onclick="enviab('buscasol.php')" value="Busca"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="versol" onclick="enviab('ver_solicitudes.php')" value="Solicitudes"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="sube" onclick="enviab('envia.php')" value="Envia a USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</header>
<section>
	<article style="background-color: #a4d279;">Lista de solicitudes para enviar a archivo</article>
		<table border = '1'>
			<tr>
				<td>Num.Solicitud</td>
				<td>Solicitud de</td>
				<td> Nombre </td>
				<td>Fecha Sacramento</td>
				<td>Padres</td>
				<td>Status</td>
				<td></td> 
			</tr>

<?php 
	$con= new mysqli("localhost", "root", "", "sagrario");
	if ($con->connect_errno){
	echo "conexion erronea";
	exit();
	}
	$base = "solicitudes";
	$num=0;
//  viernes 30......................

	$sql="SELECT * FROM $base WHERE status=1";
	$resul = mysqli_query($con, $sql);
	$filas=mysqli_num_rows(mysqli_query($con, $sql));

	if ($resul) {
	$solic="sin";
	while ($consulta= mysqli_fetch_array($resul))
	{
	if ($consulta['solicitud']== '1') {
	    $txSolicitud = "Bautismo";
	}elseif ($consulta['solicitud']== '2') {
	    $txSolicitud = "Confirmación";
	}else{
	    $txSolicitud = "Matrimonio";
	}
	if ($consulta['status']== '3') {
		$txstatus='cancelada';
	}elseif ($consulta['status']== '2') {
		$txstatus='enviada';
	}else{
		$txstatus='activa';
	}

	++$num;
	echo "<tr><td>".$consulta['numSolicitud']."</td><td>".$txSolicitud."</td><td>".$consulta['nombre']." ".$consulta['apPaterno']." ".$consulta['apMaterno']." ".$consulta['esposo']."-".$consulta['esposa']."</td><td>".$consulta['fecSacr']."</td><td>".$consulta['padre']." y ".$consulta['madre']."</td> <td>".$txstatus."</td><td> 
		<a href= 'cancel_solicitud.php?numSol=".$consulta['numSolicitud']."'><button type='button' class='btn-btn-cancela'>Cancelar</button></a>

		<a href='edita_solicitudes.php?numSol=".$consulta['numSolicitud']."'><button type='button' class='btn-btn-edita'>Editar</button></a></td></tr> ";

	}
	}
	else {
	echo "fallo consulta";
	}
?>
<tr>
	<td colspan="7">.</td>
</tr>
</table>
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
		Derechos Reservados    José Ignacio Virgilio Ruiz Arroyo
	</footer>
</body>
</html>