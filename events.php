<?php
session_start();
require_once "includes/eventFunctions.php";

// Validar sesión (puedes mejorarlo luego con auth.php)
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$mensaje = "";
$modoEdicion = false;
$eventoEditado = [
    'id' => null,
    'nombre' => '',
    'fecha' => '',
    'descripcion' => '',
    'lugar' => '',
    'capacidad' => ''
];

// CREAR EVENTO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
    if (insertarEvento($_POST)) {
        header("Location: events.php?mensaje=creado");
        exit();
    }
}

// ACTUALIZAR EVENTO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    if (actualizarEvento($_POST['id'], $_POST)) {
        header("Location: events.php?mensaje=actualizado");
        exit();
    }
}

// ELIMINAR EVENTO
if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
    eliminarEvento($_GET['eliminar']);
    header("Location: events.php?mensaje=eliminado");
    exit();
}

// EDITAR (mostrar datos en formulario)
if (isset($_GET['editar']) && is_numeric($_GET['editar'])) {
    $modoEdicion = true;
    $eventoEditado = obtenerEventoPorId($_GET['editar']);
}

// MENSAJE
if (isset($_GET['mensaje'])) {
    switch ($_GET['mensaje']) {
        case 'creado':
            $mensaje = "✅ Evento creado correctamente.";
            break;
        case 'actualizado':
            $mensaje = "✏️ Evento actualizado correctamente.";
            break;
        case 'eliminado':
            $mensaje = "🗑️ Evento eliminado correctamente.";
            break;
    }
}

$eventos = obtenerEventosDelUsuario($_SESSION['usuario']);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include "includes/header.php"; ?>
    <main class=" flex-fill">
        <div class="container mt-4">

            <h2>Lista de Eventos</h2>

            <?php if ($mensaje): ?>
                <div class="alert alert-success"><?= $mensaje ?></div>
            <?php endif; ?>

            <table class="table table-bordered table-striped mt-3">
                <thead class="table-primary">
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Lugar</th>
                        <th>Capacidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td><?= htmlspecialchars($evento['nombre']) ?></td>
                            <td><?= htmlspecialchars($evento['fecha']) ?></td>
                            <td><?= htmlspecialchars($evento['descripcion']) ?></td>
                            <td><?= htmlspecialchars($evento['lugar']) ?></td>
                            <td><?= htmlspecialchars($evento['capacidad']) ?></td>
                            <td>
                                <a href="events.php?editar=<?= $evento['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="events.php?eliminar=<?= $evento['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar evento?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3 class="mt-5"><?= $modoEdicion ? "Editar Evento" : "Crear Nuevo Evento" ?></h3>
            <form method="POST" class="row g-3">
                <?php if ($modoEdicion): ?>
                    <input type="hidden" name="actualizar" value="1">
                    <input type="hidden" name="id" value="<?= $eventoEditado['id'] ?>">
                <?php else: ?>
                    <input type="hidden" name="crear" value="1">
                <?php endif; ?>

                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" required value="<?= htmlspecialchars($eventoEditado['nombre']) ?>">
                </div>
                <div class="col-md-6">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required value="<?= htmlspecialchars($eventoEditado['fecha']) ?>">
                </div>
                <div class="col-md-6">
                    <label>Lugar</label>
                    <input type="text" name="lugar" class="form-control" required value="<?= htmlspecialchars($eventoEditado['lugar']) ?>">
                </div>
                <div class="col-md-6">
                    <label>Capacidad</label>
                    <input type="number" name="capacidad" class="form-control" required value="<?= htmlspecialchars($eventoEditado['capacidad']) ?>">
                </div>
                <div class="col-md-12">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($eventoEditado['descripcion']) ?></textarea>
                </div>
                <div class="col-12">
                    <button class="btn btn-success" type="submit">
                        <?= $modoEdicion ? "Actualizar Evento" : "Crear Evento" ?>
                    </button>
                </div>
            </form>
        </div>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>