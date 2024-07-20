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
                        <div class="row">
                            <!-- BUSCADOR -->


                        </div>


                    </div>
                </div>



                <div class="container bg-black pt-16 rounded-container">
                    <?php include_once('publicarnoticiacarrusel.php'); ?>
                </div>

                <!-- El contenido dinámico se cargará aquí -->
                <br>
                <br>
                <br>
                <br>


                <div class=" container pt-23 ">

                    <?php
                        if ($_SESSION['id_rol'] != 1) {
                                echo '
                                
                        <a type="button" name="btn_Nuevo" id="btn_Nuevo" data-bs-toggle="modal"
                                        data-bs-target="#noticiaModal" class="nav-link nav-item-hover">
                            <i class="fas fa fa-plus fa-fw fa-lg" class=" aria-hidden="true"></i>
                            
                            <span class="nav-item">Crear </span>
                        </a>
                    
                                ';
                            }
                        ?>
                    <div id="noticia_creada" class="grid-container">
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
.grid-container {
    display: grid;

    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(4, 2fr);
    gap: 3px;
    justify-items: center;
    /* Centrar elementos horizontalmente */
    align-items: center;
    /* Centrar elementos verticalmente */
    border-radius: 15px;
}

.rounded-container {
    border-radius: 30px;
    /* Puedes ajustar este valor según el grado de redondez que desees */
    padding: 30px;
    /* Ajusta el padding si es necesario */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Añade una sombra suave para mejor visibilidad del contorno */
}
</style>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>