<?php
$link = mysqli_connect("localhost", "root", "root", "tfg_hoteles");

// comprobar conexion
if($link === false){
    die("ERROR:  " . mysqli_connect_error());
}
$usuario_inscrito=false;

$usuario=$_POST['usuario'];
$password=$_POST['password'];
// Hacemos una consulta donde comprueba el dni y el pin si coinciden
    $sql="select *
        from clientes
		where usuario='$usuario' and contraseña='$password'";

$res=mysqli_query($link , $sql);
$numerofilas=mysqli_num_rows($res);
// La búsqueda no arrojó usuarios con ese nombre ni contraseña, por lo tanto el usuario no existe
    if($numerofilas>0){
        $usuario_inscrito=true;
    }
// Usuario inscrito en el banco y en la base de datos 
    else if ($numerofilas==0) {
        $usuario_inscrito=false;
    }
    if($usuario_inscrito==true){
    echo "Inicio Sesion correcto";
    }
    if($usuario_inscrito==false)
    echo "Inicio Sesion incorrecto";

?>