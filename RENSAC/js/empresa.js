window.onload = function(){
	mostrarDatos();
	$('#tablaDatos').DataTable(); 
    $('#tablaDatos tbody').on('click', 'tr', function () {seleccionSimple(this);});
    $('#tablaDatos tbody').on('dblclick', 'tr', function () {seleccionDoble(this);});

    /*Activar el modal de Registro de Empresa Contratista*/
  	$('#nuevaEmpresa').on('click', function(){
  		limpiar();
		$("#ruc").attr('disabled',false);
  		$('#modalNuevaEmpresa').modal({
  			show:true,
  			backdrop:'static',
  		});
  	});

  	/*Registrar y/o modificar Empresa Contratista por Ajax*/
	$('#registroEmpresa').on('click', function(){

		var flag = $.trim($('#txtFlag').val());
		var ruc = $.trim($('#ruc').val());
		var razonSocial = $.trim($('#razonSocial').val());
		var direccion  = $.trim($('#direccion').val());
		var telefono = $.trim($('#telefono').val());
		var email = $.trim($('#email').val());		
		var referencias = $.trim($('#referencias').val());
		var estado = "Activo"
		if(ruc.length!=11){alertify.error("El RUC debe ser de 11 dígitos");}
		if(razonSocial.length==0){alertify.error("Ingresar razón social");}
		if(direccion.length==0){alertify.error("Ingresar dirección");}
		if(telefono.length==0){alertify.error("Ingresar telefono");}
		if(email.length==0){alertify.error("Ingresar email");}
		if(referencias.length==0){alertify.error("Ingresar referencias");}

		if(ruc.length!=11 || razonSocial.length==0 || direccion.length==0|| direccion.length==0||telefono.length==0|| email.length==0|| referencias.length==0 ){
			return false;
		}
		if(validarCorreo(email)==false){
			alertify.error("E-mail no válido");
			return false;
		};
		
		if(flag == "M"){
			var tipo = 11;
	    	var url = document.URL;			
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&ruc='+ruc+'&razonSocial=' +razonSocial+'&direccion=' +direccion+'&telefono=' +telefono+'&email=' +email+'&referencias=' +referencias,
				url: '../scripts/registros.php',
				success: function(respuesta){
	          		if(respuesta==1){
	          			alertify.success("Modificación exitosa");
	          			$('#modalNuevaEmpresa').modal('hide');
	          			mostrarDatos();
	          		}
	          		else{
	          			alertify.error("No se pudo modificar");
	          		}
				},
				 error: function(respuesta){
				 	alertify.error("No se pudo modificar");
				 }
			});
		}
		if(flag=="N"){
			var tipo = 3;
	    	var url = document.URL;
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&ruc='+ruc+'&razonSocial=' +razonSocial+'&direccion=' +direccion+'&telefono=' +telefono+'&email=' +email+'&referencias=' +referencias,
				url: '../scripts/registros.php',
				success: function(respuesta){
					if(respuesta==1){
	          			alertify.success("Registro exitoso");
	          			$('#modalNuevaEmpresa').modal('hide');
	          			mostrarDatos();
	          		}
	          		else{
	          			alertify.error("No se pudo registrar");
	          		}
				},
				 error: function(respuesta){
				 	alertify.error("No se pudo registrar");
				 }
			});
		}
	});

}
function peticionEliminar(){
	alertify.confirm("Esta seguro de eliminar el trabajo requerido??", function (e) {
		if (e) {
			eliminar();
		} 
		else {
			alertify.error("Acción cancelada");	
			return false;
		}
	});
}
function verificarRUC(){
	var ruc = $.trim($('#ruc').val());
	if(validarSoloNumero(ruc)==false){
		alertify.error("El RUC debe ser solo números");
		$.trim($('#ruc').val(""));
		return false;
	};
	if(ruc.length!=11){
		alertify.error("El RUC debe tener 11 dígitos");
		return false;
	}	
	var tipo = 13;
	var url = document.URL;
	$.ajax({
		type: 'POST',
		data:'tipo='+tipo+'&RUC='+ruc,
		url: '../scripts/registros.php',
		success: function(respuesta){
			if(respuesta==1){
				alertify.success("RUC disponible");
		        return true;
			}
			if(respuesta==0){
				alertify.error("RUC no disponible");
		        return false;
			}
		},
		error: function(respuesta){
			alertify.error(respuesta);
			return false;
		}
	});
}
function limpiar(){
  	$('#txtFlag').val("N");
	$('#txtCodigo').val("");
	$('#cabeceraRegistro').html("Registrar nueva empresa");
	$('#ruc').val("");
	$('#razonSocial').val("");
	$('#direccion').val("");
	$('#telefono').val("");
	$('#email').val("");
	$('#referencias').val("");
}
function eliminar(){  	
    var RUC = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	var tipo = 12;
	var url = document.URL;			
	$.ajax({
		type: 'POST',
		data:'tipo='+tipo+'&RUC='+RUC,
		url: '../scripts/registros.php',
		success: function(respuesta){
			if(respuesta==1){				
				alertify.success("Eliminación correcta");
		        mostrarDatos();
		        $("#btnEliminarTR").hide();
		        return true;
			}
			if(respuesta==0){
				alertify.error(respuesta);
				$("#btnEliminarTR").hide();
				return false;
			}
		},
		error: function(respuesta){
			alertify.error(respuesta);
			return false;
		}
	});
}
function mostrarDatos(){
	var tipo = 10;
	var url = document.URL;			
	$.ajax({
		type: 'POST',
		data:'tipo='+tipo,
		url: '../scripts/registros.php',
		success: function(respuesta){
			$('#tablaDatos').DataTable().destroy();
			$('#cuerpoTabla').html(respuesta);
			$('#tablaDatos').DataTable();
		},
		error: function(respuesta){
			alertify.error(respuesta);
		}
	});
}

function seleccionSimple(e){
	if ($('#tablaDatos tbody tr td').length == 1){
 	   return false;
	}
	if ( $(e).hasClass('selected')){
 		$(e).removeClass('selected');
 		$("#btnEliminarTR").hide();
 	}
	else {
      	$('#tablaDatos').DataTable().$('tr.selected').removeClass('selected');
   		$(e).addClass('selected');
   		$("#btnEliminarTR").show();
    }
}
function seleccionDoble(e){
	if ($('#tablaDatos tbody tr td').length == 1){
 	   return false;
	}
	$(e).addClass('selected');
	$("#btnEliminarTR").show();
	$('#modalNuevaEmpresa').modal({
  		show:true,
  		backdrop:'static',
  	});
  	$('#cabeceraRegistro').html("Modificar empresa");
  	document.getElementById('txtFlag').value = "M";
  	document.getElementById('ruc').value = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	document.getElementById('razonSocial').value = $('#tablaDatos').DataTable().cell('.selected', 1).data();
  	document.getElementById('direccion').value = $('#tablaDatos').DataTable().cell('.selected', 2).data();  	
  	document.getElementById('telefono').value = $('#tablaDatos').DataTable().cell('.selected', 3).data();
  	document.getElementById('email').value = $('#tablaDatos').DataTable().cell('.selected', 4).data();
  	document.getElementById('referencias').value = $('#tablaDatos').DataTable().cell('.selected', 5).data();

	$("#ruc").attr('disabled',true);
}