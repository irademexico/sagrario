<?php 
    

include("conectarse.php");
    $numSol='1842.18';

    
    $base='solic_local';
    $sql="UPDATE solic_local SET nombre='nana' WHERE numSolicitud=$numSol ";

    $result = mysqli_query($con, $sql);



?>