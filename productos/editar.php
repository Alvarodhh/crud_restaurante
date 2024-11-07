<?php
require_once  'funciones.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$producto = obtenerProductosPorId($_GET['id']);

if (!$producto) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarProducto($_GET['id'], $_POST['nombre'], doubleval($_POST['precio']), $_POST['descripcion'],$_POST['stock'],$_POST['categoria'], isset($_POST['disponible']));
    if ($count > 0) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo actualizar el Producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <div class="container">
    <center><h1>Editar Producto</h1></center>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required></label><br>
        
        <label>Precio: <input type="number" name="precio" step="any" value="<?php echo($producto['precio']); ?>" required></label><br>

        <label>Descripcion: <input type="text" name="descripcion" value="<?php echo htmlspecialchars ($producto['descripcion']); ?>" required></label><br>

        <label>Stock: <input type="number" name="stock" value="<?php echo($producto['stock']); ?>" required></label><br>

        <label>Categoria:
            <select name="categoria" class="opciones">
                <option value="Sopa">Sopa</option>
                <option value="Segundo">Segundo</option>
                <option value="Bebidas">Bebidas</option>
                <option value="Postre">Postre</option>
            </select>
        </label><br>
        <label>Disponible: <input type="checkbox" name="disponible" <?php echo $producto['disponible'] ? 'checked' : ''; ?>></label><br><input type="submit" value="Actualizar Producto">
    </form>

    <a href="index.php">Volver a la lista de productos</a>
</div>
</body>
</html>

