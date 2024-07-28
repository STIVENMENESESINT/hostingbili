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
    <script type='text/javascript' src="../../herramientas/js/GprogramaFormacion.js"></script>
    <link rel="stylesheet" href="../../herramientas/css/GprogramaFormacion.css">
    <style>
    .container {
        background: rgba(255, 255, 255, 0.95);
        padding: 50px;
        padding-right: 50px;

        padding-right: 50px;
        padding-left: 50px;
        border-radius: 30px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s ease-out;
        max-width: 1400px;
        width: 95%;
    }

    .navbar {
        display: flex;
        justify-content: center;
        padding: 15px 0;
    }
    </style>
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
        <div class="layout__content">
            <div class="container content__page">
                <br />
                <div class="navbar">
                    <?php 
                        include_once('panel.php')
                    ?>
                </div>
                <!-- NO TOCAR -->
                <div id="sin_contenido"></div>
            </div>
            <div id="pfB"></div>
        </div>
    </div>
    </div>

    <!-- MODAL 5 ASIGNACIONES [1]-->
    <div class="modal fade" id="AceptSolicitudModal" tabindex="-1" aria-labelledby="AceptSolicitudLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">Gestionar Seguimiento Programa de Formacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="List_Gestion"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-button" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="create-button" id="btnGuardarCambios2">Asignar</button>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL4 Cancelar SOLI-->
    <div class="modal fade" id="cancelSolicitudModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cancelSolicitudLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Estas Seguro de Denegar la Solicitud?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="cancel"></div>
                </div>
                <div class="modal-footer">

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