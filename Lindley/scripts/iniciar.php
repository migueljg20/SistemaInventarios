<?php
    $con=@mysql_connect('localhost','root','');
    @mysql_select_db("lindley");

    $res=@mysql_query("SELECT * from usuario where usuario= '".$_POST['txtusuario']."' and clave='".$_POST['txtclave']."'");
    if (@mysql_num_rows($res)>0)
    {
            session_start();
            $_row=@mysql_fetch_row($res);
                   
            $_SESSION['nombres']=$_row[2];
            $_SESSION['apellidos']=$_row[3];
            $_SESSION['usuario']=$_row[1];
            header("location:../sites/principal.php");

    } else {
        echo "<script>alert('El usuario o password es incorrecto intente nuevamente.'); 
        window.location='../index.php';</script>";
    }

    
?>
