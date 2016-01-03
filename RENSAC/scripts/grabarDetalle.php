<?php 
	$con=mysqli_connect('localhost','root','','redempresarial');
	$res1 = mysqli_query($con, "SELECT * FROM invAlmacenDetalle WHERE codigoBarras='".$_POST['codigoBarras']."'");
	$res2 = mysqli_query($con, "SELECT * FROM invAlmacenDetalle WHERE codigoInventario='".$_POST['codigoInventario']."'");
	if(strlen($_POST['codigoBarras'])>0 and  mysqli_num_rows($res1)>0)
	{
		$data['mensaje'] = "Ya está inventariado este bien!";	
		$data['error'] = true;
	}
	else
	{
		if(mysqli_num_rows($res2)>0)
		{
			$data['mensaje'] = "Ya existe este código de inventario!";		
			$data['error'] = true;		
		}
		else
		{
			mysqli_query($con,"insert into invAlmacenDetalle(idInv,codigoAntiguo,codigoInventario,codigoBarras,denominacion,marca,modelo,serie,color,largo,ancho,alto,estado,etiquetado,situacion,observacion) values('".$_POST['idInventario']."','".$_POST['codigoAntiguo']."','".$_POST['codigoInventario']."','".$_POST['codigoBarras']."','".$_POST['denominacion']."','".$_POST['marca']."','".$_POST['modelo']."','".$_POST['serie']."','".$_POST['color']."','".$_POST['largo']."','".$_POST['ancho']."','".$_POST['alto']."', '".$_POST['estado']."', '".$_POST['etiquetado']."', '".$_POST['situacion']."', '".$_POST['observacion']."')");
			$data['mensaje'] = "Agregado correctamente";
			$data['error'] = false;
		}
		
	}	
	echo json_encode($data);
?>