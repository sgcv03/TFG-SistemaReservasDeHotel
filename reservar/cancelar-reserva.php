<?php
session_start();
// Realiza la conexión a la base de datos
$link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

// Obtén el ID de la reserva a cancelar desde la URL
$idReserva = $_GET['id_reserva'];

// Elimina la reserva de la base de datos
$query = "DELETE FROM reservas WHERE id_reserva = '$idReserva'";
$result = mysqli_query($link, $query);

// Verifica si la eliminación fue exitosa
if ($result) {
    $_SESSION['exitoReserva'] = "Se ha cancelado la reserva.";
    header('Location: reservas-usuario.php');
} else {
    $_SESSION['errorReserva'] = "No se ha podido cancelar la reserva.";
    header('Location: reservas-usuario.php');
    exit();
}

// Cierra la conexión a la base de datos
mysqli_close($link);
?>
