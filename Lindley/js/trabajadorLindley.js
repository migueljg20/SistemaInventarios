window.onload = function(){
	mostrarDatos();
	$('#tablaDatos').DataTable(); 
    $('#tablaDatos tbody').on('click', 'tr', function () {seleccionSimple(this);});
    $('#tablaDatos tbody').on('dblclick', 'tr', function () {seleccionDoble(this);});


    /*Activar el modal de Registro de Trabajador Contratista*/
  	$('#nuevoTrabajador').on('click', function(){  		
  		limpiar();
  		$('#txtFlag').val("N");  				
		$('#cabeceraRegistro').html("Registrar nuevo Trabajador");
		$("#codigo").attr('disabled',true);	
		$("#dni").attr('disabled',false);	
  		$('#modalNuevoTrabajador').modal({
  			show:true,
  			backdrop:'static',
  		});
  	});

  	/*Registrar y/o modificar Trabajador Contratista por Ajax*/
  	
	$('#registroTrabajador').on('click', function(){		
		var flag = $.trim($('#txtFlag').val());		
		var dni = $('#dni').val();
		var nombres = $('#nombres').val();
    	var apellidos = $('#apellidos').val();
    	var direccion = $('#direccion').val();
    	var telefono = $('#telefono').val();    	


		if(dni.length==0 || nombres.length==0 || apellidos.length==0 || direccion.length==0 || telefono.length==0 ){
			alertify.error("Datos incorrectos, debe llenar y seleccionar todos los campos");
			return false;
		}

		if(flag == "M"){
			var tipo = 21;
	    	var url = document.URL;			
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&dni=' +dni+'&nombres=' +nombres+'&apellidos=' +apellidos+'&direccion=' +direccion+'&telefono=' +telefono,
				url: '../scripts/registros.php',
				success: function(respuesta){					
	          		if(respuesta==1){	          			
	          			alertify.success("Modificación exitosa");
	          			$('#modalNuevoTrabajador').modal('hide');
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
			var tipo = 6;
	    	var url = document.URL;
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&dni=' +dni+'&nombres=' +nombres+'&apellidos=' +apellidos+'&direccion=' +direccion+'&telefono=' +telefono,
				url: '../scripts/registros.php',
				success: function(respuesta){
					alertify.success("Registro exitoso");
	          		$('#modalNuevoTrabajador').modal('hide');
	          		mostrarDatos();	          		
				},
				 error: function(respuesta){
				 	alertify.success("No se pudo registrar");
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
function limpiar(){	
	document.getElementById('codigo').value= "";	
	document.getElementById('dni').value= "";	
	document.getElementById('nombres').value= "";	
	document.getElementById('apellidos').value= "";	
	document.getElementById('direccion').value= "";	
	document.getElementById('telefono').value= "";	
}

function eliminar(){  	
    var dni = $('#tablaDatos').DataTable().cell('.selected', 1).data();
  	var tipo = 22;
	var url = document.URL;			
	$.ajax({
		type: 'POST',
		data:'tipo='+tipo+'&dni='+dni,
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
	var tipo = 20;
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
	$("#btnEliminarTR").hide();
	$('#modalNuevoTrabajador').modal({
  		show:true,
  		backdrop:'static',
  	});
  	$('#cabeceraRegistro').html("Modificar Trabajador");
  	document.getElementById('txtFlag').value = "M";
  	document.getElementById('codigo').value = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	document.getElementById('dni').value = $('#tablaDatos').DataTable().cell('.selected', 1).data();
  	document.getElementById('nombres').value = $('#tablaDatos').DataTable().cell('.selected', 2).data();
  	document.getElementById('apellidos').value = $('#tablaDatos').DataTable().cell('.selected', 3).data();
  	document.getElementById('direccion').value = $('#tablaDatos').DataTable().cell('.selected', 4).data();
  	document.getElementById('telefono').value = $('#tablaDatos').DataTable().cell('.selected', 5).data();

	$("#codigo").attr('disabled',true);	
	$("#dni").attr('disabled',true);	

}