<?php 

	$con=mysqli_connect('localhost','root','','redempresarial');

	$i = $_POST['tipo'];
	switch ($i) {
    case 8:
        $res=mysqli_query($con,"select * from basedatos2008 where codigoInventario = '".$_POST['codigoAnterior']."'");
        break;
    case 9:
        $res=mysqli_query($con,"select * from basedatos2009 where codigoInventario = '".$_POST['codigoAnterior']."'");
        break;
    case 10:
        $res=mysqli_query($con,"select * from basedatos2010 where codigoInventario = '".$_POST['codigoAnterior']."'");
        break;
    case 11:
        $res=mysqli_query($con,"select * from basedatos2011 where codigoInventario = '".$_POST['codigoAnterior']."'");
        break;
    case 12:
        $res=mysqli_query($con,"select * from basedatos2012 where codigoInventario = '".$_POST['codigoAnterior']."'");
        break;
    case 13:
        $res=mysqli_query($con,"select * from basedatos2013 where codigoInventario = '".$_POST['codigoAnterior']."'");
        break;
	}

	
	if(mysqli_num_rows($res)>0)
	{
		while($bien=mysqli_fetch_row($res))
  		{
		   	$codigoActivo = $bien[0];
		   	$codigoInventario = $bien[1];
		   	$denominacion = $bien[2];
		   		
		}
		$datos['codigoActivo'] = $codigoActivo;
   		$datos['codigoInventario'] = $codigoInventario;
   		$datos['denominacion']= utf8_encode($denominacion);   		
	}
	else
	{		
		$datos['mensaje'] = "No existe este bien en la base de datos!";	
		$datos['error'] = true;
	}
	
   
  	echo json_encode($datos);
?>
