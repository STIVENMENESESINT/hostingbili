<?php	

	include_once("db.php");
	$mihtml = '<table border=1';	
	$mihtml .= '<thead>';
	$mihtml .= '<tr>';
	$mihtml .= '<th>ID</th>';
	$mihtml .= '<th>COD Transaccion</th>';
	$mihtml .= '<th>Nombres</th>';
	$mihtml .= '<th>Tipo de Pago</th>';
	$mihtml .= '<th>Estado Transaccion</th>';
	$mihtml .= '<th>E-mail</th>';
	$mihtml .= '</tr>';
	$mihtml .= '</thead>';
	$mihtml .= '<tbody>';
	
	$resultado_transacciones = "SELECT * FROM transacciones";
	$resultado_transacciones = mysqli_query($conectar, $resultado_transacciones);
	while($transacciones = mysqli_fetch_assoc($resultado_transacciones)){
		$mihtml .= '<tr><td>'.$transacciones['id'] . "</td>";
		$mihtml .= '<td>'.$transacciones['transaccion_cod'] . "</td>";
		$mihtml .= '<td>'.$transacciones['nombres'] . "</td>";
		$mihtml .= '<td>'.$transacciones['tipo_pago'] . "</td>";
		$mihtml .= '<td>'.$transacciones['estado_transaccion'] . "</td>";
		$mihtml .= '<td>'.$transacciones['email'] . "</td></tr>";		
	}
	
	$mihtml .= '</tbody>';
	$mihtml .= '</table';

	
	//referencia
	use Dompdf\Dompdf;

	// incluye autoloader
	require_once("dompdf/autoload.inc.php");

	//Creando instancia para generar PDF
	$dompdf = new DOMPDF();
	
	// Cargar el HTML
	$dompdf->load_html('<h1 style="text-align: center;">BaulPHP - Lista de Transacciones</h1>'. $mihtml .'
		');

	//Renderizar o html
	$dompdf->render();

	//Exibibir nombre de archivo
	$dompdf->stream(
		"Lista_Transacciones", 
		array(
			"Attachment" => false //Para realizar la descarga
		)
	);
?>