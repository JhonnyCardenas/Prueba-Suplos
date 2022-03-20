<?php 
	require_once("conexion.php");	

	$id = $_POST['id'];
	define('JSONlocal', '../data-1.json');

	$data = file_get_contents(JSONlocal);
	$items = json_decode($data, true);

    for ($i=0; $i < count($items) ; $i++) {
    	if ($items[$i]["Id"] == $id) {
    		$insert = mysqli_query($enlace_db,"INSERT INTO `tb_intelcost_guardados`(`intel_estado`, `intel_bienes`) VALUES ('comprado','".$items[$i]["Id"]."');");
			if ($insert) {
	            $salidaJson = array("respuesta" => "done");
	        }
	        echo json_encode($salidaJson);
    	}
    }

 ?>