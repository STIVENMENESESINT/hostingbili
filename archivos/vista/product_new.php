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
    <link rel="stylesheet" href="../../herramientas/css/style.css">

    <title>Libros</title>
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



    <div class="content__page">


        <div class="container">
            <div class="is-fluid mb-6">
                <h1 class="title">Biblioteca Bilingüismo<br>Nuevo libro B-Team-Language </h1>
            </div>
            <div class="buttons">
                <div class="container">
                    <a href="" class="navbar-item">Publicar Libro </a>
                    <form id="addBookForm" enctype="multipart/form-data">
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">Título:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="titulo" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Prologo Corto del Libro:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="prologo" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Autor:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="autor" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Descripcion Corta Autor:</label>
                                    <div class="control">
                                        <input class="input" type="text" name="descripcion_autor" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Año de Publicación:</label>
                                    <div class="control">
                                        <input class="input" type="number" name="anio_publicacion" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Sección:</label>
                                    <div class="control">
                                        <select id="fk_seccion"></select>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Archivo PDF:</label>
                                    <div class="control">
                                        <input class="input" type="file" name="archivo_pdf" accept="application/pdf"
                                            required>
                                    </div>
                                </div>
                                <div class="field">
                                    <input type="hidden" name="fk_publicante" value="1">
                                    <!-- ID del usuario publicante -->
                                </div>
                                <div class="field">
                                    <p class="control has-text-centered">
                                        <button type="button" id="guardar_libro" class="create-button">Guardar</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>