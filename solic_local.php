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

<article><h1>Solicitudes Procesadas</h1></article>

    <section style="font-size: 1em">
        <form name="form" method="POST" action='busca_solic_local.php'>
        	<p>Numero de solicitud: <input type="number" name="solini" step=".01"> - [ solicitud final ] : <input type="number" name="solfin" step=".01"></p>
        	<p>Fecha de solicitud: <input type="date" name="fecsolini"> - [ Fecha final ] : <input type="date" name="fecsolfin"></p>

        	<input type="submit" value="Buscar">

            <!--<input  type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" > -->
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