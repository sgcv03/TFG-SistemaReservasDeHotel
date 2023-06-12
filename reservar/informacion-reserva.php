<?php
session_start(); // Iniciamos la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Informacion Reserva | CostaMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../index.css">
    <link rel="icon" type="image/x-icon" href="../Imagenes/LogoHotel.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img class="navbar-brand" src="../Imagenes/LogoHotelSinFondo.png" alt="Logo"></img>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <span class="navbar-text">
                    <img src="../Imagenes/banderaSpain.png" alt="Español" width="30" height="30" class="rounded-circle">
                </span>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <?php
                if (isset($_SESSION["loggedin"]) == true) { // Si el usuario ha iniciado sesión, ocultar los botones de inicio de sesión y registro
                    echo '<li class="nav-item">
                    <a class="nav-link" href="../perfil-usuario/perfil-usuario.php">Mi Perfil (' . $_SESSION["usuario"] . ')</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../reservar/reservas-usuario.php">Mis Reservas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../CerrarSesion.php">Cerrar sesión</a>
                  </li>';
                } else { // Si el usuario no ha iniciado sesión, mostrar los botones de inicio de sesión y registro
                    echo '<li class="nav-item navbar-expand">
                    <a class="nav-link btn btn-outline-primary" href="../login/login.php">Iniciar sesión</a>
                  </li>
                  <li class="nav-item">
                    <a style="color: white;" class="nav-link btn btn-primary" href="../registrar/registrar.php">Hazte una cuenta</a>
                  </li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center">Detalles de la Reserva</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tus Datos</h5>
                        <p class="card-text">Nombre: <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellidos']; ?></p>
                        <p class="card-text">DNI: <?php echo $_SESSION['dni_cliente']; ?></p>
                        <p class="card-text">Usuario: <?php echo $_SESSION['usuario']; ?></p>
                        <p class="card-text">Email: <?php echo $_SESSION['email']; ?></p>
                        <p class="card-text">Teléfono: <?php echo $_SESSION['telefono']; ?></p>

                    </div>
                </div>
            </div>
            <?php
            $conexion = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

            // Verifica la conexión a la base de datos
            if (!$conexion) {
                die("Error de conexión a la base de datos: " . mysqli_connect_error());
            }

            // Consulta SQL para obtener los datos de la reserva
            $reservaId = $_GET['id_reserva'];
            $query = "SELECT id_reserva, fecha_entrada, fecha_salida, precioTotal FROM reservas WHERE id_reserva = '$reservaId'";
            $resultado = mysqli_query($conexion, $query);

            if (mysqli_num_rows($resultado) > 0) {
                // Se obtiene los datos de la reserva
                $fila = mysqli_fetch_assoc($resultado);
                $reservaId = $fila['id_reserva'];
                $reservaFechaEntrada = $fila['fecha_entrada'];
                $reservaFechaSalida = $fila['fecha_salida'];
                $reservaPrecioTotal = $fila['precioTotal'];

                // Cierra la conexión a la base de datos
                mysqli_close($conexion);
            }
            ?>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos de la Reserva</h5>
                        <p class="card-text">ID de Reserva: <?php echo $reservaId; ?></p>
                        <p class="card-text">Fecha de Entrada: <?php echo $reservaFechaEntrada; ?></p>
                        <p class="card-text">Fecha de Salida: <?php echo $reservaFechaSalida; ?></p>
                        <p class="card-text">Precio Total: <?php echo $reservaPrecioTotal; ?>€</p>
                    </div>
                </div>
            </div>
            <?php
            $conexion = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");

            if (!$conexion) {
                die("Error de conexión a la base de datos: " . mysqli_connect_error());
            }

            //Se obtiene el id_habitacion mediante la URL
            $id_habitacion = $_GET['id_habitacion'];

            // Consulta para obtener los datos de la habitación
            $query_habitacion = "SELECT * FROM habitaciones WHERE id_habitacion = $id_habitacion";

            $resultado_habitacion = mysqli_query($conexion, $query_habitacion);

            //Se verifica si se obtuvieron resultados de la habitación
            if ($resultado_habitacion && mysqli_num_rows($resultado_habitacion) > 0) {
                $fila_habitacion = mysqli_fetch_assoc($resultado_habitacion);
                $habitacionTipo = $fila_habitacion['tipo'];
                $habitacionDescripcion = $fila_habitacion['descripcion'];
                $habitacionImagen = $fila_habitacion['imagen'];

                // Consulta para obtener los datos del hotel reservado
                $query_hotel = "SELECT * FROM hoteles WHERE id_hotel = " . $fila_habitacion['id_hotel'];

                $resultado_hotel = mysqli_query($conexion, $query_hotel);

                // Verifica si se obtuvieron resultados del hotel
                if ($resultado_hotel && mysqli_num_rows($resultado_hotel) > 0) {
                    $fila_hotel = mysqli_fetch_assoc($resultado_hotel);
                    $hotelNombre = $fila_hotel['nombre'];
                    $hotelDireccion = $fila_hotel['direccion'];
                    $hotelPais = $fila_hotel['pais'];
                    $hotelCiudad = $fila_hotel['ciudad'];
                    $hotelCategoria = $fila_hotel['categoria'];
                    $hotelImagen = $fila_hotel['imagen'];

                    // Mostrar los datos en la tarjeta
                    echo "<div class='col-md-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>Datos del Hotel y Habitación</h5>
                        <p class='card-text'>Hotel: " . $hotelNombre . "</p>
                        <p class='card-text'>Dirección: " . $hotelDireccion . "</p>
                        <p class='card-text'>País: " . $hotelPais . "</p>
                        <p class='card-text'>Ciudad: " . $hotelCiudad . "</p>
                        <p class='card-text'>Categoría: " . $hotelCategoria . "</p>
                        <img src='data:image/jpeg;base64," . base64_encode($hotelImagen) . "' class='card-img-top' alt='Imagen del hotel'>
                        <strong><p class='card-text'>" . $habitacionTipo . "</p></strong>
                        <img src='data:image/jpeg;base64," . base64_encode($habitacionImagen) . "' class='card-img-top' alt='Imagen del hotel'>
                        <p class='card-text'>Descripción: " . $habitacionDescripcion . "</p>
                    </div>
                </div>
            </div>";
                }
            }

            // Cerrar la conexión
            mysqli_close($conexion);
            ?>

        </div>
    </div>


    <br><br><br><br><br><br><br><br><br><br><br><br><br>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Contáctanos</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Dirección: Calle Falsa, 123</p>
                    <p><i class="fas fa-phone"></i> Teléfono: +34 123 456 789</p>
                    <p><i class="fas fa-envelope"></i> Email: info@midominio.com</p>
                </div>
                <div class="col-md-4">
                    <h4>Redes Sociales</h4>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <ion-icon name="logo-instagram"></ion-icon>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Suscríbete</h4>
                    <p>Recibe nuestras últimas noticias y ofertas especiales.</p>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Introduce tu email">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Suscribirme</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <p class="text-center">&copy; 2023 CostaMS.com - Todos los derechos reservados</p>
        </div>
    </footer>
</body>