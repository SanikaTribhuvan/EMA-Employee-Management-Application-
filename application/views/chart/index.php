
<script>
    // Update page title
    document.getElementById('pageTitle').textContent = 'Organizational Chart';
</script>
<link rel="stylesheet" href="<?= base_url('application\views\assets\css\main.css'); ?>">
    <script src="<?= base_url('application\views\assets\js\main.js'); ?>"></script>


<!-- Organizational Chart Section -->
<div class="chart-container">
    <div class="chart-header">
        <h1 class="chart-title">
            <i data-lucide="git-branch" style="width: 1.25rem; height: 1.25rem;"></i>
            Organizational Chart
        </h1>
        <p class="chart-description">
            Interactive visualization of the company's organizational structure and reporting hierarchy
        </p>
    </div>

    <div class="chart-body">
        <div class="chart-controls">
            <div class="view-toggle">
                <button class="view-btn active" id="chartViewBtn" onclick="showChartView()">
                    <i data-lucide="git-branch" style="width: 1rem; height: 1rem;"></i>
                    Chart View
                </button>
                <button class="view-btn" id="tableViewBtn" onclick="showTableView()">
                    <i data-lucide="table" style="width: 1rem; height: 1rem;"></i>
                    Table View
                </button>
            </div>
            
            <div class="stat-item">
                <i data-lucide="users" class="stat-icon"></i>
                <span class="stat-label">Total Employees:</span>
                <span class="stat-value"><?= count($employees) ?></span>
            </div>
            
            <div class="stat-item">
                <i data-lucide="layers" class="stat-icon"></i>
                <span class="stat-label">Levels:</span>
                <span class="stat-value"><?= !empty($employees) ? max(array_column($employees, 'level')) : 0 ?></span>
            </div>
        </div>

        <!-- Chart View -->
        <div id="chartView" class="chart-view">
            <div class="chart-loading" id="chartLoading">
                <div class="loading-spinner"></div>
                <p>Loading organizational chart...</p>
            </div>
            <div id="orgChart" style="width: 100%; height: 100%; min-height: 500px;"></div>
        </div>

        <!-- Table View -->
        <div id="tableView" style="display: none;">
            <?php if(!empty($employees)): ?>
                <div class="table-container">
                    <div class="table-header-section">
                        <h2 class="table-title">
                            <i data-lucide="table" style="width: 1rem; height: 1rem;"></i>
                            Employee Hierarchy Table
                        </h2>
                        <p class="table-subtitle">
                            Complete list of all employees with their organizational details
                        </p>
                    </div>

                    <table class="modern-table">
                        <thead class="table-head">
                            <tr>
                                <th>Employee</th>
                                <th>Employee ID</th>
                                <th>Designation</th>
                                <th>Level</th>
                                <th>Manager</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php foreach($employees as $emp): ?>
                                <tr>
                                    <td>
                                        <div class="employee-cell">
                                            <div class="employee-avatar">
                                                <?= substr($emp->name, 0, 1) . (strpos($emp->name, ' ') ? substr($emp->name, strpos($emp->name, ' ') + 1, 1) : '') ?>
                                            </div>
                                            <div class="employee-info">
                                                <div class="employee-name"><?= htmlspecialchars($emp->name) ?></div>
                                                <div class="employee-id"><?= htmlspecialchars($emp->ename) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="font-family: 'JetBrains Mono', monospace; font-weight: 500;">
                                            #<?= str_pad($emp->empid, 4, '0', STR_PAD_LEFT) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($emp->designation) ?></td>
                                    <td>
                                        <span class="level-badge <?= $emp->level == 1 ? 'level-1' : ($emp->level == 2 ? 'level-2' : 'level-3-plus') ?>">
                                            <?= $emp->level == 1 ? 'CEO' : ($emp->level == 2 ? 'Manager' : 'Level ' . $emp->level) ?>
                                        </span>
                                    </td>
                                    <td><?= $emp->manager ? htmlspecialchars($emp->manager) : '<span style="color: rgb(var(--muted-foreground));">No Manager</span>' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="stats-bar">
                        <div class="stat-item">
                            <i data-lucide="crown" class="stat-icon"></i>
                            <span class="stat-label">CEOs:</span>
                            <span class="stat-value"><?= count(array_filter($employees, fn($e) => $e->level == 1)) ?></span>
                        </div>
                        <div class="stat-item">
                            <i data-lucide="users" class="stat-icon"></i>
                            <span class="stat-label">Managers:</span>
                            <span class="stat-value"><?= count(array_filter($employees, fn($e) => $e->level == 2)) ?></span>
                        </div>
                        <div class="stat-item">
                            <i data-lucide="user" class="stat-icon"></i>
                            <span class="stat-label">Staff:</span>
                            <span class="stat-value"><?= count(array_filter($employees, fn($e) => $e->level > 2)) ?></span>
                        </div>
                        <div class="stat-item">
                            <i data-lucide="building" class="stat-icon"></i>
                            <span class="stat-label">Departments:</span>
                            <span class="stat-value"><?= count(array_unique(array_map(fn($e) => explode(' ', $e->designation)[0], $employees))) ?></span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i data-lucide="git-branch" class="empty-icon"></i>
                    <div class="empty-title">No Organizational Data</div>
                    <div class="empty-description">
                        No employees found to display in the organizational chart
                    </div>
                    <a href="<?= base_url('employees/create'); ?>" class="btn btn-primary">
                        <i data-lucide="user-plus" style="width: 1rem; height: 1rem;"></i>
                        Add First Employee
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Google Charts Script -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Initialize Lucide Icons
    lucide.createIcons();

    // View Toggle Functions
    function showChartView() {
        document.getElementById('chartView').style.display = 'block';
        document.getElementById('tableView').style.display = 'none';
        document.getElementById('chartViewBtn').classList.add('active');
        document.getElementById('tableViewBtn').classList.remove('active');
        
        // Redraw chart when switching views
        if (typeof chart !== 'undefined') {
            setTimeout(() => {
                chart.draw(chartData, chartOptions);
            }, 100);
        }
    }

    function showTableView() {
        document.getElementById('chartView').style.display = 'none';
        document.getElementById('tableView').style.display = 'block';
        document.getElementById('chartViewBtn').classList.remove('active');
        document.getElementById('tableViewBtn').classList.add('active');
    }

    // Google Charts Implementation
    let chart, chartData, chartOptions;

    <?php if(!empty($employees)): ?>
    google.charts.load('current', {packages:["orgchart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const loading = document.getElementById('chartLoading');
        
        try {
            chartData = new google.visualization.DataTable();
            chartData.addColumn('string', 'Name');
            chartData.addColumn('string', 'Manager');
            chartData.addColumn('string', 'ToolTip');

            chartData.addRows([
                <?php foreach($employees as $emp): ?>
                    [{
                        v: '<?= addslashes($emp->ename) ?>', 
                        f: `<div style="padding: 0.75rem; text-align: center; font-family: 'Inter', sans-serif;">
                                <div style="font-weight: 600; font-size: 0.875rem; margin-bottom: 0.25rem; color: rgb(var(--foreground));">
                                    <?= addslashes($emp->name) ?>
                                </div>
                                <div style="font-size: 0.75rem; color: rgb(var(--primary)); margin-bottom: 0.25rem;">
                                    <?= addslashes($emp->designation) ?>
                                </div>
                                <div style="font-size: 0.625rem; color: rgb(var(--muted-foreground)); font-family: 'JetBrains Mono', monospace;">
                                    <?= addslashes($emp->ename) ?> • Level <?= $emp->level ?>
                                </div>
                            </div>`
                    }, 
                    '<?= addslashes($emp->manager ?? '') ?>', 
                    `Employee: <?= addslashes($emp->name) ?>\nDesignation: <?= addslashes($emp->designation) ?>\nLevel: <?= $emp->level ?>\nMobile: <?= addslashes($emp->mob ?? 'N/A') ?>\nManager: <?= addslashes($emp->manager ?? 'No Manager') ?>`],
                <?php endforeach; ?>
            ]);

            chartOptions = {
                allowHtml: true,
                allowCollapse: true,
                nodeClass: 'org-chart-node',
                selectedNodeClass: 'org-chart-selected',
                size: 'medium'
            };

            chart = new google.visualization.OrgChart(document.getElementById('orgChart'));
            
            // Hide loading indicator
            loading.style.display = 'none';
            
            // Draw the chart
            chart.draw(chartData, chartOptions);

            // Add event listeners
            google.visualization.events.addListener(chart, 'select', function() {
                const selection = chart.getSelection();
                if (selection.length > 0) {
                    const row = selection[0].row;
                    const employeeCode = chartData.getValue(row, 0);
                    console.log('Selected employee:', employeeCode);
                    
                    // Add visual feedback
                    const nodes = document.querySelectorAll('.google-visualization-orgchart-node');
                    nodes.forEach(node => {
                        node.style.transform = '';
                        node.style.boxShadow = '';
                    });
                    
                    // Highlight selected node
                    setTimeout(() => {
                        const selectedNodes = document.querySelectorAll('.google-visualization-orgchart-nodesel');
                        selectedNodes.forEach(node => {
                            node.style.transform = 'scale(1.05)';
                            node.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.2)';
                            node.style.transition = 'all 0.3s ease';
                        });
                    }, 100);
                }
            });

            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    if (document.getElementById('chartView').style.display !== 'none') {
                        chart.draw(chartData, chartOptions);
                    }
                }, 250);
            });

        } catch (error) {
            console.error('Error drawing chart:', error);
            loading.innerHTML = `
                <div style="color: rgb(var(--destructive));">
                    <i data-lucide="alert-circle" style="width: 2rem; height: 2rem; margin: 0 auto 1rem;"></i>
                    <p>Error loading organizational chart</p>
                    <p style="font-size: 0.875rem; margin-top: 0.5rem;">Please try refreshing the page</p>
                </div>
            `;
            lucide.createIcons();
        }
    }
    <?php else: ?>
    // Hide loading when no employees
    document.getElementById('chartLoading').style.display = 'none';
    document.getElementById('orgChart').innerHTML = `
        <div class="empty-state">
            <i data-lucide="git-branch" class="empty-icon"></i>
            <div class="empty-title">No Organizational Data</div>
            <div class="empty-description">
                No employees found to display in the organizational chart
            </div>
        </div>
    `;
    lucide.createIcons();
    <?php endif; ?>

    // Enhanced table interactions
    document.querySelectorAll('.table-body tr').forEach(row => {
        row.addEventListener('click', function() {
            // Remove previous selection
            document.querySelectorAll('.table-body tr').forEach(r => r.classList.remove('selected'));
            // Add selection to clicked row
            this.classList.add('selected');
        });
    });

    // Add selection styling
    const style = document.createElement('style');
    style.textContent = `
        .table-body tr.selected {
            background-color: rgb(var(--primary) / 0.1) !important;
            border-color: rgb(var(--primary)) !important;
        }
    `;
    document.head.appendChild(style);
</script>

<?php $this->load->view('templates/footer'); ?>