 <?php
$varDateTime = date("Y-m-d H:i:s");
?>

 <!DOCTYPE html>
 <html>

 <head>
     <?php
        include_once('archivos/vista/cabecera.php');
    ?>
     <script type='text/javascript' src="herramientas/js/index.js"></script>

     <link rel="stylesheet" type="text/css" href="herramientas/css/index.css">
     <link rel="stylesheet" type="text/css" href="herramientas/css/inicio.css">


     <script type='text/javascript' src="herramientas/js/noticia.js"></script>
     <link rel="stylesheet" href="herramientas/css/solicitud.css">
     <link rel="stylesheet" href="herramientas/css/about.css">

     <style>
     /* Estilo para fijar la barra de navegación en la parte superior */
     .navbar {
         position: fixed;
         top: 0;
         width: 100%;
         z-index: 1030;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         background-color: #04324d;
         /* Fondo blanco suave y semitransparente */
     }

     /* Añadir espacio superior al contenido para que no quede oculto detrás de la barra de navegación */


     .layout {
         position: relative;
         min-width: 1290px;
         width: 90%;
         height: 80vh;
         min-height: 80vh;
         margin: 9vh auto 2vh;
         display: grid;
         grid-template-areas:
             "aside content";
         grid-template-columns: 1% 99%;
         border-radius: 4rem;
         background-color: rgba(255, 255, 255, 0.8);
         border: 2px solid var(--primary-text);
     }

     /* Estilos adicionales para la barra de navegación */

     img {
         vertical-align: middle;
         /* Centra verticalmente la imagen */
         border-style: hidden;
         /* Oculta el borde de la imagen */
         height: 75px;
         /* Ajusta la altura de la imagen según lo necesites */
         width: auto;
         /* Mantiene la proporción original de la imagen */
         display: block;
         /* Hace que la imagen se comporte como un bloque */
         margin-left: auto;
         /* Ajusta el margen izquierdo automáticamente */
         margin-right: auto;
         /* Ajusta el margen derecho automáticamente */
         max-width: 100%;
         /* Asegura que la imagen no sea más grande que su contenedor */
     }

     .navbar-brand {
         display: flex;
         align-items: center;

     }

     .nav-item .btn-link {
         color: #007bff;
         font-weight: bold;
     }

     .nav-item .btn-link:hover {
         color: #0056b3;
         text-decoration: underline;
     }
     </style>
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
     <!-- Navigation Bar -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light background-color: var(--alternate-background)">
         <div class="container-fluid">
             <img src="imagenes/img/logo/log.jpg" alt="Logo">
             <a class="navbar-brand" href="#" data-lang-es="Equipo de Multilingüismo"
                 data-lang-en="Multilingualism-Team" data-lang-fr="Équipe Multilinguisme">
                 Equipo de Multilingüismo
             </a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                 aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav ms-auto">
                     <li class="nav-item">
                         <button class="btn btn-link nav-link" data-bs-toggle="modal" data-bs-target="#loginModal"
                             data-lang-es="Iniciar Sesión" data-lang-en="Login" data-lang-fr="Se Connecter">
                             Iniciar Sesión
                         </button>
                     </li>
                     <li class="nav-item">
                         <button class="btn btn-link nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                             data-lang-es="Regístrate" data-lang-en="Register" data-lang-fr="S'inscrire">
                             Regístrate
                         </button>
                     </li>

                     <li class="nav-item">
                         <button class="btn btn-link nav-link" data-bs-toggle="modal"
                             data-bs-target="#RestablecerContraseña" data-lang-es="Olvidaste Tu Contraseña"
                             data-lang-en="Forgot Your Password" data-lang-fr="Mot de Passe Oublié">
                             Olvidaste Tu Contraseña
                         </button>
                     </li>
                 </ul>
             </div>
         </div>

     </nav>
     <div>

         <div class="layout">

             <div class="container layout__content">
                 <!-- traductor -->
                 <div>

                     <select id="language-select">
                         <option value="es"><label for="language-select">Idioma:</label></option>
                         <option value="es">Español</option>
                         <option value="en">English</option>
                         <option value="fr">Français</option>
                     </select>
                 </div>

                 <div class="content__page">




                     <div class="main-container">


                         <!--este es mi carrucel principal -->
                         <div class="custom-carousel-container">
                             <!--este es mi carrucel principal -->
                             <style>
                             .main-container {
                                 display: flex;

                                 align-items: center;
                                 width: 100%;
                                 height: 355px;
                             }

                             /* Contenedor personalizado para el carrusel */
                             .custom-carousel-container {
                                 position: relative;
                                 top: 0;
                                 width: 60%;
                                 display: flex;
                                 justify-content: center;
                                 align-items: center;
                                 padding: 10px;
                                 /* Ajusta el padding superior e inferior según sea necesario */
                             }

                             /* Estilos personalizados para el carrusel */
                             .custom-carousel {
                                 max-width: 800px;
                                 /* Ajusta el ancho máximo del carrusel */
                                 margin: 0 auto;
                             }

                             .custom-carousel .carousel-inner img {
                                 max-height: 500px;
                                 /* Ajusta la altura máxima de las imágenes */
                                 width: auto;
                                 height: 300px;
                                 margin: 0 auto;
                                 border-radius: 16px;
                                 background-color: #f2f2f2;
                                 padding: 19px;
                                 /* Ajusta el padding alrededor de las imágenes */
                                 box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                             }

                             .custom-carousel .carousel-control-prev,
                             .custom-carousel .carousel-control-next {
                                 width: auto;
                                 /* Ajusta el ancho para que solo los íconos sean clicables */
                             }

                             .custom-carousel .carousel-control-prev-icon,
                             .custom-carousel .carousel-control-next-icon {
                                 background-color: rgba(0, 0, 0, 0.5);
                                 /* Fondo semitransparente para mejor visibilidad */
                                 border-radius: 50%;
                                 /* Forma circular */
                                 padding: 10px;
                                 /* Espacio alrededor del ícono */

                             }

                             .uppercase-title {
                                 text-transform: uppercase;
                             }
                             </style>
                             <div id="carouselExampleIndicators" class="carousel slide custom-carousel"
                                 data-bs-ride="carousel">
                                 <div class="carousel-indicators">
                                     <button type="button" data-bs-target="#carouselExampleIndicators"
                                         data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                                     <button type="button" data-bs-target="#carouselExampleIndicators"
                                         data-bs-slide-to="1" aria-label="Slide 2" class="active"
                                         aria-current="true"></button>
                                     <button type="button" data-bs-target="#carouselExampleIndicators"
                                         data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                 </div>
                                 <div class="carousel-inner">
                                     <div class="carousel-item">
                                         <img src="imagenes/img/banner/banner12-banner.webp" class="d-block w-100"
                                             alt="...">
                                     </div>
                                     <div class="carousel-item active">
                                         <img src="imagenes/img/banner/banner11-banner.webp" class="d-block w-100"
                                             alt="...">
                                     </div>
                                     <div class="carousel-item">
                                         <img src="imagenes/img/banner/BANNER-INGLES-BANNER.webp" class="d-block w-100"
                                             alt="...">
                                     </div>
                                 </div>
                                 <button class="carousel-control-prev" type="button"
                                     data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                     <span class="visually-hidden">Previo</span>
                                 </button>
                                 <button class="carousel-control-next" type="button"
                                     data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                     <span class="visually-hidden">Siguiente</span>
                                 </button>
                             </div>
                         </div>
                         <div class="banner">


                             <div class="bilingualism__english-cards-container">
                                 <div class="bilingualism__english-cards">
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240087">
                                             <img loading="lazy" src="imagenes/img/banner/ingles1-banner.webp"
                                                 alt="English 1 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Fortalecimiento de herramientas básicas para la comunicación en inglés."
                                             data-lang-en="Strengthening basic tools for communication in English."
                                             data-lang-fr="Renforcement des outils de base pour la communication en anglais.">
                                             Fortalecimiento de herramientas básicas para la comunicación en inglés.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240088">
                                             <img loading="lazy" src="imagenes/img/banner/ingles2-banner.webp"
                                                 alt="English 2 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Comunicación en contextos personales y profesionales en inglés."
                                             data-lang-en="Communication in personal and professional contexts in English."
                                             data-lang-fr="Communication dans des contextes personnels et professionnels en anglais.">
                                             Comunicación en contextos personales y profesionales en inglés.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240089">
                                             <img loading="lazy" src="imagenes/img/banner/ingles3-banner.webp"
                                                 alt="English 3 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Comunicación en contextos personales y profesionales en inglés."
                                             data-lang-en="Communication in personal and professional contexts in English."
                                             data-lang-fr="Communication dans des contextes personnels et professionnels en anglais.">
                                             Comunicación en contextos personales y profesionales en inglés.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240090">
                                             <img loading="lazy" src="imagenes/img/banner/ingles4-banner.webp"
                                                 alt="English 4 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Consolidación y comprensión de diferentes textos orales y escritos en inglés."
                                             data-lang-en="Consolidation and understanding of different oral and written texts in English."
                                             data-lang-fr="Consolidation et compréhension de différents textes oraux et écrits en anglais.">
                                             Consolidación y comprensión de diferentes textos orales y escritos en
                                             inglés.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240091">
                                             <img loading="lazy" src="imagenes/img/banner/ingles5-banner.webp"
                                                 alt="English 5 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Interacción en diferentes contextos expresando gustos y preferencias en inglés."
                                             data-lang-en="Interaction in different contexts expressing tastes and preferences in English."
                                             data-lang-fr="Interaction dans différents contextes en exprimant des goûts et des préférences en anglais.">
                                             Interacción en diferentes contextos expresando gustos y preferencias en
                                             inglés.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240092">
                                             <img loading="lazy" src="imagenes/img/banner/ingles6-banner.webp"
                                                 alt="English 6 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Fortalecimiento de herramientas para la comunicación en inglés."
                                             data-lang-en="Strengthening tools for communication in English."
                                             data-lang-fr="Renforcement des outils pour la communication en anglais.">
                                             Fortalecimiento de herramientas para la comunicación en inglés.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240093">
                                             <img loading="lazy" src="imagenes/img/banner/ingles7-banner.webp"
                                                 alt="English 7 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Consolidación de herramientas para la comunicación efectiva en diferentes contextos."
                                             data-lang-en="Consolidation of tools for effective communication in different contexts."
                                             data-lang-fr="Consolidation des outils pour une communication efficace dans différents contextes.">
                                             Consolidación de herramientas para la comunicación efectiva en diferentes
                                             contextos.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240094">
                                             <img loading="lazy" src="imagenes/img/banner/ingles8-banner.webp"
                                                 alt="English 8 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Construcción de textos orales y escritos según las características e intencionalidad del contexto."
                                             data-lang-en="Construct oral and written texts according to the characteristics and intentionality of the context."
                                             data-lang-fr="Construire des textes oraux et écrits selon les caractéristiques et l'intentionnalité du contexte.">
                                             Construcción de textos orales y escritos según las características e
                                             intencionalidad
                                             del contexto.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240095">
                                             <img loading="lazy" src="imagenes/img/banner/ingles9-banner.webp"
                                                 alt="English 9 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Comentar sobre eventos que han ocurrido o están planificados en inglés basándose en textos narrativos."
                                             data-lang-en="Comment on events that have occurred or are planned in English based on narrative texts."
                                             data-lang-fr="Commenter des événements qui se sont produits ou sont prévus en anglais en se basant sur des textes narratifs.">
                                             Comentar sobre eventos que han ocurrido o están planificados en inglés
                                             basándose en
                                             textos narrativos.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240096">
                                             <img loading="lazy" src="imagenes/img/banner/ingles10-banner.webp"
                                                 alt="English 10 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Construir textos orales y escritos en inglés sobre eventos futuros."
                                             data-lang-en="Construct oral and written texts in English about future events."
                                             data-lang-fr="Construire des textes oraux et écrits en anglais sur des événements futurs.">
                                             Construir textos orales y escritos en inglés sobre eventos futuros.
                                         </p>
                                     </div>
                                     <div class="bilingualism__english-levels">
                                         <a target="_blank"
                                             href="https://comunidades.netlab-sena.net/cursos-cortos/inscripcion-sofia/51240097">
                                             <img loading="lazy" src="imagenes/img/banner/ingles11-banner.webp"
                                                 alt="English 11 banner" class="bilingualism__english-imgs">
                                         </a>
                                         <p class="bilingualism__english-text"
                                             data-lang-es="Escribir textos argumentativos en inglés con coherencia y cohesión según la intencionalidad comunicativa."
                                             data-lang-en="Write argumentative texts in English with coherence and cohesion according to the communicative intentionality."
                                             data-lang-fr="Rédiger des textes argumentatifs en anglais avec cohérence et cohésion selon l'intentionnalité communicative.">
                                             Escribir textos argumentativos en inglés con coherencia y cohesión según la
                                             intencionalidad comunicativa.
                                         </p>
                                     </div>
                                 </div>


                             </div>
                         </div>

                     </div>

                     <h1 class="title" data-lang-es="NOTICIAS" data-lang-en="NEWS" data-lang-fr="ACTUALITÉS">NOTICIAS
                     </h1>
                     <div class="divider"></div>
                     <div id="noticia_creada2" class=" grid-container ">
                     </div>

                     <!-- Fin Cursos Sena Bilinguismo -->
                 </div>

             </div>
         </div>

         <!-- Login Modal -->
         <div class=" modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="loginModalLabel">Multilingualism-Team</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <!-- Aquí va tu formulario -->
                         <div class="card">
                             <div class="card-body">
                                 <div class="form-group">
                                     <label>Identificación:</label>
                                     <div class="input-with-icon">
                                         <i class="fas fa-id-card identificacion-icon"></i>
                                         <input type="text" class="form-control" id="numeroiden" name="numeroiden"
                                             title='Ingrese solo números' placeholder="123456789"
                                             style='cursor:pointer;'
                                             oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label>Correo:</label>
                                     <div class="input-with-icon">
                                         <i class="fas fa-envelope correo-icon"></i>
                                         <input type="email" class="form-control" id="correo" name="correo" title=''
                                             placeholder="usuario@soysena.edu.co" style='cursor:pointer;'>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label>Contraseña:</label>
                                     <div class="input-with-icon">
                                         <i class="fas fa-lock clave-icon"></i>
                                         <input type="password" class="form-control" id="clave" name="clave" title=''
                                             placeholder="********" style='cursor:pointer;'>
                                     </div>
                                 </div>
                                 <div class="form-group form-check form-switch">
                                     <input class="form-check-input" type="checkbox" id="exampleSwitch">
                                     <label class="form-check-label" for="exampleSwitch">Recordar Contraseña</label>
                                 </div>
                             </div>
                             <div class="card-footer" style="background-color: #ffffff;">
                                 <button type="button" id="btnEntrar" name="btnEntrar"
                                     class="btn btn-success w-100 d-block mx-auto mb-3">Ingresar</button>


                                 <p id="footerText" class="footer-text">© SENA Centro Agropecuario Regional Cauca </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-dialog modal-dialog-scrollable">
                     <div class="modal-content">
                         <!-- Cabecera del diálogo -->
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Regístrate</h5>
                             <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="checkbox" name="addNewForm" id="addNewForm"
                                     value="yes" onclick="FormEmpresa()">
                                 <h5 class="modal-title" id="exampleModalLabel">Registro Empresa</h5>
                             </div>
                         </div>
                         <div class="modal-body">
                             <!-- FORMULARIO DE EMPRESA -->
                             <div id="formEmpresa" style="display: none;">
                                 <div class="form-container">
                                     <div class="form-group">
                                         <label for="nombre" class="form-label">Empresa</label>
                                         <input type="text" id="nombre_empresa" name="nombre" class="form-input"
                                             placeholder="Nombre de la empresa">
                                     </div>
                                     <div class="form-group">
                                         <label for="nit" class="form-label">NIT</label>
                                         <input type="text" id="numeroiden_empresa" name="numeroiden_empresa"
                                             class="form-input" placeholder="123456789">
                                     </div>
                                     <div class="form-group">
                                         <label class="form-label">Contacto Empresa</label>
                                         <input type="tel" id="telefono_empresa" class="form-input"
                                             placeholder="empresa@gmail.com">
                                     </div>
                                     <div class="form-group">
                                         <label for="email" class="form-label">Correo Electrónico</label>
                                         <input type="email" id="correo_empresa" name="correo_empresa"
                                             class="form-input" placeholder="usuario@gmail.com">
                                     </div>
                                     <hr>
                                     <!-- REPRESENTANTE LEGAL -->
                                     <div class="form-group">
                                         <h3 class="form-label"><strong>Representante Legal</strong></h3>
                                     </div>
                                     <!-- Nombres y Apellidos -->
                                     <div class="form-group">
                                         <label for="nameusu" class="form-label">Primer Nombre:</label>
                                         <input type="text" class="form-input" id="nameusu_rep" name="nameusu"
                                             title="Primer Nombre" style="cursor:pointer;">
                                     </div>
                                     <div class="form-group">
                                         <label for="nombre_dos" class="form-label">Segundo Nombre:</label>
                                         <input type="text" class="form-input" id="nombre_dos_rep" name="nombre_dos"
                                             title="Segundo Nombre">
                                     </div>
                                     <div class="form-group">
                                         <label for="apellidoUsu" class="form-label">Primer Apellido:</label>
                                         <input type="text" class="form-input" id="apellidoUsu_rep" name="apellidoUsu"
                                             title="Primer Apellido">
                                     </div>
                                     <div class="form-group">
                                         <label for="apellidoUsu_dos" class="form-label">Segundo Apellido:</label>
                                         <input type="text" class="form-input" id="apellidoUsu_dos_rep"
                                             name="apellidoUsu_dos" title="Segundo Apellido">
                                     </div>
                                     <div class="form-group">
                                         <label for="id_tpdoc" class="form-label">Tipo de Documento:</label>
                                         <select class="form-input" id="id_tpdoc_rep" name="id_tpdoc"
                                             title="Tipo de Documento"></select>
                                     </div>
                                     <!-- Número de Documento -->
                                     <div class="form-group">
                                         <label for="numeroiden_registro" class="form-label">Número Documento:</label>
                                         <input type="text" class="form-input" id="numeroiden_registro_rep"
                                             name="numeroiden_registro" title="" style="cursor:pointer;"
                                             onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                             placeholder="123456789">
                                     </div>
                                     <div class="form-group">
                                         <label for="id_genero" class="form-label">Sexo:</label>
                                         <select class="form-input" id="id_genero_rep" name="id_genero"></select>
                                     </div>
                                     <div class="form-group">
                                         <label for="celular" class="form-label">Celular:</label>
                                         <input type="text" class="form-input" id="celular_rep" name="celular"
                                             placeholder="Celular" title="Teléfono móvil"
                                             placeholder="+1 (555) 123-4567">
                                     </div>
                                     <div class="form-group">
                                         <label for="correo_registro" class="form-label">Correo Electrónico:</label>
                                         <input type="text" class="form-input" id="correo_registro_rep"
                                             name="correo_registro" placeholder="Correo Electrónico"
                                             title="@example.com">
                                     </div>
                                     <!-- Clave-->
                                     <div class="form-group">
                                         <label for="clave_registro" class="form-label">Clave:</label>
                                         <input type="password" class="form-input" id="clave_registro_rep" name="clave"
                                             title="Clave">
                                     </div>
                                     <div class="modal-footer">
                                         <button type="submit" class="form-button form-button-submit"
                                             id='btnGuardarEmpresa' name='btnGuardar'>Registrar</button>
                                         <button type="reset" class="form-button form-button-reset"
                                             data-bs-dismiss="modal">Cancelar</button>
                                     </div>
                                 </div>
                             </div>

                             <!-- FORMULARIO USUARIOS -->
                             <style>
                             .form-container {
                                 display: flex;
                                 flex-wrap: wrap;
                                 justify-content: space-between;

                             }

                             .form-group {
                                 flex: 1 1 46%;
                                 display: flex;
                                 flex-direction: column;
                                 padding: 7px;
                             }

                             .form-group-full {
                                 flex: 1 1 100%;
                             }

                             .modal-footer {
                                 display: flex;
                                 justify-content: center;
                                 gap: 10px;
                                 margin-top: 20px;
                                 width: 100%;
                             }

                             .modal-body {

                                 /* Increased padding for more space inside the card */
                                 max-width: 800px;
                                 /* Set a maximum width for the card */
                                 max-height: 90vh;
                                 /* Set a maximum height for the card */
                                 width: 100%;
                                 /* Make sure it takes the full available width */

                             }

                             .form-label {
                                 margin-bottom: 2px;
                             }

                             .form-input {
                                 padding: 6px;
                                 margin-bottom: -15px;
                                 border: 1px solid #ccc;
                                 border-radius: 4px;
                             }

                             .form-button {
                                 padding: 10px 20px;
                                 border: none;
                                 border-radius: 4px;
                                 cursor: pointer;
                             }

                             .btn-success {
                                 background-color: #28a745;
                                 color: white;
                             }

                             .form-button-reset {
                                 background-color: #dc3545;
                                 color: white;
                             }
                             </style>
                             <div id="formRegisUsu" class="form-container">
                                 <div class="form-group">
                                     <label for="nameusu" class="form-label">Nombres Completos:</label>
                                     <input type="text" class="form-input" id="nameusu" name="nameusu"
                                         title="Primer Nombre" style="cursor:pointer;">
                                 </div>
                                 <div class="form-group">
                                     <label for="apellidoUsu" class="form-label">Apellidos Completos:</label>
                                     <input type="text" class="form-input" id="apellidoUsu" name="apellidoUsu"
                                         title="Primer Apellido">
                                 </div>
                                 <div class="form-group">
                                     <label for="id_tpdoc" class="form-label">Tipo de Documento:</label>
                                     <select class="form-input" id="id_tpdoc" name="id_tpdoc"
                                         title="Tipo de Documento"></select>
                                 </div>
                                 <div class="form-group">
                                     <label for="numeroiden_registro" class="form-label">Número Documento:</label>
                                     <input type="text" class="form-input" id="numeroiden_registro"
                                         name="numeroiden_registro" title="" style="cursor:pointer;"
                                         onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                 </div>
                                 <div class="form-group">
                                     <label for="id_genero" class="form-label">Sexo:</label>
                                     <select class="form-input" id="id_genero" name="id_genero"></select>
                                 </div>
                                 <div class="form-group">
                                     <label for="celular" class="form-label">Celular:</label>
                                     <input type="text" class="form-input" id="celular" name="celular"
                                         placeholder="Celular" title="Teléfono móvil">
                                 </div>
                                 <div class="form-group">
                                     <label for="correo_registro" class="form-label">Correo Electrónico:</label>
                                     <input type="text" class="form-input" id="correo_registro" name="correo_registro"
                                         placeholder="Correo Electrónico" title="@example.com">
                                 </div>
                                 <div class="form-group">
                                     <label for="cod_dpto" class="form-label">Departamento:</label>
                                     <select class="form-input" id="cod_dpto" name="cod_dpto" title="Departamento"
                                         style="cursor:pointer;"></select>
                                 </div>
                                 <div class="form-group">
                                     <label for="cod_municipio" class="form-label">Municipio:</label>
                                     <select class="form-input" id="cod_municipio" name="cod_municipio"
                                         title="Municipio" style="cursor:pointer;"></select>
                                 </div>
                                 <div class="form-group">
                                     <label for="cod_poblado" class="form-label">Poblado:</label>
                                     <select class="form-input" id="cod_poblado" name="cod_poblado" title="Poblado"
                                         style="cursor:pointer;"></select>
                                 </div>
                                 <div class="form-group">
                                     <label class="form-label">Tipo De Poblacion:</label>
                                     <select class="form-input" id="cod_poblacion_regis" name="cod_poblacion" title="caracterizacion"
                                         style="cursor:pointer;"></select>
                                 </div>
                                 <div class="form-group">
                                     <label for="clave_registro" class="form-label">Contraseña:</label>
                                     <input type="password" class="form-input" id="clave_registro" name="clave"
                                         title="Clave">
                                 </div>
                                 <div class="modal-footer">
                                     <button type="submit" class="form-button btn-success" id="btnGuardar"
                                         name="btnGuardar">Registrar</button>
                                     <button type="reset" class="form-button form-button-reset"
                                         data-bs-dismiss="modal">Cancelar</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Restablecer contraseña Modal -->
     <div class="modal fade" id="RestablecerContraseña">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Restablecer contraseña</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <label> Identificación: </label>
                         <div class="input-with-icon">
                             <i class="fas fa-id-card identificacion-icon"></i>
                             <input type="text" class="form-control" id="numeroiden" name="numeroiden"
                                 title='Ingrese solo números' placeholder="123456789" style='cursor:pointer;'
                                 oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                         </div>
                     </div>
                     <div class="form-group">
                         <label> Correo: </label>
                         <div class="input-with-icon">
                             <i class="fas fa-envelope correo-icon"></i>
                             <input type="email" class="form-control" id="correo" name="correo" title=''
                                 placeholder="usuario@soysena.edu.co" style='cursor:pointer;'>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-success" data-bs-dismiss="modal" id='btnRecordar'
                         name='btnRecordar'>Recordar</button>
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id='btnCancelar'
                         name='btnCancelar'>Cancelar</button>
                 </div>
             </div>
         </div>
     </div>
     <!-- resvista modal -->
     <div class="modal fade" id="revistaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" data-lang-es="Subir Imágenes al Carrusel"
                         data-lang-en="Upload Carousel Images" data-lang-fr="Télécharger des Images pour le Carrousel">
                         Subir Nueva Revista</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                         <label for="pdf" data-lang-es="Selecciona un archivo PDF:" data-lang-en="Select a PDF file:"
                             data-lang-fr="Sélectionnez un fichier PDF:">Selecciona un Archivo PDF:</label>
                         <input type="file" name="pdf" id="pdf" class="form-control" accept=".pdf">
                     </div>
                 </form>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-lang-es="Salir"
                         data-lang-en="Exit" data-lang-fr="Sortir">Salir</button>
                     <input class="btn btn-primary" type="button" id="actualizarPermisousu" value="Actualizar"
                         data-lang-es="Actualizar" data-lang-en="Update" data-lang-fr="Mettre à jour">
                 </div>
             </div>
         </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
     <script>
     function FormEmpresa() {
         var checkBox = document.getElementById("addNewForm");
         var formEmpresa = document.getElementById("formEmpresa");
         if (checkBox.checked == true) {
             formEmpresa.style.display = "block";
         } else {
             formEmpresa.style.display = "none";
         }
     }
     </script>
 </body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
 </script> <!-- Script de Bootstrap -->

 </html>