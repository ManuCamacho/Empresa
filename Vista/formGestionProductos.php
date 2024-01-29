<?php
include_once '../Controlador/controlaProducto.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores - Perfil del Proveedor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Gestión de Productos</h1>

    <form action="" method="post">
        <label for="cod_prov">Código de Proveedor:</label>
        <input type="cod_prov" name="cod_prov" value="<?php echo $proveedor->getCod_prov(); ?>" readonly>

        <label for="cod_producto">Código de Producto:</label>
        <input type="text" id="cod_producto" name="cod_producto" value="<?php echo $producto->getCod_producto(); ?>" required>

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $producto->getDescripcion(); ?>" required>

        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" value="<?php echo $producto->getPrecio(); ?>" required>

        <label for="stock">Stock:</label>
        <input type="text" id="stock" name="stock" value="<?php echo $producto->getStock(); ?>" required>

        <input type="submit" name="create" value="Crear Producto">
    </form>

    <?php
    // Procesar el formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Obtiene los valores del formulario
            $cod_producto = $_POST['cod_producto'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $cod_prov = $_POST['cod_prov']; 
    
            // Crea un nuevo objeto Producto con los datos del formulario y el cod_prov
            $nuevo_producto = new Producto($cod_producto, $descripcion, $precio, $stock, $proveedor);
    
            // Intenta agregar el producto a la base de datos
            $result = ProductoDB::add($nuevo_producto, $proveedor);
    
            if ($result) {
                echo "Producto creado correctamente";
            } else {
                echo "Error al crear el producto";
                print_r($sentencia->errorInfo()); 
            }
        } catch (Exception $e) {
            echo "Excepción: " . $e->getMessage();
        }
    }
    ?>
</body>
</html>
