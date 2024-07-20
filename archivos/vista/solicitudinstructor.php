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
    <script type='text/javascript' src="../../herramientas/js/solicitud.js"></script>
    <link rel="stylesheet" href="../../herramientas/css/solicitud.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario General de Solicitudes</title>
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
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">
                <br/>
                <div class="cabecera_menu">
                        <?php
                                    include_once('formulariodesolicitudesgeneral.php');
                                ?>

                    <h1>holis</h1>
                    <div class="card-body">

                        <div class="row">
                            <!-- BUSCADOR -->
                            <div class="col-sm-2" >
                                <input type='text' name='dato_txt' id='dato_txt' title='Dato a buscar' placeholder='Dato a buscar' class="form-control mb-2 mr-sm-2 mb-sm-0" >
                            </div>
                            <div class="col-sm-2" >
                                <button type="button" name='btn_Buscar' id='btn_Buscar' <?php echo $var_class_button_warnigB; ?>  >
                                <i class="fa fa-search-plus" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" name='btn_Nuevo' id='btn_Nuevo' data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop" <?php echo $var_class_button_warnigN; ?>>
                                    <i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>


                        </div>
                    </div>
                    <?php
                        if ($_SESSION['id_rol'] == 3) {
                            echo '<div id="sin_contenido"></div>';
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

        <!-- MODAL DETALLE OFERTA CURSO -->
        <div class="modal fade" id="OfertaModal" tabindex="-1" aria-labelledby="OfertaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id=""> Oferta Curso</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="form_Of"></div>
                    </div>
                    <div class='modal-footer'>
                                <button type='button' class='btn btn-close' data-bs-dismiss='modal'>Cerrar</button>
                            </div>
                </div>
            </div>
        </div>
        <!-- MODAL 5 ASIGNACIONES [2]-->
        <div class="modal fade" id="AceptSolicitud2Modal" tabindex="-1" aria-labelledby="AceptSolicitudLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id=""> Prototipo de Noticia/Oferta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="noticia_creada"></div>
                        <div id="form_Of"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="subirNoti">Subir</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DETALLE SOLICITUD -->
        <div class="modal fade" id="detallesolicitud" tabindex="-1" aria-labelledby="detalleSolicitudLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="">Detalle SOLICITUD</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="datlleSolicitud"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- MODAL 5 ASIGNACIONES [1]-->
        <div class="modal fade" id="AceptSolicitudModal" tabindex="-1" aria-labelledby="AceptSolicitudLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="">GESTIONAR Estado SOLICITUD</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="form_asignaciones"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnGuardarCambios2">Asignar</button>
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
            <!--MODAL3 EDITAR SOLI-->
        <div class="modal fade" id="editSolicitudModal" tabindex="-1" aria-labelledby="editSolicitudLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editSolicitudLabel">Editar Solicitud</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="editableFields"></div>
                            <select id="responsable"></select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnGuardaCambios">Guardar
                                Cambios</button>
                        </div>
                    </div>
                </div>
        </div>
            <!--MODAL2 COORDINACION-->
        <div class="modal fade" id="createTipoSolicitudModal" tabindex="-1"
                aria-labelledby="createTipoSolicitudLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTipoSolicitudLabel">Nuevo Tipo Solicitud</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label>Asigna el nombre de tu Tipo de Solicitud</label>
                            <input type="text" id="nombre"> <br>
                            <label for="nombreTipoSolicitud">Asigna un rol a tu Tipo de Solicitud</label>
                            <div id="id_rol"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">Volver</button>
                            <button type="button" class="btn btn-primary" id="btnNewSoli">Guardar</button>
                        </div>
                    </div>
                </div>
        </div>
            <!-- Modal1 -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="">GESTIONAR NUEVA SOLICITUD</h1>
                            <?php
                                        if ($_SESSION['id_rol'] == 3) {
                                            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTipoSolicitudModal">
                                                Crear Tipo Soli
                                            </button>';
                                        }
                                    ?>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" onchange="MostrarTipo_soli()">
                            <div id="id_tiposolicitud"></div>
                        </div>
                        <div id="tipo_soli"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="btnVolver"
                                id="btnVolver">Salir</button>
                            <input class="btn btn-primary" type="submit" name="btnEnviar" id="btnEnviar" value="Enviar">
                        </div>
                    </div>
                </div>
        </div>
    </div>  </div>    </div><a href="listardesdeinstructor.php">
                  <i class="fas fa-arrow-circle-left"></i>
                  <span class="nav-item">Regresar</span>
              </a>
</body>
        <?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>