<?php 
	require("conexion.php");
	error_reporting(0);

	define('JSONlocal', '../data-1.json');

	$data = file_get_contents(JSONlocal);
	$items = json_decode($data, true);
	 $tabla='';

	$estado = $_POST['estado'];

	// echo $estado;

    $consulta_personas = mysqli_query($enlace_db, "SELECT `intel_estado`, `intel_bienes` FROM `tb_intelcost_guardados` WHERE  `intel_estado`='".$estado."' ");
    $resultado_personas = mysqli_fetch_all($consulta_personas);


    for ($i=0; $i < count($items) ; $i++) { 
    	for ($c=0; $c < count($resultado_personas); $c++) { 

    		if ( $items[$i]["Id"] == $resultado_personas[$c][1]) {
    		$tabla.= "<table id='tabla_items".$i."'>
				<tr>
				   <td rowspan='8'></td>
				   <td rowspan='8'>
				    <img style='width: 80%' src='img/home.jpg' /> 
				   </td>
		  		</tr>
			  	<tr>
				   <td scope='row'>Direccion: </td>
				   <td>".$items[$i]["Direccion"]."</td>
			  	</tr>
			  	<tr>
				   <td>Ciudad: </td>
				   <td>".$items[$i]["Ciudad"]." </td>
			  	</tr>
			  	<tr>
				   <td>Telefono: </td>
				   <td>".$items[$i]["Telefono"]."</td>
			  	</tr>
			  	<tr>
				   <td>Codigo postal: </td>
				   <td>".$items[$i]["Codigo_Postal"]."</td>
			  	</tr>
			  	<tr>
				   <td>Tipo: </td>
				   <td>".$items[$i]["Tipo"]." </td>
			  	</tr>
			  	<tr>
				   <td>Precio: </td>
				   <td>".$items[$i]["Precio"]."</td>
			  	</tr>	
			  	<tr>
				   <td></td>
				   <td><button class='btn red' id='btn_casa' onclick='eliminar_datos(".$c.")' type='button'>Eliminar</button></td>
			  	</tr>			  
		    	</table><br>";

				$salidaJson = array(
					"respuesta" => "done", 
					"tabla" => $tabla
				);
    		}	
    	}
    }

					
	echo json_encode($salidaJson);

    // echo $tabla;

?>