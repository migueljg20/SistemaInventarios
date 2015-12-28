<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="principal.php">Principal</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventario General<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="registrarGeneral.php">Registrar Inventarios</a></li>
                        <li><a href="verificarGeneral.php">Verificar Inventarios</a></li>                        
                        <li><a href="sobrantesGeneral.php">Bienes Sobrantes</a></li>
                        <li><a href="faltantesGeneral.php">Bienes Faltantes</a></li>
                    </ul>
                </li>         
                
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventario Terceros<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="registrarTerceros.php">Registrar Inventarios</a></li>
                        <li><a href="verificarTerceros.php">Verificar Inventarios</a></li>               
                    </ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Inventario Vehículos<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="verificarVehiculos.php">Verificar Inventarios</a></li>                        
                        <li><a href="registrarVehiculos.php">Registrar Inventarios</a></li>
                    </ul>
                </li>
                


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                session_start();
                if (isset($_SESSION['usuario']))
                {
                    echo '<li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"> </span>'.'  '.$_SESSION['usuario'].'<span class="caret"></span></a>
                                      <ul class="dropdown-menu" role="menu">
                                              <li><a href="../scripts/logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion</a></li>
                                      </ul>
                                  </li>';
                }
                else
                    echo '<a href="../index.php">Iniciar</a>';
                ?>
            </ul>
        </div>
    </div>
</nav>