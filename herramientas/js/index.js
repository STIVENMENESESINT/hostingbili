$(document).ready(function(){ 
	
	function calcularEdad() {	
		fecha = $('#fechaNacimientoUsu').val();
		var hoy = new Date();
		var cumpleanos = new Date(fecha);
		var edad = hoy.getFullYear() - cumpleanos.getFullYear();
		var m = hoy.getMonth() - cumpleanos.getMonth();

				if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
					edad--;
				}
				$('#edadUsu').val(edad);
			}
			
			$(document).on("change", "#fechaNacimientoUsu",function (){
				calcularEdad();
			});	
				function limpiar(){
					document.getElementById("nameUsu").value = "";
					document.getElementById("identificacion").value = "";
				}

				$(document).on("click", "#btnEntrar", function () {
					if ($("#numeroiden").val() == "") {
						// Validación de número de identificación vacío
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Debe ingresar número de identificación...',
						});
						$("#numeroiden").focus();
					} else if (!(/^\d{8,}$/.test($("#numeroiden").val()))) {
						// Validación de formato de número de identificación (al menos 8 dígitos)
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'El número de identificación debe contener al menos 8 dígitos numéricos.',
						});
						$("#numeroiden").focus();
					} else if ($("#correo").val() == "") {
						// Validación de correo electrónico vacío
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Debe ingresar el correo de usuario...',
						});
						$("#correo").focus();
					} else if (!validateEmail($("#correo").val())) {
						// Validación de formato de correo electrónico
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Formato de correo electrónico inválido. Por favor, ingrese un correo válido.',
						});
						$("#correo").focus();
					} else {
						// Envío de datos al servidor
						$.post("include/ctrlIndex2.php", {
							action: 'confirmar',
							numeroiden: $("#numeroiden").val(),
							clave: $("#clave").val(),
							correo: $("#correo").val()
						}, function (data) {
							if (data.validacion == "no") {
								// Manejo de errores del servidor
								Swal.fire({
									icon: 'error',
									title: 'Error',
									text: 'Credenciales de acceso no existen',
								});
								limpiar();
							} else {
								if (data.estado == "I") {
									// Usuario inactivo
									Swal.fire({
										icon: 'warning',
										title: 'Advertencia',
										text: 'El usuario existe pero está inactivo',
									});
									limpiar();
								} else if (data.estado == "A") {
									// Acceso autorizado
									Swal.fire({
										icon: 'success',
										title: '¡Bienvenido!',
										text: 'Acceso autorizado. Redirigiendo...',
										showConfirmButton: false,
										timer: 1500 // Tiempo en milisegundos (1.5 segundos)
									});
									setTimeout(function () {
										location.href = "archivos/vista/inicio.php";
									}, 1500); // Redirige después de mostrar la alerta
								}
							}
						}, 'json');
					}
				});
				
				// Función para validar el formato de correo electrónico
				function validateEmail(email) {
					const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
					return re.test(email);
				}
				
				$(document).ready(function(){  
					$.post("include/select.php", {
						action: 'CrgrTipoGenero' 
					},
					function(data) {
						$("#id_genero").html(data.lisTiposG);
						$("#id_genero_rep").html(data.lisTiposG);
						},
						'json'
						).fail(function(xhr, status, error) {
							console.error(error);
						});
					});
			$(document).ready(function(){  
			$.post("include/select.php", {
				action: 'crgrDepto' 
			},
			function(data) {
				$("#cod_dpto").html(data.listDepto);
				},
				'json'
				).fail(function(xhr, status, error) {
					console.error(error);
				});
			});
			$(document).ready(function(){  
				$.post("include/select.php", {
					action: 'crgrTiposDoc' 
				},
				function(data) {
					$("#id_tpdoc").html(data.lisTiposD);
					$("#id_tpdoc_rep").html(data.lisTiposD);
				},
				'json'
				).fail(function(xhr, status, error) {
					console.error(error);
				});
			});
            
			$(document).on("change", "#cod_dpto",
			function (){
					$.post("include/select.php", {
					action:'crgrMuni',
					cod_dpto:$("#cod_dpto").val()
					}, function(data){ 
						$("#cod_municipio").html(data.listMuni);
					}, 'json');	
				});	
			$(document).on("change", "#cod_municipio",function (){
				$.post("include/select.php", {
				action:'crgrPoblados',
				cod_municipio:$("#cod_municipio").val()
				}, function(data){ 
					$("#cod_poblado").html(data.listPoblado);
				}, 'json');	
			});	

			function clear() {
				$("#fechaNacimientoUsu").val("");                    
				$("#id_tpdoc").val("0");
				$("#numeroiden_registro").val("");
				$("#nameusu").val("");
				$("#nombre_dos").val("");
				$("#apellidoUsu").val("");
				$("#apellidoUsu_dos").val("");
				$("#id_genero").val(""); 
				$("#estadoCivil").val(""); 
				$("#celular").val("");
				$("#cod_dpto").val("0");
				$("#cod_municipio").val("0");
				$("#cod_poblado").val("0");
				$("#direccion").val("");
				$("#correo_registro").val("");
				$("#correo1").val("");
				$("#clave_registro").val("");
			}
				
				$(document).on("click", "#btnCerrar",function (){
					// alert('clear entrando');
					clear();
				});
				
				$(document).on("click", "#btnGuardar",function (){
					//alert('Dentro del boton Guardar Registro Usuario.');
					if($("#edadUsu").val()==""){
						alert('Debe ingresar la fecha de nacimiento');
						$("#fechaNacimientoUsu").focus();
					}
					else
					{
						if($("#id_tpdoc").val()=="0" ){
							alert('Debe Seleccionar un tipo de documento');
							$("#id_tpdoc").focus();
						}
						else
						{
							// seguir preguntando con otra caja de texto. 
							// los demas lo hacen ustedes.
							$.post("include/ctrlIndex2.php", {
							action:'registroUsuNew',
							fechaNacimientoUsu:$("#fechaNacimientoUsu").val(),
							id_tpdoc:$("#id_tpdoc").val(),
							numeroiden_registro:$("#numeroiden_registro").val(),
							nameusu:$("#nameusu").val(),
							nombre_dos:$("#nombre_dos").val(),
							direccion:$("#direccion").val(),
							apellidoUsu:$("#apellidoUsu").val(),
							apellidoUsu_dos:$("#apellidoUsu_dos").val(),
							cod_dpto:$("#cod_dpto").val(),
							correo_registro:$("#correo_registro").val(),
							correo1:$("#correo1").val(),
							celular:$("#celular").val(),
							id_genero:$("#id_genero").val(),
							cod_municipio:$("#cod_municipio").val(),
							cod_poblado:$("#cod_poblado").val(),
							clave_registro:$("#clave_registro").val()
							
							}, function(data){
								if(data.rstl=="1"){	alert(data.msj); location.reload();} else{	alert(data.msj); }
							}, 'json');
						}
					}
				});
			});
			
				
					function clear(){
						// $("#fechaNacimientoUsu").val("");					
						//$("#id_tiposolicitud").val("0");
						$("#descripcion").val("");
						$("#id_tiposolicitud").val("0");
						$("#nombre").val("");
						
						// alert('clear SALIENDO');
					}
					$(document).on("click", "#btnVolver",function (){
						// alert('clear entrando');
						clear();
});

document.addEventListener('DOMContentLoaded', function() {
            function FormEmpresa() {
                const checkbox = document.getElementById('addNewForm');
                const formEmpresa = document.getElementById('formEmpresa');
                if (checkbox.checked) {
					$("#formRegisUsu").hide();
                    formEmpresa.style.display = 'block';
                } else {
                    formEmpresa.style.display = 'none';
					$("#formRegisUsu").show();
                }
            }
            const checkbox = document.getElementById('addNewForm');
            checkbox.addEventListener('click', FormEmpresa);
        }
	);
	$(document).on("click", "#btnGuardarEmpresa",function (){
		//alert('Dentro del boton Guardar Registro Usuario.');
		if($("#nombre_empresa").val()==""){
			alert('Debe ingresar Nombre de la empresa');
			$("#nombre_empresa").focus();
		}
		else
		{
			if($("#numeroiden_empresa").val()=="0" ){
				alert('Debe digitar NIT de la Empresa');
				$("#numeroiden_empresa").focus();
			}
			else
			{
				$.post("include/ctrlIndex2.php", {
				action:'registroEmpNew',
				nombre_empresa:$("#nombre_empresa").val(),
				numeroiden_empresa:$("#numeroiden_empresa").val(),
				telefono_empresa:$("#telefono_empresa").val(),
				correo_empresa:$("#correo_empresa").val()
				}, function(data){
					if(data.rstl=="1"){	
						if($("#numeroiden_registro_rep").val()==""){
							alert('Debe Su numero de Identificacion');
							$("#numeroiden_registro_rep").focus();
						}
						else
						{
							if($("#id_tpdoc_rep").val()=="0" ){
								alert('Debe Seleccionar un tipo de documento');
								$("#id_tpdoc_rep").focus();
							}
							else
							{
								$.post("include/ctrlIndex2.php", {
								action:'registroUsuNewE',
								id_tpdoc:$("#id_tpdoc_rep").val(),
								numeroiden_registro:$("#numeroiden_registro_rep").val(),
								nameusu:$("#nameusu_rep").val(),
								nombre_dos:$("#nombre_dos_rep").val(),
								apellidoUsu:$("#apellidoUsu_rep").val(),
								apellidoUsu_dos:$("#apellidoUsu_dos_rep").val(),
								correo_registro:$("#correo_registro_rep").val(),
								celular:$("#celular_rep").val(),
								id_genero:$("#id_genero_rep").val(),
								clave_registro:$("#clave_registro_rep").val()
								
								}, function(data){
									if(data.rstl=="1"){	alert(data.msj);  } else{	alert(data.msj); }
								}, 'json');
							}
						}
					} else{	alert(data.msj); }
				}, 'json');
			}
		}
		limpiar();
	});
	
// Restablecer contraseña 
	$(document).ready(function() {
		// Acción al hacer clic en el botón de recordar clave
		$(document).on("click", "#btnRecordarClave", function() {
			// Validar que todos los campos estén completados
			if ($("#numeroiden").val() === "" || $("#correo").val() === "") {
				alert('Todos los campos son obligatorios. Por favor, complete todos los campos.');
				return;
			}
	
			// Enviar solicitud AJAX para restablecer la clave
			$.post("../../include/ctrlIndex2.php", {
				action: 'RestablecerContraseña',
				numeroiden: $("#numeroiden").val(),
				correo: $("#correo").val()
			}, function(data) {
				if (data.rstl == "1") {
					alert('Se ha restablecido la contraseña con éxito. Verifique su correo electrónico.');
				} else {
					alert('Error al restablecer la contraseña: ' + data.msj);
				}
			}, 'json');
		});
	});
	


/* "Recordar clave - checkbox"  */

$(document).ready(function() {
    // Acción al hacer clic en el nuevo switch
    $(document).on("change", "#exampleSwitch", function() {
        if ($(this).is(":checked")) {
            console.log('Switch activado');
            // Aquí puedes agregar acciones adicionales cuando el switch está activado
        } else {
            console.log('Switch desactivado');
            // Aquí puedes agregar acciones adicionales cuando el switch está desactivado
        }
    });
});


