<?php session_start();
	
require("conexion.php");
if (isset($_POST['NPE'])) {
	$NPE =$_POST['NPE'];

$conexion= $con->prepare("SELECT * FROM boleta bo
						INNER JOIN inscripciones ins
						on bo.inscripciones_idinscripciones = ins.idinscripciones
						INNER JOIN servicio se
						on se.idservicio = ins.servicio_idservicio 
						WHERE bo.NPE = '$NPE'");
$conexion->execute();
$resultado=$conexion->fetchAll();
if($conexion->rowCount()==1){				
			foreach ($resultado as $row) {
				$_SESSION['tipousuario']='usuario';
				$_SESSION['NPE'] = $row['NPE'];
				$_SESSION['inscripciones_idinscripciones']=$row['inscripciones_idinscripciones'];
				$_SESSION['idservicios'] = $row['servicio_idservicio'];
				}	
				header('Location: calendar.php');
			}

			else{
				header('Location: index.php?er=true');
			}
}

if(isset($_POST['login'])){
$usuario= $_POST['usuario'];	
$password=$_POST['password'];

	
$admin= $con->prepare("SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'");
$admin->execute();
$salida=$admin->fetchAll();
if($admin->rowCount()==1){				
	foreach ($salida as $row) {
		$_SESSION['tipousuario']='administrador';
		$_SESSION['NPE'] = $row['NPE'];
		$_SESSION['inscripciones_idinscripciones']=$row['inscripciones_idinscripciones'];
		}	
		header('Location: calendar.php');
		/*$tipo=$_SESSION['tipousuario'];
		$npe=$_SESSION['NPE'];
		echo $tipo;*/
	}

	else{
		header('Location: index.php?er=true');
	}
}


			




 ?>