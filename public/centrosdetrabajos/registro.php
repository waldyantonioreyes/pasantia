<?php
session_start();
require_once '../../config/conexion.php';

$error = '';
$success = '';

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre       = trim($_POST['nombre']);
    $direccion    = trim($_POST['direccion']);
    $rnc          = trim($_POST['rnc']);
    $area         = trim($_POST['area']);
    $responsable  = trim($_POST['responsable']);
    $correo       = trim($_POST['correo']);
    $telefono     = trim($_POST['telefono']);
    $whatsapp     = trim($_POST['whatsapp']);
    $estado       = trim($_POST['estado']);

    // Validaciones
    if (empty($nombre) || empty($direccion) || empty($rnc) || empty($area) || empty($responsable) || empty($correo) || empty($telefono) || empty($whatsapp)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del correo no es válido.";
    } else {
        // Verificar si el centro o RNC ya existen
        $stmt = $conexion->prepare("SELECT id FROM centros_trabajos WHERE rnc = ? OR correo = ?");
        $stmt->bind_param("ss", $rnc, $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $error = "El RNC o correo ya están registrados.";
        } else {
            // Insertar nuevo centro de trabajo
            $stmt = $conexion->prepare("
                INSERT INTO centros_trabajos (nombre, direccion, rnc, area, responsable, correo, telefono, whatsApp, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("sssssssss", $nombre, $direccion, $rnc, $area, $responsable, $correo, $telefono, $whatsapp, $estado);

            if ($stmt->execute()) {
                $success = "✅ ¡Centro de trabajo registrado correctamente!";
                header("refresh:2;url=index.php");
            } else {
                $error = "Error al registrar el centro de trabajo. Intente nuevamente.";
            }
        }
        $stmt->close();
    }
}
?>

<?php
$pageTitle = "Registro de Centros de Trabajo";

// Estilos adicionales
$additionalStyles = "
<style>
    body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #0a1f44, #12c2e9);
        padding: 2rem;
    }

    .registro-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 3rem;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 650px;
        animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .registro-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .registro-header i {
        font-size: 4rem;
        color: #0cc5d2;
        margin-bottom: 1rem;
        display: block;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); filter: drop-shadow(0 0 8px #0cc5d2); }
        50% { transform: scale(1.1); filter: drop-shadow(0 0 20px #0cc5d2); }
    }

    .registro-header h1 {
        color: #0a1f44;
        font-size: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .form-group {
        margin-bottom: 1.3rem;
    }

    .form-group label {
        display: block;
        color: #0a1f44;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 1rem;
        border: 2px solid #ddd;
        border-radius: 10px;
        font-size: 1rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .form-group input:focus, .form-group select:focus {
        outline: none;
        border-color: #0cc5d2;
        box-shadow: 0 0 10px rgba(12, 197, 210, 0.3);
        background: white;
    }

    .alert {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .alert-danger {
        background: #ffe6e6;
        color: #cc0000;
        border: 1px solid #ff9999;
    }

    .alert-success {
        background: #e6ffe6;
        color: #008000;
        border: 1px solid #99ff99;
    }

    .btn-registro {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(45deg, #0cc5d2, #0454a4);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-registro:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(12, 197, 210, 0.4);
    }

    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        color: #666;
    }

    .login-link a {
        color: #0cc5d2;
        text-decoration: none;
        font-weight: 600;
    }

    .login-link a:hover {
        color: #0454a4;
        text-decoration: underline;
    }
</style>
";

ob_start();
?>

<div class="registro-container">
    <div class="registro-header">
        <i class="fas fa-building"></i>
        <h1>Registrar Centro de Trabajo</h1>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> <?= $error; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= $success; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label><i class="fas fa-briefcase"></i> Nombre</label>
            <input type="text" name="nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fas fa-map-marker-alt"></i> Dirección</label>
            <input type="text" name="direccion" required value="<?= htmlspecialchars($_POST['direccion'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fas fa-barcode"></i> RNC</label>
            <input type="text" name="rnc" required value="<?= htmlspecialchars($_POST['rnc'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fas fa-network-wired"></i> Área</label>
            <input type="text" name="area" required value="<?= htmlspecialchars($_POST['area'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fas fa-user-tie"></i> Responsable</label>
            <input type="text" name="responsable" required value="<?= htmlspecialchars($_POST['responsable'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fas fa-envelope"></i> Correo</label>
            <input type="email" name="correo" required value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fas fa-phone"></i> Teléfono</label>
            <input type="text" name="telefono" required value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fab fa-whatsapp"></i> WhatsApp</label>
            <input type="text" name="whatsapp" required value="<?= htmlspecialchars($_POST['whatsapp'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label><i class="fas fa-toggle-on"></i> Estado</label>
            <select name="estado" required>
                <option value="Activo" <?= (($_POST['estado'] ?? '') == 'Activo') ? 'selected' : '' ?>>Activo</option>
                <option value="Inactivo" <?= (($_POST['estado'] ?? '') == 'Inactivo') ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn-registro">
            <i class="fas fa-save"></i> Registrar Centro
        </button>
    </form>

    <div class="login-link">
        <a href="index.php"><i class="fas fa-arrow-left"></i> Volver a la lista</a>
    </div>
</div>

<?php
$pageContent = ob_get_clean();
include '../../includes/template.php';
?>
