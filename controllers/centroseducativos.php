<?php
// =======================
//  ELIMINAR CENTRO EDUCATIVO
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    require_once '../config/conexion.php';
    $id = intval($_POST['delete_id']);

    $stmt = $conexion->prepare("DELETE FROM centro_educativo WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../public/centroseducativos/index.php?msg=deleted");
        exit;
    } else {
        header("Location: ../public/centroseducativos/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}

// =======================
//  EDITAR CENTRO EDUCATIVO
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    require_once '../config/conexion.php';

    $id        = intval($_POST['edit_id']);
    $nombre    = trim($_POST['nombre']);
    $direccion = trim($_POST['direccion']);
    $codigo    = trim($_POST['codigo']);
    $correo    = trim($_POST['correo']);
    $telefono  = trim($_POST['telefono']);
    $whatsApp  = trim($_POST['whatsApp' ?? '']);

    // Validar datos básicos
    if (empty($nombre) || empty($correo)) {
        header("Location: ../public/centroseducativos/index.php?msg=empty_fields");
        exit;
    }

    // Query segura para editar
    $stmt = $conexion->prepare("
        UPDATE centro_educativo 
        SET nombre = ?, direccion = ?, codigo = ?, correo = ?, telefono = ?, whatsApp = ?
        WHERE id = ?
    ");
    $stmt->bind_param("ssssssi", $nombre, $direccion, $codigo, $correo, $telefono, $whatsApp, $id);

    if ($stmt->execute()) {
        header("Location: ../public/centroseducativos/index.php?msg=updated");
        exit;
    } else {
        header("Location: ../public/centroseducativos/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}

// =======================
//  CONSULTAR CENTROS EDUCATIVOS
// =======================
require_once '../../config/conexion.php';

$query = "SELECT * FROM centro_educativo ORDER BY id DESC";
$result = $conexion->query($query);

$centros = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $centros[] = $row;
    }
}

$conexion->close();

// Devolver array para incluir en HTML
return $centros;
?>
