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
    if ($_SESSION['kwsadmin']==1)
    {
        ?>
         <br>
<div class="content-wrapper">
    <br>
    <br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                <br>
                    <div class="card">
            
                    <div class="card-header">
                        <br>
                        <h3 class="card-title">KILOWATTS CFE COMAPA REYNOSA</h3>
                        <div class="card-input-group d-flex justify-content-end align-items-baseline">
                            <input type="submit" value="Agregar" class="btn btn-success" onclick="location='agregar_kwsadmin.php'">
                        </div>
                        </div>

        
                <div class="card-body">
                                 
                                 <div class="row">
                                 <div class="col-md-12"><!-- /.card-header -->
                                 
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
     <th>Actualizar</th>
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
         
         <td> <button type="button" class="btn btn-info fas fa-edit editbtn" data-toggle="modal" data-target="#modalactualizar"></button>
 
 
 
 
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
    include "ModalActualizarKwsAdmin.php";
    require 'template/footer.php';
    ?>

    <script type="text/javascript" src="scripts/mitabla.js"></script>
    <script type="text/javascript" src="scripts/ActualizarKws.js"></script>
    .
    <?php
}
ob_end_flush();
?>










