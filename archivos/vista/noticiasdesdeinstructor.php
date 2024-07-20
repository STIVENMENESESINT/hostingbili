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

  <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
  <?php include_once('cabecera.php'); ?>
  <link rel="stylesheet" href="../../herramientas/css/css/styles.css">
  <link rel="stylesheet" href="../../herramientas/css/css/layout.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrar Perfiles de Usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->




    <script type='text/javascript' src="../../herramientas/js/noticia.js"></script>
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















                <img src="https://cdn.baania.com/b10/property-project/1526/photo/99893.jpg" alt="Texto alternativo si la imagen no carga">



                <?php
                    if ($_SESSION['id_rol'] != 1) {
                            echo '<button type="button" name="btn_Nuevo" id="btn_Nuevo" data-bs-toggle="modal"
                                    data-bs-target="#noticiaModal" <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>';
                        }
                ?>
                    
                    <!-- El contenido dinámico se cargará aquí -->
                    <br>
                    <div id="noticia_creada"></div>
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
            <div>
                <!-- <div class="form-group">
                    <label for="id_nombre">Título de la Noticia:</label>
                    <input type="text" id="titulo" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="id_descripcion">Descripción:</label>
                    <textarea id="id_descripcion" name="descripcion" class="form-control" rows="4" required></textarea>
                </div> 
                <div class="form-group">
                    <label for="id_fecha_mostrada">Fecha a Mostrar:</label>
                    <input type="date" id="id_fecha_mostrada" name="fecha_inicio" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Adjuntar Imagen:</label>
                    <input type="file" id="imagen" name="imagen" class="form-control-file" required>
                </div>
                <div class=" form-group">
                    <label for="id_fecha_inicio">Fecha de Inicio:</label>
                    <input type="datetime-local" id="id_fecha_inicio" name="fecha_inicio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="id_fecha_fin">Fecha de Fin:</label>
                    <input type="datetime-local" id="id_fecha_fin" name="fecha_fin" class="form-control">
                </div>
                <div class="form-group">
                    <label for="id_direccion">Url:</label>
                    <input type="text" id="id_url" name="direccion" class="form-control">
                </div>-->
                <div class="px-4 py-2">
                    <form class="card p-3 shadow-lg border-3 text-bg-light" action="" method="post"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id_nombre" class="form-label">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="titulo"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="id_descripcion" class="form-label">Fecha a Mostrar</label>
                            <input class="form-control" type="date" id="id_fecha_mostrada" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="id_descripcion">Descripción</label>
                            <textarea rows="10" class="form-control" id="cuerpo" name="cuerpo" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Adjuntar Imagen:</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" required></input>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-control" id="id_categoria" name="categoria" onchange="MostrarTipo_Categoria()">

                            </select>
                        </div>
                        <div class="mb-3" id="tipo_cate">
                        </div>
                    </form>
                </div>
                <div id="librerias">
                    <script>
                    $(document).ready(function() {
                        $('#cuerpo').summernote({
                            height: 100
                        });
                    });
                    </script>

                </div>


            </div>
        </div>
    </div>
</div>            </div>
        </div>
    </div>   <a href="listardesdeinstructor.php">
        <i class="fas fa-arrdesdeinstructor
        <span class="nav-item">Regresar</span>
    </a>


</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>