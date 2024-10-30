<?php
require_once __DIR__ . '/../includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$cliente = obtenerClientePorId($_GET['id']);

if (!$cliente) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarCliente($_GET['id'], $_POST['nombre'], $_POST['correo'], $_POST['telefono'],$_POST['direccion']);
    if ($count > 0) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo actualizar el cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
    <center><h1>Editar Cliente</h1></center>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required></label><br>
        <label>Correo: <input type="email" name="correo" value="<?php echo htmlspecialchars($cliente['correo']); ?>" required></label><br>
        <label>Telefono: <input type="number" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required></label><br>
        <label>Direccion: <input type="text" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required></label><br>
        <input type="submit" value="Actualizar Cliente">
    </form>

    <a href="index.php">Volver a la lista de Clientes</a>
</div>
</body>
</html>

