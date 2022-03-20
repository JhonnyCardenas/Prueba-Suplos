<?php
    require_once("PHPExcel/Classes/PHPExcel.php");
    // Validación de datos a mostrar
    error_reporting(0);

    define('JSONlocal', '../data-1.json');

    $data = file_get_contents(JSONlocal);
    $items = json_decode($data, true);

    $ciudad_selector = $_POST['ciudad'];
    $tipo_selector = $_POST['tipo'];


    for ($i=0; $i < count($items) ; $i++) { 

        if ( $items[$i]["Ciudad"] == $ciudad_selector && $items[$i]["Tipo"] == $tipo_selector) {
            $tabla[$i][0]= $items[$i]["Direccion"];                
            $tabla[$i][1]= $items[$i]["Ciudad"];                
            $tabla[$i][2]= $items[$i]["Telefono"];                
            $tabla[$i][3]= $items[$i]["Codigo_Postal"];                
            $tabla[$i][4]= $items[$i]["Tipo"];                
            $tabla[$i][5]= $items[$i]["Precio"];
        }
    }
       
// Creamos nueva instancia de PHPExcel
$objPHPExcel = new PHPExcel();
// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Telefonica")
->setLastModifiedBy($_SESSION['usu_nombre_completo'])
->setTitle("Reporte control turno")
->setSubject("Reporte control turno")
->setDescription("Reporte control turno")
->setKeywords("Reporte control turno")
->setCategory("Reporte");

//Estilos para todo el libro de excel
$objPHPExcel->getDefaultStyle()->getfont()->setName("Calibri");
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
$styleArrayTitulos = array(
'font' => array(
'bold' => true,
'size' =>'8',
'name' =>'Arial',
'color' => array('rgb' => 'FFFFFF')
),
'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'=>true,
),
'fill' => array(
'type' => PHPExcel_Style_Fill::FILL_SOLID,
'color' => array('rgb' => '5bc500')
)
);
$styleArrayTitulos_2 = array(
'font' => array(
'bold' => true,
'size' =>'8',
'name' =>'Arial',
'color' => array('rgb' => 'FFFFFF')
),

'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'=>true,
),
'fill' => array(
'type' => PHPExcel_Style_Fill::FILL_SOLID,
'color' => array('rgb' => '76933C')
)
);
$styleArrayTitulos_3 = array(
'font' => array(
'bold' => true,
'size' =>'8',
'name' =>'Arial',
'color' => array('rgb' => 'FFFFFF')
),

'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'=>true,
),
'fill' => array(
'type' => PHPExcel_Style_Fill::FILL_SOLID,
'color' => array('rgb' => '0F243E')
)
);
$styleArrayTitulos_4 = array(
'font' => array(
'bold' => true,
'size' =>'8',
'name' =>'Arial',
'color' => array('rgb' => 'FFFFFF')
),

'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'=>true,
),
'fill' => array(
'type' => PHPExcel_Style_Fill::FILL_SOLID,
'color' => array('rgb' => '00B050')
)
);
$styleArrayContenido = array(
'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'=>true,
),
);
//Activar Hoja 0 Datos Cliente
$objPHPExcel->setActiveSheetIndex(0);
    //Estilos de la Hoja 0
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(21);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArrayTitulos);
    // $objPHPExcel->getActiveSheet()->setAutoFilter('A1:N1');
    // Escribiendo los titulos
    $objPHPExcel->getActiveSheet()->setCellValue('A1','Direccion');
    $objPHPExcel->getActiveSheet()->setCellValue('B1','Ciudad');
    $objPHPExcel->getActiveSheet()->setCellValue('C1','Telefono');
    $objPHPExcel->getActiveSheet()->setCellValue('D1','Codigo postal');
    $objPHPExcel->getActiveSheet()->setCellValue('E1','tipo');
    $objPHPExcel->getActiveSheet()->setCellValue('F1','Precio');
    //Ingresar Data consultada a partir de la fila 2
    for ($i=2; $i < count($items)+2; $i++) {
            
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$tabla[$i-2][0]);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$tabla[$i-2][1]);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$tabla[$i-2][2]);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$tabla[$i-2][3]);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i,$tabla[$i-2][4]);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i,$tabla[$i-2][5]);
    }
// Nombramos la hoja 0
$objPHPExcel->getActiveSheet()->setTitle('Gestión Bienes');
//Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=Reporte bienes - '.date("Y-m-d").'.xlsx');
header('Cache-Control: max-age=0');
// Guardamos el archivo, en este caso lo guarda con el mismo nombre del php
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>
