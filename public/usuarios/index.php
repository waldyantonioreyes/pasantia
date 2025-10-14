

<?php
// ejemplo-pagina.php
// session_start();

// Configurar el título de la página
$pageTitle = "Listado de Usuarios";


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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #44518eff 0%, #d1c3dfff 100%);
            padding: 40px;
            color: white;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .content {
            padding: 40px;
        }

        .msg { 
            margin-bottom: 30px;
            padding: 16px 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .msg.success { 
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .msg.error { 
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .msg::before {
            content: '✓';
            font-size: 1.5rem;
            font-weight: bold;
        }

        .msg.error::before {
            content: '✕';
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        table { 
            border-collapse: collapse;
            width: 100%;
            background: white;
        }

        th, td { 
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th { 
            background: linear-gradient(135deg, #03160cff 0%, #120d17ff 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover { 
            background: #f8f9fa;
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .btn-delete, .btn-edit { 
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-edit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-edit:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-delete { 
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .btn-delete:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.4);
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 999;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes modalSlideIn {
            from {
                transform: translate(-50%, -60%);
                opacity: 0;
            }
            to {
                transform: translate(-50%, -50%);
                opacity: 1;
            }
        }

        #formEditar {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            padding: 35px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            animation: modalSlideIn 0.4s ease;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 28px;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            background: #f8f9fa;
            color: #dc3545;
            transform: rotate(90deg);
        }

        #formEditar h3 {
            color: #667eea;
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: 600;
            padding-right: 30px;
        }

        #formEditar label {
            display: block;
            margin-top: 20px;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 600;
            font-size: 0.95rem;
        }

        #formEditar input[type='text'], #formEditar input[type='password'],
        #formEditar input[type='email'] {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        #formEditar input[type='text']:focus,  #formEditar input[type='password']:focus,
        #formEditar input[type='email']:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        #formEditar button[type='submit'],
        #formEditar button[type='button'] {
            margin-top: 25px;
            margin-right: 12px;
            padding: 14px 32px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        #formEditar button[type='submit'] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        #formEditar button[type='submit']:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
        }

        #formEditar button[type='button'] {
            background: #6c757d;
            color: white;
        }

        #formEditar button[type='button']:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(108, 117, 125, 0.4);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.8rem;
            }

            .header, .content {
                padding: 20px;
            }

            th, td {
                padding: 12px;
                font-size: 0.9rem;
            }

            .btn-delete, .btn-edit {
                padding: 8px 14px;
                font-size: 0.8rem;
            }
        }
</style>
";

$additionalScripts = "
<script>

 function confirmarEliminar() {
            return confirm('¿Estás seguro de que deseas eliminar este usuario?');
        }

       function abrirEdicion(id, nombre, email, contrasena, usuario) {
                document.getElementById('modalOverlay').style.display = 'block';
                document.getElementById('formEditar').style.display = 'block';
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_nombre').value = nombre;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_contrasena').value = contrasena;
                document.getElementById('edit_usuario').value = usuario;
                document.body.style.overflow = 'hidden';
            }
            function cerrarEdicion() {
                document.getElementById('modalOverlay').style.display = 'none';
                document.getElementById('formEditar').style.display = 'none';
                document.body.style.overflow = 'auto';
            }
</script>
";

// Capturar el contenido de la página
ob_start();
?>
<h1>Registro de Usuarios</h1>
<!-- Aquí va tu contenido personalizado -->
 
<div class="container">
        <div class="header">
            <h1>Lista de Usuarios</h1>
        </div>

        <div class="content">
            <?php
            // Cargar usuarios desde users.php
            $usuarios = include '../../controllers/usuarios.php';

            // Mostrar mensaje si viene en la URL
            if (isset($_GET['msg'])): ?>
                <?php if ($_GET['msg'] == 'deleted'): ?>
                    <div class="msg success">Usuario eliminado correctamente.</div>
                <?php elseif ($_GET['msg'] == 'updated'): ?>
                    <div class="msg success">Usuario actualizado correctamente.</div>
                <?php elseif ($_GET['msg'] == 'empty_fields'): ?>
                    <div class="msg error">Debes completar todos los campos.</div>
                <?php else: ?>
                    <div class="msg error">Ocurrió un error al procesar la acción.</div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="table-wrapper">
                <a href="../../public/usuarios/registro.php">Nuevo usuario</a>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Contraseña</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['id']); ?></td>
                                <td><?= htmlspecialchars($u['nombre']); ?></td>
                                <td><?= htmlspecialchars($u['email']); ?></td>
                                <td><?= htmlspecialchars($u['contrasena']); ?></td>
                                <td>
                                    <div style="display: flex; gap: 6px; align-items: center;">
                                        <button class="btn-edit"
                                            onclick="abrirEdicion(<?= $u['id']; ?>, '<?= htmlspecialchars($u['nombre']); ?>', '<?= htmlspecialchars($u['email']); ?>', '<?= htmlspecialchars($u['contrasena']); ?>', '<?= htmlspecialchars($u['usuario']); ?>', '<?= htmlspecialchars($u['usuario']); ?>')">
                                            Editar
                                        </button>

                                        <form method="post" action="../../controllers/usuarios.php"
                                            onsubmit="return confirmarEliminar();"
                                            style="margin: 0;">
                                            <input type="hidden" name="delete_id" value="<?= $u['id']; ?>">
                                            <button type="submit" class="btn-delete">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="text-align: center; padding: 40px; color: #6c757d;">No hay usuarios registrados.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- MODAL OVERLAY -->
            <div class="modal-overlay" id="modalOverlay" onclick="cerrarEdicion()"></div>

            <!-- MODAL PARA EDITAR EL USUARIO  -->
            <div id="formEditar">
                <button class="modal-close" onclick="cerrarEdicion()" type="button">×</button>
                <h3>Editar usuario</h3>
                <form method="post" action="../../controllers/usuarios.php">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" id="edit_nombre" required>
                    <label>Email:</label>
                    <input type="email" name="email" id="edit_email" required>
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="edit_usuario" required>
                     <label>Contraseña:</label>
                    <input type="password" name="contrasena" id="edit_contrasena" required>
                    <div>
                        <button type="submit">Guardar cambios</button>
                        <button type="button" onclick="cerrarEdicion()">Cancelar</button>
                    </div>
                </form>


<?php
$pageContent = ob_get_clean();

// Incluir la plantilla (ajusta la ruta según tu estructura)
include '../../includes/template.php';
?><?php
// Iniciar sesión
// session_start();

// Configurar el título de la página


// Scripts adicionales (opcional)

// Capturar el contenido de la página
ob_start();
?>