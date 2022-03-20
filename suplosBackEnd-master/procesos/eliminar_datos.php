<?php 
	require_once("conexion.php");	

	$id = $_POST['id'];
	
		$delete = mysqli_query($enlace_db,"DELETE FROM `tb_intelcost_guardados` WHERE `intel_id` = '".$id."';");
		if ($delete) {
	        $salidaJson = array("respuesta" => "done");
	    }
	    echo json_encode($salidaJson);

 ?>