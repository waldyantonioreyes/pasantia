<?php
// =======================
//  ELIMINAR CARRERA TÉCNICA
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    require_once '../config/conexion.php';
    $id = intval($_POST['delete_id']);

    $stmt = $conexion->prepare("DELETE FROM carreras_tecnicas WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../public/carrerastecnicas/index.php?msg=deleted");
        exit;
    } else {
        header("Location: ../public/carrerastecnicas/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}

// =======================
//  EDITAR CARRERA TÉCNICA
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    require_once '../config/conexion.php';

    $id       = intval($_POST['edit_id']);
    $nombre   = trim($_POST['nombre'] ?? '');
    $familia  = trim($_POST['familia'] ?? '');
    $codigo   = trim($_POST['codigo'] ?? '');
    $estado   = trim($_POST['estado'] ?? '');

    // Validar campos obligatorios
    if (empty($nombre) || empty($codigo)) {
        header("Location: ../public/carrerastecnicas/index.php?msg=empty_fields");
        exit;
    }

    // Query segura para editar
    $stmt = $conexion->prepare("
        UPDATE carreras_tecnicas 
        SET nombre = ?, familia = ?, codigo = ?, estado = ?
        WHERE id = ?
    ");
    $stmt->bind_param("ssssi", $nombre, $familia, $codigo, $estado, $id);

    if ($stmt->execute()) {
        header("Location: ../public/carrerastecnicas/index.php?msg=updated");
        exit;
    } else {
        header("Location: ../public/carrerastecnicas/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}

// =======================
//  CONSULTAR CARRERAS TÉCNICAS
// =======================
require_once '../../config/conexion.php';

$query = "SELECT * FROM carreras_tecnicas ORDER BY id DESC";
$result = $conexion->query($query);

$carreras = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carreras[] = $row;
    }
}

$conexion->close();

// Devolver array para incluir en HTML
return $carreras;
?>
