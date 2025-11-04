<?php
// =======================
//  ELIMINAR CENTRO DE TRABAJO
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    require_once '../config/conexion.php';
    $id = intval($_POST['delete_id']);

    $stmt = $conexion->prepare("DELETE FROM centros_trabajos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../public/centrosdetrabajos/index.php?msg=deleted");
        exit;
    } else {
        header("Location: ../public/centrosdetrabajos/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}

// =======================
//  EDITAR CENTRO DE TRABAJO
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    require_once '../config/conexion.php';

    $id           = intval($_POST['edit_id']);
    $nombre       = trim($_POST['nombre'] ?? '');
    $direccion    = trim($_POST['direccion'] ?? '');
    $rnc          = trim($_POST['rnc'] ?? '');
    $area         = trim($_POST['area'] ?? '');
    $responsable  = trim($_POST['responsable'] ?? '');
    $correo       = trim($_POST['correo'] ?? '');
    $telefono     = trim($_POST['telefono'] ?? '');
    $whatsApp     = trim($_POST['whatsApp'] ?? '');
    $estado       = trim($_POST['estado'] ?? '');

    // Validar datos básicos
    if (empty($nombre) || empty($correo)) {
        header("Location: ../public/centrosdetrabajos/index.php?msg=empty_fields");
        exit;
    }

    // Query segura para editar
    $stmt = $conexion->prepare("
        UPDATE centros_trabajos 
        SET nombre = ?, direccion = ?, rnc = ?, area = ?, responsable = ?, correo = ?, telefono = ?, whatsApp = ?, estado = ?
        WHERE id = ?
    ");
    $stmt->bind_param("sssssssssi", $nombre, $direccion, $rnc, $area, $responsable, $correo, $telefono, $whatsApp, $estado, $id);

    if ($stmt->execute()) {
        header("Location: ../public/centrosdetrabajos/index.php?msg=updated");
        exit;
    } else {
        header("Location: ../public/centrosdetrabajos/index.php?msg=error");
        exit;
    }

    $stmt->close();
    $conexion->close();
    exit;
}

// =======================
//  CONSULTAR CENTROS DE TRABAJO
// =======================
require_once '../../config/conexion.php';

$query = "SELECT * FROM centros_trabajos ORDER BY id DESC";
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
