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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cambio de Carrera</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->
</head>
<body>

<h1>Solicitud de Cambio de Carrera</h1>

<form action="procesar_cambio_carrera.php" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre Completo:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="numero_estudiante">Número de Estudiante:</label>
    <input type="text" id="numero_estudiante" name="numero_estudiante" required>

    <label for="carrera_actual">Carrera Actual:</label>
    <input type="text" id="carrera_actual" name="carrera_actual" required>

    <label for="carrera_nueva">Carrera a la que Desea Cambiar:</label>
    <input type="text" id="carrera_nueva" name="carrera_nueva" required>

    <label for="motivo">Motivo del Cambio:</label>
    <textarea id="motivo" name="motivo" rows="4" required></textarea>




    
    <label for="expectativas">Expectativas y Objetivos:</label>
    <textarea id="expectativas" name="expectativas" rows="4" required></textarea>

    <label for="plan_estudio">Plan de Estudio Propuesto:</label>
    <textarea id="plan_estudio" name="plan_estudio" rows="4"></textarea>

    <label for="descripcion">Descripción Adicional:</label>
    <input type="text" id="descripcion" name="descripcion">

    <label for="archivo">Archivo Adjunto:</label>
    <input type="file" id="archivo" name="archivo">

    <label for="url">URL:</label>
    <input type="url" id="url" name="url">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen">

    <label for="fecha_inicio">Fecha de Inicio:</label>
    <input type="datetime-local" id="fecha_inicio" name="fecha_inicio">

    <label for="fecha_fin">Fecha de Fin:</label>
    <input type="datetime-local" id="fecha_fin" name="fecha_fin">

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion">

    <!-- Los siguientes campos son selectores -->
    <label for="id_categoria">Categoría:</label>
    <select id="id_categoria" name="id_categoria">
        <option value="1">Categoría 1</option>
        <option value="2">Categoría 2</option>
        <!-- Agrega más opciones según tu base de datos -->
    </select>

    <label for="id_ficha">Ficha:</label>
    <select id="id_ficha" name="id_ficha">
        <option value="1">Ficha 1</option>
        <option value="2">Ficha 2</option>
        <!-- Agrega más opciones según tu base de datos -->
    </select>

    <label for="id_jornada">Jornada:</label>
    <select id="id_jornada" name="id_jornada">
        <option value="1">Jornada 1</option>
        <option value="2">Jornada 2</option>
        <!-- Agrega más opciones según tu base de datos -->
    </select>

    <label for="id_modalidad">Modalidad:</label>
    <select id="id_modalidad" name="id_modalidad">
        <option value="1">Modalidad 1</option>
        <option value="2">Modalidad 2</option>
        <!-- Agrega más opciones según tu base de datos -->
    </select>

    <label for="id_programaformacion">Programa de Formación:</label>
    <select id="id_programaformacion" name="id_programaformacion">
        <option value="1">Programa 1</option>
        <option value="2">Programa 2</option>
        <!-- Agrega más opciones según tu base de datos -->
    </select>

    <label for="id_tiposolicitud">Tipo de Solicitud:</label>
    <select id="id_tiposolicitud" name="id_tiposolicitud">
        <option value="1">Tipo 1</option>
        <option value="2">Tipo 2</option>
        <!-- Agrega más opciones según tu base de datos -->
    </select>

    <button type="submit">Enviar Solicitud</button>
</form>

</body>
</html>

</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>