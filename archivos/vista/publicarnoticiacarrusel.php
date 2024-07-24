
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
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
        <img src="../../imagenes/img/revista/Revista B2_pages-to-jpg-0001.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="../../imagenes/img/revista/Revista B2_pages-to-jpg-0002.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="../../imagenes/img/revista/Revista B2_pages-to-jpg-0004.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <?php
            if ($_SESSION['id_rol'] == 3) {
                echo '<embed src="../../imagenes/Revista B2.pdf" type="application/pdf" width="100%" height="600px" />';
            }else{
                echo '<embed src="../../imagenes/Revista B2.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />';
            }
            
        ?>
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
