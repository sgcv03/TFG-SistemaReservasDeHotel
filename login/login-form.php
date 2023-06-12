<?php
session_start(); // Iniciar sesión

$link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

// Comprobar conexión
if($link === false){
    die("ERROR: " . mysqli_connect_error());
}

// Obtener datos del formulario de inicio de sesión
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Consulta para buscar al usuario en la base de datos
$sql = "SELECT * FROM clientes WHERE usuario = '$usuario' and contraseña = '$password'";

$resultado = mysqli_query($link, $sql);

if(mysqli_num_rows($resultado) == 1){
    $fila = mysqli_fetch_array($resultado);
    // Contraseña correcta, se inicializan las variables de sesión
    $_SESSION['loggedin'] = true;
    $_SESSION['dni_cliente'] = $fila['DNI_cliente'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellidos'] = $fila['apellidos'];
    $_SESSION['usuario'] = $fila['usuario'];
    $_SESSION['contraseña'] = $fila['contraseña'];
    $_SESSION['email'] = $fila['email'];
    $_SESSION['telefono'] = $fila['telefono'];
    $_SESSION['direccion'] = $fila['direccion'];
    header("Location: ../index.php");
    
} else{
    $_SESSION['error'] = "No se ha podido iniciar sesión. Por favor, inténtelo de nuevo.";
    header('Location: login.php');
    exit();
}

?>
