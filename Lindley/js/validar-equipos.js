$(document).on('ready', funcPrincipal);

function funcPrincipal() 
{
	$("#form-equipo").on('submit', funcValidar);  
	$tablaEquipo = $('#tablaEquipo tbody');
    $(document).on('click', '[data-action="eliminar"]', eliminarEquipo);
}

function eliminarEquipo() {
	var id = $(this).parent().parent().find('input').val();
	$(this).parent().parent().fadeOut('slow', function () {		
		location.href = '../scripts/eliminar-equipo.php?id='+id;
	});
}

function funcValidar(event)
{		
	event.preventDefault();	
	
	var codigo = $('#codigo').val();
	var descripcion = $('#descripcion').val();
	var stock = $('#stock').val();	
	

	$.ajax({
		method: "POST",
		url: "../scripts/registrar-equipos.php",
		data: { descripcion: descripcion, stock: stock }
	})
	.done(function( data ) {
		if( data!="1" )
			alert( data );		

		renderTemplateRelacion(codigo,descripcion, stock);

	});

	// Funciones relacionadas al template HTML5
	function activateTemplate(id) {
	    var t = document.querySelector(id);
	    return document.importNode(t.content, true);
	};

	function renderTemplateRelacion(codigo,equipo, stock) {
	    var clone = activateTemplate('#template-fila');	    
	    clone.querySelector("[data-codigo='codigo']").innerHTML = codigo;
	    clone.querySelector("[data-descripcion='descripcion']").innerHTML = equipo;
	    clone.querySelector("[data-stock='stock']").innerHTML = stock;
	    $tablaEquipo.append(clone);
	}	

}
