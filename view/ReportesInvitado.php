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
    if ($_SESSION['reportesinvitado']==1)
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
                        </div>
        
        <div class="card-body">
            <div class="row">
                                        <table id="tabla example1" data-sort="table" class=" table mitabla table-bordered dt-responsive ">
                                            <thead>
                                            <tr>
                                                <td>#</td>
                                                <th>ID</th>
                                                <th>Fecha</th>
                                                <th>Ubicacion</th>
                                                <th>Descripcion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT * FROM reporte $where";
                                            $query = mysqli_query($con, $sql);
                                            $resultado = $con->query($sql);
                                            while ($row = mysqli_fetch_array($query)) {

                                                ?>

                                                <tr>
                                                    <td><?php echo $row[0] ?></td>
                                                    <td><?php echo $row[1] ?></td>
                                                    <td><?php echo $row[2] ?></td>
                                                    <td><?php echo $row[3] ?></td>
                                                    <td><?php echo $row[4] ?></td>
                                                </tr>
                                                <?php

                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        </div>
        </div>
        </div>


    </div><!-- /.content-wrapper -->
        <?php
    }
    else
    {
        require 'noacceso.php';
    }
    require 'template/footer.php';
    ?>

    <script type="text/javascript" src="scripts/mitabla.js"></script>

    <?php
}
ob_end_flush();
?>






