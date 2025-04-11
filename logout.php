<?php
session_start(); // Iniciar la sesión
session_unset(); // Destruir todas las variables de sesión
session_destroy(); // Destruir la sesión
header("Location: index.php"); // Redirigir al usuario a la página de inicio de sesión
exit(); // Asegurarse de que el script se detenga después de la redirección

?>