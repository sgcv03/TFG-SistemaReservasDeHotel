<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Inicio de sesión | CostaMS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="login.css">
  <link rel="icon" type="image/x-icon" href="../Imagenes/LogoHotel.png">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<style>

</style>

<!--Barra de navegacion-->
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="navbar-brand" src="../Imagenes/LogoHotelSinFondo.png" alt="Logo"></img>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <span class="navbar-text">
          <img src="../Imagenes/banderaSpain.png" alt="Bandera España" width="30" height="30" class="rounded-circle">
        </span>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Inicio</a>
        </li>

    </div>
  </nav>

  <br><br>

  <!--Formulario-->
  <div class="login-container">
    <div class="login-form">
      <?php
      if (isset($_SESSION['error'])) {
        echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
      }
      ?>
      <form action="login-form.php" method="post">
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
          <input type="text" class="form-control" name="usuario" placeholder="Usuario" required="required">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Contraseña" required="required">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block" onclick="">Log in</button>
        </div>
        <div class="clearfix">
          <label class="float-left form-check-label"><input type="checkbox"> Recuerdame</label>
          <a href="#" class="float-right">¿Has olvidado la contraseña?</a>
        </div>
      </form>
      <p class="text-center"><a href="../registrar/registrar.php">Crea una cuenta</a></p>
    </div>
  </div>

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  
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