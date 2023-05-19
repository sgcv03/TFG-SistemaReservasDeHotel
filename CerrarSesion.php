<?php
session_start(); // Iniciamos la sesión
$link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

// Comprobar conexión
if($link === false){
    die("ERROR:  " . mysqli_connect_error());
}

// Destruir todas las variables de sesión
$_SESSION = array();
session_destroy();

// Redirigir al usuario a la página de inicio
header("location: index.php");
exit;
?>
