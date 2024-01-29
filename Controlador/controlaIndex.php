<?php
if (isset($_POST['submit'])) {
    $buttonClicked = $_POST['submit'];
    
    if ($buttonClicked == 'Inicio Sesion') {
        header("Location: ../Vista/formInicioSesion.php");
        exit();
    } elseif ($buttonClicked == 'Registro') {
        header("Location: ../Vista/formRegistro.php");
        exit();
    }
}
?>
