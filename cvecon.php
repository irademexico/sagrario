<!DOCTYPE html>
<html >
<head>
	<meta charset="u
	tf-8">
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

	
	<form action="capcon.php" method="POST">
	<table>
	<tr>
		<td>Solicitud: </td>
		<td><input type="number" name="solicitud" maxlength="10" width="5" size="5" step=".01"></td></tr>
		<tr>
		<td>Libro: </td>
		<td><input type="number" name="libro" maxlength="4" size="4"></td>
		<td><input type="text" name="librobis"	maxlength="2" size="2" placeholder="bis"></td>
		
		<td>Foja:</td>
		<td><input type="number" name="foja" maxlength="4" size="4"></td>
		<td><input type="text" name="fojac" maxlength="3" size="4" placeholder="FTE/VTA"></td>
		<td>Acta: </td>
		<td><input type='number' name='acta' maxlength='4' size='4'></td>
		<td><input type='number' name='reg' maxlength='2' size='1' placeholder="reg"></td>
		<td><input type='text' name='actaab' maxlength='4' size='4' placeholder="A/B"></td>
		<tr><td></td><td></td><td></td><td></td>
			<td><input type="submit" name="" value="Continuar"></td></tr>
		
	</tr>

</table>
</form>
</body>
</html>
