window.onload = function(){
	mostrarDatos();
	$('#tablaDatos').DataTable(); 
    $('#tablaDatos tbody').on('click', 'tr', function () {seleccionSimple(this);});
    $('#tablaDatos tbody').on('dblclick', 'tr', function () {seleccionDoble(this);});


    /*Activar el modal de Registro de EPP*/
  	$('#nuevoEquipo').on('click', function(){
  		limpiar();
  		$('#txtFlag').val("N");  				
		$('#cabeceraRegistro').html("Registrar nuevo Equipo");		
		$("#codigoEquipo").attr('disabled',true);
  		$('#modalNuevoEquipo').modal({
  			show:true,
  			backdrop:'static',
  		});
  	});

  	/*Registrar y/o modificar EPP por Ajax*/
	$('#registroEquipo').on('click', function(){		
		var flag = $.trim($('#txtFlag').val());
		var codigoEPP = $('#codigoEquipo').val();
		var equipo = $('#descripcion').val();
		var stock = $('#stock').val();
		var marca = $('#marca').val();
		var modelo = $('#modelo').val();
		var color = $('#color').val();		


		if(equipo.length==0 || stock.length==0 || marca.length==0 || modelo.length==0 || color.length==0){
			alertify.error("Datos incorrectos, debe llenar y seleccionar todos los campos");
			return false;
		}

		if(flag == "M"){
			var tipo = 15;
	    	var url = document.URL;			
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&codigoEquipo='+codigoEPP+'&descripcion='+equipo+'&stock='+stock+'&marca='+marca+'&modelo='+modelo+'&color='+color,
				url: '../scripts/registros.php',
				success: function(respuesta){
	          		if(respuesta==1){
	          			alertify.success("Modificación exitosa");
	          			$('#modalNuevoEquipo').modal('hide');
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
			var tipo = 5;
	    	var url = document.URL;
			$.ajax({
				type: 'POST',
				data:'tipo='+tipo+'&descripcion='+equipo+'&stock='+stock+'&marca='+marca+'&modelo='+modelo+'&color='+color,
				url: '../scripts/registros.php',
				success: function(respuesta){
					alertify.success("Registro exitoso");
	          		$('#modalNuevoEquipo').modal('hide');
	          		mostrarDatos();	          		
				},
				 error: function(respuesta){
				 	alertify.success("No se pudo registrar");
				 }
			});
		}
	});

}

function limpiar(){
	document.getElementById('codigoEquipo').value = "";
	document.getElementById('descripcion').value = "";
	document.getElementById('stock').value= "";	
	document.getElementById('marca').value= "";	
	document.getElementById('modelo').value= "";	
	document.getElementById('color').value= "";	
}

function eliminar(){  	
    var codigoEPP = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	var tipo = 16;
	var url = document.URL;			
	$.ajax({
		type: 'POST',
		data:'tipo='+tipo+'&codigoEPP='+codigoEPP,
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
	var tipo = 14;
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
	$('#modalNuevoEquipo').modal({
  		show:true,
  		backdrop:'static',
  	});
  	$('#cabeceraRegistro').html("Modificar equipo");
  	document.getElementById('txtFlag').value = "M";
  	document.getElementById('codigoEquipo').value = $('#tablaDatos').DataTable().cell('.selected', 0).data();
  	document.getElementById('descripcion').value = $('#tablaDatos').DataTable().cell('.selected', 1).data();
  	document.getElementById('stock').value = $('#tablaDatos').DataTable().cell('.selected', 2).data();
  	document.getElementById('marca').value = $('#tablaDatos').DataTable().cell('.selected', 3).data();
  	document.getElementById('modelo').value = $('#tablaDatos').DataTable().cell('.selected', 4).data();
  	document.getElementById('color').value = $('#tablaDatos').DataTable().cell('.selected', 5).data();  	

	$("#codigoEquipo").attr('disabled',true);	
}