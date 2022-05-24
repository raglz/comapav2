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
if ($_SESSION['kwsinvitado']==1)
{
?>
<br>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <br>
                        <div class="card">

                            <div class="card-header">
                                <h1 class="card-title ">KiloWhats</h1>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                    <table class="table mitabla table-striped table-bordered table-responsive DT dt-responsive" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>AÑO</th>
                                            <th>ID</th>
                                            <th>Denominación</th>
                                            <th>CFE Servicio</th>
                                            <th>Tarifa</th>
                                            <th>Medidor</th>
                                            <th>Voltaje</th>
                                            <th>ENE</th>
                                            <th>FEB</th>
                                            <th>MAR</th>
                                            <th>ABR</th>
                                            <th>MAY</th>
                                            <th>JUN</th>
                                            <th>JUL</th>
                                            <th>AGO</th>
                                            <th>SEP</th>
                                            <th>OCT</th>
                                            <th>NOV</th>
                                            <th>DIC</th>
                                            <th>SUMA</th>
                                            <th>MIN</th>
                                            <th>MAX</th>
                                            <th>Promedio Operación</th>
                                         
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php



                                        $sql = "SELECT * From kws_cfe";
                                        $query = mysqli_query($con, $sql);

                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['Año'] ?></td>
                                            <td><?php echo $row['ID'] ?></td>
                                            <td><?php echo $row['Denominación'] ?></td>
                                            <td><?php echo $row['Cfe_servicio'] ?></td>
                                            <td><?php echo $row['Tarifa'] ?></td>
                                            <td><?php echo $row['Medidor'] ?></td>
                                            <td><?php echo $row['Voltaje'] ?></td>
                                            <td><?php echo number_format($row['Enero'], 2); ?></td>
                                            <td><?php echo number_format($row['Febrero'], 2);  ?></td>
                                            <td><?php echo number_format($row['Marzo'], 2);  ?></td>
                                            <td><?php echo number_format($row['Abril'], 2);  ?></td>
                                            <td><?php echo number_format($row['Mayo'], 2);  ?></td>
                                            <td><?php echo number_format($row['Junio'], 2);  ?></td>
                                            <td><?php echo number_format($row['Julio'], 2); ?></td>
                                            <td><?php echo number_format($row['Agosto'], 2); ?></td>
                                            <td><?php echo number_format($row['Septiembre'], 2);  ?></td>
                                            <td><?php echo number_format($row['Octubre'], 2); ?></td>
                                            <td><?php echo number_format($row['Noviembre'], 2); ?></td>
                                            <td><?php echo number_format($row['Diciembre'], 2); ?></td>
                                            <td id="Suma">
                                                <?php
                                                $suma = 0;
                                                $suma = $suma + $row['Enero']+$row['Febrero']+$row['Marzo']+$row['Abril']+$row['Mayo']+$row['Junio']+$row['Julio']+$row['Agosto']+$row['Septiembre']+$row['Octubre']+$row['Noviembre']+$row['Diciembre'];
                                                echo  number_format($suma, 2);


                                                ?>


                                            </td>
                                            <td id="Minimo"><?php
                                                $min = 0;
                                                $min = min($row['Enero'], $row['Febrero'], $row['Marzo'], $row['Abril'], $row['Mayo'], $row['Junio'], $row['Julio'], $row['Agosto'], $row['Septiembre'], $row['Octubre'], $row['Noviembre'], $row['Diciembre']);
                                                echo number_format($min, 2);
                                                ?></td>
                                            <td id="Maximo"><?php
                                                $max = 0;
                                                $max = max($row['Enero'], $row['Febrero'], $row['Marzo'], $row['Abril'], $row['Mayo'], $row['Junio'], $row['Julio'], $row['Agosto'], $row['Septiembre'], $row['Octubre'], $row['Noviembre'], $row['Diciembre']);
                                                echo number_format($max, 2);
                                                ?></td>
                                            <td id="Promedio"><?php
                                                $promedio = 0;
                                                $promedio = $suma / 12;
                                                echo number_format($promedio, 2);;

                                                ?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
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

    <?php
}
ob_end_flush();
?>