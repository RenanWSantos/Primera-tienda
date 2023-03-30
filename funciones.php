
<?php

function obtenerProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT productos.id, productos.nombre, productos.imagen, productos.descripcion, productos.precio
     FROM productos
     INNER JOIN carrito_usuarios
     ON productos.id = carrito_usuarios.id_producto
     WHERE carrito_usuarios.id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll();
}
function quitarProductoDelCarrito($idProducto)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $sentencia = $bd->prepare("DELETE FROM carrito_usuarios WHERE id_sesion = ? AND id_producto = ?");
    return $sentencia->execute([$idSesion, $idProducto]);
}

function obtenerProductos()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT p.id, p.nombre, c.nombre AS categoria, p.imagen, p.descripcion, p.precio 
    FROM productos p 
    INNER JOIN categorias c ON c.id = p.idCategoria;");
    return $sentencia->fetchAll();
}

function obtenerCategorias()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT id, nombre FROM categorias");
    return $sentencia->fetchAll();
}

function productoYaEstaEnCarrito($idProducto)
{
    $ids = obtenerIdsDeProductosEnCarrito();
    foreach ($ids as $id) {
        if ($id == $idProducto) return true;
    }
    return false;
}

function obtenerIdsDeProductosEnCarrito()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT id_producto FROM carrito_usuarios WHERE id_sesion = ?");
    $idSesion = session_id();
    $sentencia->execute([$idSesion]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function agregarProductoAlCarrito($idProducto)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $sentencia = $bd->prepare("INSERT INTO carrito_usuarios(id_sesion, id_producto) VALUES (?, ?)");
    return $sentencia->execute([$idSesion, $idProducto]);
}


function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function eliminarProducto($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM productos WHERE id = ?");
    return $sentencia->execute([$id]);
}

function eliminarCategoria($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM categorias WHERE id = ?");
    return $sentencia->execute([$id]);
}

function guardarProducto($nombre, $imagen, $categoria, $precio, $descripcion)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO productos(nombre, imagen, idCategoria, precio, descripcion) VALUES( ?, ?, ?, ?, ?)");
    return $sentencia->execute([$nombre, $imagen, $categoria, $precio, $descripcion]);
}

function guardarCategoria($nombre)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO categorias(nombre) VALUES(?)");
    return $sentencia->execute([$nombre]);
}

function obtenerConexion()
{
    $password = "";
    $user = "root";
    $dbName = "laboratorio";
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}
