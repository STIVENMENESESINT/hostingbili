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
                    <div class="card-body">
                        <div class="container navbar-nav">
                            <!-- BUSCADOR -->
                            <?php
                                if ($_SESSION['id_rol'] != 1) {
                                        echo '
                                    <li><a type="button" name="btn_Nuevo" id="btn_Nuevo" data-bs-toggle="modal"
                                                    data-bs-target="#noticiaModal" class="nav-link nav-item-hover">
                                        <i class="fas fa fa-plus fa-fw fa-lg" class=" aria-hidden="true"></i>
                                        
                                        <span class="nav-item2">Crear </span>
                                    </a></li>      
                                    
                                    <li><a type="button" name="btn_Nuevo" id="btn_Nuevo" data-bs-toggle="modal"
                                                    data-bs-target="#" class="nav-link nav-item-hover">
                                        <i class="fas fa fa-plus fa-fw fa-lg" class=" aria-hidden="true"></i>
                                        
                                        <span class="nav-item2">Mis Publicaciones</span>
                                    </a></li> 
                                    
                                
                                            ';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container bg-black  rounded-container">
                    <h1>Revista Sena B-Team </h2>
                        <?php include_once('publicarnoticiacarrusel.php'); ?>
                </div>
                <!-- El contenido dinámico se cargará aquí -->
                <br>
                <br>
                <br>
                <br>
                <div class=" container">
                    <h1>Nuevas Noticia</h2>


                        <div id="noticia_creada" class="grid-container ">
                        </div>

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
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha a Mostrar</label>
                        <input class="form-control" type="date" id="id_fecha_mostrada" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="cuerpo" class="form-label">Descripción</label>
                        <textarea rows="10" class="form-control" id="cuerpo" name="cuerpo" required></textarea>
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

</html>

<style>
.imagenta {
    width: auto;
    /* Ajusta el ancho según tus necesidades */
    height: auto;
    /* Mantiene la proporción de la imagen */

}

.navbar-nav {
    margin-top: 1.5rem;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: row;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

/* Estilos adicionales */
.navbar-dark .navbar-nav {
    display: flex;
    /* Alinea los elementos horizontalmente */
}

.navbar-dark .navbar-nav .nav-link {
    color: #fff;
    transition: all 0.3s ease;
    padding: 18px 15px;
    text-decoration: none;
    display: inline-block;
    /* Asegura que los enlaces estén en línea */
}

.navbar-dark .navbar-nav .nav-link:hover {
    background-color: #007bff;
}

.navbar-dark .navbar-nav li {
    display: inline-block;
    /* Asegura que los elementos de la lista estén en línea */
}

.nav-link {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-item-hover:hover {
    transform: scale(1.1);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.cabecera_menu {
    position: relative;
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(4, 2fr);
    /* Dos columnas */
    gap: 3px;
    justify-items: center;
    /* Centrar elementos horizontalmente */
    align-items: center;
    /* Centrar elementos verticalmente */
    border-radius: 15px;
    padding-top: 23px;
}

.rounded-container {
    border-radius: 30px;
    /* Puedes ajustar este valor según el grado de redondez que desees */
    padding: 50px;
    /* Ajusta el padding si es necesario */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Añade una sombra suave para mejor visibilidad del contorno */
}

/* estosson estilos de la tarjetas de noticias  */
.cards {
    position: relative;
    width: 350px;
    aspect-ratio: 16/9;
    background-color: #f2f2f2;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    perspective: 1000px;
    box-shadow: 0 0 0 5px #ffffff80;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cards svg {
    width: 48px;
    fill: #333;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cards__image {
    width: 100%;
    height: 100%;
}

.cards:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}

.cards__content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
    background-color: #f2f2f2;
    transform: rotateX(-90deg);
    transform-origin: bottom;
    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cards:hover .cards__content {
    transform: rotateX(0deg);
}

.cards__title {
    margin: 0;
    font-size: 20px;
    color: #333;
    font-weight: 700;
}

.card:hover svg {
    scale: 0;
}

.cards__description {
    margin: 10px 0 10px;
    font-size: 12px;
    color: #777;
    line-height: 1.4;
}

.cards__button {
    padding: 15px;
    border-radius: 8px;
    background: #777;
    border: none;
    color: white;
}

.secondary {
    background: transparent;
    color: #777;
    border: 1px solid #777;
}
</style>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>