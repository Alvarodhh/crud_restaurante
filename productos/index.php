<?php
require_once  'funciones.php';
if (isset($_GET['accion']) && isset($_GET['id'])) {
    switch ($_GET['accion']) {
        case 'eliminar':
            $count = eliminarProducto($_GET['id']);
            $mensaje = $count > 0 ? "Producto eliminado con éxito." : "No se pudo eliminar el Producto.";
            break;
        case 'toggleCompletada':
            $nuevoEstado = toggleProductoDisponible($_GET['id']);
            if ($nuevoEstado !== null) {
                $mensaje = $nuevoEstado ? "Producto marcado como completado." : "Producto marcado como no completado.";
            } else {
                $mensaje = "No se pudo cambiar el disponible de la tarea.";
            }
            break;
    }
}
$clientes = obtenerProducto();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos </title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
    <center><h1>Lista de Productos</h1></center>
    <a href="nuevo.php" class="button">Agregar Nuevo Producto</a>
    <h2>Lista de Productos</h2>
    <table border="1">
    <?php if (isset($mensaje)): ?>
    <div class="<?php echo strpos($mensaje, 'éxito') !== false ? 'success' : 'error'; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripcion</th>
            <th>Categoria</th>
            <th>Stock</th>
            <th>Disponible</th>
            <th colspan="2">Acciones</th>
        </tr>
        <?php foreach ($clientes as $cliente): ?>
        <tr>
            <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
            <td><?php echo htmlspecialchars($cliente['precio']); ?></td>
            <td><?php echo htmlspecialchars($cliente['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($cliente['categoria']); ?></td>
            <td><?php echo htmlspecialchars($cliente['stock']); ?></td>
            <td><?php echo $cliente['disponible'] ? 'Disponible' : 'No Disponible'; ?></td>
            <td
            class="actions">
                <a href="editar.php?id=<?php echo $cliente['_id']; ?>"class="button-editar">Editar</a>
            </td>
            <td>
            <a href="index.php?accion=eliminar&id=<?php echo $cliente['_id']; ?>" class="button-eliminar"onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
</body>
</html>

