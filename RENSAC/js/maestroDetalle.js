
$(function() {
	$('#agregarMaestro').on('click', function(){	
		var tipo = 1;	
		var numSolicitud = $.trim($('#numSolicitud').val())
		var fechaIngreso = $('#fechaIngreso').val();		
		var areaID = $('#areaID').val();		
		var trabajadorID = $('#trabajadorID').val();		
		var observaciones = $('#observaciones').val();
		
		if(numSolicitud.length>0 && fechaIngreso.length>0 && areaID.length>0 && trabajadorID.length>0 && observaciones.length>0){
		$.ajax({
				type: 'POST',
				data: 'numSolicitud='+numSolicitud+'&tipo='+tipo+'&fechaIngreso='+fechaIngreso+'&areaID='+areaID+'&trabajadorID='+trabajadorID+'&observaciones='+observaciones,
				url: '../scripts/grabaDeta.php',
				success: function(data){				
					$('#equipoProteccionID').removeAttr('disabled').focus();										
					$('#btnGuardarProforma').removeAttr('disabled').focus();
					$('#btnAgregarDeta').removeAttr('disabled').focus();
					$('#fechaEntrega').removeAttr('disabled').focus();
					$('#motivo').removeAttr('disabled').focus();

					$('#numSolicitud').attr('disabled','disabled');
					$('#fechaIngreso').attr('disabled','disabled');								
					$('#areaID').attr('disabled','disabled');					
					$('#trabajadorID').attr('disabled','disabled');					
					$('#observaciones').attr('disabled','disabled');
					$('#agregarMaestro').attr('disabled','disabled');
				}
			});
		}else{
			$('#mensaje').html('<p class="alert alert-warning">Espere!!, tiene que ingresar todos los campo.</p>').show(200).delay(1500).hide(200);
		}
		
		
	});


	$('#btnAgregarDeta').on('click', function(){
		var tipo = 2;
		var equipoProteccionID = $('#equipoProteccionID').val();
		var fechaEntrega = $('#fechaEntrega').val();
		var motivo = $('#motivo').val();
		
		if(equipoProteccionID.length>0 && fechaEntrega.length>0 && motivo.length>0){
		$.ajax({
				type: 'POST',
				data: 'equipoProteccionID='+equipoProteccionID+'&tipo='+tipo+'&fechaEntrega='+fechaEntrega+'&motivo='+motivo,
				url: '../scripts/grabaDeta.php',
				success: function(data){
					$('#control').html(data);				
					$('#equipoProteccionID').val('');
					$('#imprimir').removeAttr('disabled').focus();
					
					
				}
			});
		}else{
			$('#mensaje1').html('<p class="alert alert-warning">Espere!!, tiene que ingresar todos los campo.</p>').show(200).delay(1500).hide(200);
		}
	});


});


