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
    if ($_SESSION['statusadmin']==1)
    {
        ?>
        <br>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <br>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            
                            <!-- /.card -->

                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-header">
                                   <h2>Status De Estaciones</h2>
                                </div>
                                <div class="card-body">
                                    <table class="table mitabla table-striped table-bordered table-responsive DT dt-responsive" style="width:100%">

                                        <thead>
                                        <tr>
                                <th>ID</th>
                                <th>Ubicacion</th>
                                <th>Red</th>
                                <th>C01</th>
                                <th>C02</th>
                                <th>C03</th>
                                <th>TE</th>
                                <th>P01</th>
                                <th>P02</th>
                                <th>Comentarios</th>
                                <th>Estado</th>
                                <th>Actualizar</th>
                            </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    $sql = "SELECT * FROM status $where";
                                    $query = mysqli_query($con, $sql);
                                    $resultado =$con -> query($sql);
                                    while ($row = mysqli_fetch_array($query))
                                    {
                                    ?>
                                    <tr>
                                    <td><?php echo $row[1] ?></td>
                                    <td><?php echo $row[2] ?></td>
                                   <div align="center">
                                    <td><?php
                                    if ($row[3] >= "SI"){
                                        echo "<span  style=\"color:green;\">✓</span>";}

                                      elseif ($row[3] >= "NO"){
                                        echo "<span style=\"color:red;\">X</span>";} ?></td></div>

                                    <td><?php
                                    if ($row[4] >= "SI"){
                                        echo "<span style=\"color:green;\">✓</span>";}

                                      elseif ($row[4] >= "NO"){
                                        echo "<span style=\"color:red;\">X</span>";} ?></td>

                                     <td><?php
                                    if ($row[5] >= "SI"){
                                        echo "<span style=\"color:green;\">✓</span>";}

                                      else if ($row[5] >= "NO"){
                                        echo "<span style=\"color:red;\">X</span>";} ?></td>

                                    <td><?php
                                    if ($row[6] >= "SI"){
                                        echo "<span style=\"color:green;\">✓</span>";}

                                      else if ($row[6] >= "NO"){
                                        echo "<span style=\"color:red;\">X</span>";} ?></td>

                                    <td><?php
                                    if ($row[7] >= "SI"){
                                        echo "<span style=\"color:green;\">✓</span>";}

                                      else if ($row[7] >= "NO"){
                                        echo "<span style=\"color:red;\">X</span>";} ?></td>

                                    <td><?php
                                    if ($row[8] >= "SI"){
                                        echo "<span style=\"color:green;\">✓</span>";}

                                      else if ($row[8] >= "NO"){
                                        echo "<span style=\"color:red;\">X</span>";} ?></td>

                                    <td><?php
                                    if ($row[9] >= "SI"){
                                        echo "<span style=\"color:green;\">✓</span>";}

                                      else if ($row[9] >= "NO"){
                                        echo "<span style=\"color:red;\">X</span>";} ?></td>
                                        

                                    <td><?php echo $row[10] ?></td>


                                    <td><?php
                                    if ($row[11] >= "HABILITADO"){
                                        echo "<span style=\"color:green;\">HABILITADO</span>";}

                                      elseif ($row[11] >= "DESHABILITADO"){
                                        echo "<span style=\"color:red;\">DESHABILITADO</span>";} ?></td>
                                    <td>
                                        <!-- btn editar -->
                                        <a href="statusadmin.php?id=<?php echo $row[0] ?>">
                                            <button type="button" class="btn btn-block btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <!-- btn eliminar -->
                                        <a href="statusadmin.php?id=<?php echo $row[0] ?>">
                                            <button type="button" id="#modal-eliminar" class="btn btn-block btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                    </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <?php

    }
    else
    {
        require 'noacceso.php';
    }
    require 'template/footer.php';
    ?>

    <script type="text/javascript" src="scripts/mitabla.js"></script>
    .
    <?php
    include_once "ModalActualizarStatusAdmin.php";
}
ob_end_flush();
?>
<!-- Modal Eliminar -->
<div class="modal fade" id="modal-eliminar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar Estacion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de eliminar la estacion?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="eliminar">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

