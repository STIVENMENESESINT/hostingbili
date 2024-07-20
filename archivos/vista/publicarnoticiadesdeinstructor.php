
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
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once('cabecera.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario General de Solicitudes</title>
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

</head>
<body>
    <div class="layout">
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
        </aside>
        <div class="layout__content">
            <div class="content__page">
                <div class="content">
                    <div class="container bg-white pt-5">
                        <?php include_once('publicarnoticiacarrusel.php'); ?>
                    </div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noticiaModal">
                        Publicar Noticia
                    </button>

                    <div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="noticiaModalLabel">Formulario de Publicación de Noticias</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="noticiaForm" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="titulo">Título de la Noticia:</label>
                                            <input type="text" id="titulo" name="titulo" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion">Descripción:</label>
                                            <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="imagen">Adjuntar Imagen:</label>
                                            <input type="file" id="imagen" name="imagen" class="form-control-file" accept="image/*" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_inicio">Fecha de Inicio:</label>
                                            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_fin">Fecha de Fin:</label>
                                            <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="publicar_noti">Publicar Noticia</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
                <script src="lib/easing/easing.min.js"></script>
                <script src="lib/waypoints/waypoints.min.js"></script>
                <script src="mail/jqBootstrapValidation.min.js"></script>
                <script src="mail/contact.js"></script>
            </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {
    // Acción al hacer clic en el botón de publicar noticia
    $('#noticiaForm').on('submit', function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        formData.append('action', 'PublicarNoticia');
        
        $.ajax({
            url: "../../include/ctrlIndex3.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.rstl == "1") {
                    alert('Noticia publicada con éxito');
                    $("#noticiaForm")[0].reset(); // Limpiar el formulario
                } else {
                    alert('Error al publicar noticia: ' + data.msj);
                }
            },
            dataType: 'json'
        });
    });
});
</script>
</html>
















































<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>




