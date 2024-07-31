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
    <link rel="stylesheet" href="../../archivos/vista/style.css">
    <link rel="stylesheet" href="../../chatp/style.css">
    <link rel="stylesheet" href="../../herramientas/css/inicio.css">
</head>
<style>
.container {
    background: rgba(255, 255, 255, 0.95);
    padding: 16px;
    padding-right: 50px;
    padding-left: 50px;
    border-radius: 30px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
    max-width: 1400px;
    width: 99%;
}

.navbar {
    display: flex;
    justify-content: center;
    background-color: #04324d;
    padding: 15px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    /* Ajusta el valor según el nivel de redondez deseado */
    margin: 10px;
    /* Añade un margen para separarlo de otros elementos */
}

.nav-link {
    color: #ecf0f1;
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    display: flex;
    align-items: center;
    padding: 12px 20px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background-color: #34495e;
    color: #2ecc71;
    transform: translateY(-2px);
}

img {
    border-style: none;
}

.navbar-brand {
    display: flex;
    justify-content: space-between;
    margin: auto;
    max-width: var(--web-margin);
    padding: 1.0rem 1.5rem;
    align-items: center;
}

.navbar__cpv--logo {
    height: 2.2rem !important;
}

.navbar-brand__logo {
    height: 4rem;
}

.nav-link i {
    margin-left: 10px;
    font-size: 18px;
}

.fa-solid,
.fas {

    font-weight: 900;
}

.title {
    color: #3498db;

    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 3em;
    text-align: center;
    margin: -6px 0;
}

.divider {
    height: 6px;
    width: 150px;
    background-color: #04324d;
    margin: 30px auto;
    border-radius: 3px;
}

.carrousel {
    width: 99%;
    height: 90%;

}

.revista {
    width: 90%;
    height: 90%;
}


.nav-link {
    display: inline-block;
}

#noticia_creada {
    width: 100%;
    /* Ajusta el ancho según sea necesario */
    height: 400px;
    /* Ajusta la altura según sea necesario */
    overflow-y: auto;
    /* Permite el desplazamiento vertical */
    overflow-x: hidden;
    /* Oculta el desplazamiento horizontal si no es necesario */

    /* Añade un borde para visualización */
    padding: 10px;
    /* Añade padding si es necesario */
}
</style>
<!-- <div class="navbar-brand">
    <img class="navbar-brand_logo navbar__cpv--logo" src="" alt="logo de bilinguismo">
    <img class="navbar-brand_logo " src="" alt="logo de bilinguismo">
</div> -->
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
            </div>
            <!-- este es el traductor -->


            <div class="divider"></div>
            <style>
            .bilingualism__english-cards-container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f9f9f9;
                overflow-y: scroll;
                height: 400px;
                /* Adjust the height as needed */
            }

            .bilingualism__english-cards {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(7, auto);
                /* Adjust the number of rows if needed */
                gap: 10px;
            }

            .bilingualism__english-levels {
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px;
                background-color: #fff;
                text-align: center;
            }

            .bilingualism__english-imgs {
                width: 100%;
                height: auto;
                border-radius: 8px;
            }

            .bilingualism__english-text {
                margin-top: 10px;
                font-size: 1.3em;
                color: #333;
            }
            </style>
            <!-- Cursos Sena Bilinguismo -->
            <div>


                <div>
                    <h1 class="title" data-lang-es="Cursos Bilingüismo" data-lang-en="Courses Bilingualism"
                        data-lang-fr="Cours Bilinguisme">
                        Cursos Bilingüismo
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
                            <p class="bilingualism__english-text">Strengthening basic tools for communication in
                                English.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240088">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles2-banner.webp"
                                    alt="English 2 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Communication in personal and professional contexts in
                                English.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240089">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles3-banner.webp"
                                    alt="English 3 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Communication in personal and professional contexts in
                                English.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240090">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles4-banner.webp"
                                    alt="English 4 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Consolidation and understanding of different oral and
                                written texts in English.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240091">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles5-banner.webp"
                                    alt="English 5 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Interaction in different contexts expressing tastes
                                and preferences in English.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240092">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles6-banner.webp"
                                    alt="English 6 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Strengthening tools for communication in English.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240093">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles7-banner.webp"
                                    alt="English 7 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Consolidation of tools for effective communication in
                                different contexts.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240094">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles8-banner.webp"
                                    alt="English 8 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Construct oral and written texts according to the
                                characteristics and intentionality of the context.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240095">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles9-banner.webp"
                                    alt="English 9 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Comment on events that have occurred or are planned in
                                English based on narrative texts.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240096">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles10-banner.webp"
                                    alt="English 10 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Construct oral and written texts in English about
                                future events.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240097">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles11-banner.webp"
                                    alt="English 11 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Write argumentative texts in English with coherence
                                and cohesion according to the communicative intentionality.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240098">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles12-banner.webp"
                                    alt="English 12 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Justify oral and written opinions according to the
                                social or professional context in English.</p>
                        </div>
                        <div class="bilingualism__english-levels">
                            <a target="_blank"
                                href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240099">
                                <img loading="lazy" src="../../imagenes/img/banner/ingles13-banner.webp"
                                    alt="English 13 banner" class="bilingualism__english-imgs">
                            </a>
                            <p class="bilingualism__english-text">Interact in communicative acts with independence and
                                fluency based on current social contexts.</p>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
            <!-- Fin Cursos Sena Bilinguismo -->
            <!-- El contenido dinámico se cargará aquí -->

            <div id="conten navbar">
                <div class="navbar">
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
                                            <span class="" data-lang-es="Mis Publicaciones" data-lang-en="My Publications" data-lang-fr="Mes Publications">
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
                        <embed src="../../imagenes/Revista B2.pdf" type="application/pdf" width="90%" height="500px" />
                        </center>
                        <br>
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



</body>
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
.language-select-container {
    position: absolute;
    top: 20px;
    /* Ajusta esto para mover el contenedor hacia abajo o hacia arriba */
    left: 20px;
    /* Ajusta esto para mover el contenedor hacia la derecha o hacia la izquierda */
    background-color: rgba(240, 240, 240, 0.5);
    /* Fondo semi-transparente */
    padding: 10px;
    /* Espaciado interno */
    border-radius: 5px;
    /* Bordes redondeados */
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    /* Sombra para dar profundidad */
}

#language-select {
    width: 80px;
    /* Ajusta el ancho del select */
    padding: 5px;
    /* Espaciado interno para el select */
    border: 2px solid rgba(204, 204, 204, 0.7);
    /* Borde semi-transparente */
    border-radius: 64px;
    /* Bordes redondeados */
    font-size: 14px;
    /* Tamaño de la fuente dentro del select */
    background-color: rgba(240, 240, 240, 0.3);
    /* Fondo semi-transparente */
    color: rgba(0, 0, 0, 0.8);
    /* Color del texto */
}

label {
    margin-right: 10px;
    /* Espaciado entre la etiqueta y el select */
    font-size: 14px;
    /* Tamaño de la fuente de la etiqueta */
    color: rgba(0, 0, 0, 0.8);
    /* Color del texto de la etiqueta */
}
</style>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>