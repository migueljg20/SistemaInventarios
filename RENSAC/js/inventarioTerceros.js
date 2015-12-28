$(document).on('ready', funcPrincipal);


function funcPrincipal() {
    $('#formTercerosCabecera').on('submit', agregarCabecera);
    $('#formDetalleTerceros').on('submit', agregarFila);    
    $('#verNumeroInventarioTerceros').on('click', verInventario);
    $('#btnVerCodInventario2015').on('click', verInventario2015);   
}

function agregarCabecera() {
    event.preventDefault();

    var idInve =  $('#idInventario').val()
    var i1 = $('#inventariador').val();    
    var fecha = $('#fecha').val();
    var hora = $('#timepicker').val();
    var datosEnviados = 
    {
        'idInventario' : idInve,
        'fecha' : fecha,
        'hora': hora,
        'dependencia' : $('#dependencia').val(),
        'unidadOrganica' : $('#unidadOrganica').val(),        
        'ubicacion' : $('#ubicacion').val(),
        'usuario' : $('#usuario').val(),        
        'inventariador' : i1,        
    };
    
    if(idInve.length == 0)
    {
        alertify.error("El campo del número de Inventario es obligatorio!");
        return;
    }
    if(fecha.length == 0)
    {
        alertify.error("Debe elegir una fecha!");
        return;   
    }
    if(i1.length == 0)
    {
        alertify.error("Debe asignar un inventariador!");
        return;
    }  
    if(hora.length == 0)
    {
        alertify.error("Debe de ingresar la hora!");
        return;
    }  

    $.ajax({
        type : 'POST',
        url : '../scripts/grabarCabeceraTer.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
            }else{
                alertify.success(data.mensaje);

                    $('#verNumeroInventarioTerceros').attr('disabled', 'disabled');
                    $('#btnAgregarCabeceraTerceros').attr('disabled', 'disabled');

                    $('#idInventario').attr('disabled','disabled');
                    $('#timepicker').attr('disabled','disabled');
                    $('#fecha').attr('disabled','disabled');
                    $('#dependencia').attr('disabled','disabled');                 
                    $('#unidadOrganica').attr('disabled','disabled');
                    $('#ubicacion').attr('disabled','disabled');
                    $('#usuario').attr('disabled','disabled');            
                    $('#inventariador').attr('disabled','disabled');                   
            }                
                   
        } 
    });
}

function agregarFila() {
    event.preventDefault();

    var num = $('#detalleInventarioTerceros tr:last').find('[data-i]').text();
   
    if (num == 16){
        alertify.error('Ya no se pueden agregar más bienes a este inventario.');
        return;

    }

    var cod = $('#txtcodigoInventario2015').val();   
    var deno = $('#txtdenominacion').val();
    var color = $('#txtcolor').val();
    var marc = $('#txtmarca').val();
    var model = $('#txtmodelo').val();
    var serie = $('#txtserie').val();
    var largo = $('#txtlargo').val();
    var ancho = $('#txtancho').val();
    var alto = $('#txtalto').val();
    var estado = $('input:radio[name=estadoConservacion]:checked').val();
    var propie = $('#txtpropietario').val();
    var obser = $('#txtobservacion').val();

    if(cod.length == 0)
    {
        alertify.error('Debe asignarse un codigo de inventario actual!');
        return;
    }
   
    var datosEnviados = 
    {
       'idInventario' : $('#idInventario').val(),       
       'codigoInventario' : cod,       
       'denominacion' : deno,
       'marca' :  marc,
       'modelo' : model,
       'serie' : serie,
       'color' : color,
       'largo' : largo,
       'ancho' : ancho,
       'alto' : alto,
       'estado' : estado,
       'propietario' : propie,
       'observacion' : obser
    };

       $.ajax({
        type : 'POST',
        url : '../scripts/grabarDetalleTerceros.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
            }else{                
                alertify.success(data.mensaje);

                    $('tbody').append('<tr><td data-i></td><td>'+cod+'</td><td>'+deno+'</td><td>'+marc+'</td><td>'+model+'</td><td>'+serie+'</td><td>'+color+'</td><td>'+largo+'</td><td>'+ancho+'</td><td>'+alto+'</td><td>'+estado+'</td><td>'+propie+'</td><td>'+obser+'</td></tr>');
                     actualizarEnumeracion();                  
                   
                    $('#txtcodigoInventario2015').val('');                   
                    $('#txtdenominacion').val('');
                    $('#txtcolor').val('');
                    $('#txtmarca').val('');
                    $('#txtmodelo').val('');
                    $('#txtserie').val('');
                    $('#txtlargo').val('');
                    $('#txtancho').val('');
                    $('#txtalto').val('');
                    $("#rbNuevo").attr('checked', 'checked');
                    $('#txtpropietario').val('');
                    $('#txtobservacion').val('');
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





function verInventario(){
    var codigo = $('#idInventario').val();
    var datosEnviados = 
    {
        'codigoInventario' : codigo    
    };

     if(codigo.length == 0){
        alertify.log('Debe ingresar código.');
        return;
    }

    $.ajax({
        type : 'POST',
        url : '../scripts/verNumInvTerceros.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.success(data.mensaje);
            }else{
                $('#fecha').val(data.fecha);         
                $('#timepicker').val(data.hora);
                $('#dependencia').val(data.dependencia);
                $('#unidadOrganica').val(data.unidadOrganica);
                $('#ubicacion').val(data.ubicacion);
                $('#usuario').val(data.usuario);               
                $('#inventariador').val(data.inventariador);                
                verDetalles(codigo); 
            }                
                
        } 
    });
}

function verDetalles(cod){
    var datosEnviados = 
    {
        'codigoInventario' : cod    
    };

    $.ajax({
        type : 'POST',
        url : '../scripts/verDetallesTerceros.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
            }else{
                //LIMPIAR TABLA
                $('#detalleInventarioTerceros tbody').empty();
                for(var i=0;i<=data.longitud;i++)
                {
                    $('tbody').append('<tr><td data-i></td><td>'+data.ci[i]+'</td><td>'+data.deno[i]+'</td><td>'+data.marc[i]+'</td><td>'+data.model[i]+'</td><td>'+data.serie[i]+'</td><td>'+data.color[i]+'</td><td>'+data.largo[i]+'</td><td>'+data.ancho[i]+'</td><td>'+data.alto[i]+'</td><td>'+data.estado[i]+'</td><td>'+data.propietario[i]+'</td><td>'+data.observacion[i]+'</td></tr>');
                     actualizarEnumeracion();    
                }  
            }                
                
        } 
    });
}


function verInventario2015(){
    var codigo = $('#txtcodigoInventario2015').val();
    var datosEnviados = 
    {
        'codigoInventario2015' : codigo    
    };
    if(codigo.length == 0){
        alertify.log('Debe ingresar código.');
        return;
    }

    $.ajax({
        type : 'POST',
        url : '../scripts/verCodInvTer2015.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error){                
               alertify.error(data.mensaje);              
            }
            else
            {
                alertify.success(data.mensaje);                 
            } 
        }
    });
}

