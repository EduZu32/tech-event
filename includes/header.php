<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
    <div class="container-fluid">
        <span class="navbar-brand">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></span>
        <div class="d-flex">
            <a href="dashboard.php" class="btn btn-outline-light me-2">🏠 Inicio</a>
            <a href="events.php" class="btn btn-outline-light me-2">🎉 Eventos</a>
            <a href="logout.php" class="btn btn-light">Cerrar sesión</a>
        </div>
    </div>
</nav>