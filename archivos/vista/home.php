
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php');
    include_once('../../include/conex.php') ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/layout.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de biblioteca bilinguismo</title>
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


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Bilinguismo</title>

    <style>
            body, html {
                height: 120%;
                margin: 0;
                display: flex;
                justify-content: flex-start; /* Cambiado a flex-start para alinear elementos en la parte izquierda */
                align-items: flex-start; /* Cambiado a flex-start para alinear elementos en la parte superior */
                background-image: url('');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                font-family: 'Roboto', sans-serif;
            }
            .container {
                text-align: center;
                background:#499E2C; /* Fondo semitransparente para mejor legibilidad */
                padding: 20px 20px;
                border-radius: 15px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
                animation: fadeIn 1s ease-in-out;
                margin-top: 20vh; /* Añadir margen superior para empujar el contenedor hacia abajo */
            }
            .title {
            color: #FFFFFF; /* Color blanco */
            font-size: 4.5em; /* Tamaño de fuente más grande */
            margin-bottom: 20px; /* Mayor espacio inferior para separación */
            text-align: center; /* Centrado del texto */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Sombra suave para destacar */
            font-weight: bold; /* Negrita para mayor énfasis */
        }
        .background-image-container {
            background-image: url('https://slideplayer.es/4377364/14/images/slide_1.jpg'); /* Ruta de la imagen de fondo */
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el contenedor */
            background-position: center; /* Centra la imagen dentro del contenedor */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            padding: 20px 0; /* Ajusta el espaciado interno según sea necesario */
            text-align: center; /* Alinea el contenido al centro */
            color: #fff; /* Color del texto */
        }
        .navbar-columns {
            display: flex; /* Utiliza flexbox para alinear los elementos en una fila */
            justify-content: space-between; /* Distribuye el espacio entre las columnas */
            padding: 10px; /* Ajusta el padding según sea necesario */
        }

        .navbar-column {
            flex: 1; /* Hace que ambas columnas ocupen el mismo espacio */
            margin-right: 10px; /* Margen derecho entre las columnas */
        }

        .navbar-item.has-dropdown {
            position: relative; /* Asegura que el dropdown esté posicionado correctamente */
        }

        .navbar-dropdown {
            display: none; /* Oculta inicialmente el dropdown */
            position: absolute; /* Posiciona el dropdown de manera absoluta */
            top: 100%; /* Aparece debajo del navbar-item */
            left: 0;
            background-color: #fff; /* Color de fondo del dropdown */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra para efecto de elevación */
            z-index: 1; /* Asegura que esté por encima de otros elementos */
            padding: 10px;
            min-width: 160px; /* Ancho mínimo del dropdown */
        }

        .navbar-item.has-dropdown:hover .navbar-dropdown {
            display: block; /* Muestra el dropdown al hacer hover */
        }

        .navbar-link {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .navbar-item.has-dropdown .navbar-dropdown .navbar-item {
            display: block;
            padding: 8px 12px;
            color: #666;
            text-decoration: none;
        }

        .navbar-item.has-dropdown .navbar-dropdown .navbar-item:hover {
            background-color: #f0f0f0; /* Cambia el color de fondo al hacer hover */
            color: #FF9800; /* Cambia el color del texto al hacer hover */
        }

        .subtitle {
            color: white;
            font-size: 2.5em;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>


<div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">Usuarios</a>

                
                <div class="navbar-dropdown">
                    <?php
                        if($_SESSION['id_rol']!='1'){
                            echo '<a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>';
                        }
                    ?>
                    <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                </div>
            </div>
            <!-- aqui INICIA BIBLIOTECA -->
            <style >
                        .cabecera_menu {
                            position: relative;
                        }
                        .fixed-top-right {
                            position: absolute;
                            top: 10px; /* Ajusta este valor según necesites */
                            right: 10px; /* Ajusta este valor según necesites */
                            z-index: 1000; /* Asegura que esté por encima de otros elementos */
                            
                            padding: 5px 10px; /* Espaciado interno */
                        }
                        .fixed-top-right .btn i {
                            margin-right: 5px; /* Espacio entre el icono y el texto */
                        }
            </style>
                    <button type="button" class="btn nav-link nav-item-hover fixed-top-right" onclick="goBack()">
                        <i class="fas fa-arrow-left fa-fw fa-lg"></i>
                        <span class="nav-item">Volver</span>
                    </button>

                    <script>
                    function goBack() {
                        window.history.back();
                    }
                    </script>
            <div class="background-image-container">
    <!-- Contenido con la imagen de fondo -->
    <div class="container is-fluid">
    <div class="container is-fluid">
    <div class="navbar-columns">
    <div class="navbar-column">
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Ingresar a Sesión de la biblioteca</a>
            <div class="navbar-dropdown">
                <?php
                        if($_SESSION['id_rol']!='1'){
                            echo '<a href="category_new.php" class="navbar-item">Ingresar Nueva Sesión</a>';
                        }
                    ?>
                <a href="category_list.php" class="navbar-item">Lista Sesión</a>
                <a href="category_search.php" class="navbar-item">Buscar Sesión</a>
            </div>
        </div>
    </div>
    <div class="navbar-column">
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Ingresar a los libros</a>
            <div class="navbar-dropdown">
                <?php
                        if($_SESSION['id_rol']!='1'){
                            echo '<a href="product_new.php" class="navbar-item">Nuevo libro</a>';
                        }
                    ?>
                <a href="product_list.php" class="navbar-item">Lista de libros</a>
                <a href="product_category.php" class="navbar-item">Buscar libros por categoría</a>
            </div>
        </div>
    </div>

        <p style="font-size: 1.2em; color: #fff; text-align: center;">
        <p style="font-size: 1.5em; color: #FFFFFF; text-align: center; margin-top: 20px;">

</div>



        <h1 class="title">Biblioteca Bilinguismo  Sena Alto Cauca</h1>
        <div class="info-text">
        </div>

<h2 class="subtitle">¡Bienvenido!</h2>




<br>
Explora, aprende y contribuye con tu conocimiento.
</p>
<p style="font-size: 1.1em; color: #fff; text-align: center; margin-top: 20px;">
Este sistema te permite publicar libros y contenidos que enriquezcan nuestra comunidad educativa. ¡Tu participación es fundamental para construir un entorno de aprendizaje colaborativo y accesible para todos!
</p>
</div>

</body>
</html>
