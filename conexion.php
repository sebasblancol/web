<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "base";
date_default_timezone_set('America/Bogota');

$conexion = mysqli_connect( $servidor, $usuario, $contrasena ) or die ("Problemas con la Base de datos, contactar al desarollador");
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Error con la base de datos registrar la configuración" );

if (!mysqli_set_charset($conexion, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
    exit();
} else {}

if ($conexion) {
    echo "Conexión exitosa.";
} else {
    echo "Error en la conexión.";
}


?>