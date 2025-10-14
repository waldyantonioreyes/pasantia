<?php
session_start();
require_once '../config/conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos del formulario
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);
    
    // Validar que los campos no estén vacíos
    if (empty($usuario) || empty($contrasena)) {
        $_SESSION['error'] = "Por favor, complete todos los campos";
        header("Location: ../public/dashboard/index.php");
        exit();
    }
    
    // Preparar consulta para evitar SQL Injection
    $stmt = $conexion->prepare("SELECT id, nombre, email, usuario, contrasena FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    // Verificar si el usuario existe
    if ($resultado->num_rows == 1) {
        $usuario_data = $resultado->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($contrasena, $usuario_data['contrasena'])) {
            // Contraseña correcta - Iniciar sesión
            $_SESSION['usuario_id'] = $usuario_data['id'];
            $_SESSION['usuario_nombre'] = $usuario_data['nombre'];
            $_SESSION['usuario_email'] = $usuario_data['email'];
            $_SESSION['usuario_user'] = $usuario_data['usuario'];
            $_SESSION['loggedin'] = true;
            
            // Redirigir al dashboard
            header("Location: ../public/dashboard/index.php");
            exit();
        } else {
            // Contraseña incorrecta
            $_SESSION['error'] = "Usuario o contraseña incorrectos";
            header("Location: ../public/index.php");
            exit();
        }
    } else {
        // Usuario no existe
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
        header("Location: ../public/index.php");
        exit();
    }
    
    $stmt->close();
} else {
    // Si se accede directamente sin POST, redirigir al login
    header("Location: ../public/index.php");
    exit();
}

$conexion->close();
?>