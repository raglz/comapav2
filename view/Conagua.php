<?php
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
if ($_SESSION['conagua']==1)
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
                
                        <h1 class="m-0 text-dark">CONAGUA</h1>
                         <div class="d-flex justify-content-end align-items-center">
                             <input type="submit" value="Agregar" class="btn btn-success" data-toggle="modal" data-target="#modal-guardar">
                        </div>

               
                
                </div>
        
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                        <table  class="table mitabla table-bordered dt-responsive" width="100%">
                    <thead>
                    <tr>
                        <td>#</td>
                        <th>Fecha</th>
                        <th>Temp. Maxima</th>
                        <th>Temp. Minima</th>
                        <th>Temp. Ambiente</th>
                        <th>Agua Precipitación (M.M)</th>
                        <th>Actualizar</th>

                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $sql = "SELECT * From conagua $where";
                    $query = mysqli_query($con, $sql);
                    $resultado = $con->query($sql);
                    $resproductos = $con->query($sql);
                    //cambiar fecha a español


                    while ($row = mysqli_fetch_array($query)) {

                        ?>

                        <tr>

                            <td><?php echo $row[0] ?></td>
                            <td><?php echo $row[1] ?></td>
                            <td><?php echo $row[2] ?></td>
                            <td><?php echo $row[3] ?></td>
                            <td><?php echo $row[4] ?></td>
                            <td><?php echo $row[5] ?></td>
                            <td> <button type="button" class="btn btn-info editbtn" data-toggle="modal" data-target="#modalactualizar"><i class="fa-regular fa-pen-to-square"></i></button> </td>
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
    include "modalactualizarconagua.php";
    include "modalguardarconagua.php";
}
else
{
    require 'noacceso.php';
}
    require 'template/footer.php';
    ?>

    <script type="text/javascript" src="scripts/mitabla.js"></script>
    <script type="text/javascript" src="scripts/actualizarconagua.js"></script>

    <?php
}
ob_end_flush();
?>


