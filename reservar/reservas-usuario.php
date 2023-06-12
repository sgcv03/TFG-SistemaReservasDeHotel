<?php
session_start(); // Iniciamos la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Mis reservas | CostaMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../index.css">
    <link rel="icon" type="image/x-icon" href="../Imagenes/LogoHotel.png">
</head>

<script>
    function confirmacionCancelacion(event) {
        event.preventDefault(); // Detiene el envío del formulario

        Swal.fire({
            title: 'Cancelar Reserva',
            text: '¿Estás seguro de que deseas cancelar la reserva?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Cancelar Reserva',
            cancelButtonText: 'Salir'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma la cancelación, se envía el formulario
                event.target.closest('form').submit();
            }
        });
    }
</script>

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
                    <a class="nav-link" href="../CerrarSesion.php">Cerrar sesión</a>
                  </li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <?php
    // Obtener el usuario actual
    $usuario = $_SESSION['dni_cliente'];

    // Consultar las reservas del usuario en la base de datos
    $link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");
    $query = "SELECT * FROM reservas WHERE dni_cliente = '$usuario'";
    $result = mysqli_query($link, $query);

    // Verificar si se encontraron reservas
    if (mysqli_num_rows($result) > 0) {
    ?>
        <div class="container">
            <?php
            if (isset($_SESSION['errorReserva'])) {
                echo "<p style='color:red;'>" . $_SESSION['errorReserva'] . "</p>";
                unset($_SESSION['errorReserva']);
            }
            if (isset($_SESSION['exitoReserva'])) {
                echo "<p style='color:green;'>" . $_SESSION['exitoReserva'] . "</p>";
                unset($_SESSION['exitoReserva']);
            }

            ?>
            <h2>Mis Reservas</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numero reserva</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>DNI asociado</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                        <th>Precio Total</th>
                        <th>Estado</th>
                        <th>Habitacion reservada</th>
                        <th>Extra</th>
                        <th>Cancelar reserva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Obtener la fecha actual
                        $fechaActual = date("Y-m-d");

                        // Comprobar si la reserva ya ha finalizado
                        if ($row['fecha_Salida'] < $fechaActual && $row['estado'] != "Finalizado") {
                            // Actualizar el estado de la reserva a "Finalizado"
                            $idReserva = $row['id_reserva'];
                            $queryActualizar = "UPDATE reservas SET estado = 'Finalizado' WHERE id_reserva = '$idReserva'";
                            mysqli_query($link, $queryActualizar);
                        }

                        // Obtener la información de la habitacion asociada a la reserva
                        $id_habitacion = $row['id_habitacion'];
                        $query_habitacion = "SELECT * FROM habitaciones WHERE id_habitacion = '$id_habitacion'";
                        $result_habitacion = mysqli_query($link, $query_habitacion);
                        $row_habitacion = mysqli_fetch_assoc($result_habitacion);

                        echo "<tr>";
                        echo "<td>" . $row['id_reserva'] . "</td>";
                        echo "<td>" . $_SESSION['nombre'] . "</td>";
                        echo "<td>" . $_SESSION['apellidos'] . "</td>";
                        echo "<td>" . $row['DNI_cliente'] . "</td>";
                        echo "<td>" . $row['fecha_entrada'] . "</td>";
                        echo "<td>" . $row['fecha_Salida'] . "</td>";
                        echo "<td>" . $row['precioTotal'] . "€</td>";
                        echo "<td>" . $row['estado'] . "</td>";
                        echo "<td>" . $row_habitacion['tipo'] . "</td>";
                        echo "<td><a href='informacion-reserva.php?id_reserva=" . $row['id_reserva'] . "&id_habitacion=" . $row['id_habitacion'] . "'>Más Información</a></td>";
                        // Verificar si el estado de la reserva es diferente a "Finalizado"
                        if ($row['estado'] != "Finalizado") {
                            echo "<td><form action='cancelar-reserva.php?id_reserva=" . $row['id_reserva'] . "' method='POST'><button class='btn btn-danger' type='submit' onclick='return confirmacionCancelacion(event)'>Cancelar</button></form></td>";
                        }

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo "<div class='container'>Todavía no has realizado ninguna reserva</div>";
    }

    // Cerrar la conexión con la base de datos
    mysqli_close($link);
    ?>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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