<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/xchire-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size:12px;">Client Database Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo htmlspecialchars($profile_photo, ENT_QUOTES, 'UTF-8'); ?>" alt="Profile Picture" class="img-circle elevation-2">  
        </div>
        <div class="info">
          <a href="admin_dashboard.php?user_id=<?php echo urlencode($user_id); ?>" class="d-block" style="font-size:12px;">
            <?php echo htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8'); ?>
            <br>
            
          </a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard -->
          <li class="nav-item menu-open">
            <a href="interviwer_dashboard.php?user_id=<?php echo urlencode($user_id); ?>" class="nav-link active" style="font-size:12px; background-color: #0f5132;">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>


          <!-- Reports -->
          <li class="nav-item menu-close">
            <a href="interviewer_reports.php?user_id=<?php echo urlencode($user_id); ?>" class="nav-link" style="font-size:12px;">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Reports</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
