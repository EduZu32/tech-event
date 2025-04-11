<?php
$host = "localhost";
$usuario = "root";
$contrasenia = "88MYSQLydqhxv";
$bd = "eventos_tech";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Error de conexión: " . $e->getMessage(), 3, __DIR__ . "/../logs/errores.log");
    die("Error de conexión a la base de datos.");
}
