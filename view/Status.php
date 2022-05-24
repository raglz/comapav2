<?php
//Activamos el almacenamiento en el buffer
include "../config/dbcon.php";
$where = "";
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'template/header.php';

if ($_SESSION['status']==1)
{




?>
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
                        <h1 class="m-0 text-dark">Status De Estaciones</h1>
                        </div>
                        
                        <div class="card-body">
                            <table class="table mitabla table-striped table-bordered table-responsive dt dt-responsive" style="width: 100%;">
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
                                    <td></td>
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
    </div>
    <!-- Fin Main content -->
</div>
      
<!--Fin-Contenido-->
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
