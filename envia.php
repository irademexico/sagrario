<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Solicitudes</title>

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

    <article class="titulo">Solicitudes Enviadas a USB</article>

<section>
<?php 

$con= new mysqli("localhost", "root", "", "sagrario");
if ($con->connect_errno){
    echo "conexion erronea";
    exit();
}
$base = "solicitudes";
$num=0;
$sql="SELECT * FROM $base WHERE status = 1";
$resul = mysqli_query($con, "SELECT * FROM $base WHERE status = 1");
$filas=mysqli_num_rows(mysqli_query($con, $sql));
echo $filas." Solicitudes";
if ($resul) {
    echo "<table border = '1'> \n"; 
    echo "<tr><td>Num.Solicitud</td><td>Solicitud de</td><td> Nombre </td><td>Fec.Sacr.</td><td>Padres</td><td>Padrinos </td> </tr>\n"; 
$solic="sin";
while ($consulta= mysqli_fetch_array($resul)) 
{
    if ($consulta['solicitud']== '1') {
        $txSolicitud = "Bautismo";
    }elseif ($consulta['solicitud']== '2') {
        $txSolicitud = "Confirmación";
    }else{
        $txSolicitud = "Matrimonio";
    }

    ++$num;
   echo "<tr><td>".$consulta['numSolicitud']."</td><td>".$txSolicitud."</td><td>".$consulta['nombre']." ".$consulta['apPaterno']." ".$consulta['apMaterno']." ".$consulta['esposo']."-".$consulta['esposa']."</td><td>".$consulta['fecSacr']."</td><td>".$consulta['padre']." y ".$consulta['madre']."</td> <td>".$consulta['padrino']." - ".$consulta['madrina']."</td> </tr> \n"; 

}

echo "<tr><td colspan='6'>.</td></tr></table>";
}
else {
    echo "fallo consulta";
}
if ($filas==0) {
    
    exec("envia.bat");
    $baselocal='solic_local';
    $sql="INSERT INTO $baselocal SELECT * FROM $base";
    //$sql="UPDATE $base set status = 2 WHERE status= 1;";
    $actualiza=mysqli_query($con, $sql) ;
    $sql="truncate TABLE solicitudes";
    $eliminasol=mysqli_query($con, $sql);
}

mysqli_close($con);


?>
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
