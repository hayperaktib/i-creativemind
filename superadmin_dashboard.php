<?php include 'session.php'; ?>
<?php
include 'conn.php';

// Fetch user profile data for the modal and navbar
$user_id = $_SESSION['user_id'];
$profile_sql = "SELECT firstname, lastname, contact_number, email, profile_photo, gender, nickname FROM users WHERE user_id = ?";
$profile_stmt = mysqli_prepare($conn, $profile_sql);

if ($profile_stmt) {
    mysqli_stmt_bind_param($profile_stmt, "i", $user_id);
    mysqli_stmt_execute($profile_stmt);
    $profile_result = mysqli_stmt_get_result($profile_stmt);
    
    if ($profile_result && mysqli_num_rows($profile_result) > 0) {
        $profile_data = mysqli_fetch_assoc($profile_result);
        $firstname = $profile_data['firstname'] ?? '';
        $lastname = $profile_data['lastname'] ?? '';
        $contact_number = $profile_data['contact_number'] ?? '';
        $email = $profile_data['email'] ?? '';
        $profile_photo = $profile_data['profile_photo'] ?? '';
        $gender = $profile_data['gender'] ?? '';
        $nickname = $profile_data['nickname'] ?? '';
    } else {
        // Default values if user not found
        $firstname = '';
        $lastname = '';
        $contact_number = '';
        $email = '';
        $profile_photo = '';
        $gender = '';
        $nickname = '';
    }
    
    mysqli_stmt_close($profile_stmt);
} else {
    // Handle query preparation error
    error_log("Failed to prepare profile query: " . mysqli_error($conn));
    $firstname = $lastname = $contact_number = $email = $profile_photo = $gender = $nickname = '';
}

// Set default profile photo if none exists or file doesn't exist
if (empty($profile_photo) || !file_exists($profile_photo)) {
    $profile_photo = 'dist/img/default-avatar.png'; // You can use a default avatar image
}

try {
    $totalManagersQuery = "SELECT COUNT(*) as totalManagers FROM sales_managers";
    $totalAgentsQuery = "SELECT COUNT(*) as totalAgents FROM sales_agents";
    $totalUsersQuery = "SELECT COUNT(*) as totalUsers FROM users WHERE role != 'superadmin'";
    $databaseSizeQuery = "SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb FROM information_schema.tables WHERE table_schema = DATABASE()";

    // Recent activity query (if you have created_at columns)
    $recentActivityQuery = "SELECT 'New Manager' as activity, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i') as time 
                           UNION ALL SELECT 'System Update', DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 2 HOUR), '%Y-%m-%d %H:%i')
                           UNION ALL SELECT 'New Agent Added', DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 5 HOUR), '%Y-%m-%d %H:%i')
                           ORDER BY time DESC LIMIT 5";

    $totalManagersResult = mysqli_query($conn, $totalManagersQuery);
    $totalAgentsResult = mysqli_query($conn, $totalAgentsQuery);
    $totalUsersResult = mysqli_query($conn, $totalUsersQuery);
    $databaseSizeResult = mysqli_query($conn, $databaseSizeQuery);

    $totalManagers = $totalManagersResult ? mysqli_fetch_assoc($totalManagersResult)['totalManagers'] : 0;
    $totalAgents = $totalAgentsResult ? mysqli_fetch_assoc($totalAgentsResult)['totalAgents'] : 0;
    $totalUsers = $totalUsersResult ? mysqli_fetch_assoc($totalUsersResult)['totalUsers'] : 0;
    $databaseSize = $databaseSizeResult ? mysqli_fetch_assoc($databaseSizeResult)['size_mb'] : 0;

    $recentActivityResult = mysqli_query($conn, $recentActivityQuery);
} catch (Exception $e) {
    error_log("Dashboard query error: " . $e->getMessage());
    $totalManagers = $totalAgents = $totalUsers = $databaseSize = 0;
}

// Don't close the connection here since it's used later in the file
// mysqli_close($conn); // Remove this line or move it to the end of the file
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CDMS | Dashboard</title>
    <?php include 'header_scripts.php'; ?>
    <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Custom CSS to remove sidebar underlines -->
    <style>
        /* Remove underlines from all sidebar links */
        .main-sidebar .nav-link {
            text-decoration: none !important;
            border-bottom: none !important;
        }

        .main-sidebar .nav-link:hover {
            text-decoration: none !important;
        }

        .main-sidebar .brand-link {
            text-decoration: none !important;
            border-bottom: none !important;
        }

        .main-sidebar .brand-link:hover {
            text-decoration: none !important;
        }

        .main-sidebar a {
            text-decoration: none !important;
        }

        .main-sidebar a:hover {
            text-decoration: none !important;
        }

        /* Remove any underline from user info link */
        .main-sidebar .user-panel .info a {
            text-decoration: none !important;
        }

        .main-sidebar .user-panel .info a:hover {
            text-decoration: none !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed"
    style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="wrapper">
        <?php include 'superadmin_navbar_section.php'; ?>
        <?php include 'superadmin_profile_modal.php'; ?>
        <?php include 'superadmin_main_sidebar.php'; ?>

        <div class="content-wrapper" style="background: transparent;">
            <div class="content-header">
                <div class="container-fluid px-4">
                    <div class="row mb-4 align-items-center">
                        <div class="col-sm-8">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <i class="fas fa-chart-line text-white fa-2x"></i>
                                    </div>
                                </div>
                                <div>
                                    <h1 class="m-0 fw-bold" style="color: #0f5132; font-size: 2.5rem;">Dashboard</h1>
                                    <p class="fs-6 mt-1 mb-0" style="color: #6c757d;">Welcome back! Here's what's
                                        happening with your system.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb bg-white rounded-4 px-3 py-2 shadow-sm border-0">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-decoration-none fw-semibold" style="color: #0f5132;">
                                    <i class="fas fa-home me-1"></i>Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active fw-semibold" aria-current="page" style="color: #212529;">
                                Dashboard
                            </li>
                        </ol>
                    </nav>
                </div>
                <section class="content">
                    <div class="container-fluid px-4">
                        <div class="row g-4 mb-4">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div
                                    class="card border-0 shadow-lg h-100 position-relative overflow-hidden rounded-4 animate__animated animate__fadeInUp">
                                    <div class="position-absolute top-0 start-0 w-100 bg-success" style="height: 6px;">
                                    </div>
                                    <div class="card-body p-4 bg-white">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <h2 class="display-5 fw-bold mb-0 text-success me-2">
                                                        <?php echo number_format($totalManagers); ?>
                                                    </h2>
                                                </div>
                                                <p class="text-uppercase text-muted fw-semibold mb-0"
                                                    style="font-size: 11px; letter-spacing: 1px;">Total Managers</p>
                                                <small class="text-muted">Active personnel</small>
                                            </div>
                                            <div class="text-success" style="opacity: 0.2;">
                                                <i class="fas fa-people-roof fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0 border-0">
                                        <a href="superadmin_sales_manager.php"
                                            class="btn btn-success w-100 rounded-0 rounded-bottom-4 text-white fw-semibold py-3 text-decoration-none d-flex justify-content-between align-items-center border-0">
                                            <span><i class="fas fa-eye me-2"></i>View Details</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Agents Card -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden rounded-4 animate__animated animate__fadeInUp"
                                    style="animation-delay: 0.1s;">
                                    <div class="position-absolute top-0 start-0 w-100 bg-info" style="height: 6px;">
                                    </div>
                                    <div class="card-body p-4 bg-white">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <h2 class="display-5 fw-bold mb-0 text-info me-2">
                                                        <?php echo number_format($totalAgents); ?>
                                                    </h2>
                                                </div>
                                                <p class="text-uppercase text-muted fw-semibold mb-0"
                                                    style="font-size: 11px; letter-spacing: 1px;">Total Agents</p>
                                                <small class="text-muted">Field representatives</small>
                                            </div>
                                            <div class="text-info" style="opacity: 0.2;">
                                                <i class="fas fa-people-group fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0 border-0">
                                        <a href="superadmin_sales_agent.php"
                                            class="btn btn-info w-100 rounded-0 rounded-bottom-4 text-white fw-semibold py-3 text-decoration-none d-flex justify-content-between align-items-center border-0">
                                            <span><i class="fas fa-eye me-2"></i>View Details</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Users Card -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden rounded-4 animate__animated animate__fadeInUp"
                                    style="animation-delay: 0.2s;">
                                    <div class="position-absolute top-0 start-0 w-100 bg-warning" style="height: 6px;">
                                    </div>
                                    <div class="card-body p-4 bg-white">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <h2 class="display-5 fw-bold mb-0 text-warning me-2">
                                                        <?php echo number_format($totalUsers); ?>
                                                    </h2>
                                                </div>
                                                <p class="text-uppercase text-muted fw-semibold mb-0"
                                                    style="font-size: 11px; letter-spacing: 1px;">Total Users</p>
                                                <small class="text-muted">System users</small>
                                            </div>
                                            <div class="text-warning" style="opacity: 0.2;">
                                                <i class="fas fa-users fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0 border-0">
                                        <a href="superadmin_users.php"
                                            class="btn btn-warning w-100 rounded-0 rounded-bottom-4 text-white fw-semibold py-3 text-decoration-none d-flex justify-content-between align-items-center border-0">
                                            <span><i class="fas fa-eye me-2"></i>View Details</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Database Size Card -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="card border-0 shadow-lg h-100 position-relative overflow-hidden rounded-4 animate__animated animate__fadeInUp"
                                    style="animation-delay: 0.3s;">
                                    <div class="position-absolute top-0 start-0 w-100 bg-danger" style="height: 6px;">
                                    </div>
                                    <div class="card-body p-4 bg-white">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-2">
                                                    <h2 class="display-5 fw-bold mb-0 text-danger me-1">
                                                        <?php echo number_format($databaseSize, 1); ?>
                                                    </h2>
                                                    <span class="text-muted fw-normal">MB</span>
                                                </div>
                                                <p class="text-uppercase text-muted fw-semibold mb-0"
                                                    style="font-size: 11px; letter-spacing: 1px;">Database Size</p>
                                                <small class="text-muted">Storage used</small>
                                            </div>
                                            <div class="text-danger" style="opacity: 0.2;">
                                                <i class="fas fa-database fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0 border-0">
                                        <a href="superadmin_phpmyadmin.php"
                                            class="btn btn-danger w-100 rounded-0 rounded-bottom-4 text-white fw-semibold py-3 text-decoration-none d-flex justify-content-between align-items-center border-0">
                                            <span><i class="fas fa-eye me-2"></i>View Details</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <!-- Quick Actions Card -->
                            <div class="col-lg-8">
                                <div class="card border-0 shadow-sm rounded-4 animate__animated animate__fadeInUp"
                                    style="animation-delay: 0.4s;">
                                    <div class="card-header bg-white border-bottom-0 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="fas fa-bolt text-primary"></i>
                                            </div>
                                            <h5 class="fw-bold mb-0" style="color: #0f5132;">Quick Actions</h5>
                                        </div>
                                    </div>
                                    <div class="card-body py-4">
                                        <div class="row g-3">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <a href="superadmin_sales_manager.php"
                                                    class="btn btn-outline-success w-100 py-3 text-decoration-none position-relative overflow-hidden">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-user-plus me-2"></i>
                                                        <span class="fw-semibold">Add New Manager</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <a href="superadmin_sales_agent.php"
                                                    class="btn btn-outline-info w-100 py-3 text-decoration-none position-relative overflow-hidden">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-users me-2"></i>
                                                        <span class="fw-semibold">Manage Agents</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <a href="superadmin_users.php"
                                                    class="btn btn-outline-warning w-100 py-3 text-decoration-none position-relative overflow-hidden">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-cog me-2"></i>
                                                        <span class="fw-semibold">User Settings</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <a href="superadmin_phpmyadmin.php"
                                                    class="btn btn-outline-danger w-100 py-3 text-decoration-none position-relative overflow-hidden">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-database me-2"></i>
                                                        <span class="fw-semibold">Database Admin</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activity Card -->
                            <div class="col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 animate__animated animate__fadeInUp"
                                    style="animation-delay: 0.5s;">
                                    <div class="card-header bg-white border-bottom-0 py-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="fas fa-clock text-success"></i>
                                            </div>
                                            <h5 class="fw-bold mb-0" style="color: #0f5132;">Recent Activity</h5>
                                        </div>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="activity-timeline">
                                            <?php if ($recentActivityResult && mysqli_num_rows($recentActivityResult) > 0): ?>
                                                <?php while ($activity = mysqli_fetch_assoc($recentActivityResult)): ?>
                                                    <div class="d-flex align-items-start mb-3">
                                                        <div class="bg-success rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                            style="width: 8px; height: 8px; min-width: 8px;"></div>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1 fw-semibold" style="font-size: 14px;">
                                                                <?php echo htmlspecialchars($activity['activity']); ?>
                                                            </p>
                                                            <small class="text-muted"><?php echo $activity['time']; ?></small>
                                                        </div>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <div class="text-center py-4">
                                                    <i class="fas fa-info-circle text-muted mb-2"></i>
                                                    <p class="text-muted mb-0">No recent activity</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light border-0 py-3">
                                        <a href="#" class="btn btn-sm btn-outline-success w-100">
                                            <i class="fas fa-history me-2"></i>View All Activity
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php include 'footer_scripts.php'; ?>
                        <script
                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                        <script>
                            setInterval(function () {
                                location.reload();
                            }, 300000);

                            document.querySelectorAll('.card').forEach(card => {
                                card.addEventListener('mouseenter', function () {
                                    this.style.transform = 'translateY(-5px)';
                                    this.style.transition = 'transform 0.3s ease';
                                });

                                card.addEventListener('mouseleave', function () {
                                    this.style.transform = 'translateY(0)';
                                });
                            });

                            function animateCounter(element, target) {
                                let current = 0;
                                const increment = target / 100;
                                const timer = setInterval(() => {
                                    current += increment;
                                    if (current >= target) {
                                        current = target;
                                        clearInterval(timer);
                                    }
                                    element.textContent = Math.floor(current).toLocaleString();
                                }, 20);
                            }

                            document.addEventListener('DOMContentLoaded', function () {
                                const counters = document.querySelectorAll('.display-5');
                                counters.forEach(counter => {
                                    const target = parseInt(counter.textContent.replace(/,/g, ''));
                                    counter.textContent = '0';
                                    setTimeout(() => animateCounter(counter, target), 500);
                                });
                            });
                        </script>
</body>
</body> 
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debug: Check if modal exists
    const modal = document.getElementById('updateProfileModal');
    if (!modal) {
        console.error('Profile modal not found!');
        return;
    }

    // Debug: Check if modal trigger exists
    const modalTrigger = document.querySelector('[data-target="#updateProfileModal"]');
    if (!modalTrigger) {
        console.error('Modal trigger not found!');
        return;
    }

    // Add click event listener to modal trigger
    modalTrigger.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Modal trigger clicked');
        
        // Use Bootstrap 4 modal method
        $('#updateProfileModal').modal('show');
    });

    // Alternative: Force modal to work even if Bootstrap isn't loaded properly
    window.openProfileModal = function() {
        const modal = document.getElementById('updateProfileModal');
        if (modal) {
            modal.style.display = 'block';
            modal.classList.add('show');
            document.body.classList.add('modal-open');
            
            // Create backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.id = 'modal-backdrop';
            document.body.appendChild(backdrop);
        }
    };

    window.closeProfileModal = function() {
        const modal = document.getElementById('updateProfileModal');
        const backdrop = document.getElementById('modal-backdrop');
        
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
        }
        
        if (backdrop) {
            backdrop.remove();
        }
    };

    // Add close functionality to close buttons
    document.querySelectorAll('[data-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            window.closeProfileModal();
        });
    });

    // Check for update messages
    <?php if (isset($_SESSION['update_success'])): ?>
        alert('<?php echo addslashes($_SESSION['update_success']); ?>');
        <?php unset($_SESSION['update_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['update_error'])): ?>
        alert('Error: <?php echo addslashes($_SESSION['update_error']); ?>');
        <?php unset($_SESSION['update_error']); ?>
    <?php endif; ?>
});

// Fallback function that can be called directly
function openUpdateProfileModal() {
    $('#updateProfileModal').modal('show');
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check for update messages
    <?php if (isset($_SESSION['update_success'])): ?>
        // Show success message
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo addslashes($_SESSION['update_success']); ?>',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
        <?php unset($_SESSION['update_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['update_error'])): ?>
        // Show error message
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?php echo addslashes($_SESSION['update_error']); ?>',
            confirmButtonText: 'OK',
            confirmButtonColor: '#14452f'
        });
        <?php unset($_SESSION['update_error']); ?>
    <?php endif; ?>
});
</script>

<!-- Alternative: If you don't have SweetAlert, use this simple alert approach -->
<?php if (isset($_SESSION['update_success'])): ?>
<script>
    alert('<?php echo addslashes($_SESSION['update_success']); ?>');
</script>
<?php unset($_SESSION['update_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['update_error'])): ?>
<script>
    alert('Error: <?php echo addslashes($_SESSION['update_error']); ?>');
</script>
<?php unset($_SESSION['update_error']); ?>
<?php endif; ?>

</html>