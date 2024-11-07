<?php
require_once __DIR__ . '/../config/database.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}
function crearProducto($nombre, $precio, $descripcion,$categoria,$stock) {
    global $productosCollection;
    $resultado = $productosCollection->insertOne([
        'nombre' => sanitizeInput($nombre),
        'precio' => sanitizeInput($precio),
        'descripcion' => sanitizeInput($descripcion),
        'categoria' => sanitizeInput($categoria),
        'stock' => sanitizeInput($stock),
        'disponible' => false
    ]);
    return $resultado->getInsertedId();
}

function obtenerProducto() {
    global $productosCollection;
    return $productosCollection->find();
}
function obtenerProductosPorId($id) {
    global $productosCollection;
    return $productosCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

function actualizarProducto($id, $nombre, $precio, $descripcion, $stock, $categoria, $disponible) {
    global $productosCollection;
    $resultado = $productosCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'precio' => sanitizeInput($precio),
            'descripcion' => sanitizeInput($descripcion),
            'stock' => sanitizeInput($stock),
            'categoria' => sanitizeInput($categoria),
            'disponible' => $disponible
        ]]
    );
    return $resultado->getModifiedCount();
}
function eliminarProducto($id) {
    global $productosCollection;
    $resultado = $productosCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}
function toggleProductoDisponible($id) {
    global $productosCollection;
    $producto = $productosCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    if ($producto) {
        $nuevoEstado = !$producto['disponible'];
        $resultado = $productosCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => ['disponible' => $nuevoEstado]]
        );
        return $resultado->getModifiedCount() > 0 ? $nuevoEstado : null;
    }
    return null;
}