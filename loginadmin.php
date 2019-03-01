<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="Boobstrap/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <form action="validacionindex.php" method="POST">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Ingresar</h5>
            <form class="form-signin">
              
              <form action="validacionindex.php" method="POST">
              <div class="form-label-group">
                <input type="text" name="usuario" id="Usuario" class="form-control" placeholder="Usuario" required autofocus>
                <label for="Usuario">Ingresar Usuario</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password"  id="inputPassword" class="form-control" placeholder="Contraseña" required>
                <label for="inputPassword">Contraseña</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login" value="Login">Iniciar Sesion</button>
              <hr class="my-4">
            </form>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>