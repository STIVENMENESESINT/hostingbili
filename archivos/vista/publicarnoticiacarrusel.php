<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bilinguismo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las tres imágenes más recientes de detallesolicitud
$sql = "SELECT Imagen AS imagen, nombre AS titulo, fecha_inicio AS fecha_mostrada, descripcion FROM detallesolicitud ORDER BY id_detallesolicitud DESC LIMIT 3";
$result = $conn->query($sql);

// Generar el HTML del carrusel
$carouselItems = "";
$firstItem = true;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $activeClass = $firstItem ? "active" : "";
        $carouselItems .= '
        <div class="carousel-item ' . $activeClass . '">
            <div class="d-flex justify-content-center">
                <img class="w-50" src="' . $row["imagen"] . '" alt="Image">
            </div>
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <h2 class="text-white font-weight-bold">' . $row["titulo"] . '</h2>
                <div class="d-flex text-white">
                    <small class="mr-3"><i class="fa fa-calendar-alt"></i> ' . $row["fecha_mostrada"] . '</small>
                </div>
                <p class="text-white">' . $row["descripcion"] . '</p>
                <a href="#" class="btn btn-lg btn-outline-light mt-4">Leer más</a>
            </div>
        </div>';
        $firstItem = false;
    }
} else {
    $carouselItems = '<div class="carousel-item active">
                        <img class="w-100" src="path/to/default/image.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-white font-weight-bold">No hay noticias disponibles</h2>
                        </div>
                      </div>';
}

$conn->close();
?>

<div class="container p-0">
    <div id="blog-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php echo $carouselItems; ?>
        </div>
        <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noticiaModal1">
                        Publicar Noticia
                    </button>

                    <div class="modal fade" id="noticiaModal1" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carouselModal">
    Subir Contenido
</button>
<!-- Modal -->
<div class="modal fade" id="carouselModal" tabindex="-1" role="dialog" aria-labelledby="carouselModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carouselModalLabel">Carrusel de Imágenes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="blog-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php echo $carouselItems; ?>
                    </div>
                    <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>