// alertas ofertas
$(document).ready(function(){ 
    $.post("../../include/cntrlSoli.php", {
        action: 'AlertaOferta'
    }, function(data) {
        if (data.rst === "1") {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: 'Hay demasiados usuarios Interesados en tu oferta'  + data.ms + 'Vamos a Revisarla!!!',
                showConfirmButton: false,
                timer: 1500 // Tiempo en milisegundos (1.5 segundos)
            });
        } else if (data.rst === "2") {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Hay una Empresa Interesada en tu oferta' + data.ms ,
                    showConfirmButton: false,
                    timer: 1500 // Tiempo en milisegundos (1.5 segundos)
                });
            }
    }, 'json');
});

$(document).ready(function(){ 
    $.post("../../include/cntrlSoli.php", {
        action: 'MisOfertas'
    }, function(data) {
        if (data.rs === "1") {
            $("#oferta_curso").html(
                `<h1 class="text-center my-4">Tus Cursos Ofertados</h1>` +
                data.tabla
            );
        } else {
            // mirar actualizar perfil
            $("#oferta_curso").hide();
            
        }
    }, 'json');
});