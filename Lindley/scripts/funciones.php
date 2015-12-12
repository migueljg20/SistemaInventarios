<?php
    session_start();
    function obtenerAreas(){
        global $conexion;
        // Conexión con el servidor de base de datos MySQL
        $conexion = mysqli_connect('localhost', 'root', '', 'lindley');
        mysqli_set_charset($conexion, 'utf8');             
        $resultSet = mysqli_query($conexion, "SELECT * FROM Area");
        return $resultSet->fetch_all(); 
    }

    class sistema{
    //funcion para mostrar las areas registradas
    function mostrarAreas(){
                            
        $con = new PDO('mysql:host=localhost;dbname=lindley', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT areaID, area FROM Area";
        $result = $con->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $campo):            
            echo 
            '<tr>                
                <td>'.$campo['areaID'].'</td>
                <td>'.$campo['area'].'</td>                                
                <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit"> </span></a>
                    <a href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>
                </td>
            </tr>';
        endforeach;
        echo '</tbody>';

    }

    

    //funcion para mostrar las empresas registradas
    function mostrarEmpresas(){
        $item = 0;
        $con = new PDO('mysql:host=localhost;dbname=lindley', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT ruc, razonSocial, direccion, telefono, email, referencias FROM EmpresaContratista where estado = 'Activo'";
        $result = $con->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $campo):
            $item = $item +1 ;
            echo '<tr>
                <td>'.$item.'</td>
                <td>'.$campo['ruc'].'</td>
                <td>'.$campo['razonSocial'].'</td>
                <td>'.$campo['direccion'].'</td>
                <td>'.$campo['telefono'].'</td>
                <td>'.$campo['email'].'</td>
                <td>'.$campo['referencias'].'</td>

                <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit"> </span></a>
                    <a href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>
                </td>
            </tr>';
            endforeach;
            echo '</tbody>';
        }

    //funcion para mostrar las trabajadores contratistas
    function mostrarContratistas(){
        $item = 0;
        $con = new PDO('mysql:host=localhost;dbname=lindley', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = " SELECT E.razonSocial, C.trabajadorContratistaDNI, concat_ws(' ',C.contratistaNombres,C.contratistaApellidos) as Nombres, C.contratistaDireccion, C.telefono, C.tipoTrabajador FROM TrabajadorContratista C INNER JOIN EmpresaContratista E on E.ruc = C.empresaContratistaRUC where C.estado = 'Activo'";
        $result = $con->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $campo):
            $item = $item +1 ;
            echo '<tr>
                <td>'.$item.'</td>
                <td>'.$campo['razonSocial'].'</td>
                <td>'.$campo['trabajadorContratistaDNI'].'</td>
                <td>'.$campo['Nombres'].'</td>
                <td>'.$campo['contratistaDireccion'].'</td>
                <td>'.$campo['telefono'].'</td>
                <td>'.$campo['tipoTrabajador'].'</td>

                <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit"> </span></a>
                    <a href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>
                </td>
            </tr>';
            endforeach;
            echo '</tbody>';
        }

        function mostrarTrabajosRequeridos(){
            $con = new PDO('mysql:host=localhost;dbname=lindley', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT A.areaID, TR.trabajoRequeridoID, TR.descripcion, TR.estado, TR.fechaLimite FROM TrabajoRequerido TR INNER JOIN Area A ON A.areaID = TR.areaID WHERE TR.eliminado = 0";
            $result = $con->query($query);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $campo):            
                echo 
                '<tr>     
                    <td>'.$campo['areaID'].'</td>
                    <td>'.$campo['trabajoRequeridoID'].'</td>           
                    <td>'.$campo['descripcion'].'</td>
                    <td>'.$campo['estado'].'</td>
                    <td>'.$campo['fechaLimite'].'</td>    
                </tr>';
            endforeach;
        }
    //funcion para mostrar equipos
    function mostrarEquipos(){             
        $con = new PDO('mysql:host=localhost;dbname=lindley', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT equipoProteccionID, descripcion, stock FROM EquipoProteccion";
        $result = $con->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $campo):            
            echo 
            '<tr>                
                <td>'.$campo['equipoProteccionID'].'</td>
                <td>'.$campo['descripcion'].'</td>
                <td>'.$campo['stock'].'</td>                
                <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit"> </span></a>
                    <a href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>
                </td>
            </tr>';
        endforeach;
        echo '</tbody>';
    }


    //funcion para mostrar los trabajadores de la empres lindley
    function mostrarTrabajadores(){
        $con = new PDO('mysql:host=localhost;dbname=lindley', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = " SELECT codigoTrabajador, dni, concat_ws(' ',nombres,apellidos) as Nombres, direccion, telefono FROM Trabajador where estado = 'Activo'";
        $result = $con->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $campo):
            echo '<tr>
                <td>'.$campo['codigoTrabajador'].'</td>
                <td>'.$campo['dni'].'</td>
                <td>'.$campo['Nombres'].'</td>
                <td>'.$campo['direccion'].'</td>
                <td>'.$campo['telefono'].'</td>

                <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit"> </span></a>
                    <a href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>
                </td>
            </tr>';
            endforeach;
            echo '</tbody>';
        }    
}
