<?php 
//Autor: José Ignacio Ruiz Arroyo
//Fecha: 14 - diciembre - 2017 - Inicio del proyecto
//Implantación Beta: 26-marzo-2018.
?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
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
	
		<form name="form" method="" action='#'>
			<input class="submitTop" type="button" name="inicio" onclick="enviab('index.php')" value="Inicio"   >
			<input  class="submitTop"  type="button" name="archivo" onclick="enviab('archivo.php')" value="Archivo"  >
			
			||<input class="entradaMenu"  type="text" name="clave" placeholder="Clave L-F-A">
			<input  class="submitTop"  type="submit" name="busca" onclick="enviab('busca.php')" value="Buscar"  >||

			<input class="submitTop"   type="button" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  >
			<input class="submitTop"   type="button" name="buscara" onclick="enviab('buscara.php')" value="Busqueda"   >
			<input class="submitTop"   type="button" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib.bautismo"   >
		</form>
	</header>

	<section>
		<form action="capbau.php" method="POST">
			<table>
			<tr>
				<td>Solicitud: </td>
				<td><input class="entradatx" type="text" name="solicitud" 	maxlength="9" size="9" step='.01'></td>

				<td>Libro: </td>
				<td><input class="entradatx" type="text" name="libro" 		maxlength="4" size="4"></td>
				<td><input class="entradatx" type="text" name="librobis"	maxlength="2" size="4" placeholder="L/N/LN/E"></td>

				<td>Foja:</td>
				<td><input class="entradatx" type="text" name="foja" 		maxlength="4" size="4"></td>
				<td><input class="entradatx" type="text" name="fojac" 		maxlength="3" size="4" placeholder="FTE/VTA"></td>

				<td>Acta: </td>
				<td><input class="entradatx" type='text' name='partidan' 	maxlength='4' size='4'></td>
				<td><input class="entradatx" type='text' name='partidaab' 	maxlength='1' size='1' placeholder='A/B'></td>
				<td><input class="entradatx" type="submit"  value="Continuar"></td>
			</tr>
			</table>
		</form>
	</section>

	<footer>
		Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
	</footer>

	<SCRIPT LANGUAGE="JavaScript">
		function enviab(pag){ 
			document.form.action= pag 
			document.form.submit() 
		} 
	</script>	
</body>
</html>