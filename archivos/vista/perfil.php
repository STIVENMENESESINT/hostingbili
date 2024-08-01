<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset=' . $charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
    // Consulta para obtener los datos del usuario usando una declaración preparada
    $query = "SELECT * FROM userprofile WHERE id_userprofile = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['id_userprofile']);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si se ejecutó la consulta correctamente
    if ($resultado && $resultado->num_rows > 0) {
        // Recuperar los datos del usuario
        $fila = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario </title>
    <link rel="stylesheet" href="../../herramientas/css/perfil.css">
</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>

        </aside>
        <!-- Contenido principal -->
        <div class="container layout__content">
            <div class="content__page">
                <div id="contenido">
                    <!-- Sección para mostrar y editar el perfil del usuario -->
                    <?php
                        $rutaImagen = '../../include/uploads/' . htmlspecialchars($fila['imagen']);
                        if (file_exists($rutaImagen) && !empty($fila['imagen'])) {
                            echo '<img class="circle" src="' . $rutaImagen . '" alt="Foto de Perfil">';
                        } else {
                            echo '<div class="upload-container">
                                    <div class="circle">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <label for="imagen" class="upload-label">Sube tu imagen
                                        <div class="image-upload">
                                            <label for="file-input">
                                                <div class="upload-icon">
                                                    <i class="fa fa-upload"></i>
                                                </div>
                                            </label>
                                            <input type="file" id="imagen" name="imagen" accept="image/*">
                                        </div>
                                        
                                    </label>
                                </div>';
                        }
                    ?>
                </div>
                        <!-- Campos del formulario -->
                        <h1 class="modal-title w-100 text-center">Actualizar Usuario</h1>
                        
                        <div class="container">
                            <div class="row mt-3">

                                <div class="col-sm-6">
                                    <label for="nombre" class="col-form-label">Primer Nombre:</label>
                                    
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($fila['nombre']); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="nombre_dos" class="col-form-label">Segundo Nombre:</label>
                                    <input type="text" class="form-control" id="nombre_dos" name="nombre_dos" value="<?php echo htmlspecialchars($fila['nombre_dos'] ?? ''); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="apellido" class="col-form-label">Primer Apellido:</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($fila['apellido']); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="apellido_dos" class="col-form-label">Segundo Apellido:</label>
                                    <input type="text" class="form-control" id="apellido_dos" name="apellido_dos" value="<?php echo htmlspecialchars($fila['apellido_dos'] ?? ''); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="celular" class="col-form-label">Número de Celular:</label>
                                    <input type="text" class="form-control" id="celular" name="celular"
                                        value="<?php echo htmlspecialchars($fila['celular']); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="correo" class="col-form-label">Correo Electrónico:</label>
                                    <input type="email" class="form-control" id="correo" name="correo"
                                        value="<?php echo htmlspecialchars($fila['correo']); ?>">
                                </div>
                            </div>




                    <!-- <div class="col-sm-6">
                                <label for="id_rol" class="col-form-label">Rol:</label>
                                <select class="form-control" id="id_rol" name="id_rol" title='' style='cursor:pointer;'></select>
                            </div> -->



                            <div class="modal-footer">
                                <button type="button" class="close-button"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="create-button" name="btnActualizarUsuario"
                                    id="btnActualizarUsuario">Actualizar</button>
                            </div>
                        </div>

                </div>

        </div>
    </div>
    </div>
    <script>

        // Manejar el clic del botón de actualizar usuario
        $(document).on("click", "#btnActualizarUsuario", function() {
    // Crear un objeto FormData
    var formData = new FormData();

    // Añadir los datos del formulario a formData
    formData.append('action', 'actualizarusuario');
    formData.append('nombre', $("#nombre").val());
    formData.append('nombre_dos', $("#nombre_dos").val());
    formData.append('apellido', $("#apellido").val());
    formData.append('apellido_dos', $("#apellido_dos").val());
    formData.append('correo', $("#correo").val());
    formData.append('numeroiden', $("#numeroiden").val());
    formData.append('celular', $("#celular").val());

    // Añadir el archivo de imagen si se ha seleccionado uno
    var imagen = $('#imagen')[0].files[0];
    if (imagen) {
        formData.append('imagen', imagen);
    }

    // Enviar solicitud AJAX con FormData
    $.ajax({
        url: "../../include/cntrlUsuarios.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
            if (data.rstl == "1") {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Registro Actualizado con éxito',
                    showConfirmButton: false,
                    timer: 1500 // Tiempo en milisegundos (1.5 segundos)
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.msj
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error en la solicitud: ' + textStatus);
        }
    });
});

    </script>
    </body>


</html>

<?php
    } else {
        // Si hay un error en la consulta, imprimir el mensaje de error
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>