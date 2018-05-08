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

    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link href="img/favicon.png" rel="icon" type="image/png" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>  
    <header style="font-size: 1em; height: 35px;">
        <p style="font-size: 1.3em;height: 15px;">SAGRARIO METROPOLITANO</p>
        Sistema Archivo
    
   
   
        <form name="form" method="POST" action=''>
            <input  type="submit" name="newsol" onclick="enviab('cap_solicitudes.php')" value="Nueva Solicitud"  style="background-color: #a4d279; width: auto; height: 30px; color: #1c541d; font-size: .8em;  border-style: groove; border-radius: 10px 10px 10px 10px" >
        </form>

    
</header>
<article><h1>Solicitudes enviadas al Archivo</h1></article>


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

exec("envia.bat");

$sql="UPDATE $base set status = 2 WHERE status= 1;";
$actualiza=mysqli_query($con, $sql);
mysqli_close($con);


?>
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
