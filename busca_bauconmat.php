<?php 
$numSol=$_POST['numSol'];
$solicitud=$_POST['solicitud'];
$libro=$_POST['libro'];
$ln=$_POST['ln'];
$acta=$_POST['acta'];
$ab=$_POST['ab'];
$nombre=$_POST['nombre'];
$paterno=$_POST['paterno'];
$materno=$_POST['materno'];
$padre=$_POST['padre'];
$madre=$_POST['madre'];
$padrino=$_POST['padrino'];
$madrina=$_POST['madrina'];
$fechabau=$_POST['fechabau'];
$fechanac=$_POST['fechanac'];
echo $numSol;
echo "<br>".$solicitud ;
echo "<br>".$libro ;
echo "<br>".$ln ;
echo "<br>".$acta ;
echo "<br>".$ab ;
echo "<br>".$nombre ;
echo "<br>".$paterno ;
echo "<br>".$materno ;
echo "<br>".$padre ;
echo "<br>".$madre ;
echo "<br>".$padrino ;
echo "<br>".$madrina ;
echo "<br>".$fechabau ;
echo "<br>".$fechanac ;

switch ($solicitud) {
	case 1:
		$base='bautismo';
		break;
	case 2:
		$base='confirma';
		break;
	case 3:
		$base='matrimonio';
		break;
	default:
		?>
		<script type="text/javascript">
			alert("Seleccione la base de busqueda - Bautismo, Confirmacion, Matrimonio")
			window.history.back();
		</script>
		<?php
		break;
}


$con= new mysqli("localhost", "root", "", "sagrario");
$sql="SELECT * FROM $base WHERE solicitud = $numSol";

 $encontrado=mysqli_query($con, $sql);
    
    while ($buscabase= mysqli_fetch_array($encontrado))
        {
          
          echo "<tr ><td> Solicitud: ".$buscabase['solicitud'] ."</td> <td> Nombre: ".$buscabase['nombre']." ".$buscabase['paterno']." " . $buscabase['materno'] ."</td></tr><tr><td> Padres: ".$buscabase['padre']."<br>".$buscabase['madre']."</td> <td>".$buscabase['padrino']."<br> Padrinos: ".$buscabase['madrina']."</td> <td> Fecha de Nacimiento: ". $buscabase['fechanac'] ."</td></tr><tr> <td> Clave: ". $buscabase['clave']." </td> </tr>";
          }

 ?>