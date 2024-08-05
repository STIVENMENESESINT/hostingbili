<style>
.navbar-nav {
    margin-top: 1.5rem;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: row;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

.navbar-dark .navbar-nav {
    display: flex;

}

.navbar-dark .navbar-nav .nav-link {
    transition: all 0.3s ease;
    padding: 18px 15px;
    text-decoration: none;
    display: inline-block;
    /* Asegura que los enlaces estén en línea */
}

.navbar-dark .navbar-nav .nav-link:hover {
    background-color: #007bff;
}

.navbar-dark .navbar-nav li {
    display: inline-block;
    /* Asegura que los elementos de la lista estén en línea */
}


/* hover iconos */
.nav-item-hover:hover {
    transform: scale(1.1);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}



.fixed-top-right {
    position: absolute;
    top: 10px;
    /* Ajusta este valor según necesites */
    right: 10px;
    /* Ajusta este valor según necesites */
    z-index: 1000;
    /* Asegura que esté por encima de otros elementos */
    padding: 5px 10px;
    /* Espaciado interno */
}

.fixed-top-right .btn i {
    margin-right: 5px;
    /* Espacio entre el icono y el texto */
}


.grid-container {
    display: grid;

    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(4, 2fr);
    gap: 3px;
    justify-items: center;
    /* Centrar elementos horizontalmente */
    align-items: center;
    /* Centrar elementos verticalmente */
    border-radius: 15px;
}
</style>
<ul class="navbar-nav">
    <?php
        if ($_SESSION['id_rol'] == 3) {
            echo '
                <li>
                    <a href="usuarios.php" class="nav-item ">
                        <i class="fas fa-graduation-cap "></i>
                        <span class="">
                            Administrar Usuarios
                            
                        </span>
                    </a>
                </li>
                <li>
                    <a href="solicitud.php" class="nav-item ">
                        <i class="fas fa-check-double"></i>
                        <span class="">
                            Administrar Solicitudes
                            
                        </span>
                    </a>
                </li>
                <li>
                    <a href="GprogramaFormacion.php" class="nav-item ">
                        <i class="fas fa-graduation-cap "></i>
                        <span class="">
                            Programa Formación
                            
                        </span>
                    </a>
                </li>
                <li>
                    <a href="ofertas.php" class="nav-item ">
                        <i class="fas fa-graduation-cap "></i>
                        <span class="">
                            Ofertas
                        </span>
                    </a>
                </li>
            ';
        }
    ?>
    <?php
        if ($_SESSION['id_rol'] == 2) {
            echo '
                <li>
                    <a href="solicitud.php" class="nav-item">
                        <i class="fas fa-check-double "></i>
                        <span class="">Solicitudes
                            
                        </span>
                    </a>
                </li>
                <li>
                    <a href="asignaciones.php" class="nav-item">
                        <i class="fas fa-check-double fa-fw fa-lg"></i>
                        <span class="">Asignaciones
                        
                        </span>
                    </a>
                </li>
                <li>
                    <a href="GprogramaFormacion.php" class="nav-item ">
                        <i class="fas fa-graduation-cap fa-fw fa-lg"></i>
                        <span class="">Programa Formación
                            
                        </span>
                    </a>
                </li>
            ';
        }
    ?>
    <?php
        if ($_SESSION['id_rol'] == 1) {
            echo '
                <li>
                    <a href="solicitud.php" class="nav-item">
                        <i class="fas fa-check-double fa-fw fa-lg"></i>
                        <span class="">Solicitudes
                            
                        </span>
                    </a>
                </li>
            ';
        }
    ?>
    <?php
        if ($_SESSION['id_rol'] == 5) {
            echo '
                <li>
                    <a href="solicitud.php" class="nav-item">
                        <i class="fas fa-check-double fa-fw fa-lg"></i>
                        <span class="">Solicitudes
                            
                        </span>
                    </a>
                </li>
            ';
        }
    ?>
</ul>