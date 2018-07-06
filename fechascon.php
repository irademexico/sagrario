<?php
	date_default_timezone_set('America/Mexico_City');

?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Fechas Confirmación</title>

    <meta name="description" content="Archivo Sagrario Metropolitano" />
    <meta name="keywords" content="sagrario, metropolitano" />

    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="img/favicon.ico" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>


<body>
	<header >
		SAGRARIO METROPOLITANO<br>
		Sistema Archivo

		<form class="formTop" name="form" method="POST" action=''>
			<input class="submitTop" type="submit" name="busca" onclick="enviab('buscasol.php')" value="Corregir"  >
			<input  class="submitTop" type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud" >
			<input  class="submitTop" type="submit" name="sube" onclick="enviab('envia.php')" value="Envia a USB"  >
			<input  class="submitTop" type="submit" name="feccon" onclick="enviab('fechascon.php')" value="Fechas de Confirmacion" >
		</form>
	</header>

	<article class="titulo">Fechas de confirmación</article>


	<section>
		<form action="buscafechacon.php" method="POST">

			<p>Fecha de Confirmación: 
				<input class="entrada" type="date" name="fechacon"></td>
				
				<input class="submitDown" type="submit" name="" value="Consultar">
				
		</form>
	</section>
	<SCRIPT LANGUAGE="JavaScript">
		function enviab(pag){
			document.form.action= pag
			document.form.submit()
		}

		    $(document).ready(function () {
	        $("#input1").keyup(function () {
	            var value = $(this).val();
	            $("#input2").val(value);
	        });
	    });

		        $(document).ready(function () {
	        $("#input3").keyup(function () {
	            var value = $(this).val();
	            $("#input4").val(value);
	        });
	    });
	</SCRIPT>

</body>
</html>