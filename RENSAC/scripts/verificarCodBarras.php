<?php 

	$con=mysqli_connect('localhost','root','','redempresarial');
	$res=mysqli_query($con,"select idInv from invAlmacenDetalle where codigoBarras = '".$_POST['codigoBarras']."'");
 
  
    if(mysqli_num_rows($res)>0)
	{
		$datos['mensaje'] = "El código de barras ya está registrado.";	
		$datos['error'] = true;
	}
	else
	{		
		$datos['mensaje'] = "El código de barras está disponible.";
		$datos['error'] = false;	
	}
	
   
  	echo json_encode($datos);
?>


	
	