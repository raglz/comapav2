<?php
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
    if ($_SESSION['ayuda']==1)
    {
        ?>
        <br><br>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ayuda</h3>
                                </div>
                                <div class="card-body">
                                    <h2>Bienvenido al sistema de ayuda</h2>
                                    <p>
                                        En esta sección podrá encontrar las diferentes ayudas que se encuentran disponibles en el sistema.
                                    </p>
                                    <!--Menu de ayuda-->
                                    <h2>Seleccione El menu donde ocupe ayuda</h2>
                                    <hr>
                                    <button type="button" onclick="location='AyudaStatus.php'" class="btn btn-lg" style="background-color:#F5B041; color: #FFFFFF;">Status</button>
                                    <button type="button" onclick="location='AyudaReportes.php'" class="btn btn-lg" style="background-color:#F4D03F; color: #FFFFFF;">Reportes</button>
                                    <button type="button" onclick="location='AyudaBitacora.php'" class="btn btn-lg" style="background-color:#58D68D; color: #FFFFFF;">Bitacora</button>
                                    <button type="button" onclick="location='AyudaOperacion.php'" class="btn btn-lg" style="background-color:#52BE80; color: #FFFFFF;">Operacion</button>
                                    <button type="button" onclick="location='AyudaMantenimiento.php'" class="btn btn-lg" style="background-color:#45B39D; color: #FFFFFF;">Mantenimiento</button>
                                    <button type="button" onclick="location='AyudaConagua.php'" class="btn btn-lg" style="background-color:#48C9B0; color: #FFFFFF;">Conagua</button>
                                    <button type="button" onclick="location='AyudaKilowhats.php'" class="btn btn-lg" style="background-color:#5DADE2; color: #FFFFFF;">Kilowhats</button>
                                    <button type="button" onclick="location='AyudaCosto.php'" class="btn btn-lg" style="background-color:#5499C7; color: #FFFFFF;">Costo</button>
                                    <button type="button" onclick="location='AyudaFactorPotencia.php'" class="btn btn-lg" style="background-color:#EC7063; color: #FFFFFF;">Factor de Potecnia</button>
                                    <button type="button" onclick="location='AyudaCostoSinIva.php'" class="btn btn-lg" style="background-color:#CD6155; color: #FFFFFF;">Costo Sin Iva</button>
                                    <button type="button" onclick="location='AyudaUsuario.php'" class="btn btn-lg" style="background-color:#A93226; color: #FFFFFF;">Usuarios</button>
                                    <hr>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
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

    <script type="text/javascript" src="scripts/usuario.js"></script>

    <?php
}
ob_end_flush();
?>