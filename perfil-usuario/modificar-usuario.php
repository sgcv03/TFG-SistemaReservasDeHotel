<?php
session_start();

$link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

// Comprobar conexión
if ($link === false) {
    die("ERROR: " . mysqli_connect_error());
}

// Comprueba si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recupera el ID de usuario de la sesión (asume que se ha iniciado sesión correctamente)
    $userID = $_SESSION['usuario'];

    // Verifica qué campos se están modificando y realiza las actualizaciones correspondientes
    if (isset($_POST['nuevoNombre'])) {
        $nombre = $_POST['nuevoNombre'];

        if (!empty($nombre)) {
            // Consulta para actualizar el campo 'nombre' en la base de datos
            $query = "UPDATE clientes SET nombre = '$nombre' WHERE usuario = '$userID'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['nombre'] = $nombre;
            } else {
                $_SESSION['error'] = "Error al actualizar el nombre";
            }
        }
    }

    if (isset($_POST['nuevoApellidos'])) {
        $apellidos = $_POST['nuevoApellidos'];

        if (!empty($apellidos)) {
            // Consulta para actualizar el campo 'apellidos' en la base de datos
            $query = "UPDATE clientes SET apellidos = '$apellidos' where usuario = '$userID'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['apellidos'] = $apellidos;
            } else {
                $_SESSION['error'] = "Error al actualizar los apellidos";
            }
        }
    }

    if (isset($_POST['nuevoUsuario'])) {
        $usuario = $_POST['nuevoUsuario'];

        if (!empty($usuario)) {
            // Comprobar si el usuario ya está registrado
            $sql = "SELECT * FROM clientes WHERE usuario='$usuario'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['error'] = "Ya existe un usuario con ese nombre";
                header('Location: perfil-usuario.php');
                exit();
            }
            // Consulta para actualizar el campo 'usuario' en la base de datos
            $query = "UPDATE clientes SET usuario = '$usuario' where usuario = '$userID'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['usuario'] = $usuario;
            } else {
                $_SESSION['error'] = "Error al actualizar el nombre de usuario";
            }
        }
    }

    if (isset($_POST['nuevoDni'])) {
        $dni = $_POST['nuevoDni'];

        if (!empty($dni)) {

            // Validar DNI
            if (strlen($dni) != 9 || !preg_match('/^\d{8}[a-zA-Z]{1}$/', $dni)) {
                $_SESSION['error'] = "El DNI no tiene un formato válido";
                header('Location: perfil-usuario.php');
                exit();
            }

            if (mysqli_num_rows($result) > 0) {
                $_SESSION['error'] = "El DNI introducido ya está registrado";
                header('Location: perfil-usuario.php');
                exit();
            }
            // Consulta para actualizar el campo 'DNI' en la base de datos
            $query = "UPDATE clientes SET dni_cliente = '$dni' where dni_cliente = '$dni'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['dni_cliente'] = $dni;
            } else {
                $_SESSION['error'] = "Error al actualizar el DNI";
            }
        }
    }

    if (isset($_POST['nuevaContraseña'])) {
        $contraseña = $_POST['nuevaContraseña'];

        if (!empty($contraseña)) {
            if (strlen($contraseña) > 10) {
                $_SESSION['error'] = "La contraseña supera la longitud (10 caracteres)";
                header('Location: perfil-usuario.php');
                exit();
            }
            // Consulta para actualizar el campo 'contraseña' en la base de datos
            $query = "UPDATE clientes SET contraseña = '$contraseña' where usuario = '$userID'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['contraseña'] = $contraseña;
            } else {
                $_SESSION['error'] = "Error al actualizar la contraseña";
            }
        }
    }

    if (isset($_POST['nuevoEmail'])) {
        $email = $_POST['nuevoEmail'];

        if (!empty($email)) {
            // Comprobar si el correo electrónico ya está registrado
            $sql = "SELECT * FROM clientes WHERE email='$email'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['error'] = "El correo electrónico ya está registrado";
                header('Location: perfil-usuario.php');
                exit();
            }
            // Consulta para actualizar el campo 'email' en la base de datos
            $query = "UPDATE clientes SET email = '$email' where usuario = '$userID'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['email'] = $email;
            } else {
                $_SESSION['error'] = "Error al actualizar el email";
            }
        }
    }

    if (isset($_POST['nuevoTelefono'])) {
        $telefono = $_POST['nuevoTelefono'];

        if (!empty($telefono)) {
            // Comprobar si el telefono ya está registrado
            $sql = "SELECT * FROM clientes WHERE telefono='$telefono'";
            $result = mysqli_query($link, $sql);
            //Validar numero de telefono
            if (strlen($telefono) > 15) {
                $_SESSION['error'] = "El telefono supera la longitud establecida.";
                header('Location: registrar.php');
                exit();
            }

            //Comprobar si ya está registrado el número de teléfono
            $sql = "SELECT * FROM clientes WHERE telefono='$telefono'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['error'] = "Ya existe un usuario registrado con ese número de teléfono";
                header('Location: perfil-usuario.php');
                exit();
            }
            // Consulta para actualizar el campo 'telefono' en la base de datos
            $query = "UPDATE clientes SET telefono = '$telefono' where usuario = '$userID'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['telefono'] = $telefono;
            } else {
                $_SESSION['error'] = "Error al actualizar el telefono";
            }
        }
    }

    if (isset($_POST['nuevaDireccion'])) {
        $direccion = $_POST['nuevaDireccion'];

        if (!empty($direccion)) {
            // Consulta para actualizar el campo 'direccion' en la base de datos
            $query = "UPDATE clientes SET direccion = '$direccion' WHERE usuario = '$userID'";

            // Ejecutar la consulta
            if ($link->query($query) === TRUE) {
                // Actualizar la variable de sesión correspondiente
                $_SESSION['direccion'] = $direccion;
            } else {
                $_SESSION['error'] = "Error al actualizar la direccion";
            }
        }
    }


    // Si se han realizado modificaciones, muestra un mensaje de éxito
    if (isset($nombre) || isset($apellidos) || isset($usuario) || isset($dni) || isset($contraseña) || isset($email) || isset($telefono) || isset($direccion)) {
        $_SESSION['exito'] = "Cambios realizados correctamente";
        header('Location: perfil-usuario.php');
    }
}
