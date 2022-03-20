<?php
	$enlace_db = new mysqli("localhost", "root", "", "intelcost_bienes");
	
	$acentos = mysqli_query($enlace_db, "SET NAMES 'utf8'");
	if ($enlace_db->connect_errno) {
	    echo "Fallo al conectar a Base de Datos: (" . $enlace_db->connect_errno . ") " . $enlace_db->connect_error;
	}
?>