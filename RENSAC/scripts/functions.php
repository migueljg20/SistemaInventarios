<?php 


$conexion = null;

function abrirConexion()
{
	global $conexion;
	// Conexión con el servidor de base de datos MySQL
	$conexion = mysqli_connect('localhost', 'root', '', 'redempresarial');
	mysqli_set_charset($conexion, 'utf8');
}


function getUsuarios()
{
	abrirConexion();	
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT DISTINCT(empleado) FROM basedatos ORDER BY empleado ASC");
	while ($row = $resultSet->fetch_array()) {
	  $results_array[] = $row;
	}
	return $results_array;
}

function getInventariadores()
{
	abrirConexion();	
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT dni, nombre FROM inventariadores");
	while ($row = $resultSet->fetch_array()) {
	  $results_array[] = $row;
	}
	return $results_array;	
}

function getListaInventarios()
{
	abrirConexion();	
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT IC.idInv, IC.fecha, IC.local, IC.ubicacion, IC.usuario, I1.nombre, I2.nombre FROM invAlmacenCabecera IC JOIN inventariadores I1 on IC.inventariador1 = I1.dni JOIN inventariadores I2 ON IC.inventariador2 = I2.dni");
	while ($row = $resultSet->fetch_array()) {
	  $results_array[] = $row;
	}
	return $results_array;
}

function getListaDetalles($id){
	abrirConexion();	
	global $conexion;
	$sql = "SELECT * FROM invAlmacenDetalle WHERE idInv = '".$id."'";	
	$resultSet = mysqli_query($conexion, $sql);
	while ($row = $resultSet->fetch_array()) {
	  $results_array[] = $row;
	}
	return $results_array;
}

function getCabecera($id){
	abrirConexion();	
	global $conexion;
	$sql = "SELECT IC.idInv, IC.fecha, IC.local, IC.ubicacion, IC.usuario, IC.dependencia, IC.ambiente, IC.area, I1.nombre, I2.nombre FROM invAlmacenCabecera IC JOIN inventariadores I1 on IC.inventariador1 = I1.dni JOIN inventariadores I2 ON IC.inventariador2 = I2.dni WHERE IC.idInv = '".$id."'";	
	$resultSet = mysqli_query($conexion, $sql);
	while ($row = $resultSet->fetch_array()) {
	  $results_array[] = $row;
	}
	return $results_array;
}

function getTodoInv(){
	abrirConexion();	
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT idInv FROM invAlmacenCabecera");
	while ($row = $resultSet->fetch_array()) {
	  $results_array[] = $row;
	}
	return $results_array;
}

function verCantidadDigitados(){
        abrirConexion();	
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT count(*) FROM invAlmacenDetalle");
	while ($row = $resultSet->fetch_array()) {
	  $results_array[] = $row;
	}
	return $results_array;

}

?>