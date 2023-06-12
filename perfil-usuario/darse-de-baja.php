<?php
session_start();
// Verificar si se ha enviado el formulario de confirmación de baja
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eliminar los datos del usuario y finalizar la sesión
    eliminarDatosUsuario();
    session_destroy();
    header("Location: ../index.php"); // Redirigir al usuario a la página de inicio
    exit();
}

// Función para eliminar los datos del usuario
function eliminarDatosUsuario() {
        // Crear conexión
        $link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

        // Comprobar conexión
        if($link === false){
            die("ERROR:  " . mysqli_connect_error());
        }
       
        // Obtener el ID de usuario que está logeado
        $userID = $_SESSION["usuario"];
    
        // Eliminar el usuario de la base de datos
        $query = "DELETE FROM clientes WHERE usuario = '$userID'";
        if ($link->query($query) === TRUE) {
            unset($_SESSION['nombre']);
            unset($_SESSION['apellidos']);
            unset($_SESSION['usuario']);
            unset($_SESSION['contraseña']);
            unset($_SESSION['dni_cliente']);
            unset($_SESSION['email']);
            unset($_SESSION['telefono']);
            unset($_SESSION['direccion']);
        }
}
