
<?php
	$tipo = -1;
	$descripcion ='';
	$prefijo ='';

	if(isset($_POST['tipo'])){
		$tipo =$_POST['tipo'];
	}

	session_start();
	$con=@mysqli_connect("localhost","root","","lindley");

	// registro de Area
	if($tipo==1){
		$AREA = $_POST['area']; 
  		$estado = 'Activo';
		$sql = "select * from Area";
		$res = @mysqli_query($con, $sql);

		$sql1 = "INSERT into Area(area, estado) values ('".$AREA."', '".$estado."')";
		$res = mysqli_query($con,$sql1) or die(mysqli_error($res));
		if($res>0){
			echo 1;
		}
		else{
			echo 0;
		}
	}
	// registro de Trabajo Requerido
	else
		if($tipo==2){
			$AREA = $_POST['areaID'];
			$DESCRIPCION = $_POST['descripcion'];  
			$FECHALIMITE = $_POST['fechaLimite'];
			$ESTADO = $_POST['estado'];
			$FECHAINGRESO = DATE("Y-m-d");
			$eliminado = 0;
			$consulta = "SELECT case when MAX(trabajoRequeridoID) is null then 1 else MAX(trabajoRequeridoID) +1 end as maximo from TrabajoRequerido WHERE areaID = ".$AREA."";
		  	$respuesta=@mysqli_query($con,$consulta);

		  	while($row=@mysqli_fetch_array($respuesta)) {
				$IDREQUERIDO = $row[0];
			}

		  	$sql1 = "insert into TrabajoRequerido(areaID, trabajoRequeridoID, descripcion, estado, fechaIngresado, fechaLimite, eliminado) values ('".$AREA."', '".$IDREQUERIDO."', '".$DESCRIPCION."', '".$ESTADO."', '".$FECHAINGRESO."', '".$FECHALIMITE."','".$eliminado."')";
			$res = mysqli_query($con,$sql1) or die(mysqli_error($res));
			if($res>0){
				echo 1;
			}
			else{
				echo 0;
			}
	}
	// registro de Empresas Contratista
	else
		if($tipo==3){
			$RUC = $_POST['ruc'];
			$RAZON = $_POST['razonSocial'];
			$DIRECCION = $_POST['direccion'];
			$TELEFONO = $_POST['telefono'];
			$EMAIL = $_POST['email'];
			$REFERENCIAS = $_POST['referencias'];
			$estado = 'Activo';

			$sql = "select * from EmpresaContratista where ruc = ".$RUC."";
			$res = @mysqli_query($con, $sql);
			if(@mysqli_num_rows($res)>0){
			    echo '<p class="alert alert-danger">Error el ruc ingresado ya fue registrado!</p>';
			} else	{
				$sql1 = "insert into EmpresaContratista(ruc, razonSocial, direccion, telefono, email, referencias, estado) values ('".$RUC."', '".$RAZON."', '".$DIRECCION."','".$TELEFONO."','".$EMAIL."','".$REFERENCIAS."','".$estado."')";
				$res = mysqli_query($con,$sql1) or die(mysqli_error($res));
				if($res>0){
					echo 1;
				}
				else{
					echo 0;
				}
			}
	}
	// registro de Trabajador Empresa Contratista
	else
		if($tipo==4){
			$EMPRESA = $_POST['empresa'];
			$DNI = $_POST['dni'];
			$NOMBRES = $_POST['nombres'];
			$APELLIDOS = $_POST['apellidos'];
			$DIRECCION = $_POST['direccion'];
			$TELEFONO = $_POST['telefono'];
			$TIPOTRABAJADOR = $_POST['tipoTrabajador'];
			$estado = 'Activo';

			$res=@mysqli_query($con,"INSERT INTO TrabajadorContratista (empresaContratistaRUC, trabajadorContratistaDNI, contratistaNombres, contratistaApellidos, contratistaDireccion, telefono, tipoTrabajador, estado) 
				VALUES(".$EMPRESA.",'".$DNI."','".$NOMBRES."','".$APELLIDOS."','".$DIRECCION."','".$TELEFONO."','".$TIPOTRABAJADOR."','".$estado."')");

			$Resultado= @mysql_query($res);
				if(@mysql_affected_rows()==0){
					echo'<p class="alert alert-danger">No se registro el Trabajador Contratista correctamente.</p>';
					}else
					{
						echo'<p class="alert alert-success">Se registro la Trabajador Contratista correctamente....</p>';
					}			
	}
	// registro de Equipo de Protección
	else
		if($tipo==5){
  			$DESCRIPCION = $_POST['descripcion'];
  			$STOCK = $_POST['stock'];
  			$MARCA = $_POST['marca'];
			$MODELO = $_POST['modelo'];
			$COLOR = $_POST['color'];
  			$estado = 'Activo';
			$sql1 = "INSERT into EquipoProteccion(descripcion, stock, marca, modelo, color, estado) values ('".$DESCRIPCION."', ".$STOCK.", '".$MARCA."', '".$MODELO."', '".$COLOR."', '".$estado."')";
			@mysqli_query($con,$sql1);			
			echo'<p class="alert alert-success">Se ha registrado correctamente el equipo de protección!</p>';
	}

	// registro de Trabajador Lindley
	else
		if($tipo==6){			
			$DNI = $_POST['dni'];
			$NOMBRES = $_POST['nombres'];
			$APELLIDOS = $_POST['apellidos'];
			$DIRECCION = $_POST['direccion'];
			$TELEFONO = $_POST['telefono'];			
			$estado = 'Activo';

			$res=@mysqli_query($con,"INSERT INTO Trabajador (dni, nombres, apellidos, direccion, telefono, estado) 
				VALUES('".$DNI."','".$NOMBRES."','".$APELLIDOS."','".$DIRECCION."','".$TELEFONO."','".$estado."')");

			$Resultado= @mysql_query($res);
				if(@mysql_affected_rows()==0){
					echo'<p class="alert alert-danger">No se registro el Trabajador Contratista correctamente.</p>';
				}
				else
				{
					echo'<p class="alert alert-success">Se registro la Trabajador Contratista correctamente....</p>';
				}			
		}	

	else

	//Mostrar trabajos requeridos
	if($tipo==7){
		$res = mysqli_query($con,"select areaID,trabajoRequeridoID,descripcion,estado,fechaIngresado,fechaLimite from trabajoRequerido where eliminado=0");
		while($row = mysqli_fetch_row($res)){
			echo "<tr>					
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[5]."</td>
				</tr>";
		}
	}
	//Modificar trabajos requeridos
	if($tipo==8){
		$areaID = $_POST['areaID'];
		$cod = $_POST['codigo'];
		$desc = $_POST['descripcion'];
		$estado = $_POST['estado'];
		$fechaL	=$_POST['fechaLimite'];
		$res=mysqli_query($con,"update trabajoRequerido set descripcion='".$desc."',estado='".$estado."',fechaLimite='".$fechaL."' 
							where areaID='".$areaID."' and trabajoRequeridoID='".$cod."'")or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}
	//Eliminar un trabajo requerido
	if($tipo==9){
		$areaID = $_POST['areaID'];
		$cod = $_POST['codigo'];
		$res=mysqli_query($con,"update trabajoRequerido set eliminado='"."1"."'
							where areaID='".$areaID."' and trabajoRequeridoID='".$cod."'")or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

	//Mostrar empresas...
	if($tipo==10){
		$res = mysqli_query($con,"select ruc, razonSocial, direccion, telefono, email, referencias from empresaContratista where estado = 'Activo'");
		while($row = mysqli_fetch_row($res)){
			echo "<tr>					
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
				</tr>";
		}
	}
	//Modificar empresa
	if($tipo==11){
		$RUC = $_POST['ruc'];
		$razonSocial = $_POST['razonSocial'];
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
		$referencias = $_POST['referencias'];
		$estado = "Activo";
		$res=mysqli_query($con,"update empresaContratista set razonSocial='".$razonSocial."',direccion='".$direccion."',telefono='".$telefono."',email='".$email."' ,referencias='".$referencias."' 
						where ruc='".$RUC."'")or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}
	//Eliminar una empresa contratista
	if($tipo==12){
		$RUC = $_POST['RUC'];
		$res=mysqli_query($con,"update empresaContratista set estado='"."Inactivo"."'
							where RUC='".$RUC."'")or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}
	//Verificar empresa
	if($tipo == 13){
		$RUC = $_POST['RUC'];
		$res = mysqli_query($con,"select * from empresaContratista where RUC='".$RUC."'");
		if (mysqli_num_rows($res)>0){
			echo 0; //Ya existe
		}
		else{
			echo 1; //No existe la empresaa
		}
	}


	//Mostrar EPP...
	if($tipo==14){
		$res = mysqli_query($con,"select equipoProteccionID, descripcion, stock, marca, modelo, color from equipoproteccion where estado = '1'");
		while($row = mysqli_fetch_row($res)){
			echo "<tr>					
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>					
				</tr>";
		}
	}

	//Modificar EPP
	if($tipo==15){
		$codigoEPP = $_POST['codigoEquipo'];
		$equipo = $_POST['descripcion'];
		$stock = $_POST['stock'];	
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];
		$color = $_POST['color'];	
		$estado = "1";

		$res=mysqli_query($con,"update equipoproteccion set descripcion='".$equipo."',stock=".$stock.", marca='".$marca."', modelo='".$modelo."', color='".$color."' where equipoProteccionID=".$codigoEPP)or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

	//Eliminar EPP
	if($tipo==16){
		$codigoEPP = $_POST['codigoEPP'];
		$res=mysqli_query($con,"update equipoproteccion set estado=0
							where equipoProteccionID=".$codigoEPP)or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

		//Mostrar Trabajadores Contratistas...
	if($tipo==17){
		$sql = "select tc.empresaContratistaRUC, ec.razonSocial, tc.trabajadorContratistaDNI, tc.contratistaNombres, tc.contratistaApellidos, tc.contratistaDireccion, tc.telefono, tc.tipoTrabajador
					from trabajadorcontratista tc
						inner join empresacontratista ec on ec.ruc = tc.empresacontratistaRUC
					where tc.estado = 'Activo'";
		$res = mysqli_query($con,$sql);
		while($row = mysqli_fetch_row($res)){			
			echo "<tr>	
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".$row[6]."</td>
					<td>".$row[7]."</td>
				</tr>";
		}
	}

	//Modificar Trabajadores Contratistas...
	if($tipo==18){
		$EMPRESA = $_POST['empresa'];
		$DNI = $_POST['dni'];
		$NOMBRES = $_POST['nombres'];
		$APELLIDOS = $_POST['apellidos'];
		$DIRECCION = $_POST['direccion'];
		$TELEFONO = $_POST['telefono'];
		$TIPOTRABAJADOR = $_POST['tipoTrabajador'];
		$estado = 'Activo';

		$sql = "update trabajadorcontratista set empresaContratistaRUC='".$EMPRESA."',
										contratistaNombres='".$NOMBRES."',contratistaApellidos='".$APELLIDOS."',contratistaDireccion='".$DIRECCION."'
										,telefono='".$TELEFONO."',tipoTrabajador='".$TIPOTRABAJADOR."',estado='Activo'
								where trabajadorContratistaDNI='".$DNI."'";
		$res=mysqli_query($con,$sql)or  die (mysql_error($con));		
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

	//Eliminar Trabajador Contratista
	if($tipo==19){
		$dni = $_POST['dni'];
		$res=mysqli_query($con,"update trabajadorcontratista set estado='Inactivo'
							where trabajadorContratistaDNI=".$dni)or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

	//Mostrar trabajadores de Lindley
	if($tipo==20)
	{
		$sql = "select codigoTrabajador, dni, nombres, apellidos, direccion, telefono
					from trabajador where estado = 'Activo'";
		$res = mysqli_query($con,$sql);
		while($row = mysqli_fetch_row($res)){			
			echo "<tr>	
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>					
					<td>".$row[5]."</td>					
				</tr>";
		}
	}

	//Modificar trabajadores de Lindley
	if($tipo==21)
	{				
		$DNI = $_POST['dni'];
		$NOMBRES = $_POST['nombres'];
		$APELLIDOS = $_POST['apellidos'];
		$DIRECCION = $_POST['direccion'];
		$TELEFONO = $_POST['telefono'];
		$estado = 'Activo';

		$sql = "update trabajador set nombres='".$NOMBRES."',apellidos='".$APELLIDOS."',direccion='".$DIRECCION."'
										,telefono='".$TELEFONO."', estado='Activo'
								where dni='".$DNI."'";								
		$res=mysqli_query($con,$sql)or  die (mysql_error($con));		
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

	//Eliminar trabajadores de Lindley
		if($tipo==22){
		$dni = $_POST['dni'];
		$res=mysqli_query($con,"update trabajador set estado='Inactivo'
							where dni=".$dni)or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

	//Selecccionar todas las áreas
	if($tipo==23){
		$res = mysqli_query($con,"select areaID,area from area where estado = 'Activo'");
		while($row = mysqli_fetch_row($res)){
			echo "<tr>					
					<td>".$row[0]."</td>
					<td>".$row[1]."</td>
				</tr>";
		}
	}
	//Modificar el área
	if($tipo==24){
		$areaID = $_POST['areaID'];
		$area = $_POST['area'];
		$sql = "update area set area='".$area."' where areaID='".$areaID."'";								
		$res=mysqli_query($con,$sql)or  die (mysql_error($con));		
		if($res == false){
			echo 0;
		}
		else echo 1;
	}
	//Eliminar una empresa contratista
	if($tipo==25){
		$areaID = $_POST['areaID'];
		$res=mysqli_query($con,"update area set estado='"."Inactivo"."'
							where areaID='".$areaID."'")or  die (mysql_error($con));
		if($res == false){
			echo 0;
		}
		else echo 1;
	}

?>