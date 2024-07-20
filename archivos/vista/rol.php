<?php 
//https://www.tutorialesprogramacionya.com/bootstrap5ya/index.php?inicio=20
include_once('../../include/conex.php');
header('Content-Type: text/html; charset='.$charset);
session_name($session_name);
session_start();
if (isset($_SESSION['id_userprofile'])){
?>

<!Doctype lang='es'>
<html>

<head>
    <?php include_once('cabecera.php'); ?>

    <script type='text/javascript' src="../../herramientas/js/index.js"></script>
</head>

<body>
    <h1>Roles</h1>
    <?php include_once('menu.php'); ?>

    <div>
        <?php include_once('cabeceraMenu.php'); ?>
    </div>
    <!--MODAL2 COORDINACION-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Tipo Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="nombreTipoSolicitud">Asigna el nombre de tu Tipo de Solicitud</label>
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Seleccione TIPO DE SOLICITUD</h5>
                    <?php
								if ($_SESSION['id_rol'] == 3) {
									echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
										Crear Tipo Soli
									</button>';
								}
							?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="id_tiposolicitud" onchange="MostrarTipo_soli()">
                    </div><br>
                    <div id="tipo_soli"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="btnVolver"
                        id="btnVolver">Salir</button>
                    <input class="btn btn-primary" type="submit" name="btnEnviar" id="btnEnviar" value="Enviar">
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
<?php  } else {	 header("Location: ../../index.php");	}  ?>