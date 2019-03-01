<?php
session_start();

// Conexion a la base de datos
require_once('conexion.php');


//solo usuario	
if (isset($_POST['guardar'])){
	
	$fecha = $_POST['start'];
	$hora = $_POST['iniciotime'];
	$estado = 1;
	$idinscripciones = $_POST['idinscripciones'];
	$idsubservicios = $_POST['idsubservicios'];

	$today= date("Y-m-d", time() );

	if($fecha >= $today){

		$sql1 = "SELECT * FROM calendario ca
		INNER JOIN inscripciones ins 
		on ca.inscripciones_idinscripciones = ins.idinscripciones
		WHERE ca.subservicios_idsubservicios = $idsubservicios
		AND ca.hora ='$hora'
		AND ca.fecha ='$fecha'";

		$query1 = $con->prepare( $sql1 );
		$query1->execute();
		$count = $query1->rowCount();

		if($count == 0){

			$sql1 = "SELECT * FROM calendario ca
			INNER JOIN inscripciones ins 
			on ca.inscripciones_idinscripciones = ins.idinscripciones
			WHERE ca.subservicios_idsubservicios = $idsubservicios
			AND ca.inscripciones_idinscripciones = $idinscripciones
			AND ca.hora ='$hora'
			AND ca.fecha ='$fecha'";
		
			$query1 = $con->prepare( $sql1 );
			$query1->execute();
			$count2 = $query1->rowCount();


			if($count2==0){

				$sql = "INSERT INTO calendario ( fecha, hora, estado, inscripciones_idinscripciones, subservicios_idsubservicios) 
						VALUES ('$fecha','$hora', $estado, $idinscripciones, $idsubservicios)";
				
				$query = $con->prepare( $sql );


				if ($query->execute()) {
					header('Location: calendar.php?e=true');
				}
				else{
					header('Location: calendar.php?rr=true');
				}

			}
			else{
				header('Location: calendar.php?err=true');
			}
		}
		else{
			header('Location: calendar.php?er=true');
		}
	}else{
		header('Location: calendar.php?ter=true');
	}

}

//solo admin
if (isset($_POST['eliminar'])) {

	$id = $_POST['idcalendario'];
	
	$sql = "DELETE FROM calendario WHERE idcalendario = $id";

	$query = $con->prepare($sql);

	if($query->execute()){

		header('Location: calendar.php?d=true');
	}


}

//solo admin
if(isset($_POST['modificar'])){

	$fecha = $_POST['start'];
	$hora = $_POST['iniciotime'];
	$hora0 = $_POST['iniciotime0'];
	$idcalendario = $_POST['idcalendario'];
	$idservicio = $_POST['idservicio2'];

	$sql1 = ("SELECT * FROM calendario ca
	INNER JOIN inscripciones ins 
	on ca.inscripciones_idinscripciones = ins.idinscripciones
	WHERE ca.hora ='$hora'
	AND ca.fecha ='$fecha'");

	$query1 = $con->prepare($sql1);
	$query1->execute();
	$count = $query1->rowCount();

	if($count == 0){
	
		$sql = "UPDATE calendario SET  fecha = '$fecha', hora = '$hora' 
		WHERE idcalendario = $idcalendario";

		$query = $con->prepare( $sql );
		if ($query == false) {
		 print_r($con->errorInfo());
		 die ('Erreur prepare');
		}
		
		$sth = $query->execute();
		if ($sth == false) {
		 print_r($query->errorInfo());
		 die ('Erreur execute');
		}
		header('Location: calendar.php?m=true');
	}
	else{
		header('Location: calendar.php?err=true');
	}
}

?>
