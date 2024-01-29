<?php

include_once '../Modelo/Producto.php';
include_once '../Modelo/ProveedorDB.php';

// Verificar si el proveedor ha iniciado sesión
session_start();
if (!isset($_SESSION['cod_prov'])) {
    // Redirige a la página de inicio de sesión si no hay sesión activa
    header("Location: ../Ruta/Para/Inicio/Sesion.php");
    exit();
}

// Obtiene el proveedor por su código de la sesión
$cod_prov = $_SESSION['cod_prov'];
$proveedor = ProveedorDB::getProveedor($cod_prov);

if (!$proveedor) {
    echo "Proveedor no encontrado.";
    exit();
}

// Crear un objeto Producto sin datos específicos
$producto = new Producto("", "", 0.0, 0, $proveedor);
?>
