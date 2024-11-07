<?php
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearProducto($_POST['nombre'], doubleval($_POST['precio']), $_POST['descripcion'],$_POST['categoria'],$_POST['stock']);
    if ($id) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo crear el productos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Producto</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <div class="container">
    <h1>Agregar Nuevo Producto</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label><br>
        <label>precio: <input type="number" name="precio" step="any" required></label><br>
        <label>Descripcion: <input type="text" name="descripcion" required></label><br>
        <label>Stock: <input type="number" name="stock" required></label><br>
        <label>Categoria:
            <select name="categoria" class="opciones">
                <option value="Sopa">Sopa</option>
                <option value="Segundo">Segundo</option>
                <option value="Bebidas">Bebidas</option>
                <option value="Postre">Postre</option>
            </select>
        </label><br>
        <input type="submit" value="Agregar Producto">
    </form>

    <a href="index.php">Volver a la lista de clientes</a>
</div>
</body>
</html>

