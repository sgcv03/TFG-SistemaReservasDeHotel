
<?php
session_start(); // Iniciar sesión

$link = mysqli_connect("localhost", "root", "root", "tfg_hoteles");

// Comprobar conexión
if($link === false){
    die("ERROR: " . mysqli_connect_error());
}

// Obtener datos del formulario de inicio de sesión
$usuarioExiste = false;
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Consulta SQL para buscar al usuario en la base de datos
$sql = "SELECT * FROM clientes WHERE usuario = '$usuario' and contraseña = '$password'";

$resultado = mysqli_query($link, $sql);

if(mysqli_num_rows($resultado) == 1){
    $fila = mysqli_fetch_array($resultado);
    $usuarioExiste = true;
    // Contraseña correcta, se inicializan las variables de sesión
    $_SESSION['loggedin'] = true;
    $_SESSION['dni_cliente'] = $fila['dni_cliente'];
    $_SESSION['nombre'] = $fila['nombre'];
    $_SESSION['apellidos'] = $fila['apellidos'];
    $_SESSION['usuario'] = $fila['usuario'];
    header("Location: ../Index.php");
    
} else{
    // Usuario no encontrado en la base de datos
    echo "El usuario no existe";
}

?>
