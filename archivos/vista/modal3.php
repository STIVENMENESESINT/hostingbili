<!doctype html>
<html>
<head>
	<title>Prueba de Bootstrap 5</title> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet"/>
	  
</head>
<body>

  <div class="container"> 
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroUsuario">Abrir ventana de diálogo</button>

    <div class="modal fade" id="registroUsuario"  >
		<div class="modal-dialog modal-sm modal-dialog-scrollable">
			<div class="modal-content">

				<!-- cabecera del diálogo -->
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Registro de Usuario</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- cuerpo del diálogo -->
				<div class="modal-body">
					<div class="row mt-12">						
						<div class="col-sm-4" >							
							<label for="recipient-name" class="col-form-label">Correo:</label>
							<input type="text" class="form-control" id="newCorreo" name="newCorreo"  title='' style='cursor:pointer;' >
						</div>						
					</div>									
				</div>

				<!-- pie del diálogo -->
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-bs-dismiss="modal" id='btnCancelar' name='btnCancelar' >Cerrar</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id='btnGuardar' name='btnGuardar'>Guardar</button>
				</div>
			</div>
		</div>
    </div>
  </div>  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>  
</body>
</html>