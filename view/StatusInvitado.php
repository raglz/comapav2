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
    if ($_SESSION['statusinvitado']==1)
    {
        ?>
        <br>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            
                            <!-- /.card -->
<br>
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="title">Status De Estaciones</h2>
                                </div>
                                <!-- /.card-header -->
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
                            </tr>
                            </thead>
                            <tbody>
                                
                            <?php
                            $sql = "SELECT * FROM status $where";
                            $query = mysqli_query($con, $sql);
                            $resultado = $con->query($sql);
                            while ($row = mysqli_fetch_array($query)) {

                               
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
}
ob_end_flush();
?>

