<?php
$link = mysqli_connect("localhost", "root", "root", "tfg_hoteles");
 
// comprobar conexion
if($link === false){
    die("ERROR:  " . mysqli_connect_error());
}
 
// Obtener datos
$nombre = $_POST["nombre"];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$dni=$_POST['dni'];
$usuario = $_POST['usuario'];
$password=$_POST['password'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];



// Creamos cadena SQL y la ejecutamos
$sql = "INSERT INTO clientes (dni_cliente, nombre, apellidos, usuario, contraseña, email, telefono, direccion) VALUES 
('$dni', '$nombre', '$apellidos','$usuario','$password','$email', '$telefono' , '$direccion')";

if(mysqli_query($link, $sql)){
    echo "Te has registrado correctamente";
} else{
    echo "ERROR:  $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>