
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
    <title>Formulario de Acción de Formación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
        }
        .section {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            flex: 1;
        }
        .section h2 {
            background-color: #f2f2f2;
            padding: 10px;
            margin: -10px -10px 10px -10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h1>Formulario de Acción de Formación</h1>

<form action="submit_form.php" method="post">
    <div class="container">
        <!-- Información de la acción de formación -->
        <div class="section">
            <h2>Información de la acción de formación</h2>
            <div class="form-group">
                <label for="nombreAccion">Nombre acción de formación:</label>
                <input type="text" id="nombreAccion" name="nombreAccion" required>
            </div>
            <div class="form-group">
                <label for="tipoEvento">Tipo de Evento de Formación:</label>
                <input type="text" id="tipoEvento" name="tipoEvento" required>
            </div>
            <div class="form-group">
                <label for="modalidad">Modalidad:</label>
                <input type="text" id="modalidad" name="modalidad" required>
            </div>
            <div class="form-group">
                <label for="metodologia">Metodología:</label>
                <input type="text" id="metodologia" name="metodologia" required>
            </div>
            <div class="form-group">
                <label for="puestoTrabajo">Formación en el Puesto de Trabajo:</label>
                <input type="text" id="puestoTrabajo" name="puestoTrabajo" required>
            </div>
            <div class="form-group">
                <label for="horasAF">Horas de A.F:</label>
                <input type="number" id="horasAF" name="horasAF" required>
            </div>
            <div class="form-group">
                <label for="cantidadGrupos">Cantidad de grupos:</label>
                <input type="number" id="cantidadGrupos" name="cantidadGrupos" required>
            </div>
            <div class="form-group">
                <label for="cuposOfertados">Número de Cupos Ofertados:</label>
                <input type="number" id="cuposOfertados" name="cuposOfertados" required>
            </div>
            <div class="form-group">
                <label for="beneficiariosTotales">Número de beneficiarios totales:</label>
                <input type="number" id="beneficiariosTotales" name="beneficiariosTotales" required>
            </div>
        </div>
        
        <!-- Beneficiarios por género -->
        <div class="section">
            <h2>Beneficiarios por género</h2>
            <div class="form-group">
                <label for="beneficiariosM">M:</label>
                <input type="number" id="beneficiariosM" name="beneficiariosM" required>
            </div>
            <div class="form-group">
                <label for="beneficiariosF">F:</label>
                <input type="number" id="beneficiariosF" name="beneficiariosF" required>
            </div>
        </div>

        <!-- Población en condición de vulnerabilidad -->
        <div class="section">
            <h2>Población en condición de vulnerabilidad</h2>
            <div class="form-group">
                <label for="vulnerabilidad">Número de beneficiarios:</label>
                <input type="number" id="vulnerabilidad" name="vulnerabilidad" required>
            </div>
        </div>

        <!-- Fechas de inicio y finalización -->
        <div class="section">
            <h2>Fechas de inicio y finalización</h2>
            <div class="form-group">
                <label for="fechaInicio">Fecha Inicial:</label>
                <input type="date" id="fechaInicio" name="fechaInicio" required>
            </div>
            <div class="form-group">
                <label for="fechaFinal">Fecha Final:</label>
                <input type="date" id="fechaFinal" name="fechaFinal" required>
            </div>
        </div>

        <!-- Datos del proponente -->
        <div class="section">
            <h2>Datos del proponente</h2>
            <div class="form-group">
                <label for="fechaInicioProyecto">Fecha de Inicio del Proyecto:</label>
                <input type="date" id="fechaInicioProyecto" name="fechaInicioProyecto" required>
            </div>
            <div class="form-group">
                <label for="proponente">Proponente:</label>
                <input type="text" id="proponente" name="proponente" required>
            </div>
            <div class="form-group">
                <label for="nit">NIT:</label>
                <input type="text" id="nit" name="nit" required>
            </div>
            <div class="form-group">
                <label for="directorProyecto">Director del Proyecto:</label>
                <input type="text" id="directorProyecto" name="directorProyecto" required>
            </div>
        </div>
        
        <button type="submit">Enviar</button>
    </div>
</form>

</body>
</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>