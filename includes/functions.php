<?php
require_once __DIR__ . '/../config/database.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}
function crearCliente($nombre, $correo, $telefono,$direccion) {
    global $clientesCollection;
    $resultado = $clientesCollection->insertOne([
        'nombre' => sanitizeInput($nombre),
        'correo' => sanitizeInput($correo),
        'telefono' => sanitizeInput($telefono),
        'direccion' => sanitizeInput($direccion),
    ]);
    return $resultado->getInsertedId();
}

function obtenerCliente() {
    global $clientesCollection;
    return $clientesCollection->find();
}
function obtenerClientePorId($id) {
    global $clientesCollection;
    return $clientesCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

function actualizarCliente($id, $nombre, $correo, $telefono,$direccion) {
    global $clientesCollection;
    $resultado = $clientesCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'nombre' => sanitizeInput($nombre),
            'correo' => sanitizeInput($correo),
            'telefono' => sanitizeInput($telefono),
            'direccion' => sanitizeInput($direccion),

        ]]
    );
    return $resultado->getModifiedCount();
}
function eliminarCliente($id) {
    global $clientesCollection;
    $resultado = $clientesCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}