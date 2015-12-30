<?php 

	$con=mysqli_connect('localhost','root','','redempresarial');
	$res=mysqli_query($con,"select codigoInterno,denominacion,marca,modelo,serie,estado from basedatos where codigoActivo = '".$_POST['codigoBarras']."'");
	if(mysqli_num_rows($res)>0)
	{
		while($bien=mysqli_fetch_row($res))
  		{
		   	$codigoInterno = $bien[0];
		   	$denominacion = $bien[1];
		   	$marca = $bien[2];
		   	$modelo = $bien[3];
			$serie = $bien[4];
			$estado = $bien[5];		
		}
		$datos['codigoInterno'] = $codigoInterno;
   		$datos['denominacion'] = utf8_encode($denominacion);
   		$datos['marca']= $marca;
   		$datos['modelo'] = $modelo;
   		$datos['serie'] = $serie;   	
  		$datos['estado']= $estado;		
  		$datos['error'] = false;
	}
	else
	{		
		$datos['mensaje'] = "No existe este bien en la base de datos!";	
		$datos['error'] = true;
	}
	
   
  	echo json_encode($datos);
?>


	
	
	
	