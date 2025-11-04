<?php
// Iniciar sesión si no está iniciada
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// Verificar si el usuario está autenticado (opcional)
// if (!isset($_SESSION['usuario'])) {
//     header('Location: ../login.php');
//     exit;
// }

// Detectar la ruta base automáticamente
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = $protocol . "://" . $host;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></title>
    
    <!-- Estilos en línea para evitar problemas de rutas -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            padding: 20px 0;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar.closed {
            left: -260px;
        }

        .sidebar-header {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h2 {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .menu-item {
            padding: 15px 25px;
            color: #94a3b8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border-left-color: #667eea;
        }

        .menu-item.active {
            background: rgba(102, 126, 234, 0.1);
            color: white;
            border-left-color: #667eea;
        }

        .menu-icon {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Top Bar */
        .topbar {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            z-index: 999;
        }

        .topbar.expanded {
            left: 0;
        }

        .menu-toggle {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: none;
            background: #f1f5f9;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: #e2e8f0;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            padding: 10px 20px;
            border-radius: 10px;
            gap: 10px;
            flex: 1;
            max-width: 400px;
            margin-left: 20px;
        }

        .search-bar input {
            border: none;
            background: none;
            outline: none;
            width: 100%;
            font-size: 0.95rem;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .notification-icon:hover {
            background: #e2e8f0;
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid white;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            transition: all 0.3s ease;
            min-height: calc(100vh - 70px);
        }

        .main-content.expanded {
            margin-left: 0;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 2rem;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card.green::before {
            background: linear-gradient(180deg, #10b981 0%, #059669 100%);
        }

        .stat-card.orange::before {
            background: linear-gradient(180deg, #f59e0b 0%, #d97706 100%);
        }

        .stat-card.red::before {
            background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            background: #f1f5f9;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .stat-change {
            font-size: 0.85rem;
            color: #10b981;
            font-weight: 600;
        }

        .stat-change.negative {
            color: #ef4444;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
        }

        .card-action {
            color: #667eea;
            font-size: 0.9rem;
            cursor: pointer;
            font-weight: 500;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            flex-shrink: 0;
        }

        .activity-content h4 {
            font-size: 0.95rem;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .activity-content p {
            font-size: 0.85rem;
            color: #64748b;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-left: auto;
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -260px;
            }

            .sidebar.open {
                left: 0;
            }

            .topbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .search-bar {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .overlay.show {
                display: block;
            }
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 0.9rem;
        }
    </style>
    
    <!-- Estilos adicionales de la página (opcional) -->
    <?php if (isset($additionalStyles)): ?>
        <?php echo $additionalStyles; ?>
    <?php endif; ?>
</head>
<body>
    
    <!-- Overlay para móvil -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>
                <div class="logo-icon">D</div>
                Dashboard
            </h2>
        </div>
        <nav>
            <a href="dashboard.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <span class="menu-icon">📊</span>
                <span>Panel Principal</span>
            </a>
            <a href="../../public/usuarios/index.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'usuarios.php' ? 'active' : ''; ?>">
                <span class="menu-icon">👥</span>
                <span>Usuarios</span>
            </a>
            <a href="../../public/centroseducativos/index.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'analiticas.php' ? 'active' : ''; ?>">
                <span class="menu-icon">📈</span>
                <span>Centros Educativos</span>
            </a>
            <a href="../../public/centrosdetrabajos/index.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'ventas.php' ? 'active' : ''; ?>">
                <span class="menu-icon">💳</span>
                <span>Centros de trabajos</span>
            </a>
            <a href="../../public/ejemplo/index.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'productos.php' ? 'active' : ''; ?>">
                <span class="menu-icon">📦</span>
                <span>Página de ejemplo</span>
            </a>
            <a href="configuracion.php" class="menu-item <?php echo basename($_SERVER['PHP_SELF']) == 'configuracion.php' ? 'active' : ''; ?>">
                <span class="menu-icon">⚙️</span>
                <span>Configuración</span>
            </a>
            <a href="../../controllers/logout.php" class="menu-item">
                <span class="menu-icon">🚪</span>
                <span>Cerrar Sesión</span>
            </a>
        </nav>
    </div>

    <!-- Top Bar -->
    <div class="topbar" id="topbar">
        <button class="menu-toggle" onclick="toggleSidebar()">
            ☰
        </button>

        <div class="search-bar">
            <span>🔍</span>
            <input type="text" placeholder="Buscar...">
        </div>

        <div class="user-section">
            <div class="notification-icon">
                <span>🔔</span>
                <div class="notification-badge"></div>
            </div>
            <div class="user-avatar">
                <?php echo isset($_SESSION['usuario']) ? strtoupper(substr($_SESSION['usuario'], 0, 2)) : 'JD'; ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        
        <!-- Aquí va el contenido específico de cada página -->
        <?php if (isset($pageContent)): ?>
            <?php echo $pageContent; ?>
        <?php else: ?>
            <!-- Contenido por defecto -->
            <div class="page-header">
                <h1>Bienvenido de nuevo 👋</h1>
                <p>Aquí está lo que sucede con tus proyectos hoy</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total de Usuarios</span>
                        <div class="stat-icon">👥</div>
                    </div>
                    <div class="stat-value">2,847</div>
                    <div class="stat-change">↑ 12% vs mes pasado</div>
                </div>

                <div class="stat-card green">
                    <div class="stat-header">
                        <span class="stat-title">Ingresos</span>
                        <div class="stat-icon">💰</div>
                    </div>
                    <div class="stat-value">$48,293</div>
                    <div class="stat-change">↑ 8.5% vs mes pasado</div>
                </div>

                <div class="stat-card orange">
                    <div class="stat-header">
                        <span class="stat-title">Pedidos Pendientes</span>
                        <div class="stat-icon">📦</div>
                    </div>
                    <div class="stat-value">124</div>
                    <div class="stat-change negative">↓ 3% vs mes pasado</div>
                </div>

                <div class="stat-card red">
                    <div class="stat-header">
                        <span class="stat-title">Tasa de Conversión</span>
                        <div class="stat-icon">📈</div>
                    </div>
                    <div class="stat-value">3.24%</div>
                    <div class="stat-change">↑ 1.2% vs mes pasado</div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- JavaScript en línea -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const isMobile = window.innerWidth <= 768;

            if (isMobile) {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('closed');
                document.getElementById('topbar').classList.toggle('expanded');
                document.getElementById('mainContent').classList.toggle('expanded');
            }
        }

        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            if (window.innerWidth > 768) {
                overlay.classList.remove('show');
                sidebar.classList.remove('open');
            }
        });

        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });
    </script>
    
    <!-- Scripts adicionales de la página (opcional) -->
    <?php if (isset($additionalScripts)): ?>
        <?php echo $additionalScripts; ?>
    <?php endif; ?>

</body>
</html>