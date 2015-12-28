<?php 	
	$ci = array();	
	$deno = array();
	$marc = array();
	$model = array();
	$serie = array();
	$color = array();
	$largo = array();
	$ancho = array();
	$alto = array();
	$estado = array();
	$propietario = array();
	$observacion = array();
	$i = 0;

	$con=mysqli_connect('localhost','root','','redempresarial');
	$res=mysqli_query($con,"select * from invTercerosDetalle where idInv = '".$_POST['codigoInventario']."'");
 
  
    if(mysqli_num_rows($res)>0)
	{
		while($detalle=mysqli_fetch_row($res))
    	{
			$ci[$i] = $detalle[1];			
			$deno[$i] = $detalle[2];
			$marc[$i] = $detalle[3];
			$model[$i] = $detalle[4];
			$serie[$i] = $detalle[5];
			$color[$i] = $detalle[6];
			$largo[$i] = $detalle[7];
			$ancho[$i] = $detalle[8];
			$alto[$i] = $detalle[9];
			$estado[$i] = $detalle[10];
			$propietario[$i] = $detalle[11];
			$observacion[$i] = $detalle[12];
			$i++;
		}	   
	   $datos['ci'] = $ci;	  
	   $datos['deno']= $deno;
	   $datos['marc'] = $marc;
	   $datos['model'] = $model;
	   $datos['serie']= $serie;
	   $datos['color']= $color;
	   $datos['largo']= $largo;
	   $datos['ancho']= $ancho;
	   $datos['alto']= $alto;
	   $datos['estado']= $estado;
	   $datos['propietario']= $propietario;
	   $datos['observacion']= $observacion;
	   $datos['error'] = false;

	   $datos['longitud'] = $i-1;
	}
	else
	{		
		$datos['mensaje'] = "El inventario no tiene detalles de bienes aún!";	
		$datos['error'] = true;
	}
	
   
  	echo json_encode($datos);
?>


	
	
	
	