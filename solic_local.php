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
            <input  class="submitTop"  type="button" name="busca" onclick="enviab('busca.php')" value="Buscar"  >||
            <input class="submitTop"   type="button" name="solic_local" onclick="enviab('solic_local.php')" value="Solicitudes"  >
            <input class="submitTop"   type="button" name="buscara" onclick="enviab('buscara.php')" value="Busqueda"   >
            <input class="submitTop"   type="button" name="caplibbau" onclick="enviab('cvelibrobau.php')" value="Captura Lib.bautismo"   >
        </form>
    </header>

<article><h1>Solicitudes Procesadas</h1></article>

    <section style="font-size: 1em">
        <form name="form1" method="POST" action='busca_solic_local.php'>
        	<p>Numero de solicitud: <input type="number" name="solini" step=".01"> - [ solicitud final ] : <input type="number" name="solfin" step=".01"></p>
        	<p>Fecha de solicitud: <input type="date" name="fecsolini"> - [ Fecha final ] : <input type="date" name="fecsolfin"></p>
          <p>Nombre: <input type="text" name="nombre" > Ap-Paterno: <input type="text" name="paterno" > Ap-Materno: <input type="text" name="materno">  </p>
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
