
<?php

	$con=@mysql_connect('localhost','root','');
    @mysql_select_db("lindley");



	$EMPRESA = $_GET['Empresa'];
	

	$res = @mysql_query("SELECT TC.trabajadorContratistaDNI, CONCAT(TC.contratistaNombres , ' ' , TC.contratistaApellidos) AS NOMBRES FROM trabajadorContratista TC
			INNER JOIN empresaContratista EC ON EC.ruc = TC.empresaContratistaRUC WHERE TC.empresaContratistaRUC = '".$EMPRESA."' order by 2 asc");
?>
	<div class="col-md-4">
		<label for="contratista">TRABAJADOR CONTRATISTA</label>
            <select class="form-control" id="contratista" name="contratista">
                <option value=''>Seleccionar trabajador</option>
<?php
	while($row = @mysql_fetch_row($res)){
?>

	<option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>

<?php
	}
?>
	</select>

<?php
 ?>
