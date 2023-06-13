<?php
session_start();
// Realizar la conexión a la base de datos
$link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

// Obtener los datos del formulario
$dni = $_POST['dni'];
$newPassword = $_POST['newPassword'];

// Actualizar la contraseña en la base de datos
$query = "UPDATE clientes SET contraseña = '$newPassword' WHERE DNI_cliente = '$dni'";
$result = mysqli_query($link, $query);

if ($result) {
    $_SESSION['exito'] = "Contraseña cambiada con éxito";
    header('Location: ../login/login.php');
} else {
    $_SESSION['error'] = "No se ha podido cambiar la contraseña";
    header('Location: cambiar-password-form.php');
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($link);
