

<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset=' . $charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])) {
?>




<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>AGREGAR Aprendiz</title>

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/sticky-footer-navbar.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"></head>

<body>
<header>     <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
  <!-- Fixed navbar -->
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>postulacion instructor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->


<!-- Incluye Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Incluye jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Incluye Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous"></script>

</header>


<div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">

<!-- Begin page content -->



<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <h3 class="mt-5">Postula al Programa de formacion</h3>
      <h4 class="mt-4">Lista de Espera para Aprobación</h4>
      <hr>
      <p class="lead">¡Bienvenido al proceso de postulación al curso de Inglés A2 del SENA! Esta es tu oportunidad para mejorar tus habilidades en inglés, expandir tu vocabulario y prepararte para situaciones cotidianas y profesionales.</p>
      <p class="lead">Después de completar tu registro, estarás en lista de espera para la aprobación de tu matrícula. No pierdas esta oportunidad de iniciar tu viaje hacia el dominio del idioma inglés con nosotros.</p>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
      
      
      
<!-- Content Section --> 
<!-- crud jquery-->
<div class="da">
  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Postular Nuevo Aprendiz</button>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div id="records_content"></div>
    </div>
  </div>
</div>
<!-- /Content Section --> 








<!-- Bootstrap Modals --> 
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Postular a un programa futuro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="postularForm" action="procesar_matriculaobs.php" method="POST">
                    <div class="form-group">
                        <label for="idalumno">Identificación de Aspirante:</label>
                        <input type="text" id="idalumno" name="idalumno" class="form-control" required>
                    </div>
                
                
                
                    <div class="form-group">
                        <lab for="codalumno">nombre del aspirante:</lab>
                        <input type="text" id="codalumno" name="codalumno" class="form-control" required>
                    </div>
                   
                    <div class="form-group">
                        <label for="codmatri">correo electronico:</label>
                        <input type="text" id="codmatri" name="codmatri" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="programaformacion">Programa de Formación:</label>
                        <select class="form-control" id="programaformacion" name="programaformacion" required>
                            <option value="">Seleccione un programa</option>
                            <?php
                            // Consulta para obtener los programas de formación
                            include_once('../../include/conex.php');
                            $conn = Conectarse();

                            $query = "SELECT id_programaformacion, nombre FROM programaformacion";
                            $resultado = mysqli_query($conn, $query);

                            if ($resultado && mysqli_num_rows($resultado) > 0) {
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value='" . $fila['id_programaformacion'] . "'>" . $fila['nombre'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>Error al cargar programas</option>";
                            }

                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="obs">Observación:</label>
                        <textarea id="obs" name="obs" class="form-control" style="text-transform: uppercase;" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>      </div>
    </div>
</div>      </div>
    </div>
</div>
<a href="listardesdeinstructor.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>   
<!-- // Modal --> 





<!-- Modal - Update User details --><div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
        <div class="form-group">
          <label for="update_idalumno">Identificación de Aprendiz</label>
          <input type="text" id="update_idalumno" class="form-control"/>
        </div>
        <div class="form-group">
                        <!-- for="codalumno">nombre del aspirante:</!-->
                        <input type="text" id="update_codalumno" name="codalumno" class="form-control" required>
                    </div>
     


     
        <div class="form-group">
          <label for="update_codmatri">Correo electronico: </label>
          <input type="text" id="update_codmatri" class="form-control"/>
        </div>


        <div class="form-group">
                    <label for="programaformacion">Programa de Formación:</label>
                    <select class="form-control" id="update_programaformacion" name="update_programaformacion" required>
                        <option value="">Seleccione un programa</option>
                        <?php
                        // Consulta para obtener los programas de formación
                        include_once('../../include/conex.php');
                        $conn = Conectarse();

                        $query = "SELECT id_programaformacion, nombre FROM programaformacion";
                        $resultado = mysqli_query($conn, $query);

                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $fila['id_programaformacion'] . "'>" . $fila['nombre'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Error al cargar programas</option>";
                        }

                        mysqli_close($conn);
                        ?>


                        
                    </select>
                </div>


        <div class="form-group">
          <label for="update_obs">Observaciones</label>
          <textarea id="update_obs" class="form-control"></textarea>
        </div>
      </div>



      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()">Guardar Cambios</button>
        <input type="hidden" id="hidden_user_id">
      </div>
    </div>
  </div>
</div>
<!-- // Modal --> 
<!-- Jquery JS file --> 
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script> 
<!-- Bootstrap JS file --> 
<!-- Custom JS file --> 
<script type="text/javascript" src="js/script.js"></script> 
<!-- Fin crud jquery-->



      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 
  
</div>
<!-- Fin container -->

<!-- Bootstrap core JavaScript
    ================================================== --> 
<script src="dist/js/bootstrap.min.js"></script> 

<!-- Placed at the end of the document so the pages load faster -->

</body>
</html>









<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>