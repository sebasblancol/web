<?php

require_once 'conexion.php'; // Asegúrate de que la ruta sea correcta

function crearFuncionario($nombre, $apellido, $email, $telefono, $fechaRegistro, $usuario, $contrasena) {
    global $conexion; // Usar la conexión global

    $sql = "INSERT INTO funcionario (Nombre, Apellido, Email, Telefono, FechaRegistro, Usuario, Contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conexion, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $nombre, $apellido, $email, $telefono, $fechaRegistro, $usuario, $contrasena);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    } else {
        return false;
    }
}

// Otras funciones (obtenerFuncionarios, obtenerFuncionarioPorID, etc.)...


function obtenerFuncionarios() {
    global $conexion; // Usar la conexión global
    $sql = "SELECT * FROM funcionario";
    $result = mysqli_query($conexion, $sql);
    $funcionarios = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $funcionarios;
}

function obtenerFuncionarioPorID($funcionarioID) {
    global $conexion; // Usar la conexión global
    $sql = "SELECT * FROM funcionario WHERE FuncionarioID = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $funcionarioID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $funcionario = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $funcionario;
}

function actualizarFuncionario($funcionarioID, $nombre, $apellido, $email, $telefono, $fechaRegistro, $usuario, $contrasena = null) {
    global $conexion; // Usar la conexión global
    if ($contrasena) {
        $sql = "UPDATE funcionario 
                SET Nombre = ?, Apellido = ?, Email = ?, Telefono = ?, 
                    FechaRegistro = ?, Usuario = ?, Contrasena = ?
                WHERE FuncionarioID = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sssssssi", $nombre, $apellido, $email, $telefono, $fechaRegistro, $usuario, $hashedPassword, $funcionarioID);
    } else {
        $sql = "UPDATE funcionario 
                SET Nombre = ?, Apellido = ?, Email = ?, Telefono = ?, 
                    FechaRegistro = ?, Usuario = ?
                WHERE FuncionarioID = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $nombre, $apellido, $email, $telefono, $fechaRegistro, $usuario, $funcionarioID);
    }
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

function eliminarFuncionario($funcionarioID) {
    global $conexion; // Usar la conexión global

    try {
        // Iniciar transacción
        mysqli_begin_transaction($conexion);

        // Primero eliminamos los registros en 'reservaalojamiento' que dependen de este FuncionarioID
        $sqlDeleteReserva = "DELETE FROM reservaalojamiento WHERE FuncionarioID = ?";
        $stmtDeleteReserva = mysqli_prepare($conexion, $sqlDeleteReserva);
        mysqli_stmt_bind_param($stmtDeleteReserva, "i", $funcionarioID);
        mysqli_stmt_execute($stmtDeleteReserva);

        // Luego eliminamos los registros en 'login' (si existe)
        $sqlDeleteLogin = "DELETE FROM login WHERE FuncionarioID = ?";
        $stmtDeleteLogin = mysqli_prepare($conexion, $sqlDeleteLogin);
        mysqli_stmt_bind_param($stmtDeleteLogin, "i", $funcionarioID);
        mysqli_stmt_execute($stmtDeleteLogin);

        // Ahora eliminamos el registro en 'funcionario'
        $sqlDeleteFuncionario = "DELETE FROM funcionario WHERE FuncionarioID = ?";
        $stmtDeleteFuncionario = mysqli_prepare($conexion, $sqlDeleteFuncionario);
        mysqli_stmt_bind_param($stmtDeleteFuncionario, "i", $funcionarioID);
        mysqli_stmt_execute($stmtDeleteFuncionario);

        // Hacer commit
        mysqli_commit($conexion);
        return true;
    } catch (Exception $e) {
        // Hacer rollback en caso de error
        mysqli_rollback($conexion);
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        mysqli_close($conexion); // Asegúrate de cerrar la conexión
    }
}
?>
