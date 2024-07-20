
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/layout.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>
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
    <title>Secciones</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5; /* Cambiar el color de fondo */
            font-family: 'Roboto', sans-serif;
        }
        .title {
            color: #333; /* Cambiar el color del título */
            font-size: 2em; /* Ajustar el tamaño del título */
            margin-bottom: 0.5em; /* Ajustar el espacio inferior del título */
        }
        .subtitle {
            color: #555; /* Cambiar el color del subtítulo */
            font-size: 1.5em; /* Ajustar el tamaño del subtítulo */
            margin-bottom: 1.5em; /* Ajustar el espacio inferior del subtítulo */
        }
        .container {
            background-color: #fff; /* Cambiar el color de fondo del contenedor */
            border-radius: 10px; /* Agregar bordes redondeados al contenedor */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Agregar sombra al contenedor */
            padding: 2em; /* Ajustar el relleno del contenedor */
            margin-bottom: 2em; /* Ajustar el espacio inferior del contenedor */
        }
        .input {
            border-radius: 5px; /* Agregar bordes redondeados a los campos de entrada */
        }
        .button {
            border-radius: 25px; /* Agregar bordes redondeados al botón */
        }
        .button:hover {
            background-color: #48a9a6; /* Cambiar el color de fondo al pasar el mouse */
        }
        .button:active {
            background-color: #3b8070; /* Cambiar el color de fondo al hacer clic */
        }
    </style>
</head>
<body>
<style >
                        .cabecera_menu {
                            position: relative;
                        }
                        .fixed-top-right {
                            position: absolute;
                            top: 10px; /* Ajusta este valor según necesites */
                            right: 10px; /* Ajusta este valor según necesites */
                            z-index: 1000; /* Asegura que esté por encima de otros elementos */
                            background-color: white; /* Fondo blanco para mejor visibilidad */
                            
                            padding: 5px 10px; /* Espaciado interno */
                        }
                        .fixed-top-right .btn i {
                            margin-right: 5px; /* Espacio entre el icono y el texto */
                        }
                    </style>
                    <button type="button" class="btn nav-link nav-item-hover fixed-top-right" onclick="goBack()">
                        <i class="fas fa-arrow-left fa-fw fa-lg"></i>
                        <span class="nav-item">Volver</span>
                    </button>

                    <script>
                    function goBack() {
                        window.history.back();
                    }
                    </script>
    <div class="container is-fluid mb-6">
        <h1 class="title">Secciones</h1>
        <h2 class="subtitle">Nueva Secciones</h2>
    </div>
    <div class="container pb-6 pt-6">
	<?php
		include "../inc/btn_back.php";

	;
	?>

    <div class="container pb-6 pt-6">
        <form action="./php/categoria_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">Nombre de la Secciones a ingresar:</label>
                        <div class="control">
                            <input class="input" type="text" name="categoria_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">Ubicación:</label>
                        <div class="control">
                            <input class="input" type="text" name="categoria_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}" maxlength="150">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <p class="control has-text-centered">
                    <button type="submit" class="button is-info is-rounded is-large">Guardar</button>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
