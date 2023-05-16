<?php
session_start(); // Iniciamos la sesión
$link = mysqli_connect("localhost", "root", "root", "tfg_hoteles");

// Comprobar conexión
if($link === false){
    die("ERROR:  " . mysqli_connect_error());
}

// Destruir todas las variables de sesión
$_SESSION = array();
session_destroy();

// Redirigir al usuario a la página de inicio
header("location: Index.php");
exit;
?>
