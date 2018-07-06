<?php
//Autor: José Ignacio Ruiz Arroyo
//Fecha: 14 - diciembre - 2017

//valores de la base de datos, actualizar cuando el servidor se inicialise
$server = "localhost";
$usuario = "root";
$pass = "";
$nombreBase = "sagrario";


$con= new mysqli("localhost", "root", "", "sagrario");

	if ($con->connect_errno){
		echo "conexion erronea";
		exit();
	}

?>