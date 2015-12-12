
$(function() {
	$('#agregarCabecera').on('click', function(){	
		var tipo = 1;	
		var plan = $.trim($('#numPlan').val())
		var fechaInicio = $('#fechaInicio').val();
		var fechaFin = $('#fechaFin').val();
		var area = $('#area').val();
		var areaEsp = $('#areaEsp').val();
		var trabajador = $('#trabajador').val();
		var empresa = $('#empresa').val();
		var contratista = $('#contratista').val();
		var horario = $('#horario').val();
		
		if(plan.length>0 && fechaFin.length>0 && horario.length>0 && areaEsp.length>0 && area>0 && trabajador>0 && empresa>0 && contratista>0){
		$.ajax({
				type: 'POST',
				data: 'plan='+plan+'&tipo='+tipo+'&fechaInicio='+fechaInicio+'&fechaFin='+fechaFin+'&area='+area+'&areaEsp='+areaEsp+'&trabajador='+trabajador+'&empresa='+empresa+'&contratista='+contratista+'&horario='+horario,
				url: '../scripts/grabaDetalle.php',
				success: function(data){				
					$('#requerido').removeAttr('disabled').focus();					
					$('#btnGuardarProforma').removeAttr('disabled').focus();
					$('#btnAgregarDetalle').removeAttr('disabled').focus();

					$('#numPlan').attr('disabled','disabled');
					$('#fechaInicio').attr('disabled','disabled');
					$('#fechaFin').attr('disabled','disabled');					
					$('#area').attr('disabled','disabled');
					$('#areaEsp').attr('disabled','disabled');
					$('#trabajador').attr('disabled','disabled');
					$('#empresa').attr('disabled','disabled');
					$('#contratista').attr('disabled','disabled');
					$('#horario').attr('disabled','disabled');
					$('#agregarCabecera').attr('disabled','disabled');
				}
			});
		}else{
			$('#mensaje').html('<p class="alert alert-warning">Espere!!, tiene que ingresar todos los campo.</p>').show(200).delay(1500).hide(200);
		}
		
		
	});


	$('#btnAgregarDetalle').on('click', function(){
		var tipo = 2;
		var requerido = $('#requerido').val();
		
		if(requerido>0){
		$.ajax({
				type: 'POST',
				data: 'requerido='+requerido+'&tipo='+tipo,
				url: '../scripts/grabaDetalle.php',
				success: function(data){
					$('#proforma').html(data);				
					$('#requerido').val('');
					$('#imprimir').removeAttr('disabled').focus();
					
					
				}
			});
		}else{
			$('#mensaje1').html('<p class="alert alert-warning">Espere!!, tiene que ingresar todos los campo.</p>').show(200).delay(1500).hide(200);
		}
	});


});

