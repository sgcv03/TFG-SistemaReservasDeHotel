<?php
session_start();


$link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");
 
// Comprobar conexion
if($link === false){
    die("ERROR:  " . mysqli_connect_error());
}

 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Obtener datos
$nombre = $_POST["nombre"];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$dni = $_POST['dni'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

// Validar DNI
if (strlen($dni) != 9 || !preg_match('/^\d{8}[a-zA-Z]{1}$/', $dni)) {
    $_SESSION['error'] = "El DNI no tiene un formato válido";
    header('Location: registrar.php');
    exit();
}
//Comprobar si ya está registrado el DNI
$sql = "SELECT dni_cliente FROM clientes WHERE dni_cliente='$dni'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result)>0){
    $_SESSION['error'] = "El DNI ya está registrado en nuestro sistema.";
    header('Location: registrar.php');
    exit();
}

// Comprobar si el correo electrónico ya está registrado
$sql = "SELECT dni_cliente FROM clientes WHERE email='$email'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "El correo electrónico ya está registrado";
    header('Location: registrar.php');
    exit();
}

// Comprobar si el usuario ya está registrado
$sql = "SELECT * FROM clientes WHERE usuario='$usuario'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "Ya existe un usuario con ese nombre";
    header('Location: registrar.php');
    exit();
}

//Comprobar que la contraseña no supera la longitud
$sql = "SELECT * FROM clientes WHERE contraseña='$password'";
$result = mysqli_query($link, $sql);
if (strlen($password) > 10) {
    $_SESSION['error'] = "La contraseña supera los 10 caracteres";
    header('Location: registrar.php');
    exit();
}

//Validar numero de telefono
if (strlen($telefono) > 15) {
    $_SESSION['error'] = "El telefono supera la longitud establecida.";
    header('Location: registrar.php');
    exit();
}

//Comprobar si ya está registrado un número de teléfono
$sql = "SELECT * FROM clientes WHERE telefono='$telefono'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "Ya existe un usuario registrado con ese número de teléfono";
    header('Location: registrar.php');
    exit();
}

//Si pasa todas las anteriores validaciones, se crea la sentencia SQL y se inserta al usuario en la base de datos.
$sql = "INSERT INTO clientes (dni_cliente, nombre, apellidos, usuario, contraseña, email, telefono, direccion) VALUES 
('$dni', '$nombre', '$apellidos','$usuario','$password','$email', '$telefono' , '$direccion')";


if(mysqli_query($link, $sql)){
    header('Location: ../index.php');
  }else{
    $_SESSION['error'] = "Error al registrar el usuario. Introduzca de nuevo las credenciales.";
    header('Location: registrar.php');
    exit();
  }

 
}
