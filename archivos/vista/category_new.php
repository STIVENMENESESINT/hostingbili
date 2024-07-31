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
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>
    <script src="../../herramientas/js/biblioteca.js"></script>

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
        .create-button {
        background-color: #4CAF50;
        color: white;
        }

        .close-button {
            background-color: #f44336;
            color: white;
        }
        .cabecera_menu {
                            position: relative;
                        }
        .fixed-top-right {
                            position: absolute;
                            top: 10px; /* Ajusta este valor según necesites */
                            right: 10px; /* Ajusta este valor según necesites */
                            z-index: 1000; /* Asegura que esté por encima de otros elementos */
                            padding: 5px 10px; /* Espaciado interno */
                        }
        .fixed-top-right .btn i {
                            margin-right: 5px; /* Espacio entre el icono y el texto */
                                }
        .title {
            color: #3498db; /* Cambia esto por el color deseado */
            font-size: 3rem; /* Cambia el tamaño de la fuente a tu preferencia */
            margin-bottom: 0px; /* Espaciado en la parte inferior del título */
            text-align: center; /* Centra el texto */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Sombra del texto */
            font-weight: bold; /* Fuente en negrita */
            letter-spacing: 1px; /* Espaciado entre letras */
        }
    </style>
</head>
<body>

    <div class="container is-fluid mb-6">
        <h1 class="title">Biblioteca Bilingüismo<br>Secciones B-Team-Language </h1>
    </div>
    <div class="container pb-6 pt-6">
        <form id="addSectionForm" class="container">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">Nombre de la Sección a Ingresar:</label>
                        <div class="control">
                            <input class="input" type="text" id="nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">Descripción:</label>
                        <div class="control">
                            <input class="input" type="text" id="descripcion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}" maxlength="150">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">Idioma:</label>
                        <div class="control">
                            <select name="" id="id_idioma"></select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <p class="control has-text-centered">
                    <button type="button" id="guardar_seccion" class="create-button">Guardar</button>
                </p>
            </div>
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