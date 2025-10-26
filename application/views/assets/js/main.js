// Employee Management System - Main JavaScript

// Early Theme Initialization (Prevent Flash)
(function() {
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');

    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
})();

// Main App Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // DOM Elements
    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const themeToggle = document.getElementById('themeToggle');
    const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');
    const themeIcon = document.getElementById('themeIcon');

    // State Variables
    let isMobile = window.innerWidth <= 768;

    // ========================================================================
    // Sidebar & Layout Management
    // ========================================================================

    function initializeSidebar() {
        isMobile = window.innerWidth <= 768;
        if (isMobile) {
            body.classList.add('sidebar-closed');
            sidebar.classList.add('collapsed');
        } else {
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                body.classList.add('sidebar-closed');
                sidebar.classList.add('collapsed');
            } else {
                body.classList.add('sidebar-open');
                sidebar.classList.remove('collapsed');
            }
        }
        updateToggleIcon();
    }

    function toggleSidebar() {
        if (isMobile) {
            const isSidebarOpen = sidebar.classList.contains('mobile-open');
            if (isSidebarOpen) {
                sidebar.classList.remove('mobile-open');
                if (sidebarOverlay) sidebarOverlay.classList.remove('visible');
                body.classList.add('sidebar-closed');
            } else {
                sidebar.classList.add('mobile-open');
                if (sidebarOverlay) sidebarOverlay.classList.add('visible');
                body.classList.remove('sidebar-closed');
            }
        } else {
            const isSidebarCollapsed = body.classList.contains('sidebar-closed');
            if (isSidebarCollapsed) {
                body.classList.remove('sidebar-closed');
                body.classList.add('sidebar-open');
                sidebar.classList.remove('collapsed');
                localStorage.setItem('sidebarCollapsed', 'false');
            } else {
                body.classList.remove('sidebar-open');
                body.classList.add('sidebar-closed');
                sidebar.classList.add('collapsed');
                localStorage.setItem('sidebarCollapsed', 'true');
            }
        }
        updateToggleIcon();
    }
    
    function updateToggleIcon() {
        if (!sidebarToggle) return;
        const isCollapsed = sidebar.classList.contains('collapsed') || sidebar.classList.contains('mobile-open') === false;
        
        if (isCollapsed) {
            sidebarToggle.innerHTML = `<i data-lucide="menu" style="width: 1.25rem; height: 1.25rem;"></i>`;
        } else {
            sidebarToggle.innerHTML = `<i data-lucide="x" style="width: 1.25rem; height: 1.25rem;"></i>`;
        }
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', toggleSidebar);
    }
    
    if (navLinks) {
        navLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                if (isMobile) {
                    toggleSidebar();
                }
            });
        });
    }

    window.addEventListener('resize', function() {
        const wasMobile = isMobile;
        isMobile = window.innerWidth <= 768;
        if (wasMobile !== isMobile) {
            initializeSidebar();
        }
    });

    // ========================================================================
    // Theme Management
    // ========================================================================
    function setTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        updateThemeIcon();
    }

    function toggleTheme() {
        const isDark = document.documentElement.classList.contains('dark');
        setTheme(isDark ? 'light' : 'dark');
    }

    function updateThemeIcon() {
        if (!themeIcon) return;
        const isDark = document.documentElement.classList.contains('dark');
        themeIcon.setAttribute('data-lucide', isDark ? 'moon' : 'sun');
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }
    
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }

    // ========================================================================
    // General Enhancements
    // ========================================================================
    function enhanceForm(formId) {
        const form = document.getElementById(formId);
        if (!form) return;
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i data-lucide="loader" class="animate-spin" style="width: 1rem; height: 1rem;"></i> Processing...';
                if (typeof lucide !== 'undefined') lucide.createIcons();
            }
        });
    }

    function enhanceTable(tableId) {
        const table = document.getElementById(tableId);
        if (!table) return;
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', function() {
                rows.forEach(r => r.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    }
    
    document.addEventListener('keydown', function(event) {
        if ((event.ctrlKey || event.metaKey) && event.key === 'b') {
            event.preventDefault();
            toggleSidebar();
        }
        if ((event.ctrlKey || event.metaKey) && event.shiftKey && event.key === 'T') {
            event.preventDefault();
            toggleTheme();
        }
    });

    initializeSidebar();
    setTheme(localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
    enhanceForm('employeeForm');
    enhanceTable('employeeTable');
});