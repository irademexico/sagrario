<!DOCTYPE html>
<html>
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

    <link href="img/favicon.png" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>  <CENTER>
    <header style="font-size: 1em; height: 35px;">
        <p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
        Sistema Archivo
    </header>
    </CENTER>
	<section style="font-size: 1em">
		<form name="form" method="POST" action='busca.php'>
			<input  type="submit" name="home" onclick="enviab('index.php')" value="Inicio"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			
			Clave L.F.A.<input type="text" name="clave">
			<input  type="submit" name="busca" onclick="enviab('busca.php')" value="Busca Acta"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  style="background-color: #a4d279; width: 10%; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="buscara" onclick="enviab('buscara.php')" value="Busqueda avanzada"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
			<input  type="submit" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib. bautismo"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
		</form>
	</section>

<article><h1>Busqueda Avanzada</h1></article>

    <section style="font-size: 1em">
        <form name="form" method="POST" action='busca_bauconmat.php'>
            <input type="radio" id="sol" name="solicitud" value="1" checked>Bautismo
            <input type="radio" id="sol" name="solicitud" value="2"  >Confirmacion
            <input type="radio" id="sol" name="solicitud" value="3"  >Matrimonio
        	<P>Numero de solicitud: <input type="number" name="numSol" step=".01"></P>
            <p>Numero de Libro: <input type="number" name="libro"> <input type="text" name="ln" placeholder="L/N/LN" size="3">-  Numero de acta: <input type="number" name="acta" ><input type="text" name="ab" placeholder="ab" size="1"></p>

            <p>Nombre: <input type="text" name="nombre"> Apellido Paterno<input type="text" name="paterno" >-  Apellido Materno: <input type="text" name="materno" ></p>
            <p>Padre<input type="text" name="padre">Madre<input type="text" name="madre"></p>
            <p>Padrino<input type="text" name="padrino" >Madrina<input type="text" name="madrina" ></p>  
            <p>Fecha de Bautismo<input type="date" name="fechabau" > Fecha de Nacimiento<input type="date" name="fechanac" ></p>


        	<input type="submit" value="Buscar">
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