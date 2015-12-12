window.onload = function(){
	mostrarDatos();
	$('#tablaDatos').DataTable(); 
    $('#tablaDatos tbody').on('click', 'tr', function () {seleccionSimple(this);});
    $('#tablaDatos tbody').on('dblclick', 'tr', function () {seleccionDoble(this);});

    /*Activar el modal de Registro de Empresa Contratista*/
  	$('#nuevaArea').on('click', function(){
  		limpiar();
  		$('#modalNuevaArea').modal({
  			show:true,
  			backdrop:'static',
  		});
  	});

  	/*Registrar y/o modificar Empresa Contratista por Ajax*/
	$('#registroArea').on('click', function(){
		var flag = $.trim($('#txtFlag').val());
		var area = $.trim($('#area').val());
		var areaID = $.trim($('#txtAreaID').val());
		var estado = "Activo"
		if(area.length==0){alertify.error("Ingrese datos");}
		if(area.length==0){
			return false;
		}
		if(flag == "M"){
			var tipo = 24;
	    	var url = document.URL;			
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&area='+area+'&areaID='+areaID,
				url: '../scripts/registros.php',
				success: function(respuesta){
	          		if(respuesta==1){
	          			alertify.success("Modificación exitosa");
	          			$('#modalNuevaArea').modal('hide');
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
			var tipo = 1;
	    	var url = document.URL;
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&area='+area,
				url: '../scripts/registros.php',
				success: function(respuesta){
					if(respuesta==1){
	          			alertify.success("Registro exitoso");
	          			$('#modalNuevaArea').modal('hide');
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
function limpiar(){
  	$('#txtFlag').val("N");
	$('#area').val("");
	$('#cabeceraRegistro').html("Registrar nueva área");
}

function eliminar(){
    var areaID = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	var tipo = 25;
	var url = document.URL;			
	$.ajax({
		type: 'POST',
		data:'tipo='+tipo+'&areaID='+areaID,
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
	var tipo = 23;
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
	$('#modalNuevaArea').modal({
  		show:true,
  		backdrop:'static',
  	});
  	$('#cabeceraRegistro').html("Modificar área");
  	document.getElementById('txtFlag').value = "M";
  	document.getElementById('txtAreaID').value = $('#tablaDatos').DataTable().cell('.selected',0).data();
  	document.getElementById('area').value = $('#tablaDatos').DataTable().cell('.selected', 1).data();

	$("#txtAreaID").attr('disabled',true);
}