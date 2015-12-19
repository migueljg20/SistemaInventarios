<?php 
	$con=mysqli_connect('localhost','root','','redempresarial');
	$res = mysqli_query($con, "SELECT * FROM invAlmacenDetalle WHERE codigoBarras='".$_POST['codigoBarras']."'");
	if(mysqli_num_rows($res)>0)
	{
		$data['mensaje'] = "Ya está inventariado este bien!";	
		$data['error'] = true;
	}
	else
	{
		mysqli_query($con,"insert into invAlmacenDetalle(idInv,codigoAntiguo,codigoInventario,codigoBarras,denominacion,marca,modelo,serie,color,largo,ancho,alto,estado,etiquetado,situacion) values('".$_POST['idInventario']."','".$_POST['codigoAntiguo']."','".$_POST['codigoInventario']."','".$_POST['codigoBarras']."','".$_POST['denominacion']."','".$_POST['marca']."','".$_POST['modelo']."','".$_POST['serie']."','".$_POST['color']."',".$_POST['largo'].",".$_POST['ancho'].",".$_POST['alto'].", '".$_POST['estado']."', '".$_POST['etiquetado']."', '".$_POST['situacion']."')");
		$data['mensaje'] = "Agregado correctamente";
		$data['error'] = false;
	}	
	echo json_encode($data);
?>