<!DOCTYPE html>
<html lang="en">
<head>
	<title>Formulario de registro</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="inscripcion.php" id="RequisicionForm" method="post" >
				<span class="contact100-form-title">
					Datos de la persona que se sometera al servicio
				</span>

				<div class="wrap-input100">
					<span class="label-input100">Ingresar Nombre</span>
					<input class="input100" type="text" name="nombre" required ">
				</div>

				<div class="wrap-input100 rs1-wrap-input100 validate-input">
					<span class="label-input100">Edad</span>
					<select name="edad"  class="input100" style="padding: 18px;">
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20 o más</option>
              </select><br>
				</div>

				<div class="wrap-input100 rs1-wrap-input100 validate-input" >
					<span class="label-input100">Servicio que desea escoger</span>
                  <select name="servicio" class="input100" style="padding: 18px;">
                    <option value="0">Seleccione uno</option>;
                      <?php
                      require("conexion.php");
      
                      $conexion = $con->prepare('SELECT * FROM servicio');
                      $conexion->execute();
        
                      while ($row = $conexion->fetch() ) {
        
                  echo "<option value='$row[0]'> $row[1]</option>";
                  }
      
                  ?>
                  </select><br>

				</div>

				<div class="wrap-input100 rs1-wrap-input100 validate-input" >
					<span class="label-input100">Institucion Educativa</span>
					<input id="inputinstitucin" class="input100" type="text" placeholder="Nombre de la institucion" name="institucion">
					
				</div>

				<div class="wrap-input100 rs1-wrap-input100 validate-input" >
					<span class="label-input100">Seleccione grado</span>
					 <select name="grado"  class="input100" style="padding: 18px;">
                <option value="Noveno">Noveno</option>
                <option value="Primer año de Bachillerato General">Primer año de Bachillerato General</option>
                <option value="Primer año de Bachillerato Tecnico">Primer año de Bachillerato Tecnico</option>
                <option value="Segundo año de Bachillerato General">Segundo año de Bachillerato General</option>
                <option value="Segundo año de Bachillerato Tecnico">Segundo año de Bachillerato Tecnico</option>
                <option value="Tercer año de Bachillerato Tecnico">Tercer año de Bachillerato Tecnico</option>
              </select><br>
				</div>

				<div class="wrap-input100" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Correo Electronico</span>
					<input class="input100" id="inputCorreo" placeholder="Correo address" name="correo" required type="text" ">
				</div>

				<span class="contact100-form-title">
					Datos de la persona que pagara el servicio
				</span>
				<div class="wrap-input100" >
					<span class="label-input100">Ingresar Nombre</span>
					<input class="input100" type="text" name="nombrepago"  required ">
				</div>

					<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<span class="label-input100">Correo</span>
					<input class="input100" type="text" placeholder="Correo address" name="correopago" required>
					
				</div>

				<div class="wrap-input100 rs1-wrap-input100 validate-input" >
					<span class="label-input100">Telefono</span>
					<input class="input100" type="text" placeholder="Correo address" name="telefonopago" required>
				</div>

				
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" type="submit" name="pagar" value="Pagar">Pagar
						</button>
					</div>
				</div>
			</form>
		</div>

	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
