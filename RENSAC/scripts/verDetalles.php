<?php 
	$cia = array();
	$ci = array();
	$codbar = array();
	$deno = array();
	$marc = array();
	$model = array();
	$serie = array();
	$color = array();
	$largo = array();
	$ancho = array();
	$alto = array();
	$estado = array();
	$etiquetado = array();
	$operativo = array();
	$observacion = array();
	$i = 0;

	$con=mysqli_connect('localhost','root','','redempresarial');
	$sql="select * from invAlmacenDetalle where idInv = '".$_POST['codigoInventario']."'";
	$res=mysqli_query($con,$sql);
 
  
    if(mysqli_num_rows($res)>0)
	{
		while($detalle=mysqli_fetch_row($res))
    	{
			$cia[$i] = $detalle[1];
			$ci[$i] = $detalle[2];
			$codbar[$i] = $detalle[3];
			$deno[$i] = $detalle[4];
			$marc[$i] = $detalle[5];
			$model[$i] = $detalle[6];
			$serie[$i] = $detalle[7];
			$color[$i] = $detalle[8];
			$largo[$i] = $detalle[9];
			$ancho[$i] = $detalle[10];
			$alto[$i] = $detalle[11];
			$estado[$i] = $detalle[12];
			$etiquetado[$i] = $detalle[13];
			$operativo[$i] = $detalle[14];
			$observacion[$i] = $detalle[15];
			$i++;
		}
	   $datos['cia'] = $cia;
	   $datos['ci'] = $ci;
	   $datos['codbar']= $codbar;
	   $datos['deno']= $deno;
	   $datos['marc'] = $marc;
	   $datos['model'] = $model;
	   $datos['serie']= $serie;
	   $datos['color']= $color;
	   $datos['largo']= $largo;
	   $datos['ancho']= $ancho;
	   $datos['alto']= $alto;
	   $datos['estado']= $estado;
	   $datos['etiquetado']= $etiquetado;
	   $datos['operativo']= $operativo;
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



	
	
	
	