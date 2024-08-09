$(document).on("click", "#btn_Buscar",function ()	{
    $.post("../../include/cntrlUsuarios.php", {
    action:'buscarUsuario',
    dato_txt:$("#dato_txt").val()
    }, function(data){
        if(data.rstl=='1'){ $("#usuarios").html(data.listaUsu); }
        else { $("#usuarios").html(data.listaUsu); }
    }, 'json');	
});
$(document).on("click", "#btn_permiso", function () {
    var iduserprofile = $(this).data('id');
    console.log("ID del usuario es " + iduserprofile);

    $.post("../../include/cntrlUsuarios.php", {
        action: 'permisoUsuario',
        id_userprofile: iduserprofile
    }, function (data) {
        if (data.rstl == '1') {
            $("#id_permiso").html(data.listaPermiso);

            // Llamar a función para cargar permisos y gestionar eventos de permisos
            cargarPermisos(iduserprofile);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.msj
            });
        }
    }, 'json');
});
$(document).on("click", "#ExportarUsu", function () {
    $.post("../../include/cntrlUsuarios.php", {
        action: 'exportarUsuarios'
    }, function (data) {
        if (data.rstl == '1') {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: data.msj,
                showConfirmButton: false,
                timer: 1500 // Tiempo en milisegundos (1.5 segundos)
            }).then(() => {
                window.location.href = data.fileUrl; // Redirigir a la descarga del archivo
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.msj
            });
        }
    }, 'json');
});


function cargarPermisos(iduserprofile) {
    $.post("../../include/select.php", {
        action: 'crgrEstado'
    }, function (data) {
        var opcionesEstado = data.listEstado;
        $("#id_estado").html(opcionesEstado);
    }, 'json').fail(function (xhr, status, error) {
        console.error(error);
    });

    $.post("../../include/select.php", {
        action: 'crgrTipoRol2'
    }, function (data) {
        var opcionesRol = data.lisTiposR;
        $("#id_rol").html(opcionesRol);
    }, 'json').fail(function (xhr, status, error) {
        console.error(error);
    });

    $(document).on("click", "#actualizarPermisousu", function () {
        $.post("../../include/cntrlUsuarios.php", {
            action: 'GestionPermiso',
            id_userprofile: iduserprofile,
            id_estado: $("#id_estado").val(),
            id_rol: $("#id_rol").val()
        }, function (data) {
            if (data.rstl == '1') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: data.msj,
                    showConfirmButton: false,
                    timer: 1500 // Tiempo en milisegundos (1.5 segundos)
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.msj
                });
            }
        }, 'json');
    });
}
