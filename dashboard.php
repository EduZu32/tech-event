<?php
session_start();

//Comporbamos si el usuario ya ha iniciado sesion
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require_once "includes/eventFunctions.php";
$eventos = obtenerEventosDelUsuario($_SESSION['usuario']);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos | <?= htmlspecialchars($_SESSION['usuario']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body claas="d-flex flex-column min-vh-100">
    <?php include "includes/header.php"; ?>

    <div id="particles-js"></div>
    <main class=" flex-fill">
        <div class="container py-5">
            <h1 class="text-center mb-4">🎉 Gestión de Eventos Tecnológicos</h1>
            <p class="text-center mb-5">A continuación se muestran tus eventos creados:</p>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php if (count($eventos) > 0): ?>
                    <?php foreach ($eventos as $evento): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($evento['nombre']) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= date("d/m/Y", strtotime($evento['fecha'])) ?></h6>
                                    <p class="card-text"><?= htmlspecialchars($evento['descripcion']) ?></p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Lugar:</strong> <?= htmlspecialchars($evento['lugar']) ?></li>
                                        <li class="list-group-item"><strong>Capacidad:</strong> <?= htmlspecialchars($evento['capacidad']) ?> personas</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Aún no has creado ningún evento.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <?php include "includes/footer.php"; ?>
    <script>
        particlesJS.load('particles-js', './particles.json', function() {
            console.log('particles.js loaded');
        });
    </script>
</body>

</html>