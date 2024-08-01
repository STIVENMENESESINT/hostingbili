<head>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" href="../../herramientas/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/layout.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>



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
    <style>
    .cabecera_menu {
        position: relative;
    }

    .fixed-top-right {
        position: absolute;
        top: 10px;
        /* Ajusta este valor según necesites */
        right: 10px;
        /* Ajusta este valor según necesites */
        z-index: 1000;
        /* Asegura que esté por encima de otros elementos */
        background-color: white;
        /* Fondo blanco para mejor visibilidad */

        padding: 5px 10px;
        /* Espaciado interno */
    }

    .fixed-top-right .btn i {
        margin-right: 5px;
        /* Espacio entre el icono y el texto */
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
    <div class="container layout__content">
        <div class="content__page">


            <div class=" is-fluid mb-6">
                <h1 class="title">Libros</h1>
                <h2 class="subtitle">Lista de Libros Por Secciones O Categorias</h2>
            </div>
            <div class=" pb-6 pt-6">
                <?php
		include "../inc/btn_back.php";

	;
	?>

                <div class="ner pb-6 pt-6">
                    <?php
        require_once "../php/main.php";
    ?>
                    <div class="columns">
                        <div class="column is-one-third">
                            <h2 class="title has-text-centered">Secciones o Categorias </h2>
                            <?php
                $categorias=conexion();
                $categorias=$categorias->query("SELECT * FROM categoria");
                if($categorias->rowCount()>0){
                    $categorias=$categorias->fetchAll();
                    foreach($categorias as $row){
                        echo '<a href="index.php?vista=product_category&category_id='.$row['id_categoria'].'" class="button is-link is-inverted is-fullwidth">'.$row['categoria_nombre'].'</a>';
                    }
                }else{
                    echo '<p class="has-text-centered" >No hay categorías registradas</p>';
                }
                $categorias=null;
            ?>
                        </div>
                        <div class="column">
                            <?php
                $categoria_id = (isset($_GET['id_categoria'])) ? $_GET['id_categoria'] : 0;

                /*== Verificando categoria ==*/
                $check_categoria=conexion();
                $check_categoria=$check_categoria->query("SELECT * FROM categoria WHERE id_categoria='$categoria_id'");

                if($check_categoria->rowCount()>0){

                    $check_categoria=$check_categoria->fetch();

                    echo '
                        <h2 class="title has-text-centered">'.$check_categoria['categoria_nombre'].'</h2>
                        <p class="has-text-centered pb-6" >'.$check_categoria['categoria_ubicacion'].'</p>
                    ';

                    require_once "../php/main.php";

                    # Eliminar producto #
                    if(isset($_GET['product_id_del'])){
                        require_once "../php/producto_eliminar.php";
                    }

                    if(!isset($_GET['page'])){
                        $pagina=1;
                    }else{
                        $pagina=(int) $_GET['page'];
                        if($pagina<=1){
                            $pagina=1;
                        }
                    }

                    $pagina=limpiar_cadena($pagina);
                    $url="index.php?vista=product_category&category_id=$categoria_id&page="; /* <== */
                    $registros=15;
                    $busqueda="";

                    # Paginador producto #
                    require_once "../php/producto_lista.php";

                }else{
                    echo '<h2 class="has-text-centered title" >Seleccione una Secciones para empezar</h2>';
                }
                $check_categoria=null;
            ?>
                        </div>
                    </div>
                </div>