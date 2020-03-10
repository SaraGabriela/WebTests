<?php 
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
$txtTurno=(isset($_POST['txtTurno']))?$_POST['txtTurno']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$error=array();

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal=false;

include ("../conexion/conexion.php");

switch ($accion) {
	case 'btnAgregar':

		if($txtNombre==""){
			$error['nombre']="Escribe el nombre";
		}
		if($txtApellido==""){
			$error['apellido']="Escribe el apellido";
		}
		if($txtCorreo==""){
			$error['correo']="Escribe el correo";
		}
		if($txtTelefono==""){
			$error['telefono']="Escribe el telefono";
		}
		if($txtTurno==""){
			$error['turno']="Escribe el turno";
		}
		if(count($error)>0){
			$mostrarModal=true;
			break;
		}

		$sentencia=$pdo->prepare("INSERT INTO empleados(nombre,apellido,correo,telefono,turno) VALUES (:nombre,:apellido,:correo,:telefono,:turno)");

		$sentencia->bindParam(':nombre',$txtNombre);
		$sentencia->bindParam(':apellido',$txtApellido);
		$sentencia->bindParam(':correo',$txtCorreo);
		$sentencia->bindParam(':telefono',$txtTelefono);
		$sentencia->bindParam(':turno',$txtTurno);
		$sentencia->execute();

		header('Location: index.php');
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
		
		break;

	case 'btnEliminar':
		$sentencia=$pdo->prepare("DELETE FROM empleados WHERE id_empleado=:id_empleado");

		$sentencia->bindParam(':id_empleado',$txtID);
		$sentencia->execute();

		header('Location: index.php');

		break;

	case 'btnCancelar':
		header('Location: index.php');
		break;

	case 'Seleccionar':
		$accionAgregar="disabled";
		$accionModificar=$accionEliminar=$accionCancelar="";
		$mostrarModal=true;
	break;
}

		$sentencia = $pdo->prepare("SELECT * FROM `empleados` WHERE 1");
		$sentencia->execute();
		$listaEmpleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

		#print_r($listaEmpleados);
 ?>