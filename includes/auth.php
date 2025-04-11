<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    //Leer el archivo de texto

    $lineas = file("../usuarios.txt", FILE_IGNORE_NEW_LINES);

    $autenticado = false;

    foreach ($lineas as $linea) {
        list($user, $pass) = explode(":", $linea);
        if ($usuario == $user && $contrasenia == $pass) {
            $autenticado = true;
            break;
        }
    }

    if ($autenticado) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../dashboard.php");
        exit();
    } else {
        header("Location: ../index.php?error=1");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
