<?php 

	$con=mysqli_connect('localhost','root','','redempresarial');
	$res=mysqli_query($con,"select fecha,hora,dependencia,unidadOrganica,ubicacion,usuario,inventariador from invTercerosCabecera where idInv = '".$_POST['codigoInventario']."'");
 
  
    if(mysqli_num_rows($res)>0)
	{
		while($cabecera=mysqli_fetch_row($res))
    	{
			$fecha = $cabecera[0];
			$hora = $cabecera[1];
			$dependencia = $cabecera[2];
			$unidadOrganica = $cabecera[3];
			$ubicacion = $cabecera[4];
			$usuario = $cabecera[5];			
			$inventariador = $cabecera[6];			
		}
	   $datos['fecha'] = $fecha;
	   $datos['hora'] = $hora;
	   $datos['dependencia']= $dependencia;
	   $datos['unidadOrganica']= $unidadOrganica;
	   $datos['ubicacion'] = $ubicacion;
	   $datos['usuario'] = $usuario;	   
	   $datos['inventariador']= $inventariador;	  
	   $datos['error'] = false;
	}
	else
	{		
		$datos['mensaje'] = "El número de inventario está disponible.";	
		$datos['error'] = true;
	}
	
   
  	echo json_encode($datos);
?>

