
<script>
    // Update page title
    document.getElementById('pageTitle').textContent = 'Dashboard - Employee Management System';
</script>
<link rel="stylesheet" href="<?= base_url('application\views\assets\css\main.css'); ?>">
    <script src="<?= base_url('application\views\assets\js\main.js'); ?>"></script>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card" data-testid="card-total-employees">
        <div class="stat-header">
            <div class="stat-title">Total Employees</div>
            <i data-lucide="users" class="stat-icon"></i>
        </div>
        <div class="stat-value"><?= isset($total_employees) ? $total_employees : '0' ?></div>
        <div class="stat-description">
            <span class="stat-trend">+12%</span>
            <span>across all departments</span>
        </div>
    </div>

    <div class="stat-card" data-testid="card-active-today">
        <div class="stat-header">
            <div class="stat-title">Active Today</div>
            <i data-lucide="user-check" class="stat-icon"></i>
        </div>
        <div class="stat-value"><?= isset($active_today) ? $active_today : '0' ?></div>
        <div class="stat-description">currently working</div>
    </div>

    <div class="stat-card" data-testid="card-departments">
        <div class="stat-header">
            <div class="stat-title">Departments</div>
            <i data-lucide="building" class="stat-icon"></i>
        </div>
        <div class="stat-value"><?= isset($total_departments) ? $total_departments : '0' ?></div>
        <div class="stat-description">active departments</div>
    </div>

    <div class="stat-card" data-testid="card-growth-rate">
        <div class="stat-header">
            <div class="stat-title">Growth Rate</div>
            <i data-lucide="trending-up" class="stat-icon"></i>
        </div>
        <div class="stat-value">15.2%</div>
        <div class="stat-description">
            <span class="stat-trend">+3.1%</span>
            <span>this quarter</span>
        </div>
    </div>
</div>

<!-- Content Grid -->
<div class="content-grid">
    <!-- Recent Hires -->
    <div class="content-card" data-testid="card-recent-hires">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="clock"></i>
                Recent Hires
            </div>
            <div class="card-description">Latest employees added to the system</div>
        </div>
        <div class="card-content">
            <?php if (isset($recent_employees) && !empty($recent_employees)): ?>
                <?php foreach ($recent_employees as $employee): ?>
                    <div class="employee-item" data-testid="employee-item-<?= $employee->id ?>">
                        <div class="employee-avatar">
                            <?= substr($employee->name, 0, 1) . (strpos($employee->name, ' ') ? substr($employee->name, strpos($employee->name, ' ') + 1, 1) : '') ?>
                        </div>
                        <div class="employee-info">
                            <div class="employee-name"><?= htmlspecialchars($employee->name) ?></div>
                            <div class="employee-role"><?= htmlspecialchars($employee->designation) ?></div>
                        </div>
                        <div class="employee-badge badge-new">New</div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i data-lucide="user-x" class="empty-icon"></i>
                    <p>No recent hires to display</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Management Team -->
    <div class="content-card" data-testid="card-management-team">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="building"></i>
                Management Team
            </div>
            <div class="card-description">Leadership and management personnel</div>
        </div>
        <div class="card-content">
            <?php if (isset($management_team) && !empty($management_team)): ?>
                <?php foreach ($management_team as $manager): ?>
                    <div class="employee-item" data-testid="manager-item-<?= $manager->id ?>">
                        <div class="employee-avatar">
                            <?= substr($manager->name, 0, 1) . (strpos($manager->name, ' ') ? substr($manager->name, strpos($manager->name, ' ') + 1, 1) : '') ?>
                        </div>
                        <div class="employee-info">
                            <div class="employee-name"><?= htmlspecialchars($manager->name) ?></div>
                            <div class="employee-role"><?= htmlspecialchars($manager->designation) ?></div>
                        </div>
                        <div class="employee-badge <?= $manager->level == 1 ? 'badge-ceo' : 'badge-manager' ?>">
                            <?= $manager->level == 1 ? 'CEO' : 'Manager' ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i data-lucide="building" class="empty-icon"></i>
                    <p>No management team to display</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="content-card" data-testid="card-quick-actions">
    <div class="card-header">
        <div class="card-title">Quick Actions</div>
        <div class="card-description">Common tasks and shortcuts for employee management</div>
    </div>
    <div class="card-content">
        <div class="quick-actions">
            <a href="<?= base_url('employees/create'); ?>" class="quick-action" data-testid="action-add-employee">
                <i data-lucide="user-plus" class="quick-action-icon"></i>
                <div class="quick-action-title">Add Employee</div>
                <div class="quick-action-desc">Create new record</div>
            </a>
            
            <a href="<?= base_url('chart'); ?>" class="quick-action" data-testid="action-org-chart">
                <i data-lucide="git-branch" class="quick-action-icon"></i>
                <div class="quick-action-title">Org Chart</div>
                <div class="quick-action-desc">View hierarchy</div>
            </a>
            
            <a href="<?= base_url('employees'); ?>" class="quick-action" data-testid="action-all-employees">
                <i data-lucide="users" class="quick-action-icon"></i>
                <div class="quick-action-title">All Employees</div>
                <div class="quick-action-desc">View and manage</div>
            </a>
            
            <div class="quick-action" data-testid="action-reports">
                <i data-lucide="trending-up" class="quick-action-icon"></i>
                <div class="quick-action-title">Reports</div>
                <div class="quick-action-desc">Analytics</div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Add click handlers for stat cards
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('click', function() {
            const title = this.querySelector('.stat-title').textContent;
            if (title === 'Total Employees') {
                window.location.href = '<?= base_url('employees'); ?>';
            }
        });
    });
</script>

<?php $this->load->view('templates/footer'); ?>