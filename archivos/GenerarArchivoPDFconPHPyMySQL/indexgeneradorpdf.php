<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Generar Archivo PDF con PHP - BaulPHP.com</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">BaulPHP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
     
	
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Busqueda</button>
          </form>
        </div>
      </nav>
    </header>

<!-- Inicio content -->  
 <div class="container">
 <h1 class="mt-5">Generar Archivo PDF con PHP</h1>
 <hr>
<div class="btn btn-primary"><a href="GenerarPDF.php" style="color:#FFF; text-decoration:none; " target="_blank">Visualizar en PDF</a></div>
<div class="btn btn-primary"><a href="DescargarPDF.php" style="color:#FFF; text-decoration:none; " target="_blank">Descargar PDF</a></div>
  <hr>
<div class="row">

  <div class="col">

  
<?php	

	include_once("db.php");
	echo '<table class="table"';	
	echo  '<thead>';
	echo  '<tr>';
	echo  '<th scope="col">ID</th>';
	echo  '<th scope="col">COD Transaccion</th>';
	echo  '<th scope="col">Nombres</th>';
	echo  '<th scope="col">Tipo de Pago</th>';
	echo  '<th scope="col">Estado Transaccion</th>';
	echo  '<th scope="col">E-mail</th>';
	echo  '</tr>';
	echo  '</thead>';
	echo  '<tbody>';
	
	$resultado_transacciones = "SELECT * FROM transacciones";
	$resultado_transacciones = mysqli_query($conectar, $resultado_transacciones);
	while($transacciones = mysqli_fetch_assoc($resultado_transacciones)){
		echo  '<tr><td>'.$transacciones['id'] . "</td>";
		echo  '<td>'.$transacciones['transaccion_cod'] . "</td>";
		echo  '<td>'.$transacciones['nombres'] . "</td>";
		echo  '<td>'.$transacciones['tipo_pago'] . "</td>";
		echo  '<td>'.$transacciones['estado_transaccion'] . "</td>";
		echo  '<td>'.$transacciones['email'] . "</td></tr>";		
	}
	
	echo  '</tbody>';
	echo  '</table>';
?>





</div>
</div><!-- Fin row -->
</div><!-- Fin container -->




<!-- Inicio Footer -->
    <footer class="footer">
      <div class="container">
        <span class="text-muted"><p>Códigos <a href="https://www.baulphp.com/" target="_blank">BaulPHP</a></p></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>