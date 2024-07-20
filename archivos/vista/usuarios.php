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
    <script type='text/javascript' src="../../herramientas/js/usuarios.js"></script>
    <title>Administrar Perfiles de Usuario</title>

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
        <!-- Contenido principal -->
        <style >
                        .cabecera_menu {
                            position: relative;
                        }
                        .fixed-top-right {
                            position: absolute;
                            top: 10px; /* Ajusta este valor según necesites */
                            right: 10px; /* Ajusta este valor según necesites */
                            z-index: 1000; /* Asegura que esté por encima de otros elementos */
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
        <div class="layout__content">
            <div class="content__page">
				<!-- INICIO A CONSTRUIR CONTENIDO DENTRO DEL LAYOUT -->
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
				<div id="usuarios"></div>
                
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
                    <div id="id_permiso"></div>                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="btnVolver"
                                id="btnVolver">Salir</button>
                        <input class="btn btn-primary" type="submit" id="actualizarPermisousu" value="Gestionar">
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