<script>
    // Update page title
    document.getElementById('pageTitle').textContent = 'Employees - Employee Management System';
</script>
<link rel="stylesheet" href="<?= base_url('application/views/assets/css/main.css'); ?>">
    <script src="<?= base_url('application/views/assets/js/main.js'); ?>"></script>

<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success" data-testid="alert-success">
        <i data-lucide="check-circle"></i>
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="search-container" data-testid="container-search">
    <form method="get" action="<?= base_url('employees'); ?>" class="search-form" data-testid="form-search">
        <div class="search-input-container">
            <i data-lucide="search" class="search-icon"></i>
            <input 
                type="text" 
                name="search" 
                value="<?= htmlspecialchars($search); ?>" 
                class="search-input" 
                placeholder="Search employees by name, ID, or designation..."
                data-testid="input-search"
            >
        </div>
        <button type="submit" class="btn btn-primary" data-testid="button-search">
            <i data-lucide="search"></i>
            Search
        </button>
        <button type="button" class="btn btn-outline" onclick="window.location.href='<?= base_url('employees'); ?>'" data-testid="button-clear">
            <i data-lucide="x"></i>
            Clear
        </button>
        <a href="<?= base_url('employees/create'); ?>" class="btn btn-success" data-testid="button-add-employee">
            <i data-lucide="user-plus"></i>
            Add Employee
        </a>
    </form>
</div>

<div class="table-container" data-testid="container-table">
    <?php if(!empty($employees)): ?>
        <table class="modern-table" data-testid="table-employees">
            <thead class="table-header">
                <tr>
                    <th data-testid="header-employee">Employee</th>
                    <th data-testid="header-id">Employee ID</th>
                    <th data-testid="header-designation">Designation</th>
                    <th data-testid="header-level">Level</th>
                    <th data-testid="header-manager">Manager</th>
                    <th data-testid="header-mobile">Mobile</th>
                    <th data-testid="header-actions">Actions</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php foreach($employees as $emp): ?>
                    <tr data-testid="row-employee-<?= $emp->empid ?>">
                        <td>
                            <div class="employee-cell">
                                <div class="employee-avatar">
                                    <?= substr($emp->name, 0, 1) . (strpos($emp->name, ' ') ? substr($emp->name, strpos($emp->name, ' ') + 1, 1) : '') ?>
                                </div>
                                <div class="employee-info">
                                    <div class="employee-name" data-testid="text-employee-name-<?= $emp->empid ?>"><?= htmlspecialchars($emp->name) ?></div>
                                    <div class="employee-code" data-testid="text-employee-code-<?= $emp->empid ?>"><?= htmlspecialchars($emp->ename) ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="employee-id" data-testid="text-employee-id-<?= $emp->empid ?>">
                                #<?= str_pad($emp->empid, 4, '0', STR_PAD_LEFT) ?>
                            </span>
                        </td>
                        <td data-testid="text-designation-<?= $emp->empid ?>"><?= htmlspecialchars($emp->designation) ?></td>
                        <td>
                            <span class="level-badge <?= $emp->level == 1 ? 'level-1' : ($emp->level == 2 ? 'level-2' : 'level-3-plus') ?>" data-testid="badge-level-<?= $emp->empid ?>">
                                <?= $emp->level == 1 ? 'CEO' : ($emp->level == 2 ? 'Manager' : 'Level ' . $emp->level) ?>
                            </span>
                        </td>
                        <td data-testid="text-manager-<?= $emp->empid ?>">
                            <?= $emp->manager ? htmlspecialchars($emp->manager) : '<span class="no-manager">No Manager</span>' ?>
                        </td>
                        <td>
                            <?php if($emp->mob): ?>
                                <a href="tel:<?= htmlspecialchars($emp->mob) ?>" class="mobile-link" data-testid="link-mobile-<?= $emp->empid ?>">
                                    <?= htmlspecialchars($emp->mob) ?>
                                </a>
                            <?php else: ?>
                                <span class="no-mobile" data-testid="text-no-mobile-<?= $emp->empid ?>">No Mobile</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="<?= base_url('employees/edit/' . $emp->empid); ?>" class="btn btn-warning" data-testid="button-edit-<?= $emp->empid ?>">
                                    <i data-lucide="edit"></i>
                                    Edit
                                </a>
                                
                                <form method="post" action="<?= base_url('employees/delete/' . $emp->empid); ?>" 
                                      onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                      style="display: inline;" data-testid="form-delete-<?= $emp->empid ?>">
                                    
                                    <button type="submit" class="btn btn-danger">
                                        <i data-lucide="trash-2"></i>
                                        Delete
                                    </button>
                                </form>
                                </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if(isset($pagination_links) && !empty($pagination_links)): ?>
            <div class="pagination-container" data-testid="container-pagination">
                <div class="pagination">
                    <?= $pagination_links; ?>
                </div>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="empty-state" data-testid="state-empty">
            <i data-lucide="users" class="empty-icon"></i>
            <div class="empty-title">No Employees Found</div>
            <div class="empty-description">
                <?php if(!empty($search)): ?>
                    No employees match your search criteria. Try adjusting your search terms.
                <?php else: ?>
                    Get started by adding your first employee to the system.
                <?php endif; ?>
            </div>
            <a href="<?= base_url('employees/create'); ?>" class="btn btn-primary" data-testid="button-add-first-employee">
                <i data-lucide="user-plus"></i>
                Add First Employee
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

<?php $this->load->view('templates/footer'); ?>