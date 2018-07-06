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
    <link href="img/favicon.ico" rel="icon" type="image/png" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header >
		SAGRARIO METROPOLITANO<br>
		Sistema Archivo
	
		<form name="form" method="POST" action='busca.php'>
			<input class="submitTop" type="submit" name="inicio" onclick="enviab('index.php')" value="Inicio"   >
			<input  class="submitTop"  type="submit" name="archivo" onclick="enviab('archivo.php')" value="Archivo"  >
			
			||<input class="entradaMenu"  type="text" name="clave" placeholder="Clave L-F-A">
			<input  class="submitTop"  type="submit" name="busca" onclick="enviab('busca.php')" value="Buscar"  >||
			<input class="submitTop"   type="submit" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  >
			<input class="submitTop"   type="submit" name="buscara" onclick="enviab('buscara.php')" value="Busqueda"   >
			<input class="submitTop"   type="submit" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib.bautismo"   >
		</form>
	</header>
	
	
	<form action="capmat.php" method="POST">
	<table>
	<tr>
		<td>Solicitud: </td>
		<td><input type="number" name="numSolicitud" maxlength="10" width="5" size="5" step=".01"></td></tr>
		<tr>
		<td>Libro: </td>
		<td><input type="number" name="libro" maxlength="4" size="4"></td>

		<td>Foja:</td>
		<td><input type="number" name="foja" maxlength="4" size="4"></td>
		<td><input type="text" name="fojac" maxlength="3" size="4" placeholder="FTE/VTA"></td>
		<td>Acta: </td>
		<td><input type='number' name='partidan' maxlength='4' size='4'></td>

		<tr><td></td><td></td><td></td><td></td>
			<td><input type="submit" name="" value="Continuar"></td></tr>
		
	</tr>

</table>
</form>
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
