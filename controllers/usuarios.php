<?php


// session_start();

// =======================
//  ELIMINAR USUARIO
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    require_once '../config/conexion.php';
    $id = intval($_POST['delete_id']);

    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../public/usuarios/index.php?msg=deleted");
        exit;
    } else {
        header("Location: ../public/usuarios/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}


// =======================
//  EDITAR USUARIO
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    require_once '../config/conexion.php';

    $id      = intval($_POST['edit_id']);
    $nombre  = trim($_POST['nombre']);
    $email   = trim($_POST['email']);
    // $contrasena   = trim($_POST['contrasena']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $usuario = trim($_POST['usuario']);


    // Validar datos básicos
    if (empty($nombre) || empty($email)) {
        header("Location: ../public/usuarios/index.php?msg=empty_fields");
        exit;
    }

    // Query segura para editar
   $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, contrasena = ?, usuario = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nombre, $email, $contrasena, $usuario, $id);


    if ($stmt->execute()) {
        header("Location: ../public/usuarios/index.php?msg=updated");
        exit;
    } else {
        header("Location: ../public/usuarios/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}


// =======================
//  CONSULTAR USUARIOS
// =======================
require_once '../../config/conexion.php';

$query = "SELECT * FROM usuarios ORDER BY id DESC";
$result = $conexion->query($query);

$usuarios = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

$conexion->close();

// Devolver array para incluir en HTML
return $usuarios;

?>