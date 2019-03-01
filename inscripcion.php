<?php 
	require("conexion.php");

 if(isset($_POST['pagar']))
    {    

	$nombre =$_POST['nombre'];
	$edad =$_POST['edad'];
	$institucion =$_POST['institucion'];
	$grado =$_POST['grado'];
	$servicio =$_POST['servicio'];
	$correo =$_POST['correo'];
	$nombrepago =$_POST['nombrepago'];
	$correopago =$_POST['correopago'];
	$telefonopago =$_POST['telefonopago'];

	$sql=$con->prepare("INSERT INTO inscripciones(nombre, edad,institucion, grado, correo,nombre_pago,correo_pago,telefono_pago,servicio_idservicio) 
		VALUES (:nombre, :edad, :institucion,:grado, :correo, :nombrepago, :correopago, :telefonopago, :idserivio)");
    $sql->bindParam(':nombre',$nombre);
    $sql->bindParam(':edad',$edad);
    $sql->bindParam(':institucion',$institucion);
    $sql->bindParam(':grado',$grado);
    $sql->bindParam(':correo',$correo);
    $sql->bindParam(':nombrepago',$nombrepago);
    $sql->bindParam(':correopago',$correopago);
    $sql->bindParam(':telefonopago',$telefonopago);
    $sql->bindParam(':idserivio',$servicio);
//echo "Tiene un dia para pagar la bolate, de no realizarse se perdera su inscripcion, y ya pagada podra realizar la calendaazacion de su actividad por la noche del dia en que pago, colocando el NPE que posee esta boleta";
//echo "<form action='index.php'><input onclick='location='index.php'' type='submit' name='inicio' value='Inicio'></form> ";
	if($sql->execute()){
		$fecha_emision= date("Y-m-d", time() );
		$diaensegundos=24*60*60;
		$fecha_limite=date("Y-m-d", time() + $diaensegundos);
		$NPE = 000123;
		$estado=0;
		$servicio='';
		$precio=0;
	
			$consulta =$con->prepare("INSERT INTO boleta(fecha_emision,fecha_limite,NPE,estado,inscripciones_idinscripciones) 
				VALUES(:fecha_emision,:fecha_limite,:NPE,:estado,LAST_INSERT_ID())");
			$consulta->bindParam(':fecha_emision',$fecha_emision);
			$consulta->bindParam(':fecha_limite',$fecha_limite);
			$consulta->bindParam(':NPE',$NPE);
			$consulta->bindParam(':estado',$estado);

			if($consulta->execute()){

				$conexion = $con->query('SELECT * FROM boleta bo 
										inner join inscripciones ins
										on ins.idinscripciones = bo.inscripciones_idinscripciones
										inner join servicio se
										on ins.servicio_idservicio = se.idservicio
										where ins.idinscripciones = LAST_INSERT_ID()');

				$conexion->execute();
				$resultado2=$conexion->fetchAll();

				foreach ($resultado2 as $row) {
					$fecha_emision2 = $row['fecha_emision'];
					$fecha_limite2 = $row['fecha_limite'];
					$NPE2=$row['NPE'];
					$servicio = $row['nombre_servicio'];
					$precio = $row['precio_servicio'];
					$estado2 = $row['estado'];
					$idinscripciones2 = $row['inscripciones_idinscripciones']; 
				}
				include 'mpdf/mpdf.php';

				//Todas las las variables que se pueden utilizar
				//solo se tiene que dar estilo y poner donde sea necesario
				/*			<td>$nombre<td>
							<td>$edad<td>
							<td>$institucion<td>
							<td>$grado<td>
							<td>$servicio<td>
							<td>$correo<td>
							<td>$nombrepago<td>
							<td>$correopago<td>
							<td>$telefonopago<td>*/


				$content ="
				<h1>BOLETA DE PAGO</h1>
					<table>
					<thead>
						<tr>
							<th>Nombre<th>
							<th>Fecha Emision<th>
							<th>Fecha Limite<th>
							<th>Servicio<td>
							<th>Total a Pagar<th>
							<th>NPE<th>
						<tr>
					</thead>
					<tbody>
						<tr>
							<td>$nombre<td>
							<td>$fecha_emision2<td>
							<td>$fecha_limite2<td>
							<td>$servicio<td>
							<td>$precio<td>
							<td>$NPE2<td>
						<tr>
					</tbody>
				</table>";
				
				$mpdf = new mPDF('utf-8', 'A4',0,'',5,5,10,0,0,0,'P');

				//EJEMPLOS DE COMO INCLUIR UN ARCHIVO CSS
				/*
				$stylesheet= file_get_contents('Classes/purchaseOrder.css');
				$stylesheet2 = file_get_contents('pdfComparativa.css');*/
				
				$mpdf ->WriteHTML($content,2);
				$mpdf ->Output();
				exit;
			}
			else{
				echo "NO";
			}

	}
	else{
		echo "NO";
	}

}

 ?>
