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

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

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
            <h1 class="title">Multilingualism-Team<br> </h1>
            <div class="divider"></div>

            <div>

                <select id="language-select">
                    <option value="es"><label for="language-select">Idioma:</label></option>
                    <option value="es">Español</option>
                    <option value="en">English</option>
                    <option value="fr">Français</option>
                </select>
            </div>
            <div class="content__page">
                <!--este es mi carrucel principal -->
                <div class="carousel-container">
                    <style>
                    /* Estilos para el carrusel */
                    .carousel-inner img {
                        max-width: 100%;
                        max-height: 300px;
                        /* Reducir la altura máxima */
                        width: auto;
                        height: auto;
                        margin: 0 auto;
                        border-radius: 16px;
                        background-color: #f2f2f2;
                        padding: 10px;
                        /* Reducir el padding */
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }

                    .carousel-control-prev,
                    .carousel-control-next {
                        width: auto;
                    }

                    .carousel-control-prev-icon,
                    .carousel-control-next-icon {
                        background-color: rgba(0, 0, 0, 0.5);
                        border-radius: 50%;
                        padding: 10px;
                    }

                    /* Ajustes generales para el contenedor del carrusel */
                    .carousel-container {
                        max-width: 600px;
                        /* Ajusta el ancho máximo del carrusel */

                        padding: 20px;
                        /* Añadir un padding alrededor del carrusel */
                    }
                    </style>
                    <?php
                        include_once('calen.php');
                    ?>
                    <?php 
                        include_once('publicarnoticiacarrusel.php');
                    ?>

                </div>
                <!-- este es el traductor -->


                <div>
                    <div id="revista">
                        <h1 class="title" data-lang-es="Revista Sena B-Team" data-lang-en="Sena B-Team Magazine"
                            data-lang-fr="Magazine de l'équipe B de Sena">Revista Sena B-Team </h1>
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


                    <!-- El contenido dinámico se cargará aquí -->

                    <div id="conten navbar">
                        <?php 
                            include_once('panelinicio.php');
                        ?>

                    </div>

                    <!-- Bili asistente virtual -->
                    <?php 
                        include_once('../../chatp/index.php');
                    ?>


                    <h1 class="title" data-lang-es="NOTICIAS" data-lang-en="NEWS" data-lang-fr="ACTUALITÉS">NOTICIAS
                    </h1>
                    <div class="divider"></div>



                    <div id="noticia_creada" class=" grid-container ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Article Writer with 10 Years of Experience</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="container bg-white pt-3">
                    <div class="row px-3 pb-3 justify-content-center">
                        <div class="col-md-8">
                            <h2 class="mb-4 font-weight-bold">Article writer with 10 years of experience</h2>
                            <img class="img-fluid float-left w-50 mr-4 mb-3" src="../../imagenes/img/grup/1.png"
                                alt="Image">
                            <p class="m-0">
                                Takimata lorem et ut et diam amet dolor gubergren, amet dolor eirmod sea sea invidunt,
                                sed no
                                sed diam ipsum ut et. Sit nonumy est ut consetetur sed, labore dolor ipsum sed ea dolor
                                lorem
                                erat et erat, consetetur sed labore duo voluptua rebum sed gubergren. Dolores nonumy
                                sanctus
                                erat clita stet sed, dolore justo diam eos aliquyam diam. Clita nonumy rebum dolor dolor
                                eos
                                takimata labore diam sed, et voluptua et invidunt sanctus, elitr dolor nonumy tempor
                                dolor elitr
                                lorem no dolor ipsum, ut at gubergren dolor est aliquyam stet, et sea takimata rebum
                                labore erat
                                duo invidunt lorem. At takimata stet diam dolore accusam, kasd at diam aliquyam diam sed
                                est
                                dolor takimata. Sadipscing rebum diam ea et tempor, eirmod et et invidunt voluptua et
                                dolor sit.
                                Labore labore clita et amet sea sit et, est ipsum eirmod amet voluptua dolore, diam
                                eirmod kasd
                                lorem gubergren clita at amet, sea accusam vero amet lorem eos sed diam sit amet, nonumy
                                ipsum
                                et tempor magna dolores aliquyam vero eos ipsum. Ipsum ipsum sadipscing diam aliquyam
                                diam et
                                ipsum eos vero, gubergren magna elitr elitr clita dolor. Aliquyam vero sed sanctus sed
                                dolore
                                sanctus elitr no amet, ea magna ipsum.
                            </p>
                        </div>
                        <div class="col-md-8 pt-4">
                            <div class="d-flex flex-column skills">
                                <div class="progress w-100 mb-4">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                        aria-valuemax="100">Adaptability</div>
                                </div>
                                <div class="progress w-100 mb-4">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                        aria-valuemax="100">Research</div>
                                </div>
                                <div class="progress w-100">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                        aria-valuemax="100">Editing</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Noticia -->
<style>
.form-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    padding: 15px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    background-color: #f8f9fa;
}

.course-data-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.course-data-field {
    display: flex;
    flex-direction: column;

    flex: 1 1 45%;
}

.modal-title {
    font-weight: bold;
}

.form-control,
.col-form-label,
.modal-textbox {
    width: 100%;
    padding: 8px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.create-button,
.close-button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin-right: 10px;
}

.create-button {
    background-color: #28a745;
}

.close-button {
    background-color: #6c757d;
}

.form-group-full {
    flex: 1 1 100%;
}

.modal-footer {
    display: flex;
    justify-content: center;

    margin-top: 20px;
    width: 100%;
}
</style>




<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" data-lang-es="Crear publicación" data-lang-en="Create Publication"
                    data-lang-fr="Créer une publication">Crear publicación</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formulario" action="" method="post" enctype="multipart/form-data">
                    <div class="form-container">
                        <div class="form-group course-data-field">
                            <label class="modal-title">Título:</label>
                            <input type="text" class="form-input form-control" id="titulo1" name="titulo"
                                placeholder="Título" required>
                        </div>
                        <div class="form-group course-data-field">
                            <label class="modal-title" for="id_fecha_mostrada">Fecha a Mostrar:</label>
                            <input type="date" class="form-input form-control" id="id_fecha_mostrada"
                                name="fecha_inicio" required>
                        </div>
                        <div class="form-group course-data-field form-group-full" id="descripcion">
                            <label class="modal-title" for="descripcion">Descripción:</label>
                            <textarea rows="10" class="form-input form-control" id="descripcion" name="descripcion"
                                placeholder="Descripción" required></textarea>
                        </div>
                        <div class="form-group course-data-field">
                            <label class="modal-title" for="imagen">Adjuntar Imagen:</label>
                            <input type="file" class="form-input form-control" id="imagen" name="imagen" required>
                        </div>
                        <div class="form-group course-data-field">
                            <label class="modal-title" for="id_categoria">Categoría:</label>
                            <select class="form-input form-control" id="id_categoria" name="id_categoria"
                                onchange="MostrarTipo_Categoria()">
                                <!-- Opciones de categorías aquí -->
                            </select>
                        </div>
                        <div class="form-group course-data-field form-group-full" id="tipo_cate">
                            <!-- Contenido dependiente de la categoría -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Ofertarme</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="formdetalle_oferta">
                    <!-- Aquí se puede cargar el contenido dinámico relacionado con la oferta -->
                </div>
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
    $(document).on("click", "#actualizarPermisousu", function() {
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
                document.getElementById('pdfEmbed').src = '../../imagenes/Revista B2.pdf?' + new Date()
                    .getTime();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    </script>





</html>
<style>
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