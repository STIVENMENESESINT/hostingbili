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



                <?php
            // Incluir el menú de navegación
            include_once('publicarnoticiacarrusel.php');
            ?>



                    
                    <!-- El contenido dinámico se cargará aquí -->
                    <br>
                    <div id="noticia_creada"></div>
                </div>
            </div>
        </div>



</body>









































































                </div>


            </div>
        </div>
    </div>
</div>            </div>
        </div>
    </div>   <a href="listardesdeaprendiz.php">
        <i class="fas fa-arrow-circle-left"></i>
        <span class="nav-item">Regresar</span>
    </a>


</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>