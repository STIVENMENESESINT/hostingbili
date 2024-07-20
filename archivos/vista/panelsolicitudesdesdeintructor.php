
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
<!Doctype html>
<html lang="es">

<head>
    <?php
                    // Incluir el archivo de cabecera que probablemente contiene enlaces a CSS y otros metadatos
                    include_once('cabecera.php');
                    ?>


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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cambio de programa de formacion </title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->

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



<h1>Formulario General de Solicitudes instructor</h1>


<form action="procesar_cambio_carrera.php" method="POST" enctype="multipart/form-data">
    <label for="tipo_solicitud">Tipos de Solicitudes Disponibles:</label><br>
    <select id="tipo_solicitud" name="tipo_solicitud" required>
        <option value="">Seleccione una opción</option>
 
       

        <option value="solicitud crear un programa de formacion ">solicitud crear un programa de formacion </option>
        <option value="Solicitud de Aplazamiento de Exámenes">Solicitud de Aplazamiento de Exámenes</option>
        <option value="Solicitud de Cambio de programa de formacion">Solicitud de Cambio de programa de formacion</option>
        <option value="Solicitud de inscripcion">Solicitud de inscripcion </option>
        <option value="Solicitud de Reconocimiento de Créditos">Solicitud de Reconocimiento de Créditos</option>
        <option value="Solicitud de Beca">Solicitud de Beca</option>

        <option value="Solicitud de Reconocimiento de Prácticas Laborales">Solicitud de Reconocimiento de Prácticas Laborales</option>

        <option value="Solicitud de Revisión de Calificaciones">Solicitud de Revisión de resultados de aprendizaje</option>
        <option value="Solicitud de Certificados de Estudios">Solicitud de Certificados de Estudios</option>
        <option value="Solicitud de Ausencia por Enfermedad">Solicitud Excusa de Ausencia por Enfermedad</option>
        <option value="Solicitud de Cambio de Grupo">Solicitud de Cambio de Grupo</option>
        <option value="Solicitud de Cambio de Jornada">Solicitud de Cambio de Jornada</option>
        <option value="Solicitud de Cambio de Instructor">Solicitud de Cambio de Instructor</option>
        <option value="Solicitud de Extensión de Plazo para Entrega de Trabajos">Solicitud de Extensión de Plazo para Entrega de Trabajos</option>
    
  
    </select><br><br>





<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Reconocimiento de Prácticas Laborales') {
                $('#modalSolicitudPracticas').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Reconocimiento de Prácticas Laborales -->
<div class="modal fade" id="modalSolicitudPracticas" tabindex="-1" aria-labelledby="modalSolicitudPracticasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudPracticasLabel">Solicitud de Reconocimiento de Prácticas Laborales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudPracticas" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Aprendiz:</h3>
                    <p>El SENA tiene el gusto de presentar el programa de Prácticas, el cual busca dar la oportunidad a nuestros estudiantes de realizar su práctica en diferentes organizaciones del Área metropolitana y a nivel nacional, con el fin de apoyar y fortalecer los diferentes procesos organizacionales.</p>
                    <p>Relacionamos los datos básicos para proceder con la solicitud de practicantes, donde se busca ofrecer un usuario y clave de acceso al aplicativo, que posteriormente le permitirá publicar ofertas, consultar las hojas de vida de los estudiantes que se postulen para realizar el proceso de selección, y evaluar a los estudiantes al momento de terminar su práctica:</p>
                    
                    <h3>PARA LA CREACIÓN DE LA PRÁCTICA NECESITAMOS ESTOS DATOS:</h3>
                    
                    <div class="form-group">
                        <label for="id_empresa">Empresa:</label>
                        <select id="id_empresa" name="id_empresa">
                            <option value="1">Empresa 1</option>
                            <option value="2">Empresa 2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cargo_solicitado">Cargo Solicitado:</label>
                        <input type="text" id="cargo_solicitado" name="cargo_solicitado" required>
                    </div>
                    <div class="form-group">
                        <label for="duracion">Duración:</label>
                        <input type="text" id="duracion" name="duracion" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo_practicas">Motivo de la solicitud:</label>
                        <textarea id="motivo_practicas" name="motivo_practicas" rows="4" cols="50" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="num_estudiantes">Número de estudiantes a entrevistar:</label>
                        <input type="number" id="num_estudiantes" name="num_estudiantes" required>
                    </div>
                    <div class="form-group">
                        <label for="disponibilidad_horaria">Disponibilidad horaria:</label>
                        <textarea id="disponibilidad_horaria" name="disponibilidad_horaria" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="programa_academico">Programa académico:</label>
                        <input type="text" id="programa_academico" name="programa_academico" required>
                    </div>
                    <div class="form-group">
                        <label for="actividades_desarrollar">Actividades a desarrollar:</label>
                        <textarea id="actividades_desarrollar" name="actividades_desarrollar" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="observaciones_generales">Observaciones generales:</label>
                        <textarea id="observaciones_generales" name="observaciones_generales" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="apoyo_economico">Apoyo económico:</label>
                        <input type="text" id="apoyo_economico" name="apoyo_economico" required>
                    </div>
                    <div class="form-group">
                        <label for="lugar_practica">Lugar en que se desarrollará la práctica:</label>
                        <input type="text" id="lugar_practica" name="lugar_practica" required>
                    </div>

                    <div class="form-group">
                        <label>¿Se realizará contrato de aprendizaje (ley 789 de 2002)?</label><br>
                        <input type="radio" id="contrato_si" name="contrato_aprendizaje" value="Si">
                        <label for="contrato_si">Si</label>
                        <input type="radio" id="contrato_no" name="contrato_aprendizaje" value="No">
                        <label for="contrato_no">No</label>
                    </div>

                    <div class="form-group">
                        <label>Modalidad de práctica:</label><br>
                        <input type="checkbox" id="modalidad_trabajo_grado" name="modalidad_practica[]" value="Conducente a Trabajo de Grado">
                        <label for="modalidad_trabajo_grado">Conducente a Trabajo de Grado</label><br>
                        <input type="checkbox" id="modalidad_no_trabajo_grado" name="modalidad_practica[]" value="No Conducente a Trabajo de Grado">
                        <label for="modalidad_no_trabajo_grado">No Conducente a Trabajo de Grado</label>
                    </div>

                    <p><strong>Nota:</strong> La información suministrada en el presente formulario se tratará conforme a lo establecido en la Ley 1581 de 2012 y su Decreto reglamentario 1377 de 2013.</p>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>
















<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Revisión de Calificaciones') {
                $('#modalSolicitudRevision').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Revisión de Calificaciones -->
<div class="modal fade" id="modalSolicitudRevision" tabindex="-1" aria-labelledby="modalSolicitudRevisionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudRevisionLabel">Solicitud de Revisión de Resultados de aprendizaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudRevision" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Aprendiz:</h3>
                    <p>A continuación, puede realizar su solicitud de revisión de resultados aprendizaje:</p>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_asignatura">Asignatura:</label>
                        <select id="id_asignatura" name="id_asignatura">
                            <option value="1">Asignatura 1</option>
                            <option value="2">Asignatura 2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="motivo_revision">Motivo de la solicitud:</label>
                        <textarea id="motivo_revision" name="motivo_revision" rows="4" cols="50" required></textarea>
                    </div>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>









<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Certificados de Estudios') {
                $('#modalSolicitudCertificados').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Certificación de Estudios -->
<div class="modal fade" id="modalSolicitudCertificados" tabindex="-1" aria-labelledby="modalSolicitudCertificadosLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudCertificadosLabel">Solicitud de Certificación de Estudios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudCertificados" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Estudiante:</h3>
                    <p>A continuación, puede realizar su solicitud de certificación de estudios:</p>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_tipo_certificacion">Tipo de Certificación Solicitada:</label>
                        <select id="id_tipo_certificacion" name="id_tipo_certificacion">
                            <option value="1">Certificación 1</option>
                            <option value="2">Certificación 2</option>
                        </select>
                    </div>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>















    <div class="modal fade" id="programaFormacionModal" tabindex="-1" role="dialog" aria-labelledby="programaFormacionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="programaFormacionModalLabel">Solicitud Crear un Programa de Formación (Empresa)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Campos exclusivos para empresa</h1>
                <form id="formSolicitud" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Empresario:</h3>
                    <p>El SENA tiene el gusto de brindar cursos para la comunidad, el cual busca dar la oportunidad de realizar su formación profesional en diferentes programas a nivel nacional, con el fin de apoyar y fortalecer los diferentes procesos organizacionales. Adjunto podrá encontrar información detallada de los diferentes programas académicos con las características generales.</p>
                    <p>Relacionamos los datos básicos para proceder con la solicitud de programas de formación, donde se busca ofrecer un usuario y clave de acceso al aplicativo, que posteriormente le permitirá aplicar a ofertas:</p>

                    <h3>Para la creación de la institución necesitamos estos datos:</h3>
                    <div class="form-group">
                        <label for="nit">Nit:</label>
                        <input type="text" id="nit" name="nit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="razon_social">Razón social:</label>
                        <input type="text" id="razon_social" name="razon_social" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sector_economico">Sector económico:</label>
                        <input type="text" id="sector_economico" name="sector_economico" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gremio">Gremio:</label>
                        <input type="text" id="gremio" name="gremio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" id="ciudad" name="ciudad" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="barrio">Barrio:</label>
                        <input type="text" id="barrio" name="barrio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <input type="tel" id="celular" name="celular" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="tel" id="fax" name="fax" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="id_programa_matricula">Programa al que se desea inscribir:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                   


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Ausencia por Enfermedad') {
                $('#modalSolicitudAusenciaEnfermedad').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Ausencia por Enfermedad -->
<div class="modal fade" id="modalSolicitudAusenciaEnfermedad" tabindex="-1" aria-labelledby="modalSolicitudAusenciaEnfermedadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudAusenciaEnfermedadLabel">Solicitud de Ausencia por Enfermedad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudAusenciaEnfermedad" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Estudiante:</h3>
                    <p>A continuación, puede realizar su solicitud de ausencia por enfermedad:</p>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio_enfermedad">Fecha de inicio de la enfermedad:</label>
                        <input type="date" id="fecha_inicio_enfermedad" name="fecha_inicio_enfermedad" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_fin_enfermedad">Fecha de fin de la enfermedad:</label>
                        <input type="date" id="fecha_fin_enfermedad" name="fecha_fin_enfermedad" required>
                    </div>

                    <div class="form-group">
                        <label for="motivo_enfermedad">Motivo de la solicitud:</label>
                        <textarea id="motivo_enfermedad" name="motivo_enfermedad" rows="4" cols="50" required></textarea>
                    </div>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>












<div class="modal fade" id="aplazamientoExamenModal" tabindex="-1" role="dialog" aria-labelledby="aplazamientoExamenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aplazamientoExamenModalLabel">Solicitud de Aplazamiento de Exámenes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAplazamientoExamen" method="POST" action="procesar_aplazamiento_examen.php">
                    
                <div class="form-group">
                        <label for="id_programa_matricula">Programa al que se desea inscribir:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                
                <div class="form-group">

                    
                        <label for="fecha_examen">Fecha del examen original:</label>
                        <input type="date" id="fecha_examen" name="fecha_examen" class="form-control" required>
                    </div>


                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
















<div class="modal fade" id="cambioProgramaFormacionModal" tabindex="-1" role="dialog" aria-labelledby="cambioProgramaFormacionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambioProgramaFormacionModalLabel">Solicitud de Cambio de Programa de Formación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCambioProgramaFormacion" method="POST" action="procesar_cambio_programa.php">
                <div class="form-group">
                        <label for="id_programa_matricula">Programa de formacion actual:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                
                
                <div class="form-group">
                        <label for="id_nueva_carrera">Nueva programa de formacion Solicitado:</label>
                        <select id="id_nueva_carrera" name="id_nueva_carrera" class="form-control" required>
                            <option value="1">Carrera 1</option>
                            <option value="2">Carrera 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo_cambio">Motivo del Cambio:</label>
                        <textarea id="motivo_cambio" name="motivo_cambio" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="expectativas">Expectativas y Objetivos:</label>
                        <textarea id="expectativas" name="expectativas" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="plan_estudio">Plan de Estudio Propuesto:</label>
                        <textarea id="plan_estudio" name="plan_estudio" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción Adicional:</label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo Adjunto:</label>
                        <input type="file" id="archivo" name="archivo" class="form-control-file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>








<div class="modal fade" id="solicitudRevisionResultadosModal" tabindex="-1" role="dialog" aria-labelledby="solicitudRevisionResultadosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solicitudRevisionResultadosModalLabel">Solicitud de Revisión de Resultados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRevisionResultados" method="POST" action="procesar_revision_resultados.php">
               
                <div class="form-group">
                        <label for="id_programa_matricula">Programa al que se desea inscribir:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
               
               
                <div class="form-group">
                        <label for="id_asignatura">competencia:</label>
                        <select id="id_asignatura" name="id_asignatura" class="form-control">
                            <option value="1">Asignatura 1</option>
                            <option value="2">Asignatura 2</option>
                            <!-- Agrega más opciones según necesites -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo_revision">Motivo de la solicitud:</label>
                        <textarea id="motivo_revision" name="motivo_revision" rows="4" cols="50" class="form-control" required></textarea>
                    </div>

                    <p><strong>Nota:</strong> La información suministrada en el presente formulario se tratará conforme a lo establecido en la Ley 1581 de 2012 y su Decreto reglamentario 1377 de 2013.</p>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" class="form-control" required>.</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Cambio de Grupo') {
                $('#modalSolicitudCambioGrupo').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Cambio de Grupo -->
<div class="modal fade" id="modalSolicitudCambioGrupo" tabindex="-1" aria-labelledby="modalSolicitudCambioGrupoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudCambioGrupoLabel">Solicitud de Cambio de Grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudCambioGrupo" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Estudiante:</h3>
                    <p>A continuación, puede realizar su solicitud de cambio de grupo:</p>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_grupo_actual">Grupo Actual:</label>
                        <select id="id_grupo_actual" name="id_grupo_actual">
                            <option value="1">Grupo 1</option>
                            <option value="2">Grupo 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_grupo_nuevo">Nuevo Grupo Solicitado:</label>
                        <select id="id_grupo_nuevo" name="id_grupo_nuevo">
                            <option value="1">Grupo 1</option>
                            <option value="2">Grupo 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="motivo_cambio_grupo">Motivo del cambio:</label>
                        <textarea id="motivo_cambio_grupo" name="motivo_cambio_grupo" rows="4" cols="50" required></textarea>
                    </div>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Cambio de Jornada') {
                $('#modalSolicitudCambioJornada').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Cambio de Jornada -->
<div class="modal fade" id="modalSolicitudCambioJornada" tabindex="-1" aria-labelledby="modalSolicitudCambioJornadaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudCambioJornadaLabel">Solicitud de Cambio de Jornada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudCambioJornada" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Estudiante:</h3>
                    <p>A continuación, puede realizar su solicitud de cambio de jornada:</p>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_jornada_actual">Jornada Actual:</label>
                        <select id="id_jornada_actual" name="id_jornada_actual">
                            <option value="1">Jornada 1</option>
                            <option value="2">Jornada 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_jornada_nueva">Nueva Jornada Solicitada:</label>
                        <select id="id_jornada_nueva" name="id_jornada_nueva">
                            <option value="1">Jornada 1</option>
                            <option value="2">Jornada 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="motivo_cambio_jornada">Motivo del cambio:</label>
                        <textarea id="motivo_cambio_jornada" name="motivo_cambio_jornada" rows="4" cols="50" required></textarea>
                    </div>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>







<div class="modal fade" id="inscripcionModal" tabindex="-1" role="dialog" aria-labelledby="inscripcionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inscripcionModalLabel">Solicitud de Inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formInscripcion" method="POST" action="procesar_inscripcion.php">
                    <div class="form-group">
                        <label for="id_programa_matricula">Programa al que se desea inscribir:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="periodo">Periodo Académico:</label>
                        <input type="text" id="periodo" name="periodo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo_matricula">Motivo de la solicitud:</label>
                        <textarea id="motivo_matricula" name="motivo_matricula" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>















<div class="modal fade" id="reconocimientoCreditosModal" tabindex="-1" role="dialog" aria-labelledby="reconocimientoCreditosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reconocimientoCreditosModalLabel">Solicitud de Reconocimiento de Créditos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formReconocimientoCreditos" method="POST" action="procesar_reconocimiento_creditos.php">
                    <div class="form-group">
                        <label for="id_carrera_actual">Carrera Actual:</label>
                        <select id="id_carrera_actual" name="id_carrera_actual" class="form-control" required>
                            <option value="1">Carrera 1</option>
                            <option value="2">Carrera 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_programa_matricula">Programa al que se desea inscribir:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_carrera_solicitada">Carrera a la que se solicita el reconocimiento:</label>
                        <select id="id_carrera_solicitada" name="id_carrera_solicitada" class="form-control" required>
                            <option value="1">Carrera 1</option>
                            <option value="2">Carrera 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="motivo_reconocimiento">Motivo de la solicitud:</label>
                        <textarea id="motivo_reconocimiento" name="motivo_reconocimiento" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
















<div class="modal fade" id="becaModal" tabindex="-1" role="dialog" aria-labelledby="becaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="becaModalLabel">Solicitud de Beca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formBeca" method="POST" action="procesar_solicitud_beca.php">
                    <div class="form-group">
                        <label for="id_beca">Tipo de Beca Solicitada:</label>
                        <select id="id_beca" name="id_beca" class="form-control" required>
                            <option value="1">Beca 1</option>
                            <option value="2">Beca 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_programa_matricula">Programa al que se desea inscribir:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo_beca">Motivo de la solicitud:</label>
                        <textarea id="motivo_beca" name="motivo_beca" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>











<div class="modal fade" id="solicitudPracticasProfesionalesModal" tabindex="-1" role="dialog" aria-labelledby="solicitudPracticasProfesionalesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solicitudPracticasProfesionalesModalLabel">Solicitud de Prácticas Profesionales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formSolicitud" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Aprendiz:</h3>
                
                
                
                
                    <div class="form-group">
                        <label for="id_programa_matricula">Programa al que se desea inscribir:</label>
                        <select id="id_programa_matricula" name="id_programa_matricula" class="form-control" required>
                            <option value="1">Programa 1</option>
                            <option value="2">Programa 2</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_empresa">Empresa:</label>
                        <select id="id_empresa" name="id_empresa" class="form-control" required>
                            <option value="1">Empresa 1</option>
                            <option value="2">Empresa 2</option>
                            <!-- Agrega más opciones según necesites -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="cargo_solicitado">Cargo Solicitado:</label>
                        <input type="text" id="cargo_solicitado" name="cargo_solicitado" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="duracion">Duración:</label>
                        <input type="text" id="duracion" name="duracion" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="motivo_practicas">Motivo de la solicitud:</label>
                        <textarea id="motivo_practicas" name="motivo_practicas" rows="4" cols="50" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="disponibilidad_horaria">Disponibilidad horaria:</label>
                        <textarea id="disponibilidad_horaria" name="disponibilidad_horaria" rows="4" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="programa_academico">Programa académico:</label>
                        <input type="text" id="programa_academico" name="programa_academico" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="actividades_desarrollar">Actividades a desarrollar:</label>
                        <textarea id="actividades_desarrollar" name="actividades_desarrollar" rows="4" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="observaciones_generales">Observaciones generales:</label>
                        <textarea id="observaciones_generales" name="observaciones_generales" rows="4" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="apoyo_economico">Apoyo económico:</label>
                        <input type="text" id="apoyo_economico" name="apoyo_economico" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="lugar_practica">Lugar en que se desarrollará la práctica:</label>
                        <input type="text" id="lugar_practica" name="lugar_practica" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>¿Se realizará contrato de aprendizaje (ley 789 de 2002)?</label><br>
                        <input type="radio" id="contrato_si" name="contrato_aprendizaje" value="Si" required>
                        <label for="contrato_si">Si</label>
                        <input type="radio" id="contrato_no" name="contrato_aprendizaje" value="No">
                        <label for="contrato_no">No</label>
                    </div>

                    <div class="form-group">
                        <label>Modalidad de práctica:</label><br>
                        <input type="checkbox" id="modalidad_trabajo_grado" name="modalidad_practica[]" value="Conducente a Trabajo de Grado">
                        <label for="modalidad_trabajo_grado">Conducente a Trabajo de Grado</label><br>
                        <input type="checkbox" id="modalidad_no_trabajo_grado" name="modalidad_practica[]" value="No Conducente a Trabajo de Grado">
                        <label for="modalidad_no_trabajo_grado">No Conducente a Trabajo de Grado</label>
                    </div>

                    <p><strong>Nota:</strong> La información suministrada en el presente formulario se tratará conforme a lo establecido en la Ley 1581 de 2012 y su Decreto reglamentario 1377 de 2013.</p>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" class="form-control" required>.</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>














<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Cambio de Instructor') {
                $('#modalSolicitudCambioInstructor').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Cambio de Instructor -->
<div class="modal fade" id="modalSolicitudCambioInstructor" tabindex="-1" aria-labelledby="modalSolicitudCambioInstructorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudCambioInstructorLabel">Solicitud de Cambio de Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudCambioInstructor" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Estudiante:</h3>
                    <p>A continuación, puede realizar su solicitud de cambio de instructor:</p>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="id_tutor_actual">Tutor Actual:</label>
                        <select id="id_tutor_actual" name="id_tutor_actual">
                            <option value="1">Tutor 1</option>
                            <option value="2">Tutor 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_tutor_nuevo">Nuevo Instructor Solicitado:</label>
                        <select id="id_tutor_nuevo" name="id_tutor_nuevo">
                            <option value="1">Tutor 1</option>
                            <option value="2">Tutor 2</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="motivo_cambio_tutor">Motivo del cambio:</label>
                        <textarea id="motivo_cambio_tutor" name="motivo_cambio_tutor" rows="4" cols="50" required></textarea>
                    </div>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>

















<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Extensión de Plazo para Entrega de Trabajos') {
                $('#modalSolicitudExtensionPlazo').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Extensión de Plazo para Entrega de Trabajos -->
<div class="modal fade" id="modalSolicitudExtensionPlazo" tabindex="-1" aria-labelledby="modalSolicitudExtensionPlazoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudExtensionPlazoLabel">Solicitud de Extensión de Plazo para Entrega de Trabajos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudExtensionPlazo" method="POST" action="procesar_solicitud.php">
                    <h3>Estimado Estudiante:</h3>
                    <p>A continuación, puede realizar su solicitud de extensión de plazo para la entrega de trabajos:</p>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="SEGUNDOnombre">Segundo Nombre:</label>
                        <input type="text" id="SEGUNDOnombre" name="SEGUNDOnombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="primerapellido">Primer Apellido:</label>
                        <input type="text" id="primerapellido" name="primerapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="segundoapellido">Segundo Apellido:</label>
                        <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tipodedocumento">Tipo de Documento:</label>
                        <input type="text" id="tipodedocumento" name="tipodedocumento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de Documento:</label>
                        <input type="text" id="documento" name="documento" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="emailsecundario">Correo Electrónico Secundario:</label>
                        <input type="email" id="emailsecundario" name="emailsecundario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="codigoaprendiz">Código de Aprendiz:</label>
                        <input type="text" id="codigoaprendiz" name="codigoaprendiz" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nueva_fecha">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha" name="nueva_fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo del aplazamiento:</label>
                        <textarea id="motivo" name="motivo" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_actual_entrega">Fecha de entrega actual:</label>
                        <input type="date" id="fecha_actual_entrega" name="fecha_actual_entrega" required>
                    </div>

                    <div class="form-group">
                        <label for="nueva_fecha_entrega">Nueva fecha solicitada:</label>
                        <input type="date" id="nueva_fecha_entrega" name="nueva_fecha_entrega" required>
                    </div>

                    <div class="form-group">
                        <label for="motivo_extension">Motivo de la solicitud:</label>
                        <textarea id="motivo_extension" name="motivo_extension" rows="4" cols="50" required></textarea>
                    </div>

                    <p>Para constancia se firma en Pereira a los <input type="date" id="fecha_firma" name="fecha_firma" required>.</p>

                    <button type="submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Script jQuery para abrir el modal -->
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').change(function() {
            var selectedOption = $(this).children('option:selected').val();
            if (selectedOption === 'Solicitud de Aprobación de Proyecto') {
                $('#modalSolicitudAprobacionProyecto').modal('show'); // Abre el modal
            }
        });
    });
</script>

<!-- Modal para la Solicitud de Aprobación de Proyecto de Grado -->
<div class="modal fade" id="modalSolicitudAprobacionProyecto" tabindex="-1" aria-labelledby="modalSolicitudAprobacionProyectoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudAprobacionProyectoLabel">Solicitud de Aprobación de Proyecto de Grado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSolicitudAprobacionProyecto" method="POST" action="procesar_solicitud.php" enctype="multipart/form-data">
                    <h3>Estimado Estudiante:</h3>
                    <p>A continuación, puede realizar su solicitud de aprobación de proyecto de grado:</p>

                    <div class="form-group">
                        <label for="nombre">Nombre completo del estudiante:</label><br>
                        <input type="text" id="nombre" name="nombre" required><br><br>
                    </div>

                    <div class="form-group">
                        <label for="documento">Número de documento del estudiante:</label><br>
                        <input type="text" id="documento" name="documento" required><br><br>
                    </div>

                    <div class="form-group">
                        <label for="carrera">Carrera:</label><br>
                        <input type="text" id="carrera" name="carrera" required><br><br>
                    </div>

                    <div class="form-group">
                        <label for="titulo_proyecto">Título del proyecto de grado:</label><br>
                        <input type="text" id="titulo_proyecto" name="titulo_proyecto" required><br><br>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción del proyecto:</label><br>
                        <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br><br>
                    </div>

                    <div class="form-group">
                        <label for="asesor">Nombre del asesor:</label><br>
                        <input type="text" id="asesor" name="asesor" required><br><br>
                    </div>

                    <div class="form-group">
                        <label for="fecha_presentacion">Fecha de presentación:</label><br>
                        <input type="date" id="fecha_presentacion" name="fecha_presentacion" required><br><br>
                    </div>

                    <div class="form-group">
                        <label for="archivo_proyecto">Archivo del proyecto (opcional):</label><br>
                        <input type="file" id="archivo_proyecto" name="archivo_proyecto"><br><br>
                    </div>

                    <button type="submit">Enviar Solicitud</button>

        
                </form>
            </div>
        </div>            <a href="paneldeinserciondesdeinstructor.php" class="btn btn-primary" id="btnRegresar">
                    Regresar
                </a>
    </div>
</div>




</html>

<!-- Incluir Bootstrap y jQuery si aún no están incluidos en tu proyecto -->
<!-- Coloca este código al final del cuerpo de tu página antes de cerrar la etiqueta </body> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar modal
        $('#solicitudPracticasProfesionalesModal').on('show.bs.modal', function(event) {
            // Aquí puedes realizar acciones cuando el modal se muestra
        });

        // Envío del formulario mediante AJAX
        $('#formSolicitud').on('submit', function(event) {
            event.preventDefault(); // Evitar que se envíe el formulario automáticamente

            // Envío del formulario mediante AJAX
            $.ajax({
                url: $(this).attr('action'), // URL del archivo PHP que procesa la solicitud
                method: $(this).attr('method'), // Método del formulario (POST en este caso)
                data: $(this).serialize(), // Datos del formulario serializados
                dataType: 'json', // Tipo de datos esperados del servidor
                success: function(response) {
                    console.log('Solicitud enviada exitosamente');
                    $('#solicitudPracticasProfesionalesModal').modal('hide'); // Cerrar el modal después de enviar
                    // Aquí puedes realizar acciones adicionales después del envío
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar la solicitud:', error);
                    // Aquí puedes manejar errores de envío
                }
            });
        });
    });
</script>



<script>
$(document).ready(function() {
    $('#tipo_solicitud').on('change', function() {
        if ($(this).val() === 'solicitud crear un programa de formacion ') {
            $('#programaFormacionModal').modal('show');
        }
    });
});
</script>

<script>
$(document).ready(function() {
    $('#tipo_solicitud').on('change', function() {
        var selectedOption = $(this).val();
        if (selectedOption === 'solicitud crear un programa de formacion ') {
            $('#programaFormacionModal').modal('show');
        } else if (selectedOption === 'Solicitud de Aplazamiento de Exámenes') {
            $('#aplazamientoExamenModal').modal('show');
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        $('#tipo_solicitud').on('change', function() {
            var opcionSeleccionada = $(this).val();

            // Ocultar todos los modales al inicio
            $('#inscripcionModal').modal('hide');
            $('#reconocimientoCreditosModal').modal('hide');
            $('#becaModal').modal('hide');

            // Mostrar el modal correspondiente según la opción seleccionada
            if (opcionSeleccionada === 'Solicitud de inscripcion') {
                $('#inscripcionModal').modal('show');
            } else if (opcionSeleccionada === 'Solicitud de Reconocimiento de Créditos') {
                $('#reconocimientoCreditosModal').modal('show');
            } else if (opcionSeleccionada === 'Solicitud de Beca') {
                $('#becaModal').modal('show');
            }
            // Agrega más condiciones según tus necesidades

        });
    });
</script>




<script>
    $(document).ready(function() {
        // Evento cuando se muestra el modal
        $('#practicasModal').on('show.bs.modal', function(event) {
            // Limpiar el formulario al abrir el modal
            $('#formPracticas')[0].reset();
        });

        // Evento cuando se envía el formulario de solicitud de prácticas
        $('#formPracticas').on('submit', function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Aquí puedes agregar código adicional antes de enviar el formulario,
            // por ejemplo, validación adicional o procesamiento de datos.

            // Envío del formulario mediante AJAX
            $.ajax({
                url: $(this).attr('action'), // URL del archivo PHP que procesa la solicitud
                method: $(this).attr('method'), // Método del formulario (POST en este caso)
                data: $(this).serialize(), // Datos del formulario serializados
                dataType: 'json', // Tipo de datos esperados del servidor
                success: function(response) {
                    // Manejo de la respuesta exitosa del servidor
                    // Puedes mostrar un mensaje de éxito, cerrar el modal, etc.
                    console.log('Solicitud de prácticas enviada exitosamente');
                    $('#practicasModal').modal('hide'); // Cierra el modal después de enviar
                },
                error: function(xhr, status, error) {
                    // Manejo de errores en la solicitud AJAX
                    console.error('Error al enviar la solicitud de prácticas:', error);
                    // Puedes mostrar un mensaje de error o realizar alguna acción adicional
                }
            });
        });
    });
</script>









<script>
$(document).ready(function() {
    $('#tipo_solicitud').on('change', function() {
        var selectedOption = $(this).val();
        if (selectedOption === 'solicitud crear un programa de formacion ') {
            $('#programaFormacionModal').modal('show');
        } else if (selectedOption === 'Solicitud de Aplazamiento de Exámenes') {
            $('#aplazamientoExamenModal').modal('show');
        } else if (selectedOption === 'Solicitud de Cambio de programa de formacion') {
            $('#cambioProgramaFormacionModal').modal('show');
        }
        // Agrega más condiciones según sea necesario para otros tipos de solicitud
    });
});
</script>


<!-- Incluir Bootstrap y jQuery si aún no están incluidos en tu proyecto -->
<!-- Coloca este código al final del cuerpo de tu página antes de cerrar la etiqueta </body> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar modal
        $('#solicitudRevisionResultadosModal').on('show.bs.modal', function(event) {
            // Aquí puedes realizar acciones cuando el modal se muestra
        });

        // Envío del formulario mediante AJAX
        $('#formRevisionResultados').on('submit', function(event) {
            event.preventDefault(); // Evitar que se envíe el formulario automáticamente

            // Envío del formulario mediante AJAX
            $.ajax({
                url: $(this).attr('action'), // URL del archivo PHP que procesa la solicitud
                method: $(this).attr('method'), // Método del formulario (POST en este caso)
                data: $(this).serialize(), // Datos del formulario serializados
                dataType: 'json', // Tipo de datos esperados del servidor
                success: function(response) {
                    console.log('Solicitud enviada exitosamente');
                    $('#solicitudRevisionResultadosModal').modal('hide'); // Cerrar el modal después de enviar
                    // Aquí puedes realizar acciones adicionales después del envío
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar la solicitud:', error);
                    // Aquí puedes manejar errores de envío
                }
            });
        });
    });
</script>













<script>
    $(document).ready(function() {
        // Evento cuando se muestra el modal
        $('#becaModal').on('show.bs.modal', function(event) {
            // Limpiar el formulario al abrir el modal
            $('#formBeca')[0].reset();
        });

        // Evento cuando se envía el formulario de solicitud de beca
        $('#formBeca').on('submit', function(event) {
            event.preventDefault(); // Evita que se envíe el formulario automáticamente

            // Aquí puedes agregar código adicional antes de enviar el formulario,
            // por ejemplo, validación adicional o procesamiento de datos.

            // Envío del formulario mediante AJAX
            $.ajax({
                url: $(this).attr('action'), // URL del archivo PHP que procesa la solicitud
                method: $(this).attr('method'), // Método del formulario (POST en este caso)
                data: $(this).serialize(), // Datos del formulario serializados
                dataType: 'json', // Tipo de datos esperados del servidor
                success: function(response) {
                    // Manejo de la respuesta exitosa del servidor
                    // Puedes mostrar un mensaje de éxito, cerrar el modal, etc.
                    console.log('Solicitud de beca enviada exitosamente');
                    $('#becaModal').modal('hide'); // Cierra el modal después de enviar
                },
                error: function(xhr, status, error) {
                    // Manejo de errores en la solicitud AJAX
                    console.error('Error al enviar la solicitud de beca:', error);
                    // Puedes mostrar un mensaje de error o realizar alguna acción adicional
                }
            });
        });
    });
</script>

<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
