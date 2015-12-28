<?php 
	$con=mysqli_connect('localhost','root','','redempresarial');
	$res = mysqli_query($con, "SELECT * FROM invTercerosCabecera WHERE idInv='".$_POST['idInventario']."'");
	if(mysqli_num_rows($res)>0)
	{
		$data['mensaje'] = "Ya existe el número de inventario!";	
		$data['error'] = true;
	}
	else
	{
		mysqli_query($con,"insert into invTercerosCabecera(idInv,fecha,hora,dependencia,unidadOrganica,ubicacion,usuario,inventariador) values('".$_POST['idInventario']."','".$_POST['fecha']."','".$_POST['hora']."','".htmlentities($_POST['dependencia'])."','".htmlentities($_POST['unidadOrganica'])."','".htmlentities($_POST['ubicacion'])."','".$_POST['usuario']."','".$_POST['inventariador']."')");
		$data['mensaje'] = "Agregado correctamente";
		$data['error'] = false;
	}	
	echo json_encode($data);
?>