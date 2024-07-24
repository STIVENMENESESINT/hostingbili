
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="../../imagenes/img/revista/Revista B2_pages-to-jpg-0001.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="../../imagenes/img/revista/Revista B2_pages-to-jpg-0003.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="../../imagenes/img/revista/Revista B2_pages-to-jpg-0007.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="../../imagenes/img/revista/Revista B2_pages-to-jpg-0006.jpg" class="d-block w-100" alt="...">
        </div>
        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- boton publicar carrucel imagenes -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#noticiaModal1">
    Publicar
</button>
<!-- Modal publicar carrucel imagenes -->
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
                        <input type="text" id="titulo_carrousel" name="titulo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Adjuntar Imagen:</label>
                        <input type="file" id="imagen" name="imagen" class="form-control-file" accept="image/*"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary" id="publicar_carucel">Publicar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- boton carrucel imagenes -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#carouselModal">
    Subir Contenido
</button>
<!-- Modal carrucel imagenes -->
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