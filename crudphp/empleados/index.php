<?php 
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
$txtTurno=(isset($_POST['txtTurno']))?$_POST['txtTurno']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include ("../conexion/conexion.php");

switch ($accion) {
	case 'btnAgregar':

		$sentencia=$pdo->prepare("INSERT INTO empleados(nombre,apellido,correo,telefono,turno) VALUES (:nombre,:apellido,:correo,:telefono,:turno)");

		$sentencia->bindParam(':nombre',$txtNombre);
		$sentencia->bindParam(':apellido',$txtApellido);
		$sentencia->bindParam(':correo',$txtCorreo);
		$sentencia->bindParam(':telefono',$txtTelefono);
		$sentencia->bindParam(':turno',$txtTurno);
		$sentencia->execute();

		echo "Presionaste btnAgregar";
		break;

	case 'btnModificar':

		$sentencia=$pdo->prepare("UPDATE empleados SET nombre=:nombre,apellido=:apellido,correo=:correo,telefono=:telefono,turno=:turno WHERE id_empleado=:id_empleado");


		$sentencia->bindParam(':nombre',$txtNombre);
		$sentencia->bindParam(':apellido',$txtApellido);
		$sentencia->bindParam(':correo',$txtCorreo);
		$sentencia->bindParam(':telefono',$txtTelefono);
		$sentencia->bindParam(':turno',$txtTurno);
		$sentencia->bindParam(':id_empleado',$txtID);
		$sentencia->execute();

		header('Location: index.php');
		echo "Presionaste btnModificar";
		break;

	case 'btnEliminar':
		$sentencia=$pdo->prepare("DELETE FROM empleados WHERE id_empleado=:id_empleado");

		$sentencia->bindParam(':id_empleado',$txtID);
		$sentencia->execute();

		header('Location: index.php');

		echo "Presionaste btnEliminar";
		break;

	case 'btnCancelar':
		echo $txtID;
		echo "Presionaste btnCancelar";
		break;
}

		$sentencia = $pdo->prepare("SELECT * FROM `empleados` WHERE 1");
		$sentencia->execute();
		$listaEmpleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

		#print_r($listaEmpleados);
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CRUD</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
	<form action="" method="post">
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Empleado</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div class="form-row">
		        	<input type="hidden" required name="txtID" value="<?php echo $txtID; ?>" placeholder="" id="txt1" require="">
				<div class="form-group col-md-6">
				<label for="">Nombre:</label>
				<input type="text" class="form-control" required name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="" id="txt2" require="">
				<br>
				</div>
				<div class="form-group col-md-6">
				<label for="">Apellido:</label>
				<input type="text" class="form-control" required name="txtApellido" value="<?php echo $txtApellido; ?>" placeholder="" id="txt3" require="">
				<br>
				</div>
				<div class="form-group col-md-12">
				<label for="">Correo:</label>
				<input type="email" class="form-control" required name="txtCorreo" value="<?php echo $txtCorreo; ?>" placeholder="" id="txt4" require="">
				<br>
				</div>
				<div class="form-group col-md-12">
				<label for="">Telefono:</label>
				<input type="text" class="form-control" required name="txtTelefono" value="<?php echo $txtTelefono; ?>" placeholder="" id="txt5" require="">
				<br>
				</div>
				<div class="form-group col-md-12">
				<label for="">Turno:</label>
				<input type="text" class="form-control" required name="txtTurno" value="<?php echo $txtTurno; ?>" placeholder="" id="txt6" require="">
				<br>
				</div>
		        </div>
		      </div>
		      <div class="modal-footer">
		      	<button value="btnAgregar" class="btn btn-success" type="submit" name="accion">Agregar</button>
				<button value="btnModificar" class="btn btn-warning" type="submit" name="accion">Modificar</button>
				<button value="btnEliminar" class="btn btn-danger" type="submit"  name="accion">Eliminar</button>
				<button value="btnCancelar" class="btn btn-primary" type="submit" name="accion">Cancelar</button>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
		  Agregar registro
		</button>


	</form>

	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Nombre Completo</th>
					<th>Correo</th>
					<th>Telefono</th>
					<th>Turno</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<?php foreach ($listaEmpleados as $empleado) {  ?>
				<tr>
					<td><?php echo $empleado['nombre']; ?> <?php echo $empleado['apellido']; ?></td>
					<td><?php echo $empleado['correo']; ?></td>
					<td><?php echo $empleado['telefono']; ?></td>
					<td><?php echo $empleado['turno']; ?></td>
					<td>
						<form action="" method="post">
							<input type="hidden" name="txtID" value="<?php echo $empleado['id_empleado']; ?>">
							<input type="hidden" name="txtNombre" value="<?php echo $empleado['nombre']; ?>">
							<input type="hidden" name="txtApellido" value="<?php echo $empleado['apellido']; ?>">
							<input type="hidden" name="txtCorreo" value="<?php echo $empleado['correo']; ?>">
							<input type="hidden" name="txtTelefono" value="<?php echo $empleado['telefono']; ?>">
							<input type="hidden" name="txtTurno" value="<?php echo $empleado['turno']; ?>">

							<input type="submit" value="Seleccionar" name="accion">
							<button value="btnEliminar" type="submit" name="accion">Eliminar</button>
						</form>
						
					</td>
				</tr>
			<?php	}  ?>
		</table>
	</div>
</div>
</body>
</html>