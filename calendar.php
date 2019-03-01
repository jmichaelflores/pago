<?php
session_start();
require_once('conexion.php');

if($_SESSION['tipousuario']=='usuario') {

$idinscripciones = $_SESSION['inscripciones_idinscripciones'];

$sql = "SELECT * FROM subservicios sb
inner join calendario ca
on sb.idsubservicios = ca.subservicios_idsubservicios";

$sqlsb = "SELECT * FROM subservicios sb
inner join servicio se
on sb.servicio_idservicio = se.idservicio
inner join inscripciones ins
on se.idservicio = ins.servicio_idservicio
WHERE ins.idinscripciones = $idinscripciones";

$sql2 = "SELECT * FROM inscripciones ins
inner join calendario ca
on ca.inscripciones_idinscripciones = ins.idinscripciones
WHERE ins.idinscripciones = $idinscripciones";

$req2 = $con->prepare($sql2);
$req2->execute();
$countcalendario = $req2->rowCount();


$req2 = $con->prepare($sqlsb);
$req2->execute();
$countsubservicio = $req2->rowCount();


}
elseif($_SESSION['tipousuario']=='administrador') {

$sql = "SELECT * FROM subservicios sb
inner join calendario ca
on sb.idsubservicios = ca.subservicios_idsubservicios";

}
else {
	header('Location: index.php?er=true');
}


$req = $con->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />


    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        
    }
	#calendar {
		max-width: 800px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}
    </style>
    <script type="text/javascript">
    	function validarHora(){
    		var h = document.getElementById('iniciotime').value;
    		alert(h);
    	}
    </script>


</head>

<body>
    <div class="container">
          <?php
        	if (isset($_GET['err']) || isset($_GET['er'])) {

        		echo ("<center>
        			<div class='alert alert-danger' role='alert'>
						  Ese horario ya se encuentra definido
						</div>
						</center>");
        	}
         ?>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Calendarización</h1>
                <p class="lead">Completa la fecha para agendar test, entrevista y talleres predefinidas que no tendrás que cambiar!</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- /.row -->

       <?php if($_SESSION['tipousuario']=='usuario' && $countcalendario != $countsubservicio){?>
		
		<!-- Modal Agregar-->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
			  </div>
			  <div class="modal-body">
				<input type="hidden" name="idinscripciones" class="form-control" 
					  id="title" placeholder="" value="<?php echo $idinscripciones; ?>">
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Servicio</label>
					<div class="col-sm-10">
					<select class="form-control" name="idsubservicios" id="idsubservicios">
					<?php
					$idinscripciones = $_SESSION['inscripciones_idinscripciones'];
					$sql2 = ("SELECT * FROM  subservicios sb 
						inner join servicio se
						on sb.servicio_idservicio = se.idservicio
						INNER JOIN inscripciones ins 
						on se.idservicio = ins.servicio_idservicio 
						where ins.idinscripciones = $idinscripciones");

						$query2 ="SELECT * FROM calendario ca
						inner join subservicios sb
						on ca.subservicios_idsubservicios = sb.idsubservicios
						WHERE ca.inscripciones_idinscripciones =$idinscripciones";

						$servicio = $con->prepare($query2);
						$servicio->execute();
						$servicios = $servicio->fetchAll();
						$x2=$servicio->rowCount();
						$req2 = $con->prepare($sql2);
						$req2->execute();
						//$req2->fetchAll();

						$x=0;
						while($row = $req2->fetch()){

							if($servicios[$x]['subservicio'] != $row['subservicio']){
	
								echo"<option value='".$row['idsubservicios']."'>".$row['subservicio']."</option>";
								
							}
							else{
								 $x++;
							}

							

						}
							 
							?>
					</select>
					
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Fecha</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Hora Inicio </label>
					<div class="col-sm-10">
					   <input type="time" id="title" name="iniciotime" min="7:00" max="14:00" step="3600" required>
					   <span class="note">Horario entre 7am y 4pm</span>
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
				<button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		<?php } 

		$en = $_SESSION['tipousuario'] === 'usuario' ? "disabled" : '' ;
		?>
		
		<!-- Modal Editar-->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Evento</h4>
			  </div>
			  <div class="modal-body">

				<input type="hidden" name="idcalendario" class="form-control" 
					  id="idcalendario" >

				<input type="hidden" name="idservicio2" class="form-control" 
					  id="idservicio2" >

				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Titulo</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Titulo" disabled="">
					</div>
				  </div>

				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Fecha</label>
					<div class="col-sm-10">
					  <input type="date" name="start" class="form-control" id="start" <?php echo "$en"; ?>>
					</div>
				  </div>

				 <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Hora Inicio </label>
					<div class="col-sm-10">
					   <input type="time" id="iniciotime" name="iniciotime" min="7:00" max="14:00" step="3600" <?php echo "$en"; ?>>
					   <span class="note">Horario (1 Hora Clase)</span>
					</div>
				  </div>

				  <div class="form-group">
					<div class="col-sm-10">
					   <input type="hidden" id="iniciotime0" name="iniciotime0" min="7:00" max="14:00" step="3600">
					</div>
				  </div>
				  

			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-sucess" data-dismiss="modal">Cerrar</button>
				<?php 
				if ($_SESSION['tipousuario']=='administrador') {
				echo "<button type='submit' class='btn btn-danger' name='eliminar' value='1'>Eliminar</button>
				<button type='submit' class='btn btn-primary' name='modificar'>Modificar</button>";
				}
				 ?>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.min.js'></script>
	<script src='js/fullcalendar/fullcalendar.js'></script>
	<script src='js/fullcalendar/locale/es.js'></script>
	
	
	<script>

	$(document).ready(function() {

		var date = new Date();
       var yyyy = date.getFullYear().toString();
       var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
       var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
		
		$('#calendar').fullCalendar({
			header: {
				 language: 'es',
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay',

			},
			defaultDate: yyyy+"-"+mm+"-"+dd,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD '));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD '));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #idcalendario').val(event.id);
					$('#ModalEdit #idservicio2').val(event.idservicio);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #start').val(moment(event.start).format('YYYY-MM-DD'));
					$('#ModalEdit #iniciotime').val(moment.utc(event.start).format('HH:mm'));
					$('#ModalEdit #iniciotime0').val(moment.utc(event.start).format('HH:mm'));
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position
				edit(event);
			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php 

			foreach($events as $event):

				if($_SESSION['tipousuario']=='administrador'){
			?>
				{
					id: "<?php echo $event['idcalendario']; ?>",
					idservicio: "<?php echo $event['idsubservicios']; ?>",
					title: "<?php echo $event['subservicio']; ?>",
					start: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
					end: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
					color: "#0071c5",
				},
			<?php 
		}

		else{

			if($_SESSION['tipousuario']=='usuario' && $event['inscripciones_idinscripciones']==$_SESSION['inscripciones_idinscripciones']){?>
					{	id: "<?php echo $event['idcalendario']; ?>",
						idservicio: "<?php echo $event['idsubservicios']; ?>",
						title: "<?php echo $event['subservicio']; ?>",
						start: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
						end: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
						color: "#0071c5",
					},
				<?php
				}
				else if($event['inscripciones_idinscripciones']!=$_SESSION['inscripciones_idinscripciones']){?>
				{	id: "<?php echo $event['idcalendario']; ?>",
					idservicio: "<?php echo $event['idsubservicios']; ?>",
					title: "<?php echo 'RESERVADO'; ?>",
					start: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
					end: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
					color: "#cc0000",
				},
				<?php
				}
				else{?>
				{	id: "<?php echo $event['idcalendario']; ?>",
					idservicio: "<?php echo $event['idsubservicios']; ?>",
					title: "<?php echo 'LIBRE'; ?>",
					start: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
					end: "<?php echo $event['fecha'].' '.$event['hora']; ?>",
					color: "##298A08",
				},

	<?php } 
		}
		endforeach; ?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Evento se ha guardado correctamente');
					}else{
						alert('No se pudo guardar. Inténtalo de nuevo.'); 
					}
				}
			});
		}
		
	});

</script>

</body>

</html>
