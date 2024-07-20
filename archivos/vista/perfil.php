<?php
// Incluir el menú de navegación
include_once('cabecera.php');
?>
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
            <a class="btn btn-green mr-2" href="facebook.com/jesusandres.salazar2"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-green mr-2" href="linkedin.com/in/jesus-andres-salazar-anacona-75502a291"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-green mr-2" href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <a href="actualizarusuariooriginal.php" class="btn btn-sm btn-custom justify-content-center" style="background-color: #39A900; color: white;">
            Actualizar Usuario
        </a>

    </div>

</div>

<style>
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