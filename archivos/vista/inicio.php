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
        <div class="layout__content">
            <div class="container content__page">
                <div id="conten navbar">


                    <div class="navbar">

                        <?php
                        if ($_SESSION['id_rol'] == 3) {
                            echo '
                                <li>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#revistaModal" class="nav-link">
                                    
                                        <span class="nav-link">
                                            Nueva Revista
                                            <i class="fas fa-newspaper" ></i>
                                        </span>
                                    
                                    </a>
                                </li>      
                        ';
                        }
                        ?>
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

                </div>
                <div class="carrousel" class="grid-container">
                    <h1 class="title">Bilingüismo<br>B-Team-Language </h1>
                    <div class="divider"></div>
                    <br>

                    <div>
                        <embed src="../../imagenes/Revista B2.pdf" type="application/pdf" width="100%" height="500px" />
                    </div>
                </div>
                <!-- El contenido dinámico se cargará aquí -->
                <br>
                <?php 
                        include_once('../../chatp/index.php');
                    ?>

                <h1 class="title">NOTICIAS</h1>
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