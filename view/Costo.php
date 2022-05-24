<?php
include "../config/dbcon.php";
$where = "";
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
    header("Location: login.html");
}
else
{
require 'template/header.php';
if ($_SESSION['costo']==1)
{
    ?>
<head>
<link href="css/consultarapida.css" rel="stylesheet" type="text/css" media="screen" />
</head> 
    <br>
    <!--Contenido-->
    <div class="content-wrapper">
        <br>
    
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
    
                            <div class="card-header">
                            <h1 class="m-0 text-dark">COMAPA Reynosa</h1>
                            </div>

                            <div align="center">
                                <input class="flexsearch--input" type="text" style="width : 400px" name="termino" id="termino" placeholder="Buscar..." aria-label="Search">
                            </div>

                            <section class="content-area">
                            <div class="table-area" id="tabla_resultados">
                            </div>
                        </section>
              
            <!-- /.card-body -->
          

 
 </div>
 </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Main content -->
    </div>
    <?php
}
else
{
    require 'noacceso.php';
}
    require 'template/footer.php';
    ?>

    <script type="text/javascript" src="scripts/usuario.js"></script>
    <script src="js/buscador.js"></script>

    <?php
}
ob_end_flush();
?>