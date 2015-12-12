
<?php 
	$con=@mysqli_connect("localhost","root","","lindley");

	session_start();
	$tipo = $_POST['tipo'];

	if($tipo==1){

		$SOLICITUD = $_POST['numSolicitud'];
		$INGRESO = $_POST['fechaIngreso'];
		$AREA = $_POST['areaID'];
		$TRABAJADOR = $_POST['trabajadorID'];
		$OBSERVACIONES = $_POST['observaciones'];		

		$sql2 = "INSERT into ControlEntregaEPP(numSolicitudEPP, areaID, trabajadorID, fechaIngreso, observaciones) values (".$SOLICITUD.",'".$AREA."','".$TRABAJADOR."','".$INGRESO."','".$OBSERVACIONES."')";
		@mysqli_query($con,$sql2);
		$_SESSION['numSolicitudEPP'] = $SOLICITUD;

	} 
	if($tipo==2){
			$EQUIPO = $_POST['equipoProteccionID'];
			$ENTREGA = $_POST['fechaEntrega'];
			$MOTIVO = $_POST['motivo'];
			$SOLICITUD = $_SESSION['numSolicitudEPP'];

			$sql2 = "INSERT into ControlEntregaEPPDetalle(numSolicitudEPP, equipoProteccionID, motivo, fechaEntrega, estado) values ('".$SOLICITUD."','".$EQUIPO."','".$MOTIVO."','".$ENTREGA."', 1)";
			@mysqli_query($con,$sql2);

			$resultado = @mysqli_query($con,"SELECT CD.detalleID, E.descripcion, CD.fechaEntrega, CD.motivo FROM ControlEntregaEPPDetalle CD INNER JOIN equipoProteccion E ON CD.equipoProteccionID = E.equipoProteccionID WHERE numSolicitudEPP = ".$SOLICITUD." ");


			while($mostrar = @mysqli_fetch_array($resultado)){
			echo '<tr>';				
				echo '<td class="text-center">'.$mostrar['descripcion'].'</td>';
				echo '<td class="text-center">'.$mostrar['fechaEntrega'].'</td>';
				echo '<td class="text-center">'.$mostrar['motivo'].'</td>';
				
				echo '<td class="center">
						<input type="button" class="btn btn-xs btn-danger col-md-offset-5" name="name" onclick="eliminar('.$mostrar['detalleID'].')" value="ELIMINAR"/>
					 </td>';
			}
			echo '</tr>';

		}
	
		if($tipo==3){
			$SOLI = $_POST['solicitud'];
			$SOLICITUD = $_SESSION['numSolicitudEPP'];

			
			$sql2 = "DELETE FROM ControlEntregaEPPDetalle WHERE detalleID = '".$SOLI."' AND numSolicitudEPP = ".$SOLICITUD."";
			@mysqli_query($con,$sql2);

			$resultado = @mysqli_query($con,"SELECT CD.detalleID, E.descripcion, CD.fechaEntrega, CD.motivo FROM ControlEntregaEPPDetalle CD INNER JOIN equipoProteccion E ON CD.equipoProteccionID = E.equipoProteccionID WHERE numSolicitudEPP = ".$SOLICITUD." ");


			while($mostrar = @mysqli_fetch_array($resultado)){
			echo '<tr>';				
				echo '<td class="text-center">'.$mostrar['descripcion'].'</td>';
				echo '<td class="text-center">'.$mostrar['fechaEntrega'].'</td>';
				echo '<td class="text-center">'.$mostrar['motivo'].'</td>';
				
				echo '<td class="center">
						<input type="button" class="btn btn-xs btn-danger col-md-offset-5" name="name" onclick="eliminar('.$mostrar['detalleID'].')" value="ELIMINAR"/>
					 </td>';
			}
			echo '</tr>';

		}
		


	
	
?>
