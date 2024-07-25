<?php
// Inicia la sesión
session_start();
?>

<head>
    <?php include_once('cabecera.php');
    include_once('../../include/conex.php') ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sistema de biblioteca bilinguismo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../vista/css/biblioteca.css">
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Incluye jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Incluye Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-b4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy0sF/xTkqlj6Qrg/x2O9f7E3UJFpxoY+J" crossorigin="anonymous"></script>

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
        <div class="layout__content">
            <div class="content__page">

</head>
<body>
    <!-- Botón para volver atrás -->
    <a href="#" class="fixed-top-right" onclick="goBack()">
        <i class="fas fa-arrow-left"></i>
        <span>Volver</span>
    </a>

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
                        <i class="fas fa-search"></i>
                        <h3>Explora</h3>
                        <p>Descubre una amplia variedad de recursos educativos.</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-book-reader"></i>
                        <h3>Aprende</h3>
                        <p>Amplía tus horizontes con nuevos conocimientos.</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-hands-helping"></i>
                        <h3>Contribuye</h3>
                        <p>Comparte tu sabiduría con la comunidad.</p>
                    </div>
                </div>
                
                <p class="info-text">
                    Este sistema te permite publicar libros y contenidos que enriquecen nuestra comunidad educativa.
                </p>
                <p class="highlight-text">
                    ¡Tu participación es fundamental para construir un entorno de aprendizaje colaborativo y accesible para todos!
                </p>
            </div>

            <!-- Menú de navegación -->
            <div class="navbar-columns">
                <div class="navbar-column">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">Usuarios <i class="fas fa-users"></i></a>
                        <div class="navbar-dropdown">
                            <?php
                                if(isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != '1'){
                                    echo '<a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>';
                                }
                            ?>
                            <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                            <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                        </div>
                    </div>
                </div>

                <div class="navbar-column">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">Ingresar a la Biblioteca <i class="fas fa-calendar-day"></i></a>
                        <div class="navbar-dropdown">
                            <?php
                                if(isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != '1'){
                                    echo '<a href="category_new.php" class="navbar-item">Ingresar Nueva Sesión</a>';
                                }
                            ?>
                            <a href="category_list.php" class="navbar-item">Lista de Sesiones</a>
                            <a href="category_search.php" class="navbar-item">Buscar Sesión</a>
                        </div>
                    </div>
                </div>

                <div class="navbar-column">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">Ingresar a los Libros <i class="fas fa-book"></i></a>
                        <div class="navbar-dropdown">
                            <?php
                                if(isset($_SESSION['id_rol']) && $_SESSION['id_rol'] != '1'){
                                    echo '<a href="product_new.php" class="navbar-item">Nuevo Libro</a>';
                                }
                            ?>
                            <a href="product_list.php" class="navbar-item">Lista de Libros</a>
                            <a href="product_category.php" class="navbar-item">Buscar Libros por Categoría</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>