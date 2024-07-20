<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <link rel="stylesheet" href="../../herramientas/css/bulma.min.css">
    <link rel="stylesheet" href="../../herramientas/css/estilos.css">
</head>
<body>
<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/layout.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>
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
        <style >
                        .cabecera_menu {
                            position: relative;
                        }
                        .fixed-top-right {
                            position: absolute;
                            top: 10px; /* Ajusta este valor según necesites */
                            right: 10px; /* Ajusta este valor según necesites */
                            z-index: 1000; /* Asegura que esté por encima de otros elementos */
                            background-color: white; /* Fondo blanco para mejor visibilidad */
                            
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
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">


            <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        Mi cuenta
                    </a>

            
<div class="container is-fluid mb-6">
    <h1 class="title"> Ingresar Libros  </h1>
    <h2 class="subtitle">Nuevo libro o Contenido</h2>
</div>
<div class="buttons">

<div class="container pb-6 pt-6">
	<?php
		include "../inc/btn_back.php";

	;
	?>



<div class="container pb-6 pt-6">
    <?php require_once "../php/main.php"; ?>
    <a href="index.php?vista=product_search" class="navbar-item">Buscar Libro o Contenido</a>

    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/producto_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Asignar Un Codigo Unico Al Libro Que Desea Ingresar:</label>
                    <input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Tituo Del Libro Nuevo A Ingresar:</label>
                    <input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                   
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Cuantas Unidades Disponibles: </label>
                    <input class="input" type="text" name="producto_stock" pattern="[0-9]{1,25}" maxlength="25" required>
                </div>
            </div>
            <div class="column">
                <label>Seccion O Ubicacion Del Libro</label><br>
                <div class="select is-rounded">
                    <select name="producto_categoria">
                        <option value="" selected>Seleccione una opción</option>
                        <?php
                            $categorias = conexion();
                            $categorias = $categorias->query("SELECT * FROM categoria");
                            if ($categorias->rowCount() > 0) {
                                $categorias = $categorias->fetchAll();
                                foreach ($categorias as $row) {
                                    echo '<option value="' . $row['categoria_id'] . '">' . $row['categoria_nombre'] . '</option>';
                                }
                            }
                            $categorias = null;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label>Foto o Imagen Del Libro</label><br>
                <div class="file is-small has-name">
                    <label class="file-label">
                        <input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg">
                        <span class="file-cta">
                            <span class="file-label">Imagen</span>
                        </span>
                        <span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
                    </label>
                </div>
            </div>


            <div class="column">
                                <label>Archivo del Libro:</label><br>
                                <div class="file is-small has-name">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="producto_archivo" accept=".pdf, .doc, .docx">
                                        <span class="file-cta">
                                            <span class="file-label">Archivo</span>
                                        </span>
                                        <span class="file-name">PDF, DOC, DOCX. (MAX 10MB)</span>
                                    </label>
                                </div>
                            </div>
                        </div>








            <div class="column">
    
</div>

                    <a href="index.php?vista=product_list" class="navbar-item">Lista de libros</a>
                    <a href="index.php?vista=product_category" class="navbar-item"> listar libros Por Seccion O Categoria</a>
                    <a href="index.php?vista=category_new" class="navbar-item">Crear Nueva Seccion O Categoria</a>




        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>

    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<a href="index.php?vista=logout" class="button is-link is-rounded">
                        Salir
                    </a>
</body>
</html>
