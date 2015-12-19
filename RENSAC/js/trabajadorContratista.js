window.onload = function(){
	mostrarDatos();
	$('#tablaDatos').DataTable(); 
    $('#tablaDatos tbody').on('click', 'tr', function () {seleccionSimple(this);});
    $('#tablaDatos tbody').on('dblclick', 'tr', function () {seleccionDoble(this);});


    /*Activar el modal de Registro de Trabajador Contratista*/
  	$('#nuevoContratista').on('click', function(){
  		limpiar();
  		$('#txtFlag').val("N");  				
		$('#cabeceraRegistro').html("Registrar nuevo Trabajador Contratista");				
  		$('#modalNuevoContratista').modal({
  			show:true,
  			backdrop:'static',
  		});
  	});

  	/*Registrar y/o modificar Trabajador Contratista por Ajax*/
	$('#registroContratista').on('click', function(){		
		var flag = $.trim($('#txtFlag').val());
		var empresa = $('#empresa').val();
		var dni = $('#dni').val();
		var nombres = $('#nombres').val();
    	var apellidos = $('#apellidos').val();
    	var direccion = $('#direccion').val();
    	var telefono = $('#telefono').val();
    	var tipoTrabajador=$('input[type="radio"]:checked').val();    	


		if(empresa.length==0 || dni.length==0 || nombres.length==0 || apellidos.length==0 || direccion.length==0 || telefono.length==0 || tipoTrabajador.length==0){
			alertify.error("Datos incorrectos, debe llenar y seleccionar todos los campos");
			return false;
		}

		if(flag == "M"){
			var tipo = 18;
	    	var url = document.URL;			
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&empresa='+empresa+'&dni=' +dni+'&nombres=' +nombres+'&apellidos=' +apellidos+'&direccion=' +direccion+'&telefono=' +telefono+'&tipoTrabajador=' +tipoTrabajador,
				url: '../scripts/registros.php',
				success: function(respuesta){					
	          		if(respuesta==1){	          			
	          			alertify.success("Modificación exitosa");
	          			$('#modalNuevoContratista').modal('hide');
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
			var tipo = 4;
	    	var url = document.URL;
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&empresa='+empresa+'&dni=' +dni+'&nombres=' +nombres+'&apellidos=' +apellidos+'&direccion=' +direccion+'&telefono=' +telefono+'&tipoTrabajador=' +tipoTrabajador,
				url: '../scripts/registros.php',
				success: function(respuesta){
					alertify.success("Registro exitoso");
	          		$('#modalNuevoContratista').modal('hide');
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
	document.getElementById('empresa').value = "";
	document.getElementById('dni').value= "";	
	document.getElementById('nombres').value= "";	
	document.getElementById('apellidos').value= "";	
	document.getElementById('direccion').value= "";	
	document.getElementById('telefono').value= "";	
}

function eliminar(){  	
    var dni = $('#tablaDatos').DataTable().cell('.selected', 2).data();
  	var tipo = 19;
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
	var tipo = 17;
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
	$('#modalNuevoContratista').modal({
  		show:true,
  		backdrop:'static',
  	});
  	$('#cabeceraRegistro').html("Modificar Trabajador Contratista");
  	document.getElementById('txtFlag').value = "M";
  	document.getElementById('empresa').value = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	document.getElementById('dni').value = $('#tablaDatos').DataTable().cell('.selected', 2).data();
  	document.getElementById('nombres').value = $('#tablaDatos').DataTable().cell('.selected', 3).data();
  	document.getElementById('apellidos').value = $('#tablaDatos').DataTable().cell('.selected', 4).data();
  	document.getElementById('direccion').value = $('#tablaDatos').DataTable().cell('.selected', 5).data();
  	document.getElementById('telefono').value = $('#tablaDatos').DataTable().cell('.selected', 6).data();
  	var tipo = $('#tablaDatos').DataTable().cell('.selected', 7).data();

  	if (tipo=="Contratista")
  		document.getElementById("tipoContratista").checked=true;
  	else
  		if (tipo=="Operario")
				document.getElementById("tipoOperario").checked=true;  	
	$("#dni").attr('disabled',true);	
}