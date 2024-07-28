
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <style>
        .carousel-inner img {
            max-width: 100%;
            max-height: 500px; /* Ajusta esta altura según sea necesario */
            width: auto;
            height: auto;
            margin: 0 auto; /* Centra la imagen horizontalmente */
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: auto; /* Ajusta el ancho para que solo los íconos sean clicables */
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente para mejor visibilidad */
            border-radius: 50%; /* Forma circular */
            padding: 10px; /* Espacio alrededor del ícono */
        }
    </style>
    <div class="carousel-inner movImg">
        <div class="carousel-item active">
        <img src="../../imagenes/img/banner/banner12-banner.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="../../imagenes/img/banner/banner11-banner.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="../../imagenes/img/banner/BANNER-INGLES-BANNER.webp" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previo</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        <button type="submit" class="btn btn-primary">Subir Imagen</button>
                    </form>                       
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="btnVolver"
                                id="btnVolver">Salir</button>
                        <input class="btn btn-primary" type="submit" id="actualizarPermisousu" value="Gestionar">
                    </div>
                </div>
            </div>
        </div>