<?php
session_start();
// Verificar si se ha enviado el formulario de confirmación de reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_habitacion']) && isset($_POST['precioTotal']) && isset($_POST['fechaEntrada']) && isset($_POST['fechaSalida']) && isset($_POST['dni_cliente'])) {
    $id_habitacion = $_POST['id_habitacion'];
    $precioTotal = $_POST['precioTotal'];
    $fechaEntrada = $_POST['fechaEntrada'];
    $fechaSalida = $_POST['fechaSalida'];
    $dni_cliente = $_POST['dni_cliente'];


    $link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

    $query_insertar = "INSERT INTO reservas (fecha_entrada, fecha_salida, precioTotal, estado, DNI_cliente, id_habitacion) VALUES ('$fechaEntrada', '$fechaSalida', '$precioTotal', 'CONFIRMADA', '$dni_cliente', '$id_habitacion')";
    $resultado_insertar = mysqli_query($link, $query_insertar);

    // Verificar si la inserción fue exitosa
    if ($resultado_insertar) {
        header('Location: reservas-usuario.php');
        
    } else {
        $_SESSION['error'] = "Error al realizar la reserva";
        header('location: reservar.php');
        exit();
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($link);

} else {
    $_SESSION['error'] = "Error: No se ha enviado el formulario de confirmación de reserva.";
    header('location: reservar.php');
    exit();

}
