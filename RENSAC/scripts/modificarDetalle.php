<?php 
	$con=mysqli_connect('localhost','root','','redempresarial');
	$sql = "UPDATE invAlmacenDetalle SET codigoAntiguo='".$_POST['codigoAntiguo']."',codigoInventario='".$_POST['codigoInventario']."',codigoBarras='".$_POST['codigoBarras']."',denominacion='".$_POST['denominacion']."',marca='".$_POST['marca']."', modelo='".$_POST['modelo']."',serie='".$_POST['serie']."',color='".$_POST['color']."',largo='".$_POST['largo']."',ancho='".$_POST['ancho']."',alto='".$_POST['alto']."',estado='".$_POST['estado']."',etiquetado='".$_POST['etiquetado']."',situacion='".$_POST['situacion']."',observacion='".$_POST['observacion']."' WHERE codigoInventario='".$_POST['id']."'";
	
	mysqli_query($con,$sql);
			$data['mensaje'] = "Modificado correctamente";
			$data['error'] = false;
		
		
		
	echo json_encode($data);
?>