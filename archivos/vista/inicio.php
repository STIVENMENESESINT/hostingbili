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
</head>
<style>
.container {
    background: rgba(255, 255, 255, 0.95);
    padding: 50px;
    padding-right: 50px;
    padding-left: 50px;
    border-radius: 30px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
    max-width: 1400px;
    width: 95%;
}

.navbar {
    display: flex;
    justify-content: center;
    background-color: #04324d;
    padding: 15px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    font-size: 7em;
    margin-bottom: 0px;
    text-align: center;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    font-weight: bold;
    letter-spacing: 1px;
}

.divider {
    height: 6px;
    width: 150px;
    background-color: #04324d;
    margin: 30px auto;
    border-radius: 3px;
}

.carrousel {
    width: 90%;
    height: 90%;
}

.revista {
    width: 90%;
    height: 90%;
}

.nav-link {
    display: inline-block;
}
</style>
<!-- <div class="navbar-brand">
    <img class="navbar-brand_logo navbar__cpv--logo" src="" alt="logo de bilinguismo">
    <img class="navbar-brand_logo " src="" alt="logo de bilinguismo">
</div> -->

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
            <div class="content__page">

                <div class="carrousel">
                    <!--este es mi carrucel principal -->
                    <?php 
                        include_once('publicarnoticiacarrusel.php');
                    ?>
                </div>

            </div>

            <div class="divider"></div>
            <div>
                <h1 class="title">Bilingüismo<br>B-Team-Language </h1>
                <div class="divider"></div>
            </div>
            <!-- El contenido dinámico se cargará aquí -->

            <div id="conten navbar">


                <div class="navbar">


                    <a id="showRevista" type="button" class="nav-link nav-item-hover">

                        <span class="nav-item">Desplegar Revista<i class="fas fa-book-open"></i></span>
                    </a>


                    <?php
                        if ($_SESSION['id_rol'] != 1) {
                            echo '
                                <li>   
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#noticiaModal" class="nav-link">
                                    
                                        <span class="nav-link"> 
                                            Crear  
                                            <i class="fas fa-plus " ></i>   
                                        </span>
                                       
                                    </a>
                                </li>      
                                <li>
                                    <a type="button" class="nav-link">
                                    
                                            
                                        <span class="nav-link">
                                            Mis Publicaciones
                                            <i class="fas fa-thin fa-folder-open" >
                                            </i>    
                                        </span>
                                    
                                    </a>
                                </li> 
                        ';
                        }
                        ?>
                </div>
                <div id="revista">
                    <h1>Revista Sena B-Team </h2>
                        <div class="divider"></div>
                        <a id="hideRevista" type="button" class="nav-link nav-item-hover">

                            <span class="nav-item">Ocultar Revista<i class="fas fa-book"></i></span>
                        </a>
                        <?php
                            if ($_SESSION['id_rol'] == 3) {
                                echo '
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#revistaModal" class="nav-link nav-item-hover">
                                        
                                        <span class="nav-item">Nueva Revista<i class="fas fa-plus " ></i></span>
                                    </a>
                            ';
                        }
                        ?>
                        <embed src="../../imagenes/Revista B2.pdf" type="application/pdf" width="90%" height="500px" />
                        <br>
                </div>
                <div class="divider"></div>

            </div>
            <!-- Bili asistente virtual -->
            <?php 
                        include_once('../../chatp/index.php');
                    ?>

            <h1 class="title">NOTICIAS</h1>
            <!-- <div class="bilinguismo__ingles-cards">
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240087"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles1-banner.webp" alt="ingles 1 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Afianzamiento de herramientas básicas para la
                            comunicación en inglés.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240088"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles2-banner.webp"
                                alt=" ingles 2 banner" class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Comunicación en contextos personales
                            y laborales en inglés</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240089"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles3-banner.webp" alt="ingles 3 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Comunicación en contextos personales
                            y laborales en inglés.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240090"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles4-banner.webp" alt="ingles 4 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Consolidación y comprensión de diferentes textos
                            orales
                            y escritos en inglés.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240091"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles5-banner.webp" alt="ingles 5 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Interacción en diferentes contextos expresando gustos
                            y preferencias en inglés.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240092"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles6-banner.webp" alt="ingles 6 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Afianzamiento de herramientas para la comunicación en
                            inglés. </p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240093"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles7-banner.webp" alt="ingles 7 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Consolidación de herramientas para la
                            comunicación efectiva en diferentes contextos.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240094"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles8-banner.webp" alt="ingles 8 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Construir textos orales y escritos de acuerdo con las
                            características e intencionalidad del contexto.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240095"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles9-banner.webp" alt="ingles 9 banner"
                                class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Opinar de hechos ocurridos o planeados en inglés con
                            base en textos narrativos.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240096"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles10-banner.webp"
                                alt="ingles 10 banner" class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Construir textos orales y escritos en lengua
                            inglesa acerca de sucesos futuros.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240097"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles11-banner.webp"
                                alt="ingles 11 banner" class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Elaborar textos argumentativos en inglés con
                            coherencia y
                            cohesión según la intencionalidad comunicativa.</p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240098"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles12-banner.webp"
                                alt="ingles 12 banner" class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Justificar opiniones orales y escritas según el
                            contexto social o laboral en inglés. </p>
                    </div>
                    <div class="bilinguismo__ingles-niveles">
                        <a target="_blank"
                            href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240099"><img
                                loading="lazy" src="../../imagenes/img/banner/ingles13-banner.webp"
                                alt="ingles 13 banner" class="bilinguismo__ingles-imgs"></a>
                        <p class="bilinguismo__ingles-text">Interactuar en actos comunicativos con independencia
                            y
                            fluidez a partir de contextos sociales actuales.</p>
                    </div>
                </div> -->
            <div class="divider"></div>


            <div id="noticia_creada" class="grid-container ">
            </div>
        </div>
    </div>



</body>
<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-center">Crear publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="card p-3 shadow-lg border-3 text-bg-light" action="" method="post"
                    enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Título:</label>
                        <input type="text" class="form-control" id="titulo" placeholder="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha a Mostrar</label>
                        <input class="form-control" type="date" id="id_fecha_mostrada" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea rows="10" class="form-control" id="descripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Adjuntar Imagen:</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoría</label>
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
                <h1 class="modal-title fs-5" id="">Subir Imágenes al Carrusel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="image">Selecciona una imagen:</label>
                    <input type="file" name="image[]" id="image" class="form-control" multiple>
                </div>

            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                <input class="btn btn-primary" type="button" id="actualizarPermisousu" value="Gestionar">
            </div>
        </div>
    </div>
</div>


</html>


<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>