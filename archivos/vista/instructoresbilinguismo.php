<?php
// Incluir el archivo de configuración de conexión a la base de datos
include_once('../../include/conex.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset='.$charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

// Verificar si existe una sesión activa con el id_userprofile
if (isset($_SESSION['id_userprofile'])){
?>



<!Doctype html>
<html lang="es">

<head>
    <?php
        include_once('cabecera.php');

        ?>


    <script type='text/javascript' src="../../herramientas/js/instructor.js"></script>
    <link rel="stylesheet" href="../../herramientas/css/css/instructor.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>instructores de bilinguismo</title>
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






    <style>




.container {
  height: 294px;
  width: 240px;
  color: white;
  perspective: 800px;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.card {
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, #1CAF50, #9BC34A);


  border-radius: 2rem;
  position: relative;
  transition: transform 1500ms;
  transform-style: preserve-3d;
}

.card-top {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 10%;
  position: absolute;
  width: 50%;
  background-color: green;
  border: 2px solid green;
  top: 0;
  border-top: none;
  border-radius: 0 0 1rem 1rem;
  box-shadow: 0px 0px 10px 5px rgba(0, 255, 0, 0.7);
}

.card-top-para {
  font-size: 16px;
  font-weight: bold;
}

.container:hover > .card {
  cursor: pointer;
  transform: rotateX(180deg) rotateZ(-180deg);
}

.front,
.back {
  height: 100%;
  width: 100%;
  border-radius: 2rem;
  box-shadow: 0px 0px 10px 5px rgba(0, 255, 0, 0.7);
  position: absolute;
  backface-visibility: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
}

.back {
  background: linear-gradient(to bottom, #1CAF50, #9BC34A);
  transform: rotateX(180deg) rotateZ(-180deg);
}

.heading {
  font-size: 22px;
  font-weight: bold;
}

.follow {
  font-size: 16px;
  font-weight: 500;
}

.icons {
  display: flex;
  flex-direction: row;
  gap: 20px;
  margin-top: 20px;
}
</style>

</head>

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
        <div class="layout__content">
            <div class="content__page">
            
                <h1>INSTRUCTORES Bilinguismo</h1>
             

                <br><br><br><br><br>


                <div class="row">
                    <div class="col-sm-4">
                        <ul class="navbar-nav">

                <div class="container">




  <div class="card">
    
    <div class="front">
      <div class="card-top">
        
        <p class="card-top-para">INSTRUCTOR</p>
  
      </div>
 
   <br>
   <a href="perfilesdeinstructoruno.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>

        <center>  <p class="heading">ANA LUCIA SALAMANCA </p></center>
      <p class="follow">INGLES 1A
        
    </p></div>
    <div class="back">
      <p class="heading">LICENCIADO EN IDIOMAS</p>
      
      <a href="perfilesdeinstructoruno.php">
      <center>  <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
      </center> </a>

      <div class="icons">
        
      

      </div>
    </div>
  </div>
</div>




<br><br><br><br><br>
</ul>
</div>
<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">INSTRUCTOR</p>
      </div>
      
      <a href="perfilintructordos.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <p class="heading"> DANNY JAMAUCA </p>
      <p class="follow">INGLES A2
    </p></div>
    <div class="back">
      <p class="heading">LICENCIADA EN LENGUAS MODERNAS</p>
      
      <a href="perfilintructordos.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <div class="icons">
        
  

      </div>
    </div>
  </div>
</div>

<br><br><br><br><br>
<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">INSTRUCTOR</p>
      </div>
      <br>    <br>
      <a href="perfilintructortres.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <p class="heading"> YANETH LILIANA BURBANO </p>
      <p class="follow">INGLES A3
    </p></div>
    <div class="back">
      <p class="heading">LINCENCIADA EN IDIOMAS EXTRANGEROS</p>
      
      <a href="perfilintructortres.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <div class="icons">
        
   

      </div>
    </div>
  </div>
</div>
<br><br><br><br><br>

<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">INSTRUCTOR</p>
      </div>
      
      <a href="perfilintructorcuatro.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <p class="heading"> Front Card </p>
      <p class="follow">Follow me for more...
    </p></div>
    <div class="back">
      <p class="heading">Follow Me</p>
      
      <a href="perfilintructorcuatro.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <div class="icons">
        
    

      </div>
    </div>
  </div>
</div>


<div class="row">
                    <div class="col-sm-4">
                        <ul class="navbar-nav">


<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">INSTRUCTOR</p>
      </div>
      
      <a href="perfilintructorcinco.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <p class="heading"> Front Card </p>
      <p class="follow">Follow me for more...
    </p></div>
    <div class="back">
      <p class="heading">Follow Me</p>
      
      <a href="perfilintructorcinco.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>

      <div class="icons">
        
  

      </div>
    </div>
  </div>
</div>
</ul>
</div>
<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">Profile</p>
      </div>
      
      <a href="perfilintructorsexto.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <p class="heading"> Front Card </p>
      <p class="follow">Follow me for more...
    </p></div>
    <div class="back">
      <p class="heading">Follow Me</p>
      
      <a href="perfilintructorsexto.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <div class="icons">
        

      </div>
    </div>
  </div>
</div>


<br><br><br><br><br>

<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">Profile</p>
      </div>
      
      <a href="perfilintructorseptimo.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <p class="heading"> Front Card </p>
      <p class="follow">Follow me for more...
    </p></div>
    <div class="back">
      <p class="heading">Follow Me</p>
      <a href="perfilintructorseptimo.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <div class="icons">
        


      </div>
    </div>
  </div>
</div>
<br><br><br><br><br>

<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">Profile</p>
      </div>
      
      <a href="perfilesdeinstructorocho.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <p class="heading"> Front Card </p>
      <p class="follow">Follow me for more...
    </p></div>
    <div class="back">
      <p class="heading">Follow Me</p>
      
      <a href="perfilesdeinstructorocho.php">
        <center><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Ana Lucia Salamanca Dorado" width="100" height="100" class="profile-photo">
        </center> </a>
      <div class="icons">
        
    

      </div>
    </div>
  </div>
</div>

<br><br><br><br><br>


            </div>
        </div>
    </div>
</body>
        <?php
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
} else {
    header("Location: ../../index.php");
}
?>



