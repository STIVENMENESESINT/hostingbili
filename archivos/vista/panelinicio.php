<div class="navbar">
    <ul class="navbar-nav">
        <a id="showRevista" type="button" class="nav-link ">

            <i class="fas fa-book-open nav-link"><br>

                <span class="" data-lang-es="Desplegar Revista" data-lang-en="Expand Magazine"
                    data-lang-fr="Déplier le Magazine">
                    Desplegar Revista

                </span>
            </i>

        </a>
        <?php
                                    if ($_SESSION['id_rol'] != 1 && $_SESSION['id_rol'] != 5) {
                                        echo '
                                            <li>   
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#noticiaModal" class="nav-link">
                                                    <i class="fas fa-plus nav-link">
                                                        <span class="" data-lang-es="Crear" data-lang-en="Create" data-lang-fr="Créer"> 
                                                            Crear  
                                                            
                                                        </span>
                                                    </i>
                                                    
                                                </a>
                                            </li>      
                                            <li>
                                                <a type="button" class="nav-link">
                                                
                                                    <i class="fas fa-thin fa-folder-open nav-link">
                                                        <span id="MisSoliActivate" data-bs-toggle="modal" data-bs-target="#MisSoli" class="" data-lang-es="Mis Publicaciones" data-lang-en="My Publications" data-lang-fr="Mes Publications">
                                                            Mis Publicaciones
                                                        
                                                            
                                                        </span>
                                                    </i>    
                                                    
                                                </a>
                                            </li> 
                                    ';
                                    }
                                ?>

        <div id="revista">
            <h1 data-lang-es="Revista Sena B-Team" data-lang-en="Sena B-Team Magazine"
                data-lang-fr="Magazine de l'équipe B de Sena">Revista Sena B-Team </h2>
                <div class="divider"></div>
                <a id="hideRevista" type="button" class="nav-link nav-item-hover">
                    <i class="fas fa-book"></i>
                    <span class="nav-item" data-lang-es="Ocultar Revista" data-lang-en="Hide Magazine"
                        data-lang-fr="Cacher le Magazine">Ocultar
                        Revista</span>
                </a>
                <?php
                            if ($_SESSION['id_rol'] == 3) {
                                echo '
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#revistaModal" class="nav-link nav-item-hover">
                                        <i class="fas fa-plus " ></i>
                                        <span class="nav-item"  data-lang-es="Nueva Revista" data-lang-en="New Magazine" data-lang-fr="Nouveau Magazine">Nueva Revista</span>
                                    </a>
                            ';
                        }
                        ?>
                <center>
                    <embed src="../../imagenes/Revista B2.pdf" type="application/pdf" width="90%" height="500px" />
                </center>
                <br>
        </div>
    </ul>