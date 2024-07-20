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


<!DOCTYPE html>
<html lang="es">
<head>
      <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
      <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eliminar categoria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css"> <!-- Enlaza tu archivo de estilos CSS -->


<!-- Incluye Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Incluye jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Incluye Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous"></script>

<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Información del Instructor</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    form {
      max-width: 600px;
      margin: 0 auto;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 5px;
      background-color: #f9f9f9;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    input[type=text],
    input[type=email],
    input[type=tel],
    textarea {
      width: calc(100% - 20px);
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    textarea {
      resize: vertical;
    }
    button[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    button[type=submit]:hover {
      background-color: #45a049;

    }

    .bg-green {
        background-color: #39A900;
    }

    .btn-green {
        background-color: #39A900;
        color: white;
        /* Cambia el color del texto a blanco para una mejor legibilidad */
        border-color: #338200;

        /* Cambia el color del borde */
    }


    .btn-green:hover {
        background-color: #39A900;
        /* Un color ligeramente más oscuro para el hover */
        border-color: #39A900;
    }

    .sidebar-text img {
        width: 50%;
        /* Reduce el tamaño de la imagen */
        padding: 1rem;
        /* Ajusta el padding para la imagen */
    }


    .sidebar-text h1 {
        font-size: 1.5rem;
        /* Reduce el tamaño de la fuente para el nombre */
    }

    .sidebar-text p {
        font-size: 1rem;
        /* Reduce el tamaño de la fuente para la descripción */
        margin-bottom: 1rem;
        /* Ajusta el margen inferior */
    }

    .sidebar-text .btn {
        font-size: 0.875rem;
        /* Reduce el tamaño de la fuente para los botones */
        padding: 0.5rem 1rem;
        /* Ajusta el padding para los botones */
    }

    .sidebar-text .btn-outline-primary {
        padding: 0.25rem 0.5rem;
        /* Reduce el padding para los botones de redes sociales */
    }

    .sidebar-text .d-flex {
        margin-bottom: 1rem;
        /* Ajusta el margen inferior de la sección de redes sociales */
    }

    .sidebar-icon {
        width: 33rem;
        font-size: 1.5rem;
        /* Reduce el tamaño del icono de la sidebar */
    }

    .btn-custom {
        font-size: 0.875rem;
        /* Tamaño de fuente más pequeño */
        padding: 0.5rem 1rem;
        /* Reducir padding */
        width: 35rem;
        /* Ajuste el ancho automáticamente */
    }

  </style>
</head>
<body>
<form action="/submit-formulario" method="POST">
  <fieldset>
    <legend>Información del Instructor</legend>


    <div class="row px-3 pb-5 justify-content-center">
    <div class="sidebar-text d-flex flex-column h-100 justify-content-center text-center">
        <img class="mx-auto d-block bg-green img-fluid rounded-circle mb-4 p-3" src="../../imagenes/useradmin.png" alt="Image">
        <h1 class="font-weight-bold"><?php echo " " . $_SESSION['usuLog'];
                                        ?></h1>
        <p class="mb-4" <?php
                        echo " " . $_SESSION['id_rol'];
                        ?> </p>
        <div class="sidebar-icon d-flex justify-content-center mb-5">
            <a class="btn btn-green mr-2" href="#"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-green mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-green mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-green mr-2" href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <a href="listarinstructorseptimo.php" class="btn btn-sm btn-custom justify-content-center" style="background-color: #39A900; color: white;">
           informacion del instructor
        </a>

    </div>

</div>

    
    <div class="form-group">
      <label for="descripcion">enviar mensaje:</label>
      <textarea id="descripcion" name="descripcion" rows="4"></textarea>
    </div>

    <div class="form-group">
      <label for="foto">Foto del instructor:</label>
      <input type="file" id="foto" name="foto" accept="image/*">
    </div>

    <!-- Aquí agregamos los 5 botones adicionales -->
    <div class="form-group">
      <button type="button" onclick="window.location.href='/ruta-destino-1.php'">Botón 1</button>
      <button type="button" onclick="window.location.href='/ruta-destino-2.php'">Botón 2</button>
      <button type="button" onclick="window.location.href='/ruta-destino-3.php'">Botón 3</button>
      <button type="button" onclick="window.location.href='/ruta-destino-4.php'">Botón 4</button>
      <button type="button" onclick="window.location.href='/ruta-destino-5.php'">Botón 5</button>
    </div>

    <!-- Botón de envío del formulario -->

  </fieldset>
</form>


</body>
</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>







