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
                    <div>
                        <h1 class="title" data-lang-es="Cursos Virtuales Bilingüismo"
                            data-lang-en="Virtual Bilingualism Courses" data-lang-fr=" Cours Virtuels de Bilinguisme">

                        </h1>
                    </div>
                    <div class="bilingualism__english-cards-container">
                        <div class="bilingualism__english-cards">
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240087">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles1-banner.webp"
                                        alt="English 1 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Fortalecimiento de herramientas básicas para la comunicación en inglés."
                                    data-lang-en="Strengthening basic tools for communication in English."
                                    data-lang-fr="Renforcement des outils de base pour la communication en anglais.">
                                    Fortalecimiento de herramientas básicas para la comunicación en inglés.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240088">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles2-banner.webp"
                                        alt="English 2 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Comunicación en contextos personales y profesionales en inglés."
                                    data-lang-en="Communication in personal and professional contexts in English."
                                    data-lang-fr="Communication dans des contextes personnels et professionnels en anglais.">
                                    Comunicación en contextos personales y profesionales en inglés.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240089">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles3-banner.webp"
                                        alt="English 3 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Comunicación en contextos personales y profesionales en inglés."
                                    data-lang-en="Communication in personal and professional contexts in English."
                                    data-lang-fr="Communication dans des contextes personnels et professionnels en anglais.">
                                    Comunicación en contextos personales y profesionales en inglés.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240090">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles4-banner.webp"
                                        alt="English 4 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Consolidación y comprensión de diferentes textos orales y escritos en inglés."
                                    data-lang-en="Consolidation and understanding of different oral and written texts in English."
                                    data-lang-fr="Consolidation et compréhension de différents textes oraux et écrits en anglais.">
                                    Consolidación y comprensión de diferentes textos orales y escritos en inglés.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240091">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles5-banner.webp"
                                        alt="English 5 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Interacción en diferentes contextos expresando gustos y preferencias en inglés."
                                    data-lang-en="Interaction in different contexts expressing tastes and preferences in English."
                                    data-lang-fr="Interaction dans différents contextes en exprimant des goûts et des préférences en anglais.">
                                    Interacción en diferentes contextos expresando gustos y preferencias en inglés.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240092">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles6-banner.webp"
                                        alt="English 6 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Fortalecimiento de herramientas para la comunicación en inglés."
                                    data-lang-en="Strengthening tools for communication in English."
                                    data-lang-fr="Renforcement des outils pour la communication en anglais.">
                                    Fortalecimiento de herramientas para la comunicación en inglés.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240093">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles7-banner.webp"
                                        alt="English 7 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Consolidación de herramientas para la comunicación efectiva en diferentes contextos."
                                    data-lang-en="Consolidation of tools for effective communication in different contexts."
                                    data-lang-fr="Consolidation des outils pour une communication efficace dans différents contextes.">
                                    Consolidación de herramientas para la comunicación efectiva en diferentes contextos.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240094">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles8-banner.webp"
                                        alt="English 8 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Construcción de textos orales y escritos según las características e intencionalidad del contexto."
                                    data-lang-en="Construct oral and written texts according to the characteristics and intentionality of the context."
                                    data-lang-fr="Construire des textes oraux et écrits selon les caractéristiques et l'intentionnalité du contexte.">
                                    Construcción de textos orales y escritos según las características e intencionalidad
                                    del contexto.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240095">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles9-banner.webp"
                                        alt="English 9 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Comentar sobre eventos que han ocurrido o están planificados en inglés basándose en textos narrativos."
                                    data-lang-en="Comment on events that have occurred or are planned in English based on narrative texts."
                                    data-lang-fr="Commenter des événements qui se sont produits ou sont prévus en anglais en se basant sur des textes narratifs.">
                                    Comentar sobre eventos que han ocurrido o están planificados en inglés basándose en
                                    textos narrativos.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240096">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles10-banner.webp"
                                        alt="English 10 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Construir textos orales y escritos en inglés sobre eventos futuros."
                                    data-lang-en="Construct oral and written texts in English about future events."
                                    data-lang-fr="Construire des textes oraux et écrits en anglais sur des événements futurs.">
                                    Construir textos orales y escritos en inglés sobre eventos futuros.
                                </p>
                            </div>
                            <div class="bilingualism__english-levels">
                                <a target="_blank"
                                    href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240097">
                                    <img loading="lazy" src="../../imagenes/img/banner/ingles11-banner.webp"
                                        alt="English 11 banner" class="bilingualism__english-imgs">
                                </a>
                                <p class="bilingualism__english-text"
                                    data-lang-es="Escribir textos argumentativos en inglés con coherencia y cohesión según la intencionalidad comunicativa."
                                    data-lang-en="Write argumentative texts in English with coherence and cohesion according to the communicative intentionality."
                                    data-lang-fr="Rédiger des textes argumentatifs en anglais avec cohérence et cohésion selon l'intentionnalité communicative.">
                                    Escribir textos argumentativos en inglés con coherencia y cohesión según la
                                    intencionalidad comunicativa.
                                </p>
                            </div>
                        </div>

                        <div class="divider"></div>
                    </div>
                    <!-- Fin Cursos Sena Bilinguismo -->
                    <!-- El contenido dinámico se cargará aquí -->

                    <div id="conten navbar">
                        <div class="navbar">
                            <ul class="navbar-nav">
                                <a id="showRevista" type="button" class="nav-link ">

                                    <i class="fas fa-book-open nav-link"><br>
                                        <span class="" data-lang-es="Desplegar Revista" data-lang-en="Expand Magazine"
                                            data-lang-fr="Déplier le Magazine">
                                            Desplegar Revista

                                        </span>
                                    </i>

                                </a>
                                <?php
                        if ($_SESSION['id_rol'] != 1) {
                            echo '
                                <li>   
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#noticiaModal" class="nav-link">
                                        <i class="fas fa-plus nav-link">
                                            <span class="" data-lang-es="Crear" data-lang-en="Create" data-lang-fr="Créer"> 
                                                Crear  
                                                
                                            </span>
                                        </i>
                                        
                                    </a>
                                </li>      
                                <li>
                                    <a type="button" class="nav-link">
                                    
                                        <i class="fas fa-thin fa-folder-open nav-link">
                                            <span id="MisSoliActivate" data-bs-toggle="modal" data-bs-target="#MisSoli" class="" data-lang-es="Mis Publicaciones" data-lang-en="My Publications" data-lang-fr="Mes Publications">
                                                Mis Publicaciones
                                            
                                                
                                            </span>
                                        </i>    
                                        
                                    </a>
                                </li> 
                        ';
                        }
                        ?>
                        </div>
                        <div id="revista">
                            <h1 data-lang-es="Revista Sena B-Team" data-lang-en="Sena B-Team Magazine"
                                data-lang-fr="Magazine de l'équipe B de Sena">Revista Sena B-Team </h2>
                                <div class="divider"></div>
                                <a id="hideRevista" type="button" class="nav-link nav-item-hover">
                                    <i class="fas fa-book"></i>
                                    <span class="nav-item" data-lang-es="Ocultar Revista" data-lang-en="Hide Magazine"
                                        data-lang-fr="Cacher le Magazine">Ocultar Revista</span>
                                </a>
                                <?php
                            if ($_SESSION['id_rol'] == 3) {
                                echo '
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#revistaModal" class="nav-link nav-item-hover">
                                        <i class="fas fa-plus " ></i>
                                        <span class="nav-item"  data-lang-es="Nueva Revista" data-lang-en="New Magazine" data-lang-fr="Nouveau Magazine">Nueva Revista</span>
                                    </a>
                            ';
                        }
                        ?>
                                <center>
                                    <embed src="../../imagenes/Revista B2.pdf" type="application/pdf" width="90%"
                                        height="500px" />
                                </center>
                                <br>
                        </div>
                        </ul>


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