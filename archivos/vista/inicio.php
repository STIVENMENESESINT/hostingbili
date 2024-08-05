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
    <?php
    // Incluir el archivo de cabecera que probablemente contiene enlaces a CSS y otros metadatos
    include_once('cabecera.php');
    ?>

    <script type='text/javascript' src="../../herramientas/js/noticia.js"></script>
    <link rel="stylesheet" href="../../herramientas/css/solicitud.css">
    <link rel="stylesheet" href="../../herramientas/css/about.css">
    <link rel="stylesheet" href="../../herramientas/css/style.css">


    <link rel="stylesheet" href="../../chatp/style.css">

</head>


<script>
document.addEventListener("DOMContentLoaded", () => {
    const languageSelect = document.getElementById("language-select");

    languageSelect.addEventListener("change", (event) => {
        const selectedLanguage = event.target.value;
        setLanguage(selectedLanguage);
    });

    function setLanguage(language) {
        document.querySelectorAll("[data-lang-es]").forEach(element => {
            element.textContent = element.getAttribute(`data-lang-${language}`);
        });
    }

    // Set default language
    setLanguage(languageSelect.value);
});
</script>

<body>
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

            <div>

                <select id="language-select">
                    <option value="es"><label for="language-select">Idioma:</label></option>
                    <option value="es">Español</option>
                    <option value="en">English</option>
                    <option value="fr">Français</option>
                </select>
            </div>
            <div class="content__page">
                <div class="">
                    <!--este es mi carrucel principal -->
                    <?php 
                        include_once('publicarnoticiacarrusel.php');
                    ?>
                </div>
                <!-- este es el traductor -->
                <div class="divider"></div>
                <!-- Cursos Sena Bilinguismo -->
                <div>
                    <div>
                        <h1 class="title" data-lang-es="Cursos Virtuales Bilingüismo"
                            data-lang-en="Virtual Bilingualism Courses" data-lang-fr=" Cours Virtuels de Bilinguisme">

                        </h1>
                    </div>
                    <?php 
                        include_once('banner.php');
                    ?>

                    <!-- Fin Cursos Sena Bilinguismo -->
                    <!-- El contenido dinámico se cargará aquí -->

                    <div id="conten navbar">
                        <?php 
                            include_once('panelinicio.php');
                        ?>

                    </div>
                    <div id="revista">
                        <h1 class="title" data-lang-es="Revista Sena B-Team" data-lang-en="Sena B-Team Magazine"
                            data-lang-fr="Magazine de l'équipe B de Sena">Revista Sena B-Team </h2>
                            <div class="divider"></div>
                            <a id="hideRevista" type="button" class="nav-link nav-item-hover">
                                <i class="fas fa-book nav-link"></i>
                                <span class="nav-item" data-lang-es="Ocultar Revista" data-lang-en="Hide Magazine"
                                    data-lang-fr="Cacher le Magazine">Ocultar
                                    Revista</span>
                            </a>
                            <?php
                            if ($_SESSION['id_rol'] == 3) {
                                echo '
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#revistaModal" class="nav-link nav-item-hover">
                                        <i class="fas fa-plus nav-link" ></i>
                                        <span class="nav-item"  data-lang-es="Nueva Revista" data-lang-en="New Magazine" data-lang-fr="Nouveau Magazine">Nueva Revista</span>
                                    </a>
                            ';
                        }
                        ?>
                            <center>
                                <embed d="pdfEmbed" src="../../imagenes/Revista B2.pdf" type="application/pdf" width="90%"
                                    height="500px" />
                            </center>
                            <br>
                    </div>
                    <!-- Bili asistente virtual -->
                    <?php 
                        include_once('../../chatp/index.php');
                    ?>
                    <div class="divider"></div>

                    <h1 class="title" data-lang-es="NOTICIAS" data-lang-en="NEWS" data-lang-fr="ACTUALITÉS">NOTICIAS
                    </h1>



                    <div id="noticia_creada" class=" grid-container ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="modal fade" id="MisSoli" tabindex="-1" aria-labelledby="MisSoliLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Mis Publicaciones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="MisSoliForm"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close-button" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-center" data-lang-es="Crear publicación" data-lang-en="Create Publication"
                    data-lang-fr="Créer une publication">Crear publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <style>
            #formRegisUsu, .formulario {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .form-group-group, .form-group-group-2 {
                display: flex;
                justify-content: space-between;
                gap: 15px;
            }

            .form-group {
                flex: 1;
            }

            .modal-footer, .form-footer {
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-top: 20px;
            }

            .form-label {
                font-weight: bold;
            }

            .form-input, .form-control {
                width: 100%;
                padding: 8px;
                border: 1px solid #ced4da;
                border-radius: 4px;
            }

            .form-button {
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                color: #fff;
                cursor: pointer;
                font-size: 16px;
            }

            .btn-success {
                background-color: #28a745;
            }

            .form-button-reset {
                background-color: #6c757d;
            }

            .form-control[required] {
                background-color: #f8f9fa;
            }
        </style>

            <form class="formulario" action="" method="post" enctype="multipart/form-data">
                <div class="form-group-group">
                    <div class="form-group">
                        <label class="form-label" for="titulo">Título:</label>
                        <input type="text" class="form-input form-control" id="titulo" name="titulo" placeholder="Título" required>
                    </div>
                </div>
                <div class="form-group-group">
                    <div class="form-group">
                        <label class="form-label" for="id_fecha_mostrada">Fecha a Mostrar:</label>
                        <input type="date" class="form-input form-control" id="id_fecha_mostrada" name="fecha_inicio" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="descripcion">Descripción:</label>
                    <textarea rows="10" class="form-input form-control" id="descripcion" name="descripcion" placeholder="Descripción" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="imagen">Adjuntar Imagen:</label>
                    <input type="file" class="form-input form-control" id="imagen" name="imagen" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="id_categoria">Categoría:</label>
                    <select class="form-input form-control" id="id_categoria" name="id_categoria" onchange="MostrarTipo_Categoria()">
                        <!-- Opciones de categorías aquí -->
                    </select>
                </div>
                <div class="form-group-group-2" id="tipo_cate">
                    <!-- Contenido dependiente de la categoría -->
                </div>
            </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="revistaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" data-lang-es="Subir Nueva Revista" data-lang-en="Upload Carousel Images" data-lang-fr="Télécharger des Images pour le Carrousel">Subir Nueva Revista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pdf" data-lang-es="Selecciona un archivo PDF:" data-lang-en="Select a PDF file:" data-lang-fr="Sélectionnez un fichier PDF:">Selecciona un Archivo PDF:</label>
                    <input type="file" name="pdf" id="pdf" class="form-control" accept=".pdf">
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-lang-es="Salir" data-lang-en="Exit" data-lang-fr="Sortir">Salir</button>
                <input class="btn btn-primary" type="button" id="actualizarPermisousu" value="Actualizar" data-lang-es="Actualizar" data-lang-en="Update" data-lang-fr="Mettre à jour">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="OfertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Ofetarme</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="formdetalle_oferta"></div>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
    $file = $_FILES['pdf'];
    $uploadDir = '../../imagenes/'; // Cambia esto a la ruta donde quieras guardar el archivo
    $uploadFile = $uploadDir . basename($file['name']);
    
    // Verifica que el archivo sea un PDF
    if ($file['type'] === 'application/pdf') {
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo "El archivo ha sido cargado con éxito.";
        } else {
            echo "Error al cargar el archivo.";
        }
    } else {
        echo "Por favor, sube un archivo PDF.";
    }
}
?>

<script>
$(document).on("click", "#actualizarPermisousu", function () {
    // Obtén el formulario
    // Obtén el formulario
    var form = document.getElementById('uploadForm');
        
        // Verifica si el formulario se ha encontrado correctamente
        if (!form) {
            console.error('Formulario no encontrado.');
            return;
        }
        
        // Verifica si el formulario es un objeto HTMLFormElement
        if (!(form instanceof HTMLFormElement)) {
            console.error('El elemento con el ID "uploadForm" no es un formulario.');
            return;
        }
        
        // Verifica si hay un archivo seleccionado
        var fileInput = document.getElementById('pdf');
        if (fileInput.files.length === 0) {
            alert('Por favor selecciona un archivo PDF.');
            return;
        }
        
        // Envía el formulario usando AJAX
        var formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            // Muestra el resultado de la carga
            alert(result);
            // Actualiza el PDF en la página
            document.getElementById('pdfEmbed').src = '../../imagenes/Revista B2.pdf?' + new Date().getTime();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });



</script>





</html>
<style>
.modal-content {
    font-size: 2.1rem;
    /* Aumenta el tamaño de la fuente para todo el contenido del modal */
}

.modal-header h1,
.modal-body label,
.modal-body input,
.modal-body textarea,
.modal-body select,
.modal-footer button {
    font-size: 1.5rem;
    /* Ajusta el tamaño de la fuente para títulos y otros elementos específicos */
}
</style>
<?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>