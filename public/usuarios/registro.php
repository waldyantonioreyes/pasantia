


<?php
session_start();
require_once '../../config/conexion.php';

$error = '';
$success = '';

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);
    $confirmar = trim($_POST['confirmar']);
    
    // Validaciones
    if (empty($nombre) || empty($email) || empty($usuario) || empty($contrasena) || empty($confirmar)) {
        $error = "Todos los campos son obligatorios";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del email no es válido";
    } elseif (strlen($contrasena) < 5) {
        $error = "La contraseña debe tener al menos 5 caracteres";
    } elseif ($contrasena !== $confirmar) {
        $error = "Las contraseñas no coinciden";
    } else {
        // Verificar si el usuario o email ya existen
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ? OR email = ?");
        $stmt->bind_param("ss", $usuario, $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            $error = "El usuario o email ya están registrados";
        } else {
            // Encriptar contraseña
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            // Insertar nuevo usuario
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, usuario, contrasena) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $email, $usuario, $contrasena_hash);
            
            if ($stmt->execute()) {
                $success = "¡Registro exitoso! Redirigiendo al login...";
                header("refresh:2;url=index.php");
            } else {
                $error = "Error al registrar el usuario. Intente nuevamente.";
            }
        }
        $stmt->close();
    }
}
 ?>
<?php
// ejemplo-pagina.php
// session_start();

// Configurar el título de la página
$pageTitle = "Registro de Usuarios";


// Estilos adicionales (opcional)
$additionalStyles = "
<style>
    .custom-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 20px;
    }
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            
        }

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
            max-width: 500px;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            0%, 100% {
                transform: scale(1);
                filter: drop-shadow(0 0 8px #0cc5d2);
            }
            50% {
                transform: scale(1.1);
                filter: drop-shadow(0 0 20px #0cc5d2);
            }
        }

        .registro-header h1 {
            color: #0a1f44;
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #0a1f44;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
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
            letter-spacing: 1px;
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
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #0454a4;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .registro-container {
                padding: 2rem;
            }

            .registro-header h1 {
                font-size: 1.5rem;
            }

            .registro-header i {
                font-size: 3rem;
            }
        }
</style>
";

// Capturar el contenido de la página
ob_start();
?>
<h1>Registro de Usuarios</h1>
<!-- Aquí va tu contenido personalizado -->
 <div class="registro-container">
        <div class="registro-header">
            <i class="fas fa-user-plus"></i>
            <h1>Registro</h1>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre"><i class="fas fa-user"></i> Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required 
                       value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                <input type="email" id="email" name="email" required 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="usuario"><i class="fas fa-user-circle"></i> Usuario</label>
                <input type="text" id="usuario" name="usuario" required 
                       value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="contrasena"><i class="fas fa-lock"></i> Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required minlength="5">
            </div>

            <div class="form-group">
                <label for="confirmar"><i class="fas fa-lock"></i> Confirmar Contraseña</label>
                <input type="password" id="confirmar" name="confirmar" required minlength="5">
            </div>

            <button type="submit" class="btn-registro">
                <i class="fas fa-user-plus"></i> Registrarse
            </button>
        </form>

        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="index.php"><i class="fas fa-sign-in-alt"></i> Inicia sesión aquí</a>
        </div>
    </div>
<?php
$pageContent = ob_get_clean();

// Incluir la plantilla (ajusta la ruta según tu estructura)
include '../../includes/template.php';
?><?php
// Iniciar sesión
// session_start();

// Configurar el título de la página


// Scripts adicionales (opcional)
$additionalScripts = '
<script>
    console.log("Script personalizado cargado");
</script>
';

// Capturar el contenido de la página
ob_start();
?>

