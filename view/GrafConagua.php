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
if ($_SESSION['grafconagua']==1)
{
?>
<br>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container">
            <div class="content">
                <h2>grafconagua</h2>
            </div>
        </div>
    </div>
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