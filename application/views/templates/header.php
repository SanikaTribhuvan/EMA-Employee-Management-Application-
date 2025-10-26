<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="pageTitle">Employee Management System</title>
    <meta name="description" content="Modern employee management system with organizational chart, CRUD operations, and professional dashboard interface.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    <link rel="stylesheet" href="<?= base_url('application/views/assets/css/main.css'); ?>">
    
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
            
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body>
    <div class="app-container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="<?= base_url('dashboard'); ?>" class="sidebar-logo">
                    <i data-lucide="shield" style="width: 1.5rem; height: 1.5rem;"></i>
                    <div>
                        <div style="font-size: 1rem; font-weight: 600;">EMS</div>
                        <div style="font-size: 0.75rem; opacity: 0.7;">Management</div>
                    </div>
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-group">
                    <div class="nav-group-label">Main</div>
                    <div class="nav-item">
                        <a href="<?= base_url('dashboard'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') ? 'active' : ''; ?>">
                            <i data-lucide="layout-dashboard" class="nav-icon"></i>
                            Dashboard
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="<?= base_url('employees'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'employees') ? 'active' : ''; ?>">
                            <i data-lucide="users" class="nav-icon"></i>
                            Employees
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="<?= base_url('chart'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'chart') ? 'active' : ''; ?>">
                            <i data-lucide="git-branch" class="nav-icon"></i>
                            Org Chart
                        </a>
                    </div>
                </div>
                
                <div class="nav-group">
                    <div class="nav-group-label">System</div>
                    <div class="nav-item">
                        <a href="<?= base_url('settings'); ?>" class="nav-link <?= ($this->uri->segment(1) == 'settings') ? 'active' : ''; ?>">                            <i data-lucide="settings" class="nav-icon"></i>
                            Settings
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <main class="main-content" id="mainContent">
            <header class="top-header">
                <div class="header-left">
                    <nav class="breadcrumb">
                        <a href="<?= base_url('dashboard'); ?>">Home</a>
                        <?php if($this->uri->segment(1) && $this->uri->segment(1) != 'dashboard'): ?>
                            <span> / </span>
                            <span><?= ucfirst($this->uri->segment(1)); ?></span>
                            <?php if($this->uri->segment(2)): ?>
                                <span> / </span>
                                <span><?= ucfirst($this->uri->segment(2)); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </nav>
                </div>
                
                <div class="header-right">
                    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                        <i data-lucide="sun" id="themeIcon" style="width: 1.25rem; height: 1.25rem;"></i>
                    </button>
                    
                    <a href="<?= base_url('auth/logout'); ?>" class="logout-btn" onclick="return confirm('Are you sure you want to logout?');">
                        <i data-lucide="log-out" style="width: 1rem; height: 1rem;"></i>
                        <span class="logout-text">Logout</span>
                    </a>
                </div>
            </header>

            <div class="page-content">