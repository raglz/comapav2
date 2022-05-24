<?php
//importamos la conexion
include "../config/dbcon.php";

$where="";

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
    if ($_SESSION['reportes']==1)
    {
        ?>
        <br>
<div class="content-wrapper">
    <br>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                    <div class="card">
            
            <div class="card-header">
                
                        <h1 class="m-0 text-dark">Reportes</h1>
                            <th><a href="registrar_reportes.php" class="btn btn-success align-items-end justify-content-end">Agregar</a></th>
                        </div>

                <div class="d-flex justify-content-end align-items-center"">
                
                </div>
        
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                        <table  class="table mitabla table-bordered dt-responsive" width="100%">
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Ubicacion</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM reporte $where";
                            $query = mysqli_query($con, $sql);
                            $resultado = $con->query($sql);
                            //cambiar formato de fecha
                            while ($row = $resultado->fetch_assoc()) {
                                $fecha = $row['Fecha'];
                                $fecha = str_replace("-", "/", $fecha);
                                $nuevafecha = date('d-m-Y', strtotime($fecha));
                                $nuevafecha = str_replace("-", "/", $nuevafecha);

                                //pruba
                            }
                            while ($row = mysqli_fetch_array($query)) {

                                ?>

                                <tr>
                                    <td><?php echo $row[0] ?></td>
                                    <td><?php echo $row[1] ?></td>
                                    <td><?php echo $row[2] ?></td>
                                    <td><?php echo $row[3] ?></td>
                                    <td><?php echo $row[4] ?></td>
                                    <td> <button type="button" class="btn btn-info editbtn" data-toggle="modal" data-target="#modalactualizar"><i class="fa-regular fa-pen-to-square"></i></button></td>     
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        </div>
        </div>


    </div><!-- /.content-wrapper -->
    <?php
        include "modalreportes.php";
        include "ModalActualizarReporte.php";
    }
    else
    {
        require 'noacceso.php';
    }
        
    require 'template/footer.php';
    ?>

    <script type="text/javascript" src="scripts/mitabla.js"></script>
    <script type="text/javascript" src="scripts/ActualizarReportes.js"></script>
    <script type="text/javascript" src="scripts/EliminarReporte.js"></script>

    <?php
}
ob_end_flush();
?>




























