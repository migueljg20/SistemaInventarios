$(document).on('ready', funcPrincipal);

function funcPrincipal() {
    $('#btnAgregarDetalle').on('click', agregarFila);
    $('#btnAgregarCabecera').on('click', agregarCabecera);
    $('#btnVerCodBarras').on('click', verCodBarras);
    
}

function agregarFila() {

    var num = $('#detalleInventario tr:last').find('[data-i]').text();
   
    if (num == 16){
        alert('Ya no se pueden agregar más bienes a este inventario.');
        return;

    }


    var cod1 = $('#txtcodigoInventario').val();
    var cod2 = $('#txtcodigoInventario2015').val();
    var codbar = $('#txtcodigobarras').val();
    var deno = $('#txtdenominacion').val();
    var color = $('#txtcolor').val();
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
    var datosEnviados = 
    {
       'idInventario' : $('#idInventario').val(),
       'codigoAntiguo' : cod1,
       'codigoInventario' : cod2,
       'codigoBarras' : codbar,
       'denominacion' : deno,
       'marca' :  marc,
       'modelo' : model,
       'serie' : serie,
       'color' : color,
       'largo' : largo,
       'ancho' : ancho,
       'alto' : alto,
       'estado' : estado,
       'etiquetado' : etiquetado,
       'situacion' : operativo
    };

       $.ajax({
        type : 'POST',
        url : '../scripts/grabarDetalle.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alert(data.mensaje);
            }else{                
                alert(data.mensaje);

                    $('tbody').append('<tr><td data-i></td><td>'+cod1+'</td><td>'+cod2+'</td><td>'+codbar+'</td><td>'+deno+'</td><td>'+marc+'</td><td>'+model+'</td><td>'+serie+'</td><td>'+color+'</td><td>'+largo+'</td><td>'+ancho+'</td><td>'+alto+'</td><td>'+estado+'</td><td>'+etiquetado+'</td><td>'+operativo+'</td></tr>');
                     actualizarEnumeracion();
                  
                    $('#txtcodigoInventario').val('');
                    $('#txtcodigoInventario2015').val('');
                    $('#txtcodigobarras').val('');
                    $('#txtdenominacion').val('');
                    $('#txtcolor').val('');
                    $('#txtmarca').val('');
                    $('#txtmodelo').val('');
                    $('#txtserie').val('');
                    $('#txtlargo').val('');
                    $('#txtancho').val('');
                    $('#txtalto').val('');
                    $("#rbNuevo").attr('checked', true);
                    $("#chkEtiquetado").attr('checked', false);
                    $("#chkOperativo").attr('checked', false);

            }             
        } 
    });   
}

function actualizarEnumeracion() {
    var i = 0;
    $('tbody').find('tr').each(function() {
        $(this).find('[data-i]').text(++i);
    });
}

function agregarCabecera() {
    var datosEnviados = 
    {
        'idInventario' : $('#idInventario').val(),
        'fecha' : $('#fecha').val(),
        'local' : $('#local').val(),
        'ubicacion' : $('#ubicacion').val(),
        'usuario' : $('#usuario').val(),
        'cargo' : $('#cargo').val(),
        'dependencia' : $('#dependencia').val(),
        'ambiente' : $('#ambiente').val(),
        'area' : $('#area').val(),
        'inventariador1' : $('#inventariador1').val(),
        'inventariador2' : $('#inventariador2').val(),
    };

    $.ajax({
        type : 'POST',
        url : '../scripts/grabarCabecera.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alert(data.mensaje);
            }else{
                alert(data.mensaje);

                    $('#verNumeroInventario').attr('disabled', 'disabled');
                    $('#btnAgregarCabecera').attr('disabled', 'disabled');

                    $('#idInventario').attr('disabled','disabled');
                    $('#fecha').attr('disabled','disabled');
                    $('#local').attr('disabled','disabled');                 
                    $('#ubicacion').attr('disabled','disabled');
                    $('#usuario').attr('disabled','disabled');
                    $('#cargo').attr('disabled','disabled');
                    $('#dependencia').attr('disabled','disabled');
                    $('#ambiente').attr('disabled','disabled');
                    $('#area').attr('disabled','disabled');
                    $('#inventariador1').attr('disabled','disabled');
                    $('#inventariador2').attr('disabled','disabled');
            }                
                   
        } 
    });
}

function verCodBarras() {
    var datosEnviados = 
    {
        'codigoBarras' : $('#txtcodigobarras').val()       
    };

    $.ajax({
        type : 'POST',
        url : '../scripts/verCodBarras.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alert(data.mensaje);
            }else{               
                $('#txtcodigoInventario').val(data.codigoInterno);
                $('#txtdenominacion').val(data.denominacion);
                $('#txtmarca').val(data.marca);                  
                $('#txtmodelo').val(data.modelo);
                $('#txtserie').val(data.serie);
                $("input[name=estadoConservacion][value='"+data.estado.substring(0, 1)+"']").prop("checked",true);
            }                
                   
        } 
    });
}