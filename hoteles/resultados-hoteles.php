<?php
session_start(); // Iniciamos la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Hoteles | CostaMS</title>
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

    <table class="table table-striped">
        <tbody>
            <?php
            // Verificar si se ha enviado el formulario de búsqueda
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pais']) && isset($_GET['categoria'])) {
                // Obtener los parámetros de búsqueda
                $pais = $_GET['pais'];
                $categoria = $_GET['categoria'];

                // Realizar la consulta a la base de datos para obtener los hoteles filtrados
                $link = mysqli_connect("localhost", "id20778320_root", "Mapirase03!", "id20778320_tfg_hoteles");
                $query = "SELECT * FROM hoteles WHERE pais = '$pais' AND categoria = '$categoria'";
                $result = mysqli_query($link, $query);

                // Verificar si se encontraron resultados
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td style='width: 400px; text-align: center; vertical-align: middle;'><img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' class='img-thumbnail' style='width: 300px; height: 300px;' alt='Imagen del hotel'></td>";
                        echo "<td>";
                        echo "<h3><i>" . $row['nombre'] . "</i></h3> ";
                        echo "<p><strong>Dirección:</strong> " . $row['direccion'] . "</p>";
                        echo "<p><strong>Ciudad:</strong> " . $row['ciudad'] . "</p>";
                        echo "<p><strong>País:</strong> " . $row['pais'] . "</p>";
                        echo "<p><strong>Categoría:</strong> " . $row['categoria'] . "</p>";
                        echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                        echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                        echo "<p><strong>Teléfono:</strong> " . $row['telefono'] . "</p>";
                        echo "</td>";
                        echo "<td style='text-align: center; vertical-align: middle;'>";
                        echo "<a href='../habitaciones/filtrar-habitaciones.php?id_hotel=" . $row['id_hotel'] . "' class='btn btn-primary'>Ver habitaciones</a>";
                        echo "</td>";
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


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Contáctanos</h4>
                    <p><i class="fas fa-phone"></i> Teléfono: +34 123 456 789</p>
                    <p><i class="fas fa-envelope"></i> Email: tfg.costams@gmail.com</p>
                </div>
                <div class="col-md-4">
                    <h4>Redes Sociales</h4>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <ion-icon name="logo-instagram"></ion-icon>
                        <li><a href="https://www.instagram.com/costamsreservadehoteles/"><i class="fab fa-instagram"></i> Instagram</a></li>
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