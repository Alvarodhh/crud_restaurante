<?php
require_once __DIR__ . '/../vendor/autoload.php';
$mongoClient = new MongoDB\Client("mongodb+srv://dsi4:YPr7Yno41U5nUovP@myatlasclusteredu.uqpxo.mongodb.net/?retryWrites=true&w=majority&appName=myAtlasClusterEDU");
$database = $mongoClient->selectDatabase('restaurante');
$tasksCollection = $database->clientes;