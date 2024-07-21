<nav class="dropdownmenu">
    <i class="menu-toggle fas fa-bars"></i>
    <!-- <a href="actualizarusuariooriginal.php" class="logo">
        <img src="../../imagenes/logo.jpg" />
    </a> -->
    <li>
        <a href="inicio.php">
            <i class="fas fa-home menu__icon"></i>
            <span class="nav-item">Inicio</span>
        </a>
    </li>
    <li>
        <a href="panelAcciones.php">
            <i class="fas fa-th menu__icon"></i>
            <span class="nav-item">Acciones</span>
        </a>
    </li>
    <li>
        <a href="instructor.php">
            <i class="fas fa-users menu__icon"></i>
            <span class="nav-item">B-Team</span>
        </a>
    </li>
    <li>
        <a href="home.php">
            <i class="fas fa-book menu__icon"></i>
            <span class="nav-item">Biblioteca</span>
        </a>
    </li>
    <li>
        <a id="btnCerrarSession">
            <i class="fas fa-sign-out-alt menu__icon"></i>
            <span class="nav-item">Salir</span>
        </a>
    </li>
</nav>
<script>
    
    $(document).ready(function() {
        // Maneja el clic en el ícono del menú para abrir/cerrar el menú
        $(document).on("click", ".menu-toggle", function() {
            $("nav").toggleClass("active");
        });

        // Maneja el clic en el botón de cerrar sesión
        $(document).on("click", "#btnCerrarSession", function() {
            $.post("../../include/ctrlIndex2.php", {
                action: 'salir'
            }, function(data) {
                location.href = "../../index.php";
            }, 'json');
        });

        // Cierra el menú si se hace clic fuera de él
        $(document).on("click", function(event) {
            if (!$("nav").is(event.target) && $("nav").has(event.target).length === 0 && $("nav").hasClass("active")) {
                $("nav").removeClass("active");
            }
        });
    });
</script>
