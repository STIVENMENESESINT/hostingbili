<?php
include_once("db.php"); // Incluir archivo de conexión

$mihtml = '<table border="1">';	
$mihtml .= '<thead>';
$mihtml .= '<tr>';
$mihtml .= '<th>Identificacion Del Aspirante</th>';
$mihtml .= '<th>Nombre Del Aspirante </th>';
$mihtml .= '<th>Correo Electronico Del Aspirante</th>';
$mihtml .= '<th>Fecha</th>';
$mihtml .= '<th>Observación</th>';
$mihtml .= '<th>Programa De Formación Al Que Aspira</th>';
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '<tbody>';

// Realizar la consulta SQL
$query = "SELECT * FROM matriculaobs";
$resultado = mysqli_query($conexion, $query);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error al obtener datos: " . mysqli_error($conexion));
}


// Iterar sobre los resultados y construir las filas de la tabla
while ($matriculaobs = mysqli_fetch_assoc($resultado)) {
    $mihtml .= '<tr>';
    $mihtml .= '<td>'.$matriculaobs['idobs'] . "</td>";
    $mihtml .= '<td>'.$matriculaobs['idalumno'] . "</td>";
    $mihtml .= '<td>'.$matriculaobs['codalumno'] . "</td>";
    $mihtml .= '<td>'.$matriculaobs['codmatri'] . "</td>";
    $mihtml .= '<td>'.$matriculaobs['fecha'] . "</td>";
    $mihtml .= '<td>'.$matriculaobs['obs'] . "</td>";
    $mihtml .= '<td>'.$matriculaobs['programaformacion'] . "</td>";
    $mihtml .= '</tr>';		
}

$mihtml .= '</tbody>';
$mihtml .= '</table>';

// Usar Dompdf para generar el PDF
use Dompdf\Dompdf;
require_once("dompdf/autoload.inc.php");

$dompdf = new Dompdf(); // Crear instancia de Dompdf

// Cargar el HTML en Dompdf
$dompdf->load_html('<h1 style="text-align: center;"> Lista Postulacion A Programa De Formacion Nuevo</h1>'. $mihtml);

// Renderizar el PDF
$dompdf->render();

// Descargar el PDF en el navegador
$dompdf->stream("Lista_postulados.pdf", array("Attachment" => true));
?>
