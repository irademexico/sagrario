<?php 
    $txSolicitud=$_POST['numSol'];
  
    $nombre = $_POST["nombre"];
    $apPaterno  = $_POST["apPaterno"];
    $apMaterno  = $_POST["apMaterno"];

    $esposo  = $_POST["esposo"];
    $esposa  = $_POST["esposa"];

    $padre  = $_POST["padre"];
    $madre = $_POST["madre"];

    $padrino = $_POST["padrino"];
    $madrina = $_POST["madrina"];

    $fecSacr = $_POST["fecSacr"];
    $fecNac = $_POST["fecNac"];

    $status = 1;

    $con= new mysqli("localhost", "root", "", "sagrario");
    if ($con->connect_errno){
        echo "conexion erronea";
        exit();
    }
    
    $base='solicitudes';
    $sql="UPDATE $base SET nombre='$nombre', apPaterno='$apPaterno', apMaterno='$apMaterno', esposo='$esposo', esposa='$esposa', padrino='$padrino', madrina='$madrina', fecSacr='$fecSacr', fecNac='$fecNac', status='$status', madre='$madre', padre='$padre' WHERE numSolicitud=$txSolicitud";

    $result = mysqli_query($con, $sql);

    if ($con) {
        $con->close();
    }

echo "<script language='javascript'>";
echo "alert('Solicitud Actualizada') ;";
echo "window.location.href = 'ver_solicitudes.php';";
echo "</script>";


?>