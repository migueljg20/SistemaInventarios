<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <title>Empresas Contratistas</title>

    <link rel="stylesheet" href="bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/theme.css">
  </head>

  <body role="document" style="background:#7A7A7A;">
    <div class="container">
        <p><br/></p><br>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                            <div class="page-header">
                            <h3>Iniciar Sesión</h3>
                        </div>
                        <form  method="post" action="scripts/iniciar.php" role="form">
                            <div class="form-group">
                                    <label for="exampleInputEmail1">Usuario</label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" class="form-control"  name="txtusuario" id="txtusuario" placeholder="Ingrese Usuario" required>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-star"></span></span>
                                    <input type="password" class="form-control"  name="txtclave" id="txtusuario" placeholder="Ingrese Contraseña" required>
                                </div>
                            </div>
                            <hr/>
                            <button type="submit" class="btn btn-primary col-sm-offset-4"><span class="glyphicon glyphicon-lock"></span> Iniciar Sesión</button><br><br>
                            <p><br/></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
