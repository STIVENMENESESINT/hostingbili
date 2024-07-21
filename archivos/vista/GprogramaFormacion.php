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
            <div class="content__page">
                <br />
                <div style="width: 70%; margin: 0 auto; ;">
                    <?php 
                        include_once('panel.php')
                    ?>
                </div>
                <div class="cabecera_menu">l
                    <div class="container">
                        <style>
                            .container{
                                position: absolute;
                                left: 6rem;
                            }
                            .card-body{
                                position: relative;
                                left: 6rem;
                            }
                        </style>
                        <div class="card-body">
                            <div class="row">
                                <!-- BUSCADOR -->
                                <div class="col-sm-2">
                                    <input type='text' name='dato_txt' id='dato_txt' title='Dato a buscar'
                                        placeholder='Dato a buscar' class="form-control mb-2 mr-sm-2 mb-sm-0">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" name='btn_Buscar' id='btn_Buscar'
                                        <?php echo $var_class_button_warnigB; ?>>
                                        <i class="fa fa-search-plus" aria-hidden="true"></i></button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" name='btn_Nuevo' id='btn_Nuevo' data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop" <?php echo $var_class_button_warnigN; ?>>
                                        <i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- NO TOCAR -->
                        <?php
                            if ($_SESSION['id_rol'] == 3) {
                                echo '<div id="sin_contenido"></div>
                                <div id="oferta_curso"></div>';
                            }
                        ?>
                        <?php
                            if ($_SESSION['id_rol'] == 2) {
                                echo '
                                <div id="oferta_curso"></div>';
                            }
                        ?>
                        <?php
                            if ($_SESSION['id_rol'] != 3) {
                                echo '<div id="contenido"></div>';
                            }
                        ?>
                    </div>
                    <div id="solisB"></div>
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
        <div class="modal fade" id="cancelSolicitudModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="cancelSolicitudLabel" aria-hidden="true">
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