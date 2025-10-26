<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Employee Management System</title>
    <meta name="description" content="Modern employee management system login - secure access to your dashboard">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <i data-lucide="shield" style="width: 1.5rem; height: 1.5rem;"></i>
                </div>
                <h1 class="login-title">Employee Management System</h1>
                <p class="login-subtitle">Sign in to access your dashboard</p>
                <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                    <i data-lucide="sun" id="themeIcon" style="width: 1.25rem; height: 1.25rem;"></i>
                </button>
            </div>

            <div class="login-body">
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-error">
                        <i data-lucide="alert-circle" style="width: 1rem; height: 1rem;"></i>
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <i data-lucide="check-circle" style="width: 1rem; height: 1rem;"></i>
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('auth/login'); ?>" id="loginForm">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-container">
                            <i data-lucide="user" class="input-icon"></i>
                            <input 
                                type="text" 
                                name="username" 
                                id="username" 
                                class="form-input" 
                                placeholder="Enter your username"
                                required
                                autocomplete="username"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-container">
                            <i data-lucide="lock" class="input-icon"></i>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-input" 
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" id="loginButton">
                        <span id="buttonText">Sign In</span>
                        <div id="buttonSpinner" class="spinner" style="display: none;"></div>
                    </button>
                </form>
            </div>

            <div class="login-footer">
                &copy; <?= date('Y'); ?> Employee Management System. All rights reserved.
            </div>
        </div>
    </div>

    <script src="<?= base_url('application/views/assets/js/main.js'); ?>"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');

            loginForm.addEventListener('submit', function(e) {
                loginButton.disabled = true;
                buttonText.textContent = 'Signing in...';
                buttonSpinner.style.display = 'block';
            });
            
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>