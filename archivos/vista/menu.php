<nav class="dropdownmenu">

    <a href="actualizarusuariooriginal.php" class=" logo">
        <img src="../../imagenes/logo.jpg" />
    </a>
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
    <a id="btnCerrarSession" href="">
        <i class="fas fa-sign-out-alt menu__icon"></i>
        <span class="nav-item">Salir</span>
    </a>
</li>

</nav>
<script>
$(document).on("click", "#btnCerrarSession", function() {
    // alert('boton cerrar...');
    $.post("../../include/ctrlIndex2.php", {
        action: 'salir'
    }, function(data) {
        location.href = "../../index.php";
    }, 'json');
});
</script>