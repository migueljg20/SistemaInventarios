<?php 
	$con=mysqli_connect('localhost','root','','redempresarial');	
	$res1 = mysqli_query($con, "SELECT * FROM invTercerosDetalle WHERE codigoInventario='".$_POST['codigoInventario']."'");
	
	if(mysqli_num_rows($res1)>0)
	{
		$data['mensaje'] = "Ya existe este código de inventario!";		
		$data['error'] = true;		
	}
	else
	{
		mysqli_query($con,"insert into invTercerosDetalle(idInv,codigoInventario,denominacion,marca,modelo,serie,color,largo,ancho,alto,estado,propietario,observacion) values('".$_POST['idInventario']."','".$_POST['codigoInventario']."','".$_POST['denominacion']."','".$_POST['marca']."','".$_POST['modelo']."','".$_POST['serie']."','".$_POST['color']."','".$_POST['largo']."','".$_POST['ancho']."','".$_POST['alto']."', '".$_POST['estado']."', '".$_POST['propietario']."', '".$_POST['observacion']."')");
		$data['mensaje'] = "Agregado correctamente";
		$data['error'] = false;
	}		
		
	echo json_encode($data);
?>