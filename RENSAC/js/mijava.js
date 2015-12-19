/*				----------------SOLO VALIDACIONES---------------				*/

function validarCorreo(email){
	var correo = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !correo.test(email) ){
        return false;
    }
    else{
    	return true;
    }
}

function validarSoloNumero(numeroVerificar){
	var numero = /^([0-9)])+$/;
    if ( !numero.test(numeroVerificar) ){
        return false;
    }
    else{
    	return true;
    }
}

function numbersonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode            
                if (unicode < 48 || unicode > 57) //if not a number
                { return false } //disable key press                
        }

function textonly(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode
            if (unicode != 241 && unicode != 209 && unicode != 225 && unicode != 233 && unicode != 237 && unicode != 243 && unicode != 250 && unicode != 193 && unicode != 201 && unicode != 205 && unicode != 211 && unicode != 218) {
                if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
                { return false } //disable key press                
            }
        }

function telefonovalidation(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode            
            if (unicode != 45 && unicode != 32) {
                if (unicode < 48 || unicode > 57) //if not a number
                { return false } //disable key press                
        	}
        }