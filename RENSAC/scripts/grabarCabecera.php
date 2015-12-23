<?php 
	$con=mysqli_connect('localhost','root','','redempresarial');
	$res = mysqli_query($con, "SELECT * FROM invAlmacenCabecera WHERE idInv='".$_POST['idInventario']."'");
	if(mysqli_num_rows($res)>0)
	{
		$data['mensaje'] = "Ya existe el número de inventario!";	
		$data['error'] = true;
	}
	else
	{
		mysqli_query($con,"insert into invAlmacenCabecera(idInv,fecha,local,ubicacion,usuario,cargo,dependencia,ambiente,area,inventariador1,inventariador2) values('".$_POST['idInventario']."','".$_POST['fecha']."','".$_POST['local']."','".htmlentities($_POST['ubicacion'])."','".$_POST['usuario']."','".$_POST['cargo']."','".$_POST['dependencia']."','".$_POST['ambiente']."','".htmlentities($_POST['area'])."','".$_POST['inventariador1']."','".$_POST['inventariador2']."')");
		$data['mensaje'] = "Agregado correctamente";
		$data['error'] = false;
	}	
	echo json_encode($data);
?>