<?php
include("conexion.php");
$fecha_creacion = date('Y-m-d');
$fechaHora = date('Y-m-d h:i:s');
$asunto = $_POST['asunto'];

	if($asunto=='crear'){
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];
		$sql1 = "SELECT * FROM funcionario WHERE Email = '$email'";
		$proceso1 = mysqli_query($conexion,$sql1);
		$contador1 = mysqli_num_rows($proceso1);
		if($contador1>0){
			$datos = [
				"estatus"	=> "error",
				"msg"	=> "Ya existe dicho email",
			];
			echo json_encode($datos);
			exit;
		}
		$sql2 = "SELECT * FROM funcionario WHERE usuario = '$usuario'";
		$proceso2 = mysqli_query($conexion,$sql2);
		$contador2 = mysqli_num_rows($proceso2);
		if($contador2>0){
			$datos = [
				"estatus"	=> "error",
				"msg"	=> "Ya existe dicho usuario",
			];
			echo json_encode($datos);
			exit;
		}
		
		$sql3 = "INSERT INTO funcionario (Nombre,Apellido,Email,Telefono,FechaRegistro,usuario,contrasena) VALUES ('$nombre','$apellido','$email','$telefono','$fecha_creacion','$usuario','$password')";
		$proceso3 = mysqli_query($conexion,$sql3);

		$datos = [
			"estatus"	=> "ok",
			"msg" => "Se ha creado satisfactoriamente",
		];
		echo json_encode($datos);
	}

	if($asunto=='consultar'){
		$id = $_POST['id'];
		$sql1 = "SELECT * FROM funcionario WHERE FuncionarioID = ".$id;
		$proceso1 = mysqli_query($conexion,$sql1);
		while($row1=mysqli_fetch_array($proceso1)){
			$id = $row1["FuncionarioID"];
			$nombre = $row1["Nombre"];
			$apellido = $row1["Apellido"];
			$email = $row1["Email"];
			$telefono = $row1["Telefono"];
			$fechaRegistro = $row1["FechaRegistro"];
			$usuario = $row1["usuario"];
		}

		$datos = [
			"estatus"	=> "ok",
			"id"	=> $id,
			"nombre"	=> $nombre,
			"apellido"	=> $apellido,
			"email"	=> $email,
			"telefono"	=> $telefono,
			"fechaRegistro"	=> $fechaRegistro,
			"usuario"	=> $usuario,
		];
		echo json_encode($datos);
	}

	if($asunto=='modificar'){
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];
		$sql1 = "SELECT * FROM funcionario WHERE Email = '$email' and FuncionarioID != ".$id;
		$proceso1 = mysqli_query($conexion,$sql1);
		$contador1 = mysqli_num_rows($proceso1);
		if($contador1>0){
			$datos = [
				"estatus"	=> "ok",
				"msg"	=> "Ya existe dicho email",
			];
			echo json_encode($datos);
			exit;
		}
		$sql2 = "SELECT * FROM funcionario WHERE usuario = '$usuario' and FuncionarioID != ".$id;
		$proceso2 = mysqli_query($conexion,$sql2);
		$contador2 = mysqli_num_rows($proceso2);
		if($contador2>0){
			$datos = [
				"estatus"	=> "ok",
				"msg"	=> "Ya existe dicho usuario",
			];
			echo json_encode($datos);
			exit;
		}
		
		if($password!=""){
			$sql3 = "UPDATE funcionario SET nombre = '$nombre', Apellido = '$apellido', Email = '$email', Telefono = '$telefono', usuario = '$usuario', contrasena = '$password' WHERE FuncionarioID = ".$id;
		}else{
			$sql3 = "UPDATE funcionario SET nombre = '$nombre', Apellido = '$apellido', Email = '$email', Telefono = '$telefono', usuario = '$usuario' WHERE FuncionarioID = ".$id;
		}
		$proceso3 = mysqli_query($conexion,$sql3);

		$datos = [
			"estatus"	=> "ok",
			"msg" => "Se ha creado satisfactoriamente",
		];
		echo json_encode($datos);
	}

	if($asunto=='eliminar'){
		$id = $_POST['id'];
		$sql1 = "SELECT * FROM reservaalojamiento WHERE FuncionarioID = ".$id;
		$proceso1 = mysqli_query($conexion,$sql1);
		$contador1 = mysqli_num_rows($proceso1);
		$sql2 = "SELECT * FROM reservaviajes WHERE FuncionarioID = ".$id;
		$proceso2 = mysqli_query($conexion,$sql2);
		$contador2 = mysqli_num_rows($proceso2);
		$sql3 = "SELECT * FROM solicitudanticipos WHERE FuncionarioID = ".$id;
		$proceso3 = mysqli_query($conexion,$sql3);
		$contador3 = mysqli_num_rows($proceso3);
		if($contador1>0 or $contador2>0 or $contador3>0){
			$datos = [
				"estatus"	=> "error",
				"msg"	=> "Funcionario vinculado con algún proceso",
			];
			echo json_encode($datos);
			exit;
		}
		$sql4 = "DELETE FROM funcionario WHERE FuncionarioID = ".$id;
		$proceso4 = mysqli_query($conexion,$sql4);
		$datos = [
			"estatus"	=> "ok",
			"msg"	=> "Se ha eliminado el registro",
		];
		echo json_encode($datos);
		exit;
	}

	