<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset=' . $charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile


// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])) {
    // Realizar consultas necesarias, por ejemplo obtener los roles de la base de datos
    // Aquí se simula un array de roles, deberás ajustar esto según tu base de datos
    $roles = array(
        array('id_rol' => 1, 'nombre' => 'Aprendiz'),
        array('id_rol' => 2, 'nombre' => 'Instructor'),
        array('id_rol' => 3, 'nombre' => 'Coordinador')
     
  
    );
?>


<!Doctype html>
<html lang="es">

<head>
    <?php
        // Incluir el archivo de cabecera que probablemente contiene enlaces a CSS y otros metadatos
        include_once('cabecera.php');
    ?>  
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


<head>
      <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar mensaje </title>
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
 <!-- Mostrar información del usuario logueado -->
 <div class="row px-3 pb-5 justify-content-center">
                        <div class="sidebar-text d-flex flex-column h-100 justify-content-center text-center">
                            <!-- Aquí puedes mostrar la imagen del usuario, nombre y rol -->
                            <img class="mx-auto d-block bg-green img-fluid rounded-circle mb-4 p-3" src="../../imagenes/useradmin.png" alt="Image">
                            <h1 class="font-weight-bold"><?php echo " " . $_SESSION['usuLog']; ?></h1>
                            <p class="mb-4"><?php echo " " . $_SESSION['id_rol']; ?></p>
                        </div>
                    </div>



             
            <!-- Tabla para mostrar lista de mensajes -->
            <h2>Lista de Mensajes</h2>
            <table class="table table-bordered" id="tabla-mensajes">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th>Mensaje</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div><a href="listardesdeaprendiz.php">
                            <i class="fas fa-arrow-circle-left"></i>
                            <span class="nav-item">Regresar</span>
                        </a>

<script>
    $(document).ready(function() {
        // Acción al hacer clic en el botón de enviar formulario
        $("#btnEnviarFormulario").click(function() {
            var formData = new FormData();
            formData.append('action', 'EnviarFormulario');
            formData.append('mensaje', $("#mensaje").val());
            formData.append('rol', $("#rol").val());
            formData.append('archivo', $('#archivo')[0].files[0]);

            $.ajax({
                url: '../../include/ctrlIndex3.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    if (data.rst == "1") {
                        alert('Mensaje enviado con éxito');
                        // Aquí puedes actualizar la tabla o realizar alguna otra acción después de enviar el formulario
                    } else {
                        alert('Error al enviar el mensaje: ' + data.ms);
                    }
                }
            });
        });
    });
</script>

</body>
</html>


    <script>
        $(document).ready(function() {
            // Cargar lista de mensajes al cargar la página
            listarMensajes();

            // Enviar formulario
            $("#btnEnviarFormulario").click(function() {
                var formData = new FormData();
                formData.append('action', 'EnviarFormulario');
                formData.append('mensaje', $("#mensaje").val());
                formData.append('rol', $("#rol").val());
                formData.append('archivo', $("#archivo")[0].files[0]);
                
                $.ajax({
                    url: '../../include/ctrlIndex3.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.rst == "1") {
                            alert('Mensaje enviado con éxito.');
                            listarMensajes();
                        } else {
                            alert('Error al enviar el mensaje: ' + data.ms);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error en la solicitud: ' + error);
                    },
                    dataType: 'json'
                });
            });
        });

        function listarMensajes() {
            $.post('../../include/ctrlIndex3.php', { action: 'ListarMensajesaprendiz' }, function(data) {
                if (data.rst == "1") {
                    var tbody = $("#tabla-mensajes tbody");
                    tbody.empty();
                    $.each(data.rows, function(index, mensaje) {
                        var row = $("<tr>");
                        row.append($("<td>").text(mensaje.id_mensaje));
                        row.append($("<td>").text(mensaje.id_rol));
                        row.append($("<td>").text(mensaje.mensaje));
                        row.append($("<td>").text(mensaje.archivo));
                        tbody.append(row);
                    });
                } else {
                    alert('No se encontraron mensajes.');
                }
            }, 'json');
        }
    </script>
</body>
</html>

<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>
