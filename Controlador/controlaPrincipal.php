<?php
if (isset($_POST['submit'])) {
    $buttonClicked = $_POST['submit'];
    
    if ($buttonClicked == 'Gestionar Productos') {
        header("Location: ../Vista/formMostrarProductos.php");
        exit();
    } elseif ($buttonClicked == 'Gestionar Proveedores') {
        header("Location: ../Vista/formGestionProveedores.php");
        exit();
    }
}
?>
