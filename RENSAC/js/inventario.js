$(document).on('ready', funcPrincipal);

function funcPrincipal() {
    $('#formDetalle').on('submit', agregarFila);
    $('#formCabecera').on('submit', agregarCabecera);
    $('#btnVerCodBarras').on('click', verCodBarras);
    $('#verNumeroInventario').on('click', verInventario);
    $('#btnVerCodInventario2015').on('click', verInventario2015);
    $('#btnVerificarCodBarras').on('click', verificarCodBarras);
    $('#btnVerAnterior').on('click', verificarCodAnterior);
    $('#detalleInventario').editable();
}

function agregarFila() {
    event.preventDefault();

    var num = $('#detalleInventario tr:last').find('[data-i]').text();
   
    if (num == 16){
        alertify.error('Ya no se pueden agregar más bienes a este inventario.');
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
    var obser = $('#txtobservacion').val();
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

    if(cod2.length == 0)
    {
        alertify.error('Debe asignarse un codigo de inventario actual!');
        return;
    }
    if(cod2.length != 5)
    {
        alertify.error('El codigo de inventario debe tener 5 cifras obligatoriamente!');
        return;
    }
    //if(codbar.length == 0)
    //{
    //    alertify.error('Debe asignarse un codigo de barras al bien!');
    //    return;
    //}

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
       'situacion' : operativo,
       'observacion' : obser
    };

       $.ajax({
        type : 'POST',
        url : '../scripts/grabarDetalle.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
            }else{                
                alertify.success(data.mensaje);
                    $('tbody').append('<tr><td data-i></td><td>'+cod1+'</td><td>'+cod2+'</td><td>'+codbar+'</td><td>'+deno+'</td><td>'+marc+'</td><td>'+model+'</td><td>'+serie+'</td><td>'+color+'</td><td>'+largo+'</td><td>'+ancho+'</td><td>'+alto+'</td><td>'+estado+'</td><td>'+etiquetado+'</td><td>'+operativo+'</td><td>'+obser+'</td><td></td></tr>');
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
                    $("#rbNuevo").attr('checked', 'checked');
                    $("#chkEtiquetado").attr('checked', true);
                    $("#chkOperativo").attr('checked', true);
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

function agregarCabecera() {
    event.preventDefault();

    var idInve =  $('#idInventario').val()
    var i1 = $('#inventariador1').val();
    var i2 = $('#inventariador2').val();
    var fecha = $('#fecha').val();
    var datosEnviados = 
    {
        'idInventario' : idInve,
        'fecha' : fecha,
        'local' : $('#local').val(),
        'ubicacion' : $('#ubicacion').val(),
        'usuario' : $('#usuario').val(),
        'cargo' : $('#cargo').val(),
        'dependencia' : $('#dependencia').val(),
        'ambiente' : $('#ambiente').val(),
        'area' : $('#area').val(),
        'inventariador1' : i1,
        'inventariador2' : i2
    };
    
    if(idInve.length == 0)
    {
        alertify.error("El campo del número de Inventario es obligatorio!");
        return;
    }
    if(idInve.length != 6)
    {
        alertify.error("El número de Inventario debe tener 6 dígitos obligatoriamente!");
        return;
    }
    if(fecha.length == 0)
    {
        alertify.error("Debe elegir una fecha!");
        return;   
    }
    if(i1.length == 0 || i2.length==0)
    {
        alertify.error("Debe asignar dos inventariadores!");
        return;
    }
    if(i1 == i2)
    {
        alertify.error("Cuidado, está asignando doble al mismo inventariador!");
        return;
    }

    $.ajax({
        type : 'POST',
        url : '../scripts/grabarCabecera.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
            }else{
                alertify.success(data.mensaje);

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
    var codigo = $('#txtcodigobarras').val();
    var datosEnviados = 
    {
        'codigoBarras' : $('#txtcodigobarras').val()       
    };

    if(codigo.length == 0){
        alertify.log('Debe ingresar código.');
        return;
    }

    $.ajax({
        type : 'POST',
        url : '../scripts/verCodBarras.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
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
        url : '../scripts/verCodInventario.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.success(data.mensaje);
            }else{
                $('#fecha').val(data.fecha);         
                $('#local').val(data.local);
                $('#ubicacion').val(data.ubicacion);
                $('#usuario').val(data.usuario);
                $('#cargo').val(data.cargo);
                $('#dependencia').val(data.dependencia);
                $('#ambiente').val(data.ambiente);
                $('#area').val(data.area);
                $('#inventariador1').val(data.inventariador1);
                $('#inventariador2').val(data.inventariador2);
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
        url : '../scripts/verDetalles.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
            }else{
                //LIMPIAR TABLA
                $('#detalleInventario tbody').empty();
                for(var i=0;i<=data.longitud;i++)
                {
                    $('tbody').append('<tr><td data-i></td><td>'+data.cia[i]+'</td><td>'+data.ci[i]+'</td><td>'+data.codbar[i]+'</td><td>'+data.deno[i]+'</td><td>'+data.marc[i]+'</td><td>'+data.model[i]+'</td><td>'+data.serie[i]+'</td><td>'+data.color[i]+'</td><td>'+data.largo[i]+'</td><td>'+data.ancho[i]+'</td><td>'+data.alto[i]+'</td><td>'+data.estado[i]+'</td><td>'+data.etiquetado[i]+'</td><td>'+data.operativo[i]+'</td><td>'+data.observacion[i]+'</td></tr>');
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
        url : '../scripts/verCodInventario2015.php',
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

function verificarCodBarras(){
    var codigo = $('#txtcodigobarras').val();
    var datosEnviados = 
    {
        'codigoBarras' : codigo    
    };
    if(codigo.length == 0){
        alertify.log('Debe ingresar código.');
        return;
    }

    $.ajax({
        type : 'POST',
        url : '../scripts/verificarCodBarras.php',
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

function verificarCodAnterior(){
    var codigo = $('#txtcodigoInventario').val();
    var ano = $('input:radio[name=anoInventario]:checked').val();

    var datosEnviados = 
    {
        'codigoAnterior' : codigo,
        'tipo' : ano   
    };
    if(codigo.length == 0){
        alertify.log('Debe ingresar código.');
        return;
    }

    $.ajax({
        type : 'POST',
        url : '../scripts/verCodAnterior.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error){                
               alertify.error(data.mensaje);              
            }
            else
            {
               $('#txtcodigobarras').val(data.codigoActivo);
               $('#txtdenominacion').val(data.denominacion);                              
            } 
        }
    });
}