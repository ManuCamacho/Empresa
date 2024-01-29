<?php
include_once '../Modelo/ProductoDB.php';

try {
    // Inicia la sesión
    session_start();

    // Verifica si el usuario ha iniciado sesión y obtiene su cod_prov 
    if (isset($_SESSION['cod_prov'])) {
        $cod_prov = $_SESSION['cod_prov'];

        // Obtiene la lista de productos del proveedor
        $productos = ProductoDB::getAll(new Proveedor($cod_prov, "", "", "", ""));
    } else {
        header("Location: ../Vista/formInicioSesion.php");
        exit();
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

?>
