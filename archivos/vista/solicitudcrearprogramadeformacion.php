<?php
// Incluir el archivo de configuración de conexión a la base de datos y manejo de sesión
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset=' . $charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])) {
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
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

    <style>
        /* Estilos adicionales */
        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
            transition: all 0.3s ease;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            background-color: #007bff;
        }

        .nav-link {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-item-hover:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
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
                <div id="contenido">
                    <h1>Solicitud De Apertura de Un Programa de Formación formulario para empresa</h1>
                    <form id="formSolicitud" method="POST" action="procesar_solicitud.php">
            <h3>Estimado Empresario:</h3>
            <p>el sena tiene el gusto de brindar cursos para la comunidad  , el cual busca dar la oportunidad  de realizar su formacion profesional en diferentes programas a nivel nacional, con el fin de apoyar y fortalecer los diferentes procesos organizacionales. Adjunto podrá encontrar información detallada de los diferentes programas académicos con las características generales.</p>
            <p>Relacionamos los datos básicos para proceder con la solicitud de programas de formacion , donde se busca ofrecer un usuario y clave de acceso al aplicativo, que posteriormente le permitirá aplicar a ofertas:</p>
            
            <h3>PARA LA CREACIÓN DE LA INSTITUCIÓN NECESITAMOS ESTOS DATOS:</h3>
            <div class="form-group">
                <label for="nit">Nit:</label>
                <input type="text" id="nit" name="nit" required>
            </div>
            <div class="form-group">
                <label for="razon_social">Razón social:</label>
                <input type="text" id="razon_social" name="razon_social" required>
            </div>
            <div class="form-group">
                <label for="sector_economico">Sector económico:</label>
                <input type="text" id="sector_economico" name="sector_economico" required>
            </div>
            <div class="form-group">
                <label for="gremio">Gremio:</label>
                <input type="text" id="gremio" name="gremio">
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="barrio">Barrio:</label>
                <input type="text" id="barrio" name="barrio">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="fax">Fax:</label>
                <input type="tel" id="fax" name="fax">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
                    <form id="formSolicitud" action="procesar_inscripcion.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Empresa:</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="nit">NIT de la Empresa:</label>
                            <input type="text" id="nit" name="nit" required>
                        </div>

          
             
                        <div class="form-group">
                            <label for="contactoempresa">Nombre de persona de contacto en la Empresa:</label>
                            <input type="text" id="contactoempresa" name="contactoempresa" required>
                        </div>

               
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha De Requerimiento :</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>

                        <div class="form-group">
                            <label for="comentarios">Comentarios:</label>
                            <textarea id="comentarios" name="comentarios" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="archivo">Archivo Adjunto:</label>
                            <input type="file" id="archivo" name="archivo">
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio:</label>
                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio">
                        </div>

                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin:</label>
                            <input type="datetime-local" id="fecha_fin" name="fecha_fin">
                        </div>

                        <div class="form-group">
                            <label for="id_jornada">Jornada:</label>
                            <select id="id_jornada" name="id_jornada">
                                <option value="1">Jornada 1</option>
                                <option value="2">Jornada 2</option>
                                <!-- Agrega más opciones según tu base de datos -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_modalidad">Modalidad:</label>
                            <select id="id_modalidad" name="id_modalidad">
                                <option value="1">Modalidad 1</option>
                                <option value="2">Modalidad 2</option>
                                <!-- Agrega más opciones según tu base de datos -->
                            </select>
                        </div>

                        <button type="button" class="btn btn-primary" id="btnAgregarCompetencia">
                            Agregar Competencia
                        </button>

                        <button type="submit" class="btn btn-success">Enviar Solicitud</button>

                        <div class="form-group">
                            <label for="programaformacion">Programa de Formación:</label>
                            <select class="form-control" id="programaformacion" name="programaformacion" required>
                                <option value="">Seleccione un programa</option>
                                <?php
                                // Consulta para obtener los programas de formación
                                $query = "SELECT id_programaformacion, nombre FROM programaformacion WHERE tipo = 'empresa'";
                                $resultado_pf = mysqli_query($conn, $query);

                                // Verificar si se ejecutó la consulta correctamente
                                if ($resultado_pf && mysqli_num_rows($resultado_pf) > 0) {
                                    // Mostrar los datos de la consulta
                                    while ($fila_pf = mysqli_fetch_assoc($resultado_pf)) {
                                        $selected = (isset($_POST['programaformacion']) && $_POST['programaformacion'] == $fila_pf['id_programaformacion']) ? "selected" : "";
                                        echo "<option value='" . $fila_pf['id_programaformacion'] . "' $selected>" . $fila_pf['nombre'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Error al cargar programas</option>";
                                }

                                // Liberar el resultado de la consulta de programas de formación
                                mysqli_free_result($resultado_pf);
                                mysqli_close($conn);
                                ?>
                            </select>

                            <button type="submit">Enviar Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts al final para una carga más eficiente -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Evento clic para el botón de agregar competencia
            $('#btnAgregarCompetencia').click(function() {
                // Implementa aquí la lógica para agregar competencias dinámicamente
                alert('Agregar competencia: Implementa tu lógica aquí.');
            });

            // Capturar el evento de envío del formulario
            $('#formSolicitud').submit(function(event) {
                // Evitar el comportamiento predeterminado de enviar el formulario
                event.preventDefault();

                // Obtener el formulario actual
                var form = $(this);

                // Configurar la configuración de la petición AJAX
                var formData = new FormData(form[0]);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        console.log(response); // Puedes mostrar un mensaje de éxito o redireccionar aquí
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores de la petición AJAX
                        console.error('Error en la solicitud AJAX:', status, error);
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>
