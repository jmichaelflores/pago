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
    <form action="inscripcion.php" method="POST">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Datos de la persona que se sometera al servicio (todos obligatorios)</h5><br>
            <h5 class="card-title text-center">Ingrese su Nombre:</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="Email address" name="nombre" required autofocus>
                <label for="inputEmail">Ingresar Nombre</label>
              </div>

              <h5 class="card-title text-center">Seleccione su edad</h5>
              <select name="edad" class="form-control">
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20 o más</option>
              </select><br>

              <h5 class="card-title text-center">Institucion Educativa</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputinstitucin" class="form-control" placeholder="Institucion address" name="institucion" required autofocus>
                <label for="inputinstitucion">Ingresar Institucion Educativa</label>
              </div>


              <h5 class="card-title text-center">Seleccione su edad</h5>
              <select name="grado" class="form-control">
                <option value="Noveno">Noveno</option>
                <option value="Primer año de Bachillerato General">Primer año de Bachillerato General</option>
                <option value="Primer año de Bachillerato Tecnico">Primer año de Bachillerato Tecnico</option>
                <option value="Segundo año de Bachillerato General">Segundo año de Bachillerato General</option>
                <option value="Segundo año de Bachillerato Tecnico">Segundo año de Bachillerato Tecnico</option>
                <option value="Tercer año de Bachillerato Tecnico">Tercer año de Bachillerato Tecnico</option>
              </select><br>
              <label for="inputinstitucion">Servicio que desea(Solo puede escoger 1)</label>
                  <select name="servicio"  class="form-control">
                    <option value="0">Seleccione una</option>;
                      <?php
                      require("conexion.php");
      
                      $conexion= $con->query('SELECT * FROM servicio');
        
                      foreach ($conexion as $row) {
        
                  echo '<option value="'. $row['idservicio'].'">'.$row['nombre_servicio'].'  '.$row['precio_servicio'].'</option>';
                  }
      
                  ?>
                  </select><br>

                <h5 class="card-title text-center">Correo Electronico</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputCorreo" class="form-control" placeholder="Correo address" name="correo" required autofocus>
                <label for="inputinstitucion">Ingresar Correo Electronico</label>
              </div>

              <h5 class="card-title text-center">Datos de la persona que pagara el servicio (todos obligatorios)</h5>
            <form class="form-signin">
              <h5 class="card-title text-center">Nombre</h5>
              <div class="form-label-group">
                <input type="text" id="inputNombre" class="form-control" placeholder="Nombre address" name="nombrepago" required autofocus>
                <label for="inputinstitucion">Ingresar Nombre</label>
              </div>

              <h5 class="card-title text-center">Correo Electronico</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputCorreo" class="form-control" placeholder="Correo address" name="correopago" required autofocus>
                <label for="inputinstitucion">Ingresar Correo Electronico</label>
              </div>

              <h5 class="card-title text-center">Telefono</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="text" id="inputtelefono" class="form-control" placeholder="Correo address" name="telefonopago" required autofocus>
                <label for="inputinstitucion">Ingresar Telefono</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="pagar" value="Pagar">Pagar</button>
              <hr class="my-4">
            </form>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>