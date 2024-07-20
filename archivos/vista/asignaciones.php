<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset='.$charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])){
?>
<!Doctype html>
<html lang="es">

<head>
	<?php
        include_once('cabecera.php');
        include_once ('parametros_index.php');
    ?>
    <script type='text/javascript' src="../../herramientas/js/asignaciones.js"></script>
    <link rel="stylesheet" href="../../herramientas/css/asignaciones.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asignaciones</title>
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

</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php
                    // Incluir el menú de navegación
                    include_once('menu.php');
                    ?>
            </div>
        </aside>
        <style >
                        .cabecera_menu {
                            position: relative;
                        }
                        .fixed-top-right {
                            position: absolute;
                            top: 10px; /* Ajusta este valor según necesites */
                            right: 10px; /* Ajusta este valor según necesites */
                            z-index: 1000; /* Asegura que esté por encima de otros elementos */
                            background-color: white; /* Fondo blanco para mejor visibilidad */
                            
                            padding: 5px 10px; /* Espaciado interno */
                        }
                        .fixed-top-right .btn i {
                            margin-right: 5px; /* Espacio entre el icono y el texto */
                        }
                    </style>
                    <button type="button" class="btn nav-link nav-item-hover fixed-top-right" onclick="goBack()">
                        <i class="fas fa-arrow-left fa-fw fa-lg"></i>
                        <span class="nav-item">Volver</span>
                    </button>

                    <script>
                    function goBack() {
                        window.history.back();
                    }
                    </script>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">
				<!-- INICIO A CONSTRUIR CONTENIDO DENTRO DEL LAYOUT -->
                <!-- BUSCADOR -->
				<div class="cabecera_menu">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-2" >
								<input type='text' name='dato_txt' id='dato_txt' title='Dato a buscar' placeholder='Dato a buscar' class="form-control mb-2 mr-sm-2 mb-sm-0" >
							</div>
							<div class="col-sm-2" >
								<button type="button" name='btn_Buscar' id='btn_Buscar' <?php echo $var_class_button_warnigB; ?>  >
								<i class="fa fa-search-plus" aria-hidden="true"></i></button>
							</div>
							<div class="col-sm-2" >
								<button type="button" name='btn_Nuevo' id='btn_permiso'  <?php echo $var_class_button_warnigN; ?>  >
								<i class="fa fa-plus" aria-hidden="true"></i></button>
							</div>		
						</div>
					</div>
				</div>
				<!-- TABLA -->
				<div id="tablecontenido"></div>
            </div>
        </div>
    </div>
    <!-- MODAL GESTION DE PERMISOS -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="">GESTION DE PERMISOS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div id="asignado"></div>
                    <div class="modal-footer">
                        <div class='course-buttons'>
                            <button class='create-button' id="btn_curso" >CREAR CURSO</button>
                            <button class='close-button' type="button"  data-bs-dismiss="modal">CERRAR</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
        <?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>