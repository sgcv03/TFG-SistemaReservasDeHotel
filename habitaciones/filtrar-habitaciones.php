<?php
session_start();
?>
<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Resultado Habitaciones | CostaMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../index.css">
    <link rel="icon" type="image/x-icon" href="../Imagenes/LogoHotel.png">
</head>

<!--Script para mantener las fechas introducidas-->
<script>
    // Esperar a que la página se cargue
    window.addEventListener('DOMContentLoaded', function() {
        // Obtener los campos de fechas
        var fechaEntradaInput = document.getElementById('fechaEntrada');
        var fechaSalidaInput = document.getElementById('fechaSalida');

        // Obtener los valores de las fechas ingresadas
        var fechaEntrada = '<?php echo isset($_GET["fechaEntrada"]) ? $_GET["fechaEntrada"] : "" ?>';
        var fechaSalida = '<?php echo isset($_GET["fechaSalida"]) ? $_GET["fechaSalida"] : "" ?>';

        // Asignar los valores a los campos de fechas
        fechaEntradaInput.value = fechaEntrada;
        fechaSalidaInput.value = fechaSalida;
    });
</script>

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


    <table class="table table-striped">
        <tbody>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_hotel'])) {
                $id_hotel = $_GET['id_hotel'];

                $link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");
                $query = "SELECT * FROM hoteles WHERE id_hotel = '$id_hotel'";
                $result = mysqli_query($link, $query);

                // Verificar si se encontraron resultados
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td style='width: 400px; text-align: center; vertical-align: middle;'><img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' class='img-thumbnail' style='width: 150px; height: 150px;' alt='Imagen del hotel'></td>";
                        echo "<td>";
                        echo "<h3><i>" . $row['nombre'] . "</i></h3>";
                        echo "<p><strong>Dirección:</strong> " . $row['direccion'] . "</p>";
                        echo "<p><strong>Ciudad:</strong> " . $row['ciudad'] . "</p>";
                        echo "<p><strong>País:</strong> " . $row['pais'] . "</p>";
                        echo "<p><strong>Categoría:</strong> " . $row['categoria'] . "</p>";
                        echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                        echo "<p><strong>Teléfono:</strong> " . $row['telefono'] . "</p>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No se encontraron resultados.</td></tr>";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($link);
            } else {
                echo "<tr><td colspan='3' class='text-center'>Error al procesar la solicitud.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <div class="container">
        <h2>Introduce las fechas de estancia</h2>
        <form action="" method="GET">
            <input type="hidden" name="id_hotel" value="<?php echo $_GET['id_hotel']; ?>">
            <div class="form-group">
                <label for="fechaEntrada">Fecha de Entrada:</label>
                <input type="date" id="fechaEntrada" name="fechaEntrada" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="fechaSalida">Fecha de Salida:</label>
                <input type="date" id="fechaSalida" name="fechaSalida" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        <br>
        <div id="habitaciones">
            <?php
            $filtroCorrecto = false;

            // Verificar si se ha enviado el formulario de filtrado
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fechaEntrada']) && isset($_GET['fechaSalida']) && isset($_GET['id_hotel'])) {
                // Obtener las fechas de entrada y salida del formulario
                $fechaEntrada = $_GET['fechaEntrada'];
                $fechaSalida = $_GET['fechaSalida'];
                $_SESSION['fechaEntrada'] = $fechaEntrada;
                $_SESSION['fechaSalida'] = $fechaSalida;

                $_SESSION['id_hotel'] = $_GET['id_hotel'];
                $id_hotel = $_GET['id_hotel'];

                // Realizar la consulta a la base de datos para obtener las habitaciones disponibles del hotel específico
                $link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");
                $query = "SELECT * FROM habitaciones WHERE id_hotel = '$id_hotel'";

                // Si se proporcionan las fechas de entrada y salida, se filtran las habitaciones disponibles para esas fechas
                if (!empty($fechaEntrada) && !empty($fechaSalida) && $fechaEntrada <= $fechaSalida) {
                    $query .= " AND id_habitacion NOT IN (
            SELECT id_habitacion FROM reservas
            WHERE (fecha_entrada <= '$fechaEntrada' AND fecha_salida >= '$fechaEntrada')
            OR (fecha_entrada <= '$fechaSalida' AND fecha_salida >= '$fechaSalida')
            OR (fecha_entrada >= '$fechaEntrada' AND fecha_salida <= '$fechaSalida')
        )";
                } else {
                    echo "La fecha de entrada no puede ser posterior a la fecha de salida";
                    exit();
                }

                $result = mysqli_query($link, $query);

                // Verificar si se encontraron habitaciones disponibles
                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='habitaciones-list'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Mostrar la información de las habitaciones disponibles
                        echo "<br>";
                        echo "<hr>";
                        echo "<h3>" . $row['tipo'] . "</h3>";
                        echo "<p>" . $row['descripcion'] . "</p>";
                        echo "<div class='habitacion'>";
                        echo "<div class='habitacion-imagen'>";
                        echo "<img src='data:image/jpeg;base64, " . base64_encode($row['imagen']) . "' style='width: 400px;' class='img-thumbnail' alt='Imagen habitacion'>";
                        echo "</div>";
                        echo "<div class='habitacion-info'>";
                        echo "<p><strong>Precio por noche:</strong> " . $row['precioNoche'] . "€</p>";
                        // Verificar si el usuario ha iniciado sesión
                        if (isset($_SESSION['loggedin'])) {
                            // Si el usuario ha iniciado sesión, proceder con la reserva de la habitación
                            echo "<a href='../reservar/reservar.php?id_habitacion=" . $row['id_habitacion'] . "' class='btn btn-primary'>Reservar</a>";
                        } else {
                            // Si no ha iniciado sesión, le redirige a la página de login
                            echo "<a href='../login/login.php' class='btn btn-primary'>Reservar</a>";
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No se encontraron habitaciones disponibles para las fechas seleccionadas.</p>";
                }

                // Cerrar la conexión a la base de datos
                mysqli_close($link);
            }
            ?>


        </div>

    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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

</html>