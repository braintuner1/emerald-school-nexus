
<aside id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h1 class="sidebar-title">Emerald School</h1>
    </div>
    
    <nav class="sidebar-nav">
        <?php
        // Define navigation items
        $navItems = [
            ['path' => 'index.php', 'name' => 'Dashboard', 'icon' => 'fa-home'],
            ['path' => 'students.php', 'name' => 'Students', 'icon' => 'fa-users'],
            ['path' => 'assessments.php', 'name' => 'Assessments', 'icon' => 'fa-book-open'],
            ['path' => 'reports.php', 'name' => 'Reports', 'icon' => 'fa-file-alt'],
            ['path' => 'teachers.php', 'name' => 'Teachers', 'icon' => 'fa-chalkboard-teacher'],
            ['path' => 'analytics.php', 'name' => 'Analytics', 'icon' => 'fa-chart-bar']
        ];
        
        // Get current page filename
        $currentPage = basename($_SERVER['PHP_SELF']);
        
        // Output navigation items
        foreach ($navItems as $item) {
            $isActive = ($currentPage === $item['path']) ? 'active' : '';
            echo '<a href="' . $item['path'] . '" class="nav-item ' . $isActive . '">';
            echo '<i class="fas ' . $item['icon'] . '"></i>';
            echo '<span>' . $item['name'] . '</span>';
            echo '</a>';
        }
        ?>
    </nav>
    
    <div class="sidebar-footer">
        <div class="sidebar-footer-content">
            <h3>Emerald School Nexus</h3>
            <p>Version 1.0</p>
        </div>
    </div>
</aside>
