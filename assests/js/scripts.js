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

// Ajustar comportamiento al cambiar tamaño de ventana
window.addEventListener('resize', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
    if (window.innerWidth > 768) {
        overlay.classList.remove('show');
        sidebar.classList.remove('open');
    }
});

// Cambiar elemento activo del menú
document.querySelectorAll('.menu-item').forEach(item => {
    item.addEventListener('click', function(e) {
        // Solo prevenir si el href es "#" (enlaces internos/placeholder)
        if (this.getAttribute('href') === '#') {
            e.preventDefault();
        }
        
        document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        
        // Cerrar sidebar en móvil al hacer clic
        if (window.innerWidth <= 768) {
            toggleSidebar();
        }
    });
});