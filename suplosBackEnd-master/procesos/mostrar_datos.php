<?php 
	require("conexion.php");
	error_reporting(0);

	define('JSONlocal', '../data-1.json');

	$data = file_get_contents(JSONlocal);
	$items = json_decode($data, true);

    $tabla='';

    $ciudad_selector = $_POST['ciudadFilter'];
    $tipo_selector = $_POST['tipoFilter'];

    function separar_dinero($dato){
    	$trim_dato = trim($dato, "$");
    	$trim_dato_dinero = str_replace(",", "", $trim_dato);
    	return $trim_dato_dinero;
    }

    $rangoFilterTo = $_POST['rangoFilterFrom'];
    $rangoFilterFrom = $_POST['rangoFilterTo'];


    for ($i=0; $i < count($items) ; $i++) { 

    	if ( $items[$i]["Ciudad"] == $ciudad_selector && $items[$i]["Tipo"] == $tipo_selector && separar_dinero($items[$i]['Precio']) <= $rangoFilterFrom && separar_dinero($items[$i]['Precio']) >= $rangoFilterTo ) {

    		$tabla.= "<table id='tabla_items".$i."'>
				<tr>
				   <td rowspan='8'></td>
				   <td rowspan='8'>
				    <img style='width: 80% ' src='img/home.jpg' /> 
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
				   <td><button class='btn green' id='btn_casa' onclick='guardar_datos(".$i.")' type='button'>Guardar</button></td>
			  	</tr>				  
		    </table><br>";
				$salidaJson = array(
					"respuesta" => "done", 
					"tabla" => $tabla
				);
    	}
    }

					
	echo json_encode($salidaJson);

    // echo $tabla;

?>