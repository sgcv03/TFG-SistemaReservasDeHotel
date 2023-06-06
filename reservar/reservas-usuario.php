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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../index.css">
    <link rel="icon" type="image/x-icon" href="../Imagenes/LogoHotel.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img class="navbar-brand" src="../Imagenes/LogoHotelSinFondo.png" alt="Logo"></img>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <span class="navbar-text">
                    <img src="../Imagenes/banderaSpain.png" alt="Español" width="30" height="30" class="rounded-circle">
                </span>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Inicio</a>
                </li>
                <?php
                if (isset($_SESSION["loggedin"]) == true) {
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
            <h2>Mis Reservas</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numero reserva</th>
                        <th>DNI asociado</th>
                        <th>Fecha de Entrada</th>
                        <th>Fecha de Salida</th>
                        <th>Precio Total</th>
                        <th>Estado</th>
                        <th>Habitacion reservada</th>

                        <!-- Agrega aquí más columnas si lo necesitas -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Obtener la información de la habitacion asociada a la reserva
                        $id_habitacion = $row['id_habitacion'];
                        $query_habitacion = "SELECT * FROM habitaciones WHERE id_habitacion = '$id_habitacion'";
                        $result_habitacion = mysqli_query($link, $query_habitacion);
                        $row_habitacion = mysqli_fetch_assoc($result_habitacion);

                        echo "<tr>";
                        echo "<td>" . $row['id_reserva'] . "</td>";
                        echo "<td>" . $row['DNI_cliente'] . "</td>";

                        echo "<td>" . $row['fecha_entrada'] . "</td>";
                        echo "<td>" . $row['fecha_Salida'] . "</td>";
                        echo "<td>" . $row['precioTotal'] . "€</td>";
                        echo "<td>" . $row['estado'] . "</td>";
                        echo "<td>" . $row_habitacion['tipo'] . "</td>";

                        // Agrega aquí más columnas si lo necesitas
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

    // Cerrar la conexión a la base de datos
    mysqli_close($link);
    ?>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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