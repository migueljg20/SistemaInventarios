window.onload = function(){
	mostrarDatos();
	$('#tablaDatos').DataTable(); 
    $('#tablaDatos tbody').on('click', 'tr', function () {seleccionSimple(this);});
    $('#tablaDatos tbody').on('dblclick', 'tr', function () {seleccionDoble(this);});

	/*Activar el modal de Registro de Trabajo Requerido*/
	$('#nuevoTrabajoRequerido').on('click', function(){
		limpiar();		
		$("input[name='estado']").attr('disabled',true);
  		$('#modalNuevoTrabajoRequerido').modal({
  			show:true,
  			backdrop:'static',
  		});
  	});

  	/*Registrar Trabajo Requerido por Ajax*/
	$('#registroTrabajoRequerido').on('click', function(){		
		var flag = $.trim($('#txtFlag').val())
		var areaID = $('#areaID').val();
		var codigo = $('#txtCodigo').val();
		var descripcion = $.trim($('#descripcion').val());
		var fechaLimite = $('#fechaLimite').val();
		var estado = "";
		if(document.getElementById("rbPendiente").checked==true ){estado="Pendiente";}
	  	if(document.getElementById("rbSolicitado").checked==true ){estado="Solicitado";}
	  	if(document.getElementById("rbEjecutando").checked==true ){estado="Ejecutando";}
	  	if(document.getElementById("rbFinalizado").checked==true ){estado="Finalizado";}

		if(areaID==0){alertify.error("Debe seleccionar el área");}
		if(descripcion.length==0){alertify.error("Debe ingresar la descripción del trabajo");}
		if(fechaLimite==""){alertify.error("Debe ingresar la fecha");}
		if(descripcion.length==0 || areaID==0 || fechaLimite==""){			
			return false;
		}
		if(flag == "M"){
			var tipo = 8;
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&areaID='+areaID+'&codigo='+codigo+'&descripcion='+descripcion+'&fechaLimite='+fechaLimite+'&estado='+estado,
				url: '../scripts/registros.php',
				success: function(respuesta){
	          		if(respuesta==1){
	          			alertify.success("Modificación exitosa");
	          			$('#modalNuevoTrabajoRequerido').modal('hide');
	          			mostrarDatos();
	          		}
	          		else{	          			
				 		alertify.error("No se pudo modificar");
	          		}
				},
				 error: function(respuesta){
				 	alertify.error(respuesta);
				 }
			});
		}
		if(flag=="N"){
			var tipo = 2;
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&areaID='+areaID+'&descripcion='+descripcion+'&fechaLimite='+fechaLimite+'&estado='+estado,
				url: '../scripts/registros.php',
				success: function(respuesta){
					if(respuesta==1){
	          			alertify.success("Registro exitoso");
	          			$('#modalNuevoTrabajoRequerido').modal('hide');
	          			mostrarDatos();
	          		}
	          		else{
				 		alertify.error("No se pudo registrar");
	          		}
				},
				 error: function(respuesta){
				 	alertify.error(respuesta);
				 }
			});
		}
	});

	

}
function peticionEliminar(){
	alertify.confirm("Esta seguro de eliminar el trabajo requerido??", function (e) {
		if (e) {
			eliminar();
		} else {
			alertify.error("Acción cancelada");
		}
		return false;
	});
}
function eliminar(){ 
    var areaID = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	var codigo = $('#tablaDatos').DataTable().cell('.selected', 1).data();
  	var tipo = 9;
	$.ajax({
		type: 'POST',
		data:'tipo='+tipo+'&areaID='+areaID+'&codigo='+codigo,
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
	var tipo = 7;
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
function limpiar(){
	$('#txtFlag').val("N");
	$('#txtCodigo').val("");
	$('#areaID').val(0);
	$('#descripcion').val("");
	$('#fechaLimite').val("");
	$('#cabeceraRegistro').html("Registrar nuevo trabajo requerido");
	$("#areaID").attr('disabled',false);
	document.getElementById('rbPendiente').checked = true;
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
	$('#modalNuevoTrabajoRequerido').modal({
  		show:true,
  		backdrop:'static',
  	});
  	$('#cabeceraRegistro').html("Modificar trabajo requerido");
  	document.getElementById('txtFlag').value = "M";
  	document.getElementById('areaID').value = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	document.getElementById('txtCodigo').value = $('#tablaDatos').DataTable().cell('.selected', 1).data();
  	document.getElementById('descripcion').value = $('#tablaDatos').DataTable().cell('.selected', 2).data();
  	document.getElementById('fechaLimite').value = $('#tablaDatos').DataTable().cell('.selected', 4).data();
  	var estado =  $('#tablaDatos').DataTable().cell('.selected', 3).data();
  	if(estado=="Pendiente"){document.getElementById("rbPendiente").checked=true;}
  	if(estado=="Solicitado"){document.getElementById("rbSolicitado").checked=true;}
  	if(estado=="Ejecutando"){document.getElementById("rbEjecutando").checked=true;}
  	if(estado=="Finalizado"){document.getElementById("rbFinalizado").checked=true;}

  	$("input[name='estado']").attr('value',$('#tablaDatos').DataTable().cell('.selected', 3).data());
	$("#areaID").attr('disabled',true);
	$("input[name='estado']").attr('disabled',false);

}