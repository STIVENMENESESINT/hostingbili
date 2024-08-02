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

    <script type='text/javascript' src="../../herramientas/js/noticia.js"></script>
    <link rel="stylesheet" href="../../herramientas/css/solicitud.css">
    <link rel="stylesheet" href="../../herramientas/css/about.css">
    <link rel="stylesheet" href="../../herramientas/css/style.css">


    <link rel="stylesheet" href="../../chatp/style.css">

</head>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const languageSelect = document.getElementById("language-select");

    languageSelect.addEventListener("change", (event) => {
        const selectedLanguage = event.target.value;
        setLanguage(selectedLanguage);
    });

    function setLanguage(language) {
        document.querySelectorAll("[data-lang-es]").forEach(element => {
            element.textContent = element.getAttribute(`data-lang-${language}`);
        });
    }

    // Set default language
    setLanguage(languageSelect.value);
});
</script>

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
        <div class="container layout__content">

            <div>

                <select id="language-select">
                    <option value="es"><label for="language-select">Idioma:</label></option>
                    <option value="es">Español</option>
                    <option value="en">English</option>
                    <option value="fr">Français</option>
                </select>
            </div>
            <div class="content__page">
                <div class="">
                    <!--este es mi carrucel principal -->
                    <?php 
                        include_once('publicarnoticiacarrusel.php');
                    ?>
                </div>
                <!-- este es el traductor -->
                <div class="divider"></div>
                <!-- Cursos Sena Bilinguismo -->
                <div>
                    <?php 
                        include_once('banner.php');
                    ?>

                    <!-- Fin Cursos Sena Bilinguismo -->
                    <!-- El contenido dinámico se cargará aquí -->

                    <div id="conten navbar">
                        <?php 
                            include_once('panelinicio.php');
                        ?>
                    </div>
                    <!-- Bili asistente virtual -->
                    <?php 
                        include_once('../../chatp/index.php');
                    ?>
                    <div class="divider"></div>

                    <h1 class="title" data-lang-es="NOTICIAS" data-lang-en="NEWS" data-lang-fr="ACTUALITÉS">NOTICIAS
                    </h1>



                    <div id="noticia_creada" class=" grid-container ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="modal fade" id="MisSoli" tabindex="-1" aria-labelledby="MisSoliLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Mis Publicaciones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="MisSoliForm"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close-button" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-center" data-lang-es="Crear publicación" data-lang-en="Create Publication"
                    data-lang-fr="Créer une publication">Crear publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="card p-3 shadow-lg border-3 text-bg-light" action="" method="post"
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label" data-lang-es="Título:" data-lang-en="Title:"
                            data-lang-fr="Titre:">Título:</label>
                        <input type="text" class="form-control" id="titulo" placeholder="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label" data-lang-es="Fecha a Mostrar"
                            data-lang-en="Display Date" data-lang-fr="Date à Afficher">Fecha a Mostrar</label>
                        <input class="form-control" type="date" id="id_fecha_mostrada" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" data-lang-es="Descripción" data-lang-en="Description"
                            data-lang-fr="Description">Descripción</label>
                        <textarea rows="10" class="form-control" id="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label" data-lang-es="Adjuntar Imagen:"
                            data-lang-en="Attach Image:" data-lang-fr="Joindre une Image:">Adjuntar Imagen:</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_categoria" class="form-label" data-lang-es="Categoría" data-lang-en="Category"
                            data-lang-fr="Catégorie">Categoría</label>
                        <select class="form-control" id="id_categoria" name="id_categoria"
                            onchange="MostrarTipo_Categoria()">
                            <!-- Opciones de categorías aquí -->
                        </select>
                    </div>
                    <div class="mb-3" id="tipo_cate">
                        <!-- Contenido dependiente de la categoría -->
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="revistaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" data-lang-es="Subir Imágenes al Carrusel"
                    data-lang-en="Upload Carousel Images" data-lang-fr="Télécharger des Images pour le Carrousel">Subir
                    Imágenes al Carrusel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image" data-lang-es="Selecciona una imagen:" data-lang-en="Select an image:"
                        data-lang-fr="Sélectionnez une image:">Selecciona una imagen:</label>
                    <input type="file" name="image[]" id="image" class="form-control" multiple>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-lang-es="Salir"
                    data-lang-en="Exit" data-lang-fr="Sortir">Salir</button>
                <input class="btn btn-primary" type="button" id="actualizarPermisousu" value="Gestionar"
                    data-lang-es="Gestionar" data-lang-en="Manage" data-lang-fr="Gérer">
            </div>
        </div>
    </div>
</div>



</html>
<style>

</style>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>