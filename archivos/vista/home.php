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
    <?php include_once('cabecera.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sistema de biblioteca bilinguismo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../vista/css/biblioteca.css">
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Incluye jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Incluye Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
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
    <div class="container layout__content">
        <div class="content__page">

            </head>

            <body>


                <!-- Script para la función de volver atrás -->
                <script>
                function goBack() {
                    window.history.back();
                }
                </script>

                <!-- Contenedor de la imagen de fondo -->
                <div class="background-image-container">
                    <div class="container">
                        <div class="welcome-section">
                            <h1 class="title">Biblioteca Bilingüismo<br>B-Team-Language </h1>
                            <div class="divider"></div>
                            <h2 class="subtitle">¡Bienvenido a tu espacio de conocimiento!</h2>

                            <div class="info-cards">
                                <div class="info-card">
                                    <div class="icon-circle">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h3>Explora</h3>
                                    <div class="description">
                                        <p>Descubre variedad de recursos educativos.</p>
                                    </div>
                                </div>
                                <div class="info-card">
                                    <div class="icon-circle">
                                        <i class="fas fa-book-reader"></i>
                                    </div>
                                    <h3>Aprende</h3>
                                    <div class="description">
                                        <p>Amplía tus horizontes con nuevos conocimientos.</p>
                                    </div>
                                </div>
                                <div class="info-card">
                                    <div class="icon-circle">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                    <h3>Contribuye</h3>
                                    <div class="description">
                                        <p>Comparte tu sabiduría con la comunidad.</p>
                                    </div>
                                </div>
                            </div>

                            <p class="info-text">
                                Este sistema te permite publicar libros y contenidos que enriquecen nuestra comunidad
                                educativa.
                            </p>
                            <p class="highlight-text">
                                ¡Tu participación es fundamental para construir un entorno de aprendizaje colaborativo y
                                accesible para todos!
                            </p>
                        </div>









                        <!-- Menú de navegación -->
                        <div class="navbar">
                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link" href="#">Usuarios <i class="fas fa-users"></i></a>
                                <div class="navbar-dropdown">
                                    <?php
                if(isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != '1'){
                    echo '<a href="index.php?vista=user_new" class="navbar-dropdown-item">Nuevo</a>';
                }
            ?>
                                    <a href="index.php?vista=user_list" class="navbar-dropdown-item">Lista</a>
                                    <a href="index.php?vista=user_search" class="navbar-dropdown-item">Buscar</a>
                                </div>
                            </div>

                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link" href="#">Ingresar a la Biblioteca <i
                                        class="fas fa-calendar-day"></i></a>
                                <div class="navbar-dropdown">
                                    <?php
                if(isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != '1'){
                    echo '<a href="category_new.php" class="navbar-dropdown-item">Ingresar Nueva Sesión</a>';
                }
            ?>
                                    <a href="category_list.php" class="navbar-dropdown-item">Lista de Sesiones</a>
                                    <a href="category_search.php" class="navbar-dropdown-item">Buscar Sesión</a>
                                </div>
                            </div>

                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link" href="#">Ingresar a los Libros <i class="fas fa-book"></i></a>
                                <div class="navbar-dropdown">
                                    <?php
                if(isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != '1'){
                    echo '<a href="product_new.php" class="navbar-dropdown-item">Nuevo Libro</a>';
                }
            ?>
                                    <a href="product_list.php" class="navbar-dropdown-item">Lista de Libros</a>
                                    <a href="product_category.php" class="navbar-dropdown-item">Buscar Libros por
                                        Categoría</a>
                                </div>
                            </div>
                        </div>

                        <!-- Imagen grande debajo del menú -->
                        <div class="large-image">
                            <img src="../vista/img/biblioteca1.png" alt="Imagen Grande">
                        </div>






                        <!-- Footer -->
                        <footer class="footer">
                            <div class="footer-content">
                                <div class="footer-left">
                                    <img src="../vista/img/footer.png" alt="Logo">
                                </div>
                                <div class="footer-right">
                                    <p>Servicio Nacional de Aprendizaje SENA - Dirección General</p>
                                    <p>Calle 57 No. 8 - 69 Bogotá D.C. (Cundinamarca), Colombia</p>
                                    <p>Atención presencial: lunes a viernes 8:00 a.m. a 5:30 p.m. - Resto del país sedes
                                        y horarios</p>
                                    <p>Atención telefónica: lunes a viernes 7:00 a.m. a 7:00 p.m. - sábados 8:00 a.m. a
                                        1:00 p.m</p>
                                    <p>Lineas gratuitas atención al ciudadano: Bogotá (57 1) 3430111 - Resto del país
                                        018000 910270</p>
                                    <p>Lineas gratuitas atención al empresario: Bogotá (57 1) 3430101 - Resto del país
                                        018000 910682</p>
                                    <p>Conmutador Nacional (57 1) 5461500 - Extensiones 12586 - 13021 - 12535 - 12542
                                    </p>
                                    <p>biblioteca.sena@misena.edu.co</p>
                                </div>
                            </div>
                        </footer>


            </body>

</html>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>