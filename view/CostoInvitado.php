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
if ($_SESSION['costoinvitado']==1)
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
            <input class="flexsearch--input" type="text" id="buscar" style="width : 400px" onkeyup="buscar()"
              placeholder="Buscar...">
              
            <!-- /.card-body -->
          </div>
          <br><br>
                            
          <div class="row">
                            <div class="card-body form-group col-sm-12">
                            <h3><a href="statusinvitado.php" >Status De Estación</a></h3>
                            <table id="tabla" class="table mitabla " data-sort="table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="header" scope="col">ID</th>
                                        <th class="header" scope="col">Red</th>
                                        <th class="header" scope="col">C01</th>
                                        <th class="header" scope="col">C02</th>
                                        <th class="header" scope="col">C03</th>
                                        <th class="header" scope="col">TE</th>
                                        <th class="header" scope="col">P01</th>
                                        <th >P02</th>
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
                                   <td><?php echo $row['ID']; ?></td>
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
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body form-group col-sm-4">
                          <h3><a href="kwsinvitado.php" >Kilowatts CFE</a></h3>
                          <table id="tabla" class="table mitabla" style="width:100%"><thead>
                          <tr>
                              <th>ID</th>
                              <th>AÑO</th>
                              <th>Total Año</th>
                          </tr>
                          </thead>
                          <tbody>
                                                      <?php
                              $sql = "SELECT * From kws_cfe";
                            $query = mysqli_query($con, $sql);
                            
                            while ($row = mysqli_fetch_array($query)) {
                                ?>
                            
                                <tr>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['Año'] ?></td>
                              
                                    <td id="Suma">
                                        <?php
                                        $suma = 0;
                                        $suma = $suma + $row['Enero']+$row['Febrero']+$row['Marzo']+$row['Abril']+$row['Mayo']+$row['Junio']+$row['Julio']+$row['Agosto']+$row['Septiembre']+$row['Octubre']+$row['Noviembre']+$row['Diciembre'];
                                        echo  number_format($suma, 2);
                                        ?> </td>
                                </tr>
                                        <?php
                                    }
                                    ?>
                                     </tbody>
                                  </table>
                              </div>

                              <div class="">
                          <h3><a href="fpinvitado.php" >Factor de Potencia CFE</a></h3>
                          <table id="tabla" class="table responsive mitabla table-bordered" style="width:100%"><thead>
                          <tr>
                              <th>ID</th>
                              <th>AÑO</th>
                              <th>Total Año</th>
                          </tr>
                          </thead>
                          <tbody>
                                                      <?php
                              $sql = "SELECT * From fp_cfe";
                            $query = mysqli_query($con, $sql);
                            
                            while ($row = mysqli_fetch_array($query)) {
                                ?>
                            
                                <tr>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['Año'] ?></td>
                              
                                    <td id="Suma">
                                        <?php
                                        $suma = 0;
                                        $suma = $suma + $row['Enero']+$row['Febrero']+$row['Marzo']+$row['Abril']+$row['Mayo']+$row['Junio']+$row['Julio']+$row['Agosto']+$row['Septiembre']+$row['Octubre']+$row['Noviembre']+$row['Diciembre'];
                                        echo  number_format($suma, 2);
                                        ?> </td>
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

    <script type="text/javascript" src="scripts/mitabla.js"></script>
    <script src="js/buscador.js"></script>

    <?php
}
ob_end_flush();
?>