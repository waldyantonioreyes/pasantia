<?php
// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$password = '';
$base_datos = 'proyecto_final';

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer charset UTF-8
$conexion->set_charset("utf8");
?>