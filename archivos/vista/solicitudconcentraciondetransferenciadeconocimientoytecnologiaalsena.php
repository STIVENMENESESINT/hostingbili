
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




    <div class="container">

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta Concertación de Transferencia de Conocimiento y Tecnología al SENA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section label {
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h3>SERVICIO NACIONAL DE APRENDIZAJE</h3>
        <h4>DIRECCIÓN DEL SISTEMA NACIONAL DE FORMACIÓN PARA EL TRABAJO</h4>
        <h5>PROGRAMA DE FORMACIÓN CONTINUA ESPECIALIZADA - CONVOCATORIA DG-0001 DE 2018</h5>
        <h5>ACTA CONCERTACIÓN DE TRANSFERENCIA DE CONOCIMIENTO Y TECNOLOGÍA AL SENA</h5>
    </div>

    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="actaNo">Acta No.</label>
                <input type="text" class="form-control" id="actaNo" name="actaNo" required>
            </div>
            <div class="form-group col-md-6">
                <label for="clase">Clase</label>
                <input type="text" class="form-control" id="clase" name="clase" required>
            </div>
        </div>

        <div class="form-group">
            <label for="fuente">Fuente</label>
            <input type="text" class="form-control" id="fuente" name="fuente" required>
        </div>

        <div class="form-group">
            <label for="etapa">Etapa</label>
            <input type="text" class="form-control" id="etapa" name="etapa" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción (Qué puede pasar y cómo puede ocurrir)</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="consecuencia">Consecuencia de la ocurrencia del evento</label>
            <textarea class="form-control" id="consecuencia" name="consecuencia" rows="3" required></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="probabilidad">Probabilidad</label>
                <input type="text" class="form-control" id="probabilidad" name="probabilidad" required>
            </div>
            <div class="form-group col-md-4">
                <label for="impacto">Impacto</label>
                <input type="text" class="form-control" id="impacto" name="impacto" required>
            </div>
            <div class="form-group col-md-4">
                <label for="valoracionRiesgo">Valoración del riesgo</label>
                <input type="text" class="form-control" id="valoracionRiesgo" name="valoracionRiesgo" required>
            </div>
        </div>

        <div class="form-group">
            <label for="categoria">Categoría</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
        </div>

        <div class="form-group">
            <label for="asignadoA">¿A quién se le asigna?</label>
            <input type="text" class="form-control" id="asignadoA" name="asignadoA" required>
        </div>

        <div class="form-group">
            <label for="tratamiento">Tratamiento/Controles a ser implementados</label>
            <textarea class="form-control" id="tratamiento" name="tratamiento" rows="3" required></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="probabilidadTratamiento">Probabilidad (Post-Tratamiento)</label>
                <input type="text" class="form-control" id="probabilidadTratamiento" name="probabilidadTratamiento" required>
            </div>
            <div class="form-group col-md-4">
                <label for="impactoTratamiento">Impacto (Post-Tratamiento)</label>
                <input type="text" class="form-control" id="impactoTratamiento" name="impactoTratamiento" required>
            </div>
            <div class="form-group col-md-4">
                <label for="valoracionRiesgoTratamiento">Valoración del riesgo (Post-Tratamiento)</label>
                <input type="text" class="form-control" id="valoracionRiesgoTratamiento" name="valoracionRiesgoTratamiento" required>
            </div>
        </div>

        <div class="form-group">
            <label for="categoriaTratamiento">Categoría (Post-Tratamiento)</label>
            <input type="text" class="form-control" id="categoriaTratamiento" name="categoriaTratamiento" required>
        </div>

        <div class="form-group">
            <label for="afectaEjecucion">¿Afecta la ejecución del convenio?</label>
            <input type="text" class="form-control" id="afectaEjecucion" name="afectaEjecucion" required>
        </div>

        <div class="form-group">
            <label for="responsableTratamiento">Persona responsable por implementar el tratamiento</label>
            <input type="text" class="form-control" id="responsableTratamiento" name="responsableTratamiento" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fechaInicioTratamiento">Fecha estimada en que se inicia el tratamiento</label>
                <input type="date" class="form-control" id="fechaInicioTratamiento" name="fechaInicioTratamiento" required>
            </div>
            <div class="form-group col-md-6">
                <label for="fechaCompletaTratamiento">Fecha estimada en que se completa el tratamiento</label>
                <input type="date" class="form-control" id="fechaCompletaTratamiento" name="fechaCompletaTratamiento" required>
            </div>
        </div>

        <div class="form-group">
            <label for="monitoreo">¿Cómo se realiza el monitoreo?</label>
            <textarea class="form-control" id="monitoreo" name="monitoreo" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="periodicidad">Periodicidad (¿Cuándo?)</label>
            <input type="text" class="form-control" id="periodicidad" name="periodicidad" required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
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