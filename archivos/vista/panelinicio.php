<div class="navbar">
    <ul class="navbar-nav">
        <a id="showRevista" type="button" class="nav-item ">

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
                                                <a type="button" data-bs-toggle="modal" data-bs-target="#noticiaModal" class="nav-item">
                                                    <i class="fas fa-plus nav-link">
                                                        <span class="" data-lang-es="Crear" data-lang-en="Create" data-lang-fr="Créer"> 
                                                            Crear  
                                                            
                                                        </span>
                                                    </i>
                                                    
                                                </a>
                                            </li>      
                                            <li>
                                                <a type="button" class="nav-item">
                                                
                                                    <i class="fas fa-thin fa-folder-open nav-link">
                                                        <span id="MisSoliActivate" data-bs-toggle="modal" data-bs-target="#MisSoli" class="title2" data-lang-es="Mis Publicaciones" data-lang-en="My Publications" data-lang-fr="Mes Publications">
                                                            Mis Publicaciones
                                                        
                                                            
                                                        </span>
                                                    </i>    
                                                    
                                                </a>
                                            </li> 
                                    ';
                                    }
                                ?>


    </ul>

    <style>
    .navbar-nav {
        list-style: none;
        padding: 0;
        display: contents;
        flex-direction: column;
    }

    .nav-link {
        text-decoration: none;
        color: #fff;
        margin-bottom: 0.5rem;
        cursor: pointer;
    }



    #revista {
        display: none;
        padding: 2rem 0;

        color: #000;
    }

    .title2 {
        position: relative;
        top: 12px;
        margin-left: 10px;

        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
    }

    .nav-item {
        position: relative;
        top: 12px;
        margin-left: 10px;
        color: #ecf0f1;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
    }
    </style>