<?php
session_start();
include_once '../Modelo/ProveedorDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_prov = $_POST["cod_prov"];
    $pwd = $_POST["pwd"];

    $proveedorDB = ProveedorDB::InicioSesion($cod_prov, $pwd);
    if ($proveedorDB && password_verify($pwd, $proveedorDB['pwd'])) {
        

        // Guardar información en la sesión
        $_SESSION['cod_prov'] = $proveedorDB['cod_prov'];

        header("Location: ../Vista/formPrincipal.php");
        exit();
    } else {
        echo "Fallo al iniciar sesión";
    }
}
?>
