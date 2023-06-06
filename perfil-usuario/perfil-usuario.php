<?php 
 session_start();
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Mi Perfil | CostaMS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../index.css">
  <link rel="icon" type="image/x-icon" href="../Imagenes/LogoHotel.png">
</head>

<script>
  function confirmacionModificacion(event) {
        event.preventDefault(); // Detiene el envío del formulario
        
        Swal.fire({
            title: 'Modificar datos',
            text: '¿Estás seguro de que deseas modificar los datos?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Guardar cambios',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma la baja, se envía el formulario
                event.target.closest('form').submit();
            }
        });
    }

  function confirmacionBaja(event) {
        event.preventDefault(); // Detiene el envío del formulario
        
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro de que deseas darte de baja? Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Darse de baja',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma la baja, se envía el formulario
                event.target.closest('form').submit();
            }
        });
    }
</script>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="navbar-brand" src="../Imagenes/LogoHotelSinFondo.png" alt="Logo"></img>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
          if(isset($_SESSION["loggedin"]) == true){ 
            echo '<li class="nav-item">
            <a class="nav-link" href="../reservar/reservas-usuario.php">Mis Reservas</a>
          </li>
            <li class="nav-item">
                    <a class="nav-link" href="../CerrarSesion.php">Cerrar sesión</a>
                  </li>';
          } 
        ?>
      </ul>
    </div>
  </nav>


  <div class="container">
    <h1>Mis datos</h1>
    <?php
    if (isset($_SESSION['error'])) {
      echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
      unset($_SESSION['error']);
    }
    if (isset($_SESSION['exito'])) {
      echo "<p style='color:green;'>" . $_SESSION['exito'] . "</p>";
      unset($_SESSION['exito']);
    }

    ?>
    <form method="post" action="modificar-usuario.php">
        <div class="form-group">
            <label for="nombre">Nombre actual:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $_SESSION["nombre"] ?>" readonly>
            <br>
            <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" placeholder="Nuevo nombre">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos actual:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $_SESSION["apellidos"] ?>" readonly>
            <br>
            <input type="text" class="form-control" id="apellidos-value" name="nuevoApellidos" placeholder="Nuevos apellidos" >
        </div>

        <div class="form-group">
            <label for="usuario">Usuario actual:</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION["usuario"] ?>" readonly>
            <br>
            <input type="text" class="form-control" id="usuario-value" name="nuevoUsuario" placeholder="Nuevo usuario">
        </div>

        <div class="form-group">
            <label for="dni_cliente">DNI actual:</label>
            <input type="text" class="form-control" id="dni_cliente" name="dni" value="<?php echo $_SESSION["dni_cliente"] ?>"  readonly>
            <br>
            <input type="text" class="form-control" id="dni_cliente-value" name="nuevoDni" placeholder="Nuevo DNI">
        </div>

        <div class="form-group">
            <label for="contraseña">Contraseña actual:</label>
            <input type="password" class="form-control" id="contraseña" name="contraseña" value="<?php echo $_SESSION["contraseña"] ?>"  readonly>
            <br>
            <input type="password" class="form-control" id="contraseña-value" name="nuevaContraseña" placeholder="Nueva contraseña">
        </div>

        <div class="form-group">
            <label for="email">Email actual:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION["email"] ?>"  readonly>
            <br>
            <input type="email" class="form-control" id="email-value" name="nuevoEmail" placeholder="Nuevo email">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono actual:</label>
            <input type="telefono" class="form-control" id="telefono" name="telefono" value="<?php echo $_SESSION["telefono"] ?>" readonly>
            <br>
            <input type="telefono" class="form-control" id="telefono-value" name="nuevoTelefono" placeholder="Nuevo teléfono">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección actual:</label>
            <input type="direccion" class="form-control" id="direccion" name="direccion" value="<?php echo $_SESSION["direccion"] ?>"  readonly>
            <br>
            <input type="direccion" class="form-control" id="direccion-value" name="nuevaDireccion" placeholder="Nueva dirección">
        </div>

        <button type="submit" class="btn btn-primary" onclick="confirmacionModificacion(event)">Guardar Cambios</button>
    </form>
</div>

<br>
<hr>
<div class="container">
    <h1>Darse de baja</h1>
    <form method="post" action="darse-de-baja.php">
        <p>¿Estás seguro de que deseas darte de baja de la aplicación? Todos tus datos serán eliminados y no podrás recuperarlos.</p>
        <button type="submit" class="btn btn-danger" onclick="confirmacionBaja(event)">Darse de baja</button>
    </form>
</div>


<br><br><br><br><br><br><br><br><br> 

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