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
	return $resultSet->fetch_all();
}

function getInventariadores()
{
	abrirConexion();	
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT dni, nombre FROM inventariadores");
	return $resultSet->fetch_all();
}


?>