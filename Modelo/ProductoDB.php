<?php
include_once 'Producto.php';
include_once 'Proveedor.php';
include_once 'ProveedorDB.php';

class ProductoDB {

    // Método para agregar un producto a la base de datos
    public static function add(Producto $producto, Proveedor $proveedor): bool {
        $result = false;

        // Establece la conexión con la base de datos
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "INSERT INTO producto (cod_producto,descripcion,precio,stock, cod_prov) VALUES (:cod_producto,:descripcion,:precio,:stock, :cod_prov)";
        $sentencia = $conexion->prepare($sql);

        // Asigna los valores de los parámetros
        $sentencia->bindValue(":cod_producto", $producto->getCod_producto());
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
        $sql = "UPDATE producto SET descripcion = :descripcion, precio = :precio, stock = :stock WHERE cod_producto = :cod_producto";
        $sentencia = $conexion->prepare($sql);

        // Asigna los valores de los parámetros
        $sentencia->bindValue(":cod_producto", $producto->getCod_producto());
        $sentencia->bindValue(":descripcion", $producto->getDescripcion());
        $sentencia->bindValue(":precio", $producto->getPrecio());
        $sentencia->bindValue(":stock", $producto->getStock());

        // Ejecuta la consulta y actualiza el resultado
        $result = $sentencia->execute();

        return $result;
    }

    // Método para eliminar un producto de la base de datos
    public static function delete($cod_producto): bool {
        $result = false;
    
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();
    
        // Prepara la consulta SQL
        $sql = "DELETE FROM producto WHERE cod_producto = :cod_producto";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":cod_producto", $cod_producto);
    
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

    // Agrega este método para obtener productos con bajo stock por proveedor
    public static function getBajoStockPorProveedor($stockLimite, $cod_prov) {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM producto WHERE stock < :stockLimite AND cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam(":stockLimite", $stockLimite, PDO::PARAM_INT);
        $sentencia->bindParam(":cod_prov", $cod_prov, PDO::PARAM_STR);
        $sentencia->execute();

        // Obtiene los productos con bajo stock del proveedor actual
        $productosBajoStock = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $productosBajoStock;
}


    // Método para obtener un producto por su descripción y proveedor
    public static function getByDescripcion($descripcion, $cod_prov) {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();
    
        // Prepara la consulta SQL
        $sql = "SELECT * FROM producto WHERE descripcion = :descripcion AND cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);
    
        // Asigna el valor del parámetro
        $sentencia->bindValue(":descripcion", $descripcion);
        $sentencia->bindValue(":cod_prov", $cod_prov);
    
        // Ejecuta la consulta
        $sentencia->execute();
    
        // Obtiene todos los resultados de la consulta
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
        // Lista para almacenar los productos
        $productos = [];
    
        // Itera sobre los resultados y crea objetos Producto
        foreach ($resultados as $resultado) {
            // Asegúrate de que ProveedorDB tenga una función getById o similar
            $cod_prov = $resultado['cod_prov'];
            $miProveedor = ProveedorDB::getProveedor($cod_prov);
    
            // Crea un objeto Producto con la información obtenida
            $producto = new Producto(
                $resultado['cod_producto'],
                $resultado['descripcion'],
                $resultado['precio'],
                $resultado['stock'],
                $miProveedor
            );
    
            // Agrega el producto a la lista
            $productos[] = $producto;
        }
    
        return $productos;
    }
    public static function getAllDescriptions($cod_prov) {
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();
    
        // Prepara la consulta SQL
        $sql = "SELECT DISTINCT descripcion FROM producto WHERE cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);
    
        // Asigna el valor del parámetro
        $sentencia->bindValue(":cod_prov", $cod_prov);
    
        // Ejecuta la consulta
        $sentencia->execute();
    
        // Obtiene todos los resultados de la consulta
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
        // Lista para almacenar las descripciones
        $descripciones = [];
    
        // Itera sobre los resultados y agrega las descripciones a la lista
        foreach ($resultados as $resultado) {
            $descripciones[] = $resultado['descripcion'];
        }
    
        return $descripciones;
    }

   
   // Método para obtener todos los productos de un proveedor
    public static function getAll(Proveedor $proveedor): array {
        $productos = array();

        // Establece la conexión con la base de datos
        include_once '../Conexion/conexion.php';
        $conexion = Conexion::obtenerConexion();

        // Prepara la consulta SQL
        $sql = "SELECT * FROM producto WHERE cod_prov = :cod_prov";
        $sentencia = $conexion->prepare($sql);

        // Asigna los valores de los parámetros
        $sentencia->bindValue(":cod_prov", $proveedor->getCod_prov());

        // Ejecuta la consulta y obtiene los resultados
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        // Convierte los resultados en objetos Producto y los agrega al array
        foreach ($resultados as $fila) {
            $producto = new Producto(
                $fila['cod_producto'],
                $fila['descripcion'],
                $fila['precio'],
                $fila['stock'],
                $proveedor  // ¡Asegúrate de que estás pasando el proveedor!
            );

            $productos[] = $producto;
        }

        return $productos;
    }

    
}


?>
