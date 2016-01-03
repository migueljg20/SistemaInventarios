$(document).on('ready', funcPrincipal);

var $formEditar;

function funcPrincipal() {
    $('#formDetalle').on('submit', agregarFila);
    $('#formCabecera').on('submit', agregarCabecera);
    $('#btnVerCodBarras').on('click', verCodBarras);
    $('#verNumeroInventario').on('click', verInventario);
    $('#btnVerCodInventario2015').on('click', verInventario2015);
    $('#btnVerificarCodBarras').on('click', verificarCodBarras);
    $('#btnVerAnterior').on('click', verificarCodAnterior);
    $(document).on('click', '[data-editar]', mostrarModal);
    $formEditar = $('#formEditar');
    $('#btnCancelar').on('click', cerrarModal);
    $formEditar.on('submit', guardarCambios);
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
                    $('tbody').append('<tr><td data-i></td><td data-c1>'+cod1+'</td><td data-c2>'+cod2+'</td><td data-c3>'+codbar+'</td><td data-d>'+deno+'</td><td data-ma>'+marc+'</td><td data-mo>'+model+'</td><td data-se>'+serie+'</td><td data-co>'+color+'</td><td data-la>'+largo+'</td><td data-an>'+ancho+'</td><td data-al>'+alto+'</td><td data-es>'+estado+'</td><td data-et>'+etiquetado+'</td><td data-op>'+operativo+'</td><td data-ob>'+obser+'</td><td><button class="btn btn-default glyphicon glyphicon-pencil" data-editar="'+cod2+'"></button></td></tr>');
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
                    $('tbody').append('<tr><td data-i></td><td data-c1>'+data.cia[i]+'</td><td data-c2>'+data.ci[i]+'</td><td data-c3>'+data.codbar[i]+'</td><td data-d>'+data.deno[i]+'</td><td data-ma>'+data.marc[i]+'</td><td data-mo>'+data.model[i]+'</td><td data-se>'+data.serie[i]+'</td><td data-co>'+data.color[i]+'</td><td data-la>'+data.largo[i]+'</td><td data-an>'+data.ancho[i]+'</td><td data-al>'+data.alto[i]+'</td><td data-es>'+data.estado[i]+'</td><td data-et>'+data.etiquetado[i]+'</td><td data-op>'+data.operativo[i]+'</td><td data-ob>'+data.observacion[i]+'</td><td><button class="btn btn-default glyphicon glyphicon-pencil" data-editar="'+data.ci[i]+'"></button></td></tr>');
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

var $filaEditar;

function mostrarModal() {
    // Cargar los datos al modal
    $filaEditar = $(this).parents('tr');
    var id = $(this).data('editar');
    

    var cod1 = $filaEditar.find('[data-c1]').text();
    var cod2 = $filaEditar.find('[data-c2]').text();
    var codbar = $filaEditar.find('[data-c3]').text();
    var deno = $filaEditar.find('[data-d]').text();
    var marc = $filaEditar.find('[data-ma]').text();
    var model = $filaEditar.find('[data-mo]').text();
    var serie = $filaEditar.find('[data-se]').text();
    var color = $filaEditar.find('[data-co]').text();
    var largo = $filaEditar.find('[data-la]').text();
    var ancho = $filaEditar.find('[data-an]').text();
    var alto = $filaEditar.find('[data-al]').text();
    var estado = $filaEditar.find('[data-es]').text();
    var etiquetado = $filaEditar.find('[data-et]').text();
    var operativo = $filaEditar.find('[data-op]').text();
    var observacion = $filaEditar.find('[data-ob]').text();
    

    $formEditar.find('[name="id"]').val(id);
    $formEditar.find('[name="codigoInventario"]').val(cod1);
    $formEditar.find('[name="codigoInventario2015"]').val(cod2);
    $formEditar.find('[name="codigobarras"]').val(codbar);
    $formEditar.find('[name="denominacion"]').val(deno);
    $formEditar.find('[name="marca"]').val(marc);
    $formEditar.find('[name="modelo"]').val(model);
    $formEditar.find('[name="serie"]').val(serie);
    $formEditar.find('[name="color"]').val(color);
    $formEditar.find('[name="largo"]').val(largo);
    $formEditar.find('[name="ancho"]').val(ancho);
    $formEditar.find('[name="alto"]').val(alto);
    $formEditar.find("input[name=estadoConservacionM][value='"+estado+"']").prop("checked",true);
    if(etiquetado=='SI'){
        $formEditar.find('[name="etiquetado"]').prop("checked", true);
    }else{
        $formEditar.find('[name="etiquetado"]').prop("checked", false);
    }
    if(operativo=='O'){
        $formEditar.find('[name="operativo"]').prop("checked", true);
    }else{
        $formEditar.find('[name="operativo"]').prop("checked", false);
    }  
    $formEditar.find('[name="observacion"]').val(observacion);

       // Mostrar el modal
    $('#modalEditar').modal('show');
}

function cerrarModal(){
    $formEditar.find('[name="id"]').val('');
    $formEditar.find('[name="codigoInventario"]').val('');
    $formEditar.find('[name="codigoInventario2015"]').val('');
    $formEditar.find('[name="codigobarras"]').val('');
    $formEditar.find('[name="denominacion"]').val('');
    $formEditar.find('[name="marca"]').val('');
    $formEditar.find('[name="modelo"]').val('');
    $formEditar.find('[name="serie"]').val('');
    $formEditar.find('[name="color"]').val('');
    $formEditar.find('[name="largo"]').val('');
    $formEditar.find('[name="ancho"]').val('');
    $formEditar.find('[name="alto"]').val('');
       
    
    $formEditar.find('[name="observacion"]').val('');

    $('#modalEditar').modal('hide');
}

function guardarCambios(){
    event.preventDefault();

    var cod1 = $('#txtcodigoInventarioM').val();
    var cod2 = $('#txtcodigoInventario2015M').val();
    var codbar = $('#txtcodigobarrasM').val();
    var deno = $('#txtdenominacionM').val();
    var color = $('#txtcolorM').val();
    var marc = $('#txtmarcaM').val();
    var model = $('#txtmodeloM').val();
    var serie = $('#txtserieM').val();
    var largo = $('#txtlargoM').val();
    var ancho = $('#txtanchoM').val();
    var alto = $('#txtaltoM').val();
    var estado = $('input:radio[name=estadoConservacionM]:checked').val();
    var etiquetado;
    var obser = $('#txtobservacionM').val();
    if($("#chkEtiquetadoM").is(':checked')) {
        etiquetado = 'SI';
    } else {
        etiquetado = 'NO';
    }
    var operativo;
    if($("#chkOperativoM").is(':checked')) {
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
    var id = $('#idEdit').val();



    var datosEnviados = 
    {
       'id' : id,
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
        url : '../scripts/modificarDetalle.php',
        data : datosEnviados,
        dataType : 'json',
        encode : true,
        success: function(data){
            if (data.error) {
                alertify.error(data.mensaje);
            }else{                
                alertify.success(data.mensaje);
                    // falta limpiar
                cerrarModal();
            }             
        } 
    });   
}