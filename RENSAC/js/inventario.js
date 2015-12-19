$(document).on('ready', funcPrincipal);

function funcPrincipal() {
    $('#btnAgregarDetalle').on('click', agregarFila);
}

function agregarFila() {
    var cod1 = $('#txtcodigoInventario').val();
    var cod2 = $('#txtcodigoInventario2015').val();
    var codbar = $('#txtcodigobarras').val();
    var deno = $('#txtdenominacion').val();
    var marc = $('#txtmarca').val();
    var model = $('#txtmodelo').val();
    var serie = $('#txtserie').val();
    var largo = $('#txtlargo').val();
    var ancho = $('#txtancho').val();
    var alto = $('#txtalto').val();
    var estado = $('input:radio[name=estadoConservacion]:checked').val();
    var etiquetado;
    if($("#chkEtiquetado").is(':checked')) {
        etiquetado = 'SI';
    } else {
        etiquetado = 'NO';
    }
    var operativo;
    if($("#chkOperativo").is(':checked')) {
        operativo = 'O';
    } else {
        operativo = 'I';
    }

    $('tbody').append('<tr><td data-i></td><td>'+cod1+'</td><td>'+cod2+'</td><td>'+codbar+'</td><td>'+deno+'</td><td>'+marc+'</td><td>'+model+'</td><td>'+serie+'</td><td>'+largo+'</td><td>'+ancho+'</td><td>'+alto+'</td><td>'+estado+'</td><td>'+etiquetado+'</td><td>'+operativo+'</td></tr>');
    
    actualizarEnumeracion();
}

function actualizarEnumeracion() {
    var i = 0;
    $('tbody').find('tr').each(function() {
        $(this).find('[data-i]').text(++i);
    });
}