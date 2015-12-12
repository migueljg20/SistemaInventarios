
<?php 
	$con=@mysqli_connect("localhost","root","","lindley");

	session_start();
	$tipo = $_POST['tipo'];

	if($tipo==1){

		$PLAN = $_POST['plan'];
		$INICIO = $_POST['fechaInicio'];
		$FINAL = $_POST['fechaFin'];
		$AREA = $_POST['area'];
		$ESPECIFICA = $_POST['areaEsp'];
		$TRABAJADOR = $_POST['trabajador'];
		$EMPRESA = $_POST['empresa'];
		$CONTRATISTA = $_POST['contratista'];
		$HORARIO = $_POST['horario'];

		$sql2 = "INSERT into PLANTRABAJO(planTrabajoID, areaID, areaESp, trabajadorID, empresaContratistaRUC, trabajadorContratistaDNI, fechaInicio, fechaFin, horario, estado) values (".$PLAN.",'".$AREA."','".$ESPECIFICA."',".$TRABAJADOR.",'".$EMPRESA."','".$CONTRATISTA."','".$INICIO."','".$FINAL."','".$HORARIO."',1)";
		@mysqli_query($con,$sql2);
		$_SESSION['planTrabajoID'] = $PLAN;

	} 
	if($tipo==2){
			$REQUERIDO = $_POST['requerido'];
			$PLAN = $_SESSION['planTrabajoID'];

			$sql2 = "INSERT into plantrabajodetalle(planTrabajoID, trabajoRequeridoID) values (".$PLAN.",'".$REQUERIDO."')";
			@mysqli_query($con,$sql2);

			$resultado = @mysqli_query($con,"SELECT PD.detalleID, TR.descripcion FROM plantrabajodetalle PD INNER JOIN trabajoRequerido TR ON TR.trabajoRequeridoID = PD.trabajoRequeridoID WHERE planTrabajoID = ".$PLAN." ");


			while($mostrar = @mysqli_fetch_array($resultado)){
			echo '<tr>';				
				echo '<td class="text-center">'.$mostrar['descripcion'].'</td>';
				
				echo '<td class="center">
						<input type="button" class="btn btn-xs btn-danger col-md-offset-5" name="name" onclick="eliminar('.$mostrar['detalleID'].')" value="ELIMINAR"/>
					 </td>';
			}
			echo '</tr>';

		}
	
		if($tipo==3){
			$DETALLE = $_POST['detalle'];
			$PLAN = $_SESSION['planTrabajoID'];

			
			$sql2 = "DELETE FROM plantrabajodetalle WHERE detalleID = '".$DETALLE."' AND planTrabajoID = ".$PLAN."";
			@mysqli_query($con,$sql2);

			$resultado = @mysqli_query($con,"SELECT PD.detalleID, TR.descripcion FROM plantrabajodetalle PD INNER JOIN trabajoRequerido TR ON TR.trabajoRequeridoID = PD.trabajoRequeridoID WHERE planTrabajoID = ".$PLAN." ");


			while($mostrar = @mysqli_fetch_array($resultado)){
			echo '<tr>';				
				echo '<td class="text-center">'.$mostrar['descripcion'].'</td>';
				echo '<td class="center">
						<input type="button" class="btn btn-xs btn-danger col-md-offset-5" name="name" onclick="eliminar('.$mostrar['detalleID'].')" value="ELIMINAR"/>
					 </td>';
			}
			echo '</tr>';

		}

		if($tipo==4){
			$PROFORMA = $_SESSION['NRO_PROFORMA'];
			$sql2 = "SELECT count(*) FROM detalle_proforma WHERE NRO_PROFORMA = ".$PROFORMA."";
			$sql= @mysqli_query($con,$sql2);

	        while($row=@mysqli_fetch_array($sql)) {
	            $VALOR = $row[0];
	        }
	        
	        if ($VALOR == 0) {
	        	echo "<script> 
			        alert('Debe ingresar recursos a la proforma!');
			        </script>";
			    while($mostrar = @mysqli_fetch_array($resultado)){
				echo '<tr>';				
					echo '<td>'.$mostrar['DESCRIPCION'].'</td>';
					echo '<td class="text-center">'.$mostrar['CANTIDAD'].'</td>';
					echo '<td class="text-center">'.$mostrar['UNIDAD'].'</td>';
					echo '<td class="text-center">'.$mostrar['PRECIO_UNITARIO'].'</td>';
					echo '<td class="text-center">S/. '.$mostrar['SUBTOTAL'].'</td>';
					echo '<td class="center">
							<input type="button" class="btn btn-xs btn-danger col-md-offset-3" name="name" onclick="eliminar('.$mostrar['ID_DETALLE'].')" value="ELIMINAR"/>
						 </td>';
				}
				echo '</tr>';
	         } else {
	         	$GUIA = $_SESSION['NRO_GUIA'];
	         	$sql = "SELECT sum( SUBTOTAL ) FROM DETALLE_PROFORMA WHERE NRO_PROFORMA = '".$PROFORMA."'";
				$sql= @mysqli_query($con,$sql);

		        while($row=@mysqli_fetch_array($sql)) {
		            $TOTAL = $row[0];
		        }

				$sql2 = "UPDATE PROFORMAs SET TOTAL = ".$TOTAL." WHERE NRO_PROFORMA='".$PROFORMA."'";
				$sql= @mysqli_query($con,$sql2);
	         	echo "<script> 
			        alert('Se registro correctamente el pedido!!');
			        window.location='../sites/proforma-compra.php'</script>";
	         }
		}


		if($tipo==5){
			$PROFORMA = $_POST['proforma'];
			
			$sql1 = "DELETE FROM detalle_proforma WHERE NRO_PROFORMA = ".$PROFORMA."";
			$sql= @mysqli_query($con,$sql1);

			$sql2 = "DELETE FROM proformas WHERE NRO_PROFORMA = ".$PROFORMA."";
			$rpta= @mysqli_query($con,$sql2);

			echo "<script> 
			        alert('Proforma eliminada satisfactoriamente.');
			        window.location='../sites/proforma-compra.php'</script>";	
		}

	
?>
