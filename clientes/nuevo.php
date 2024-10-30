<?php
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearCliente($_POST['nombre'], $_POST['correo'], $_POST['telefono'],$_POST['direccion']);
    if ($id) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo crear al cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Cliente</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
    <h1>Agregar Nuevo Cliente</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label><br>
        <label>Correo: <input type="email" name="correo" required></label><br>
        <label>telefono: <input type="number" name="telefono" required></label><br>
        <label>Direccion: <input type="text" name="direccion" required></label><br>
        <input type="submit" value="Agregar Cliente">
    </form>

    <a href="index.php">Volver a la lista de clientes</a>
</div>
</body>
</html>

