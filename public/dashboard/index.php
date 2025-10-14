<?php
// ejemplo-pagina.php
session_start();

// Configurar el título de la página
$pageTitle = "Mi Página - Dashboard";

// Capturar el contenido de la página
ob_start();
?>

<!-- Aquí va tu contenido personalizado -->
<div class="page-header">
    <h1>Mi Página Personalizada 🎨</h1>
    <p>Este es un ejemplo de cómo usar la plantilla</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <span class="stat-title">Ejemplo 1</span>
            <div class="stat-icon">🎯</div>
        </div>
        <div class="stat-value">123</div>
        <div class="stat-change">↑ 5% este mes</div>
    </div>

    <div class="stat-card green">
        <div class="stat-header">
            <span class="stat-title">Ejemplo 2</span>
            <div class="stat-icon">✨</div>
        </div>
        <div class="stat-value">456</div>
        <div class="stat-change">↑ 10% este mes</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Mi Contenido</h3>
        <span class="card-action">Ver más →</span>
    </div>
    <p>Aquí puedes agregar tablas, formularios, gráficos, etc.</p>
</div>

<?php
$pageContent = ob_get_clean();

// Incluir la plantilla (ajusta la ruta según tu estructura)
include '../../includes/template.php';
?><?php
// Iniciar sesión
// session_start();

// Configurar el título de la página
$pageTitle = "Mi Página - Dashboard";

// Estilos adicionales (opcional)
$additionalStyles = '
<style>
    .custom-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 20px;
    }
</style>
';

// Scripts adicionales (opcional)
$additionalScripts = '
<script>
    console.log("Script personalizado cargado");
</script>
';

// Capturar el contenido de la página
ob_start();
?>

