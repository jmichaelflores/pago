<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="Boobstrap/bootstrap.min.css">
</head>
<body>
  <?php
          if (isset($_GET['er'])) {

            echo ("<center>
              <div class='alert alert-danger' role='alert'>
              NPE incorrecto!!! :(
            </div>
            </center>");
          }
         ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
          	 <form action="validacionindex.php" method="POST" class="form-signin">
            <h5 class="card-title text-center">Consejeria de Carrera</h5>
            <h5 class="card-title text-center">Ingrese el NPE de su boleta de pago para acceder a su calendario</h5>
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="NPE" required name="NPE">
                <label for="inputEmail">Ingresar NPE</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Entrar">Entrar</button>
              <hr class="my-4">
              </form>
              <form action="form2.php" class="form-signin">
                <h5 class="card-title text-center">Si no cuenta con un NPE escoja cualquiera de las siguientes opciones</h5>
              <button onclick="location='form2.php'" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="Inscribirse" value="Inscribirse">Inscribirse</button>
              <hr class="my-4">
            </form>


              <!--
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Contraseña</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Recordar contraseña</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Ingresar</button>
              <hr class="my-4">
            -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
             <!--<form action="loginadmin.php">
              <button onclick="location='loginadmin.php'" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="login">Login</button>
              <hr class="my-4">
            </form>-->
</body>