            </div> <!-- /content-container -->
        </main> <!-- /main-content -->
    </div> <!-- /app-layout -->
<link rel="stylesheet" href="<?= base_url('application\views\assets\css\main.css'); ?>">
    <script src="<?= base_url('application\views\assets\js\main.js'); ?>"></script>

    <script>
    // Initialize Lucide Icons
    lucide.createIcons();

    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");
        const toggleBtn = document.getElementById("sidebarToggle");
        const themeToggle = document.getElementById("themeToggle");
        const body = document.body;

        // ✅ Sidebar Toggle
        if (sidebar && mainContent && toggleBtn) {
            toggleBtn.addEventListener("click", function() {
                sidebar.classList.toggle("collapsed");
                mainContent.classList.toggle("sidebar-collapsed");
            });
        }

        // ✅ Theme Toggle
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            body.classList.add("dark");
            themeToggle.innerHTML =
                '<i data-lucide="sun" style="width: 1rem; height: 1rem;"></i>';
        }

        if (themeToggle) {
            themeToggle.addEventListener("click", () => {
                body.classList.toggle("dark");
                const isDark = body.classList.contains("dark");

                if (isDark) {
                    localStorage.setItem("theme", "dark");
                    themeToggle.innerHTML =
                        '<i data-lucide="sun" style="width: 1rem; height: 1rem;"></i>';
                } else {
                    localStorage.setItem("theme", "light");
                    themeToggle.innerHTML =
                        '<i data-lucide="moon" style="width: 1rem; height: 1rem;"></i>';
                }

                // Reinitialize icons
                lucide.createIcons();
            });
        }
    });
</script>

</body>
</html>
