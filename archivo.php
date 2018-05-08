<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
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
	</header>
	<section style="font-size: 1em">
		<form name="form" method="POST" action='busca.php'>
			<input  type="submit" name="home" onclick="enviab('archivo.php')" value="Inicio"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			
			Clave L.F.A.<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca Acta"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="buscara" onclick="enviab('buscara.php')" value="Busqueda avanzada"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib. bautismo"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>
			<?php 
			$clave=" ";
			if(isset($_POST['baja'])){

				$clave = "'".$POST['btn_clave']."'";
				echo "$clave  ".$clave;
			}
			echo "$clave  ".$clave;
						$con= new mysqli("localhost", "root", "", "sagrario");
						$base= "bautismo";
						$solic="solic_local";

						if ($con->connect_errno){
						    echo "conexion erronea";
						    exit();
						}

						$resul = mysqli_query($con, "SELECT * FROM $base WHERE clave = $clave");
			?>
	<section class="botton-large">
		<form action="baja.php">
			<input  type="submit" name="" value="Obtener solicitudes desde USB"  style="background-color: #a4d279; width: 100%; height: 18%; color: #1c541d; font-size: 3em;  border-style: groove; border-radius: 10px 10px 10px 10px">
		</form>
	</section>

	<section class="botton-large">
		<form action="cvebau.php">
			<input  type="submit" name="" value="Nueva acta de Bautizo"  style="background-color: #a4d279; width: 100%; height: 18%; color: #1c541d; font-size: 3em;  border-style: groove; border-radius: 10px 10px 10px 10px">
		</form>
	</section>
	
	<section class="botton-large">
		<form action="cvecon.php">
			<input  type="submit" name="" value="Nueva acta de Confirmación"  style="background-color: #a4d279; width: 100%; height: 18%; color: #1c541d; font-size: 3em;  border-style: groove; border-radius: 10px 10px 10px 10px">
		</form>
	</section>
	<section class="botton-large">
		<form action="cvemat.php">
			<input  type="submit" name="" value="Nueva acta de Matrimonio"  style="background-color: #a4d279; width: 100%; height: 18%; color: #1c541d; font-size: 3em;  border-style: groove; border-radius: 10px 10px 10px 10px">
		</form>
	</section>
	

	<SCRIPT LANGUAGE="JavaScript">
	function enviab(pag){ 
		document.form.action= pag 
		document.form.submit() 
	} 
	</script>	
<!-- <input type="text" name="legNat"	maxlength="100"  style=" word-wrap: break-word; word-break: break-all; height: 100px;"> -->
	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>

</body>
</html>