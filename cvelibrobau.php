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
<section>
	<form action="caplibbau.php" method="POST" name="f1">
	<table>
	<tr>
		<td>Libro: </td>
		<td><input type="text" name="libro" maxlength="4" size="4" pattern="[0-9]" required /></td>
		<td><input type="text" name="librobis" maxlength="4" size="4" placeholder="L/N/LN"></td>

		<TD>Foja: </TD>
		<td><input type="text" name="foja" maxlength="5" size="5" required /></td>

		<td>Acta: </td>
		<td><input type='text' name='partidan' maxlength='4' size='4' required /></td>
		<td><input list="valores" name="partidaab" maxlength='1' size='1' placeholder='A/B' pattern="[A-B]{1}"></td>

		<datalist id="valores"> <option value=""> <option value="A"> <option value="B"></datalist>
		<td><input type="button" name="continua" value="Continuar" onclick="comprobarFoja()"></td>
		<td ><input  type="button" name="libro" onclick="enviab('libro.php')" value="Actas en Libro"  ></td>
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
	function comprobarFoja(){
		clave3 = document.f1.partidaab.value;
    clave1 = document.f1.foja.value;
		clave2 = document.f1.partidan.value;
		clave4 = document.f1.libro.value;

		if (clave3 == "A" || clave3 == "B"){
	    if (clave1 != clave2 )
	       alert("La Foja y el Acta son distintas O VACIAS...\nRealizaríamos las acciones del caso negativo");
			else {
				document.f1.submit();
			}
		}
		else{
			document.f1.submit();
		}
	}

	</script>


  <footer>
    Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
  </footer>


</body>
</html>
