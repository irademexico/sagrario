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
    <link href="img/favicon.ico" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header style="font-size: 1em; height: 35px;">
		<p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
		Sistema Archivo
	</header>
	<section style="font-size: 1em">
		<form name="form" method="POST" action=''>
			<input  type="submit" name="busca" onclick="enviab('buscasol.php')" value="Corregir"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="sube" onclick="enviab('envia.php')" value="Envia a USB"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="fechas" onclick="enviab('fechassol.php')" value="Fechas de Confirmación"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>

	<form action="buscafechacon.php" method="POST">
		<table>
			<tr>
				<td>Fecha de Confirmación: </td>
				<td><input type="date" name="fechacon"></td>
			</tr>
							
			<tr>
				<td><input type="submit" name="" value="Consultar"></td>
			</tr>
		</table>
	</form>
</body>
</html>