<?php
include_once 'Producto.php';
include_once 'Proveedor.php';
include_once 'ProveedorDB.php';

class ProductoDB {

    // Método para agregar un producto a la base de datos
    public static function add(Producto $producto, Producto $proveedor): bool {
        $result = false;

        // Establece la conexión con la base de datos
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "INSERT INTO producto (codproducto,descripcion,precio,stock, cod_prov) VALUES (:codproducto,:descripcion,:precio,:stock, :cod_prov)";
        $sentencia = $conexion->prepare($sql);

        // Asigna los valores de los parámetros
        $sentencia->bindValue(":codproducto", $producto->getCod_producto());
        $sentencia->bindValue(":descripcion", $producto->getDescripcion());
        $sentencia->bindValue(":precio", $producto->getPrecio());
        $sentencia->bindValue(":stock", $producto->getStock());
        $sentencia->bindValue(":cod_prov", $proveedor->getCod_prov());

        // Ejecuta la consulta y actualiza el resultado
        $result = $sentencia->execute();

        return $result;
    }

    // Método para actualizar la información de un producto en la base de datos
    public static function update(Producto $producto): bool {
        $result = false;

        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "UPDATE producto SET descripcion = :descripcion, precio = :precio, stock = :stock WHERE codproducto = :codproducto";
        $sentencia = $conexion->prepare($sql);

        // Asigna los valores de los parámetros
        $sentencia->bindValue(":codproducto", $producto->getCod_producto());
        $sentencia->bindValue(":descripcion", $producto->getDescripcion());
        $sentencia->bindValue(":precio", $producto->getPrecio());
        $sentencia->bindValue(":stock", $producto->getStock());

        // Ejecuta la consulta y actualiza el resultado
        $result = $sentencia->execute();

        return $result;
    }

    // Método para eliminar un producto de la base de datos
    public static function delete($codproducto): bool {
        $result = false;

        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "DELETE FROM producto WHERE codproducto = :codproducto";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":codproducto", $codproducto);

        // Ejecuta la consulta y actualiza el resultado
        $result = $sentencia->execute();

        return $result;
    }

    // Método para obtener un producto por su código
    public static function get($codproducto): Producto {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM producto WHERE codproducto = :codproducto";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":codproducto", $codproducto);
        $sentencia->execute();

        // Obtiene el resultado de la consulta
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);

        // Crea un objeto Producto con la información obtenida
        $producto = new Producto();
        $producto->setCod_producto($result['codproducto']);
        $producto->setDescripcion($result['descripcion']);
        $producto->setPrecio($result['precio']);
        $producto->setStock($result['stock']);

        return $producto;
    }

    // Método para obtener productos con stock por debajo de un límite
    public static function getBajoStock($stockLimite) {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM producto WHERE stock < :stockLimite";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(['stockLimite' => $stockLimite]);

        // Obtiene los productos con bajo stock
        $productosBajoStock = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $productosBajoStock;
    }

    // Método para obtener un producto por su descripción y proveedor
    public static function getByDescripcion($descripcion, $proveedor) {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM producto WHERE descripcion = :descripcion AND cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);

        // Asigna el valor del parámetro
        $sentencia->bindValue(":descripcion", $descripcion);

        // Ejecuta la consulta
        $sentencia->execute();

        // Obtiene el resultado de la consulta
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

        // Crea un objeto Producto con la información obtenida
        $producto = new Producto();
        $producto->setDescripcion($resultado['descripcion']);
        $producto->setPrecio($resultado['precio']);
        $producto->setStock($resultado['stock']);
        $producto->setCod_producto($resultado['cod_prov']);

        return $producto;
    }

    // Método para cerrar la sesión y dirigir a la página de inicio
    public static function closeSession() {
        header("Location: ../index.php");
        exit();
    }

    // Método para obtener todos los productos de un proveedor
    public static function getAll(Proveedor $proveedor): array {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM producto WHERE cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":cod_prov", $proveedor->getCodProveedor()); 

        // Ejecuta la consulta
        $sentencia->execute();

        // Inicializa un array para almacenar los productos
        $productos = [];

        // Recorre los resultados y crea objetos Producto
        while ($resultado = $sentencia->fetch(PDO::FETCH_ASSOC)) {
            $producto = new Producto();
            $producto->setCod_producto($resultado['codproducto']);
            $producto->setDescripcion($resultado['descripcion']);
            $producto->setPrecio($resultado['precio']);
            $producto->setStock($resultado['stock']);

            // Agrega el producto al array
            $productos[] = $producto;
        }

        return $productos;
    }
}
?>
