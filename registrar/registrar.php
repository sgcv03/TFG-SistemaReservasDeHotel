<?php 
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Crea una cuenta | CostaMS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../index.css">
  <link rel="icon" type="image/x-icon" href="../Imagenes/LogoHotel.png">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<script>
  function confirmacionRegistro(){
    var respuesta = confirm("¿Deseas registrarte con los datos introducidos?")
    if (respuesta == true){
      return true;
    }else{
      return false;
    }
  }
</script>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="navbar-brand" src="../Imagenes/LogoHotelSinFondo.png" alt="Logo"></img>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <span class="navbar-text">
          <img src="../Imagenes/banderaSpain.png" alt="Español" width="30" height="30" class="rounded-circle">
        </span>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Inicio</a>
        </li>
        <li class="nav-item navbar-expand">
          <a class="nav-link btn btn-outline-primary" href="../login/login.php">Iniciar sesión</a>
        </li>
    </div>
  </nav>

  <div class="container">
      <h2 class="text-center">Crea una cuenta</h2>
    <?php
    
    if (isset($_SESSION['error'])) {
      echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
      unset($_SESSION['error']);
    }
    ?>
    <form method="post" action="registrar-form.php">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Ejemplo: Alberto" required>
          </div>
          <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" placeholder="Ejemplo: Martinez García" required>
          </div>
          <div class="form-group">
            <label  for="apellidos">DNI</label>
            <input type="text" class="form-control" name="dni" placeholder="Ejemplo: 12345678P" required>
          </div>
          <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" name="usuario" placeholder="Ejemplo: Alberto_123" required>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Ejemplo: k0Lp!43M?" required>
          </div>
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" name="email" placeholder="Ejemplo: CostaMS@gmail.com" required>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono de contacto</label>
            <input type="telefono" class="form-control" name="telefono" placeholder="Ejemplo: +34 623 45 83 51" required>
          </div>
          <div class="form-group">
            <label  for="direccion">Dirección</label>
            <input type="direccion" class="form-control" name="direccion" placeholder="Ejemplo: Calle Amapola, Nº 13" required>
          </div>
          <div class="form-group">
            <button id="botonRegistrar" type="submit" name="submit" class="btn btn-primary btn-block" onclick="return confirmacionRegistro()">Registrame</button>
          </div>
    </form>
  </div>

  <br><br><br>
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