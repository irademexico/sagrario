<?php
	@$libro=$_GET['libro'];
	@$librobis=$_GET['librobis'];
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   	<meta charset="utf-8">
    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  	<title>Libro</title>
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
  <SECTION>
  <SCRIPT LANGUAGE="JavaScript">
  function enviab(pag){
    document.form.action= pag
    document.form.submit()
  }
  </script>

 	<form action="libro.php" method="GET">
 		Libro: <input type="text" name="libro" value="<?php echo $libro ;?>" required>
 		<input type="text" name="librobis" placeholder="L/N/LN" value="<?php echo $librobis ;?>">

 		<input type="submit" value="Muestra">
 	</form>
  </SECTION>

  <footer>
    Derechos Reservados - José Ignacio Virgilio Ruiz Arroyo
  </footer>


 </body>
 </html>
 <?php
 	$con=new mysqli("localhost","root","","sagrario");

	if ($con->connect_errno){
	    echo "conexion erronea";
	    exit();
	}
	$base='bautismo';
	$sql="SELECT clave, partidan,partidaab,fechasacr,nombre,paterno,materno FROM $base WHERE libro='$libro' AND librobis='$librobis' ORDER BY partidan ASC";
	$result= $con->query($sql);
	$reg=0;

	while ($consulta= mysqli_fetch_array($result))
{
  echo ".<table border = '1' style='color:#0000cc; width= 80%;'> \n";


  $reg++;
$clave=$consulta['clave'];	
  echo "<td  style='width: 50px;'>".$consulta['clave']."</td><td>".$consulta['partidan']."-".$consulta['partidaab']."</td> <td  style='width:360px;'>".$consulta['nombre']." ".$consulta['paterno']." ".$consulta['materno'] ."</td><td style='width: 35px;'>".$consulta['fechasacr']."</td><td><a href='capbau.php?clavel=".$clave."'><button>Edita</button></a> </td>";
    }

    echo $reg." - REGISTROS";

  ?>
