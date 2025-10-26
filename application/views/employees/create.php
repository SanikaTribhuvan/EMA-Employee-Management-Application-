<script>
    // Update page title
    document.getElementById('pageTitle').textContent = 'Add New Employee - Employee Management System';
</script>
<link rel="stylesheet" href="<?= base_url('application\views\assets\css\main.css'); ?>">
    <script src="<?= base_url('application\views\assets\js\main.js'); ?>"></script>

<div class="form-container" data-testid="container-form">
    <div class="form-card">
        <div class="form-header">
            <h1 class="form-title">Add New Employee</h1>
            <p class="form-description">
                Enter employee details to add them to the system. All required fields must be completed.
            </p>
        </div>

        <div class="form-body">
            <!-- Validation Errors -->
            <?php if(validation_errors()): ?>
                <div class="alert alert-danger" data-testid="alert-validation-errors">
                    <i data-lucide="alert-circle" class="alert-icon"></i>
                    <div class="alert-content">
                        <strong>Please fix the following errors:</strong>
                        <?= validation_errors('<ul><li>', '</li></ul>'); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Employee Form -->
            <form method="post" action="<?= base_url('employees/create'); ?>" id="employeeForm" data-testid="form-employee">
                <div class="form-grid">
                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i data-lucide="user"></i>
                            Full Name
                            <span class="required-asterisk">*</span>
                        </label>
                        <div class="input-with-icon">
                            <i data-lucide="user" class="input-icon"></i>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="<?= set_value('name'); ?>" 
                                class="form-input" 
                                placeholder="John Doe"
                                required
                                autocomplete="name"
                                data-testid="input-name"
                            >
                        </div>
                        <div class="form-help">
                            <i data-lucide="info"></i>
                            Enter the employee's full legal name
                        </div>
                    </div>

                    <!-- Mobile Number -->
                    <div class="form-group">
                        <label for="mob" class="form-label">
                            <i data-lucide="phone"></i>
                            Mobile Number
                        </label>
                        <div class="input-with-icon">
                            <i data-lucide="phone" class="input-icon"></i>
                            <input 
                                type="tel" 
                                id="mob" 
                                name="mob" 
                                value="<?= set_value('mob'); ?>" 
                                class="form-input" 
                                placeholder="1234567890"
                                pattern="[0-9+\-]{10,15}" 
                                title="10-15 digits, + and - allowed"
                                autocomplete="tel"
                                data-testid="input-mobile"
                            >
                        </div>
                        <div class="form-help">
                            <i data-lucide="info"></i>
                            10-15 digits, + and - allowed (optional)
                        </div>
                    </div>

                    <!-- Employee Code -->
                    <div class="form-group">
                        <label for="ename" class="form-label">
                            <i data-lucide="hash"></i>
                            Employee Code
                            <span class="required-asterisk">*</span>
                        </label>
                        <div class="input-with-icon">
                            <i data-lucide="hash" class="input-icon"></i>
                            <input 
                                type="text" 
                                id="ename" 
                                name="ename" 
                                value="<?= set_value('ename'); ?>" 
                                class="form-input employee-code-input" 
                                placeholder="john_doe"
                                pattern="[A-Za-z0-9_\-]+" 
                                title="Alphanumeric, underscore and dash allowed"
                                required
                                data-testid="input-employee-code"
                            >
                        </div>
                        <div class="form-help">
                            <i data-lucide="info"></i>
                            Unique identifier: letters, numbers, underscore, and dash only
                        </div>
                    </div>

                    <!-- Designation -->
                    <div class="form-group">
                        <label for="designation" class="form-label">
                            <i data-lucide="briefcase"></i>
                            Designation
                            <span class="required-asterisk">*</span>
                        </label>
                        <div class="input-with-icon">
                            <i data-lucide="briefcase" class="input-icon"></i>
                            <input 
                                type="text" 
                                id="designation" 
                                name="designation" 
                                value="<?= set_value('designation'); ?>" 
                                class="form-input" 
                                placeholder="Software Engineer"
                                required
                                data-testid="input-designation"
                            >
                        </div>
                        <div class="form-help">
                            <i data-lucide="info"></i>
                            Job title or role in the organization
                        </div>
                    </div>

                    <!-- Level -->
                    <div class="form-group">
                        <label for="level" class="form-label">
                            <i data-lucide="layers"></i>
                            Level
                            <span class="required-asterisk">*</span>
                        </label>
                        <div class="input-with-icon">
                            <i data-lucide="layers" class="input-icon"></i>
                            <input 
                                type="number" 
                                id="level" 
                                name="level" 
                                value="<?= set_value('level'); ?>" 
                                class="form-input" 
                                min="1" 
                                placeholder="4"
                                required
                                data-testid="input-level"
                            >
                        </div>
                        <div class="level-info">
                            <div class="level-guide-title">Organizational Level Guide:</div>
                            <div class="level-examples">
                                <span class="level-example">Level 1: CEO</span>
                                <span class="level-example">Level 2-3: Management</span>
                                <span class="level-example">Level 4+: Staff</span>
                            </div>
                            <div class="level-note">
                                <strong>Note:</strong> Manager must have a lower level (higher authority) than employee
                            </div>
                        </div>
                    </div>

                    <!-- Manager Selection -->
                    <div class="form-group">
                        <label for="manager" class="form-label">
                            <i data-lucide="users"></i>
                            Manager (Employee Code)
                        </label>
                        <select id="manager" name="manager" class="form-select" data-testid="select-manager">
                            <option value="">-- No Manager --</option>
                            <?php foreach($managers as $m): ?>
                                <option value="<?= $m->ename; ?>" <?= set_select('manager', $m->ename); ?>>
                                    <?= htmlspecialchars($m->name); ?> (<?= htmlspecialchars($m->designation); ?>) - <?= htmlspecialchars($m->ename); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-help">
                            <i data-lucide="info"></i>
                            Select the direct reporting manager (optional)
                        </div>
                    </div>

                    <!-- Manager ID -->
                    <div class="form-group">
                        <label for="mgrid" class="form-label">
                            <i data-lucide="key"></i>
                            Manager ID
                        </label>
                        <select id="mgrid" name="mgrid" class="form-select" data-testid="select-manager-id">
                            <option value="">-- No Manager --</option>
                            <?php foreach($managers as $m): ?>
                                <option value="<?= $m->empid; ?>" <?= set_select('mgrid', $m->empid); ?>>
                                    <?= htmlspecialchars($m->name); ?> (<?= htmlspecialchars($m->designation); ?>) - ID: <?= $m->empid; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-help">
                            <i data-lucide="info"></i>
                            Manager ID should match the selected manager above
                        </div>
                    </div>
                </div>

                <!-- Manager Sync Info -->
                <div class="manager-sync-info" id="managerSyncInfo" data-testid="info-manager-sync">
                    <i data-lucide="link"></i>
                    <span>Manager selections are automatically synchronized</span>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="<?= base_url('employees'); ?>" class="btn btn-secondary" data-testid="button-cancel">
                        <i data-lucide="x"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn" data-testid="button-submit">
                        <span id="submitText">
                            <i data-lucide="user-plus"></i>
                            Add Employee
                        </span>
                        <div id="submitSpinner" class="spinner"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Manager Selection Synchronization
    const managerSelect = document.getElementById('manager');
    const mgrIdSelect = document.getElementById('mgrid');
    const syncInfo = document.getElementById('managerSyncInfo');

    // Create manager mapping
    const managerMapping = {};
    <?php foreach($managers as $m): ?>
        managerMapping['<?= $m->ename; ?>'] = '<?= $m->empid; ?>';
    <?php endforeach; ?>

    function syncManagerSelections() {
        if (managerSelect.value && mgrIdSelect.value) {
            const expectedId = managerMapping[managerSelect.value];
            if (mgrIdSelect.value === expectedId) {
                syncInfo.style.display = 'flex';
            } else {
                syncInfo.style.display = 'none';
            }
        } else {
            syncInfo.style.display = 'none';
        }
    }

    managerSelect.addEventListener('change', function() {
        const selectedManager = this.value;
        if (selectedManager && managerMapping[selectedManager]) {
            mgrIdSelect.value = managerMapping[selectedManager];
        } else {
            mgrIdSelect.value = '';
        }
        syncManagerSelections();
    });

    mgrIdSelect.addEventListener('change', function() {
        const selectedId = this.value;
        let foundManager = '';
        
        for (const [manager, id] of Object.entries(managerMapping)) {
            if (id === selectedId) {
                foundManager = manager;
                break;
            }
        }
        
        if (foundManager) {
            managerSelect.value = foundManager;
        } else {
            managerSelect.value = '';
        }
        syncManagerSelections();
    });

    // Form Submission with Loading State
    const form = document.getElementById('employeeForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    form.addEventListener('submit', function(e) {
        // Show loading state
        submitBtn.disabled = true;
        submitText.style.display = 'none';
        submitSpinner.style.display = 'block';
        
        // Form will submit normally after this
    });

    // Real-time Validation
    const inputs = document.querySelectorAll('.form-input, .form-select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    });

    function validateField(field) {
        let isValid = true;
        
        // Required field validation
        if (field.hasAttribute('required') && !field.value.trim()) {
            isValid = false;
        }
        
        // Pattern validation
        if (field.hasAttribute('pattern') && field.value) {
            const pattern = new RegExp(field.getAttribute('pattern'));
            if (!pattern.test(field.value)) {
                isValid = false;
            }
        }
        
        // Number validation
        if (field.type === 'number' && field.value) {
            const min = field.getAttribute('min');
            if (min && parseFloat(field.value) < parseFloat(min)) {
                isValid = false;
            }
        }
        
        // Update field appearance
        if (isValid) {
            field.classList.remove('error');
        } else {
            field.classList.add('error');
        }
        
        return isValid;
    }
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');

    // Check mobile
    let isMobile = window.innerWidth <= 768;
    let sidebarCollapsed = false;

    // Theme Functions
    function setTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
            if (themeIcon) themeIcon.setAttribute('data-lucide', 'moon');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            if (themeIcon) themeIcon.setAttribute('data-lucide', 'sun');
            localStorage.setItem('theme', 'light');
        }
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function toggleTheme() {
        setTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark');
    }

    if (themeToggle) themeToggle.addEventListener('click', toggleTheme);

    // Initialize theme
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    setTheme(savedTheme || (systemPrefersDark ? 'dark' : 'light'));

    // Sidebar Functions
    function collapseSidebar() {
        sidebar?.classList.add('collapsed');
        mainContent?.classList.add('expanded');
        sidebarCollapsed = true;
        if (!isMobile) localStorage.setItem('sidebarCollapsed', 'true');
        updateToggleIcon();
    }

    function expandSidebar() {
        sidebar?.classList.remove('collapsed');
        mainContent?.classList.remove('expanded');
        sidebarCollapsed = false;
        if (!isMobile) localStorage.setItem('sidebarCollapsed', 'false');
        updateToggleIcon();
    }

    function updateToggleIcon() {
        if (sidebarToggle) {
            sidebarToggle.innerHTML = sidebarCollapsed 
                ? '<i data-lucide="menu" style="width: 1.25rem; height: 1.25rem;"></i>'
                : '<i data-lucide="x" style="width: 1.25rem; height: 1.25rem;"></i>';
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }
    }

    function toggleSidebar() {
        if (isMobile) {
            if (sidebarCollapsed) {
                sidebar?.classList.remove('collapsed');
                sidebar?.classList.add('mobile-open');
                sidebarOverlay?.classList.add('visible');
            } else {
                sidebar?.classList.add('collapsed');
                sidebar?.classList.remove('mobile-open');
                sidebarOverlay?.classList.remove('visible');
            }
            sidebarCollapsed = !sidebarCollapsed;
        } else {
            sidebarCollapsed ? expandSidebar() : collapseSidebar();
        }
        updateToggleIcon();
    }

    sidebarToggle?.addEventListener('click', toggleSidebar);
    sidebarOverlay?.addEventListener('click', () => {
        if (isMobile) {
            sidebar?.classList.add('collapsed');
            sidebar?.classList.remove('mobile-open');
            sidebarOverlay?.classList.remove('visible');
            sidebarCollapsed = true;
            updateToggleIcon();
        }
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        const wasMobile = isMobile;
        isMobile = window.innerWidth <= 768;
        if (wasMobile !== isMobile) {
            if (isMobile) collapseSidebar();
            else {
                const savedState = localStorage.getItem('sidebarCollapsed');
                savedState === 'true' ? collapseSidebar() : expandSidebar();
            }
        }
    });

    // Initialize sidebar on load
    const savedState = localStorage.getItem('sidebarCollapsed');
    if (isMobile) collapseSidebar();
    else savedState === 'true' ? collapseSidebar() : expandSidebar();
});
</script>

<?php $this->load->view('templates/footer'); ?>