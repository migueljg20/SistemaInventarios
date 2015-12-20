<?php 

	$con=mysqli_connect('localhost','root','','redempresarial');
	$res=mysqli_query($con,"select fecha,local,ubicacion,usuario,cargo,dependencia,ambiente,area,inventariador1,inventariador2 from invAlmacenCabecera where idInv = '".$_POST['codigoInventario']."'");
 
  
    if(mysqli_num_rows($res)>0)
	{
		while($cabecera=mysqli_fetch_row($res))
    	{
			$fecha = $cabecera[0];
			$local = $cabecera[1];
			$ubicacion = $cabecera[2];
			$usuario = $cabecera[3];
			$cargo = $cabecera[4];
			$dependencia = $cabecera[5];
			$ambiente = $cabecera[6];
			$area = $cabecera[7];
			$inventariador1 = $cabecera[8];
			$inventariador2 = $cabecera[9];
		}
	   $datos['fecha'] = $fecha;
	   $datos['local'] = $local;
	   $datos['ubicacion']= $ubicacion;
	   $datos['usuario']= $usuario;
	   $datos['cargo'] = $cargo;
	   $datos['dependencia'] = $dependencia;
	   $datos['ambiente']= $ambiente;
	   $datos['area']= $area;
	   $datos['inventariador1']= $inventariador1;
	   $datos['inventariador2']= $inventariador2;
	   $datos['error'] = false;
	}
	else
	{		
		$datos['mensaje'] = "El número de inventario está disponible.";	
		$datos['error'] = true;
	}
	
   
  	echo json_encode($datos);
?>


	
	
	
	