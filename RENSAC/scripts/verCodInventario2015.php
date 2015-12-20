<?php 

	$con=mysqli_connect('localhost','root','','redempresarial');
	$res=mysqli_query($con,"select idInv from invAlmacenDetalle where codigoInventario = '".$_POST['codigoInventario2015']."'");
 
  
    if(mysqli_num_rows($res)>0)
	{
		$datos['mensaje'] = "El código de inventario 2015 ya está registrado.";	
		$datos['error'] = true;
	}
	else
	{		
		$datos['mensaje'] = "El código de inventario 2015 está disponible.";
		$datos['error'] = false;	
	}
	
   
  	echo json_encode($datos);
?>


	
	
	
	