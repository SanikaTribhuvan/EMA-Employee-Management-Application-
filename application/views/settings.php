<script>
    document.getElementById('pageTitle').textContent = 'Settings - Employee Management System';
</script>

<style>
    /* Settings Page specific CSS (optional) */
    .settings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1.5rem;
    }

    .form-switch {
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
    }

    .switch-label {
        font-weight: 500;
        color: rgb(var(--foreground));
    }
</style>

<div class="settings-grid">
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="settings"></i>
                General Settings
            </div>
            <div class="card-description">Global application settings.</div>
        </div>
        <div class="card-content">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="site_name" class="form-label">
                        <i data-lucide="globe"></i>
                        Site Name
                    </label>
                    <input type="text" id="site_name" name="site_name" class="form-input" value="Employee Management System" placeholder="Enter site name">
                </div>
                <div class="form-group">
                    <label for="default_level" class="form-label">
                        <i data-lucide="layers"></i>
                        Default Employee Level
                    </label>
                    <input type="number" id="default_level" name="default_level" class="form-input" value="4" min="1">
                </div>
                <div class="form-actions" style="border-top: none; padding-top: 0;">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save"></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="users"></i>
                User Management
            </div>
            <div class="card-description">Manage administrator accounts.</div>
        </div>
        <div class="card-content">
            <div class="table-container" style="margin-bottom: 1rem;">
                <table class="modern-table">
                    <thead class="table-header">
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <tr>
                            <td>admin_user</td>
                            <td>Administrator</td>
                            <td class="actions-cell">
                                <button class="btn btn-danger btn-warning">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn btn-success">
                <i data-lucide="user-plus"></i> Add New Admin
            </a>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="brush"></i>
                Customization
            </div>
            <div class="card-description">Personalize your experience.</div>
        </div>
        <div class="card-content">
            <div class="form-group">
                <label for="theme_select" class="form-label">
                    <i data-lucide="paintbrush"></i>
                    Color Theme
                </label>
                <select id="theme_select" name="theme_select" class="form-select">
                    <option value="default">Default</option>
                    <option value="maroon">Maroon (Classic)</option>
                    <option value="custom">Custom</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-switch">
                    <label for="notifications" class="switch-label">
                        <i data-lucide="bell"></i>
                        Email Notifications
                    </label>
                    <label class="switch">
                      <input type="checkbox" id="notifications">
                      <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="database"></i>
                Data & Security
            </div>
            <div class="card-description">Administrative data tools.</div>
        </div>
        <div class="card-content">
            <div class="form-actions" style="flex-direction: column; align-items: flex-start; gap: 1rem; padding: 0;">
                <button class="btn btn-primary">
                    <i data-lucide="download"></i>
                    Export Employee Data (CSV)
                </button>
                <button class="btn btn-secondary">
                    <i data-lucide="archive"></i>
                    Perform Data Backup
                </button>
                <button class="btn btn-danger">
                    <i data-lucide="file-x"></i>
                    Clear Old Records
                </button>
            </div>
        </div>
    </div>
</div>