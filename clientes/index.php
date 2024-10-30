<?php
require_once __DIR__ . '/../includes/functions.php';
if (isset($_GET['accion']) && isset($_GET['id'])) {
    switch ($_GET['accion']) {
        case 'eliminar':
            $count = eliminarCliente($_GET['id']);
            $mensaje = $count > 0 ? "Cliente eliminado con éxito." : "No se pudo eliminar al cliente.";
            break;
    }
}
$clientes = obtenerCliente();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
    <div class="container">
    <center><h1>Gestión de Clientes</h1></center>
    <a href="nuevo.php" class="button">Agregar Nuevo Cliente</a>
    <h2>Lista de Clientes</h2>
    <table border="1">
    <?php if (isset($mensaje)): ?>
    <div class="<?php echo strpos($mensaje, 'éxito') !== false ? 'success' : 'error'; ?>">
        <?php echo $mensaje; ?>
    </div>
<?php endif; ?>
        <tr>
            <th><center>Nombre</center></th>
            <th><center>Correo</center></th>
            <th><center>Telefono</center></th>
            <th><center>Direccion</center></th>
            <th colspan="2"><center>Acciones</center></th>
            
        </tr>
        <?php foreach ($clientes as $cliente): ?>
        <tr>
            <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
            <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
            <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
            <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
            <td
            class="actions">
                <a href="editar.php?id=<?php echo $cliente['_id']; ?>"class="button-editar">Editar</a>
            </td>
            <td
            class="actions">
                <a href="index.php?accion=eliminar&id=<?php echo $cliente['_id']; ?>" class="button-eliminar"onclick="return confirm('¿Estás seguro de que quieres eliminar este cliente?');">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>
</body>
</html>

