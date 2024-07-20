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
                <div id="conten">
                    <?php
                    // Incluir el archivo de cabecera que probablemente contiene enlaces a CSS y otros metadatos
                    include_once('cabeceraMenu.php');
                    ?>

                    <!-- El contenido dinámico se cargará aquí -->
                

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"></div>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Prácticas Profesionales</title>
    <style>
        /* Estilos CSS pueden ser agregados aquí según necesidad */
    </style>
</head>
<body>
    <div class="container">
        <h2>Solicitud de Prácticas Profesionales</h2>
        <form id="formSolicitud" method="POST" action="procesar_solicitud.php">
            <h3>Estimado Aprendiz:</h3>
            <p>el sena tiene el gusto de presentar el programa de Prácticas , el cual busca dar la oportunidad a nuestros estudiantes de realizar su práctica en diferentes organizaciones del Área metropolitana y a nivel nacional, con el fin de apoyar y fortalecer los diferentes procesos organizacionales. Adjunto podrá encontrar información detallada de los diferentes programas académicos con las características generales.</p>
            <p>Relacionamos los datos básicos para proceder con la solicitud de practicantes, donde se busca ofrecer un usuario y clave de acceso al aplicativo, que posteriormente le permitirá publicar ofertas, consultar las hojas de vida de los estudiantes que se postulen para realizar el proceso de selección, y evaluar a los estudiantes al momento de terminar su práctica:</p>
            

            <h3>PARA LA CREACIÓN DE LA PRÁCTICA NECESITAMOS ESTOS DATOS:</h3>
            <div class="form-group">
                <label for="nombre_practica">Nombre de la práctica:</label>
                <input type="text" id="nombre_practica" name="nombre_practica" required>
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
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>
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
</body>
</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>