<?php
require_once "db.php";
require_once "helpers.php";

// Crear evento
function insertarEvento($datos)
{
    global $conexion;

    $sql = "INSERT INTO eventos (nombre, fecha, descripcion, lugar, capacidad, creado_por)
            VALUES (:nombre, :fecha, :descripcion, :lugar, :capacidad, :creado_por)";

    $stmt = $conexion->prepare($sql);
    return $stmt->execute([
        ':nombre' => sanitizarTexto($datos['nombre']),
        ':fecha' => $datos['fecha'],
        ':descripcion' => sanitizarTexto($datos['descripcion']),
        ':lugar' => sanitizarTexto($datos['lugar']),
        ':capacidad' => validarEntero($datos['capacidad']),
        ':creado_por' => $_SESSION['usuario'] // 👈 AÑADIDO
    ]);
}

// Leer todos los eventos
function obtenerEventos()
{
    global $conexion;

    $stmt = $conexion->query("SELECT * FROM eventos ORDER BY fecha ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Leer un evento por ID
function obtenerEventoPorId($id)
{
    global $conexion;

    $stmt = $conexion->prepare("SELECT * FROM eventos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Actualizar evento
function actualizarEvento($id, $datos)
{
    global $conexion;

    $sql = "UPDATE eventos SET nombre = :nombre, fecha = :fecha, descripcion = :descripcion,
            lugar = :lugar, capacidad = :capacidad WHERE id = :id";

    $stmt = $conexion->prepare($sql);
    return $stmt->execute([
        ':nombre' => sanitizarTexto($datos['nombre']),
        ':fecha' => $datos['fecha'],
        ':descripcion' => sanitizarTexto($datos['descripcion']),
        ':lugar' => sanitizarTexto($datos['lugar']),
        ':capacidad' => validarEntero($datos['capacidad']),
        ':id' => $id
    ]);
}

// Eliminar evento
function eliminarEvento($id)
{
    global $conexion;

    $stmt = $conexion->prepare("DELETE FROM eventos WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

function obtenerEventosDelUsuario($usuario)
{
    global $conexion;

    $stmt = $conexion->prepare("SELECT * FROM eventos WHERE creado_por = :usuario ORDER BY fecha ASC");
    $stmt->execute([':usuario' => $usuario]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
