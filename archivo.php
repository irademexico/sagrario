<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Archivo</title>
    <meta name="description" content="Archivo Sagrario Metropolitano" />
    <meta name="keywords" content="sagrario, metropolitano" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="img/favicon.ico" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header >
		SAGRARIO METROPOLITANO<br>
		Sistema Archivo
	
		<form name="form" method="POST" action='busca.php'>
			<input class="submitTop" type="button" name="inicio" onclick="enviab('index.php')" value="Inicio"   >
			<input  class="submitTop"  type="button" name="archivo" onclick="enviab('archivo.php')" value="Archivo"  >
			
			||<input class="entradaMenu"  type="text" name="clave" placeholder="Clave L-F-A">
			<input  class="submitTop"  type="submit" name="busca" onclick="enviab('busca.php')" value="Buscar"  >||
			<input class="submitTop"   type="button" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  >
			<input class="submitTop"   type="button" name="buscara" onclick="enviab('buscara.php')" value="Busqueda"   >
			<input class="submitTop"   type="button" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib.bautismo"   >
		</form>
	</header>
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
	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>
</body>
</html>