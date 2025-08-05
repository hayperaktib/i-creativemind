<?php
session_start();
include 'conn.php';

// Ensure that POST data is being processed
if (isset($_POST['login'])) {
    // Fetch and sanitize input data
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $alertType = 'error';
        $alertMessage = 'Please enter both username and password.';
    } else {
        // Prepare SQL query to prevent SQL injection
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            $alertType = 'error';
            $alertMessage = 'Cannot find an account with the username.';
        } else {
            $row = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);

                // Store user data in session variables
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['profile_photo'] = $row['profile_photo'];
                $_SESSION['id_number'] = $row['id_number'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['contact_number'] = $row['contact_number'];
                
                // Redirect based on role
                $redirectUrl = '';
                switch ($row['role']) {
                    case 'superadmin':
                        $redirectUrl = 'superadmin_dashboard.php';
                        break;
                    case 'admin':
                        $redirectUrl = 'admin_dashboard.php';
                        break;
                    case 'interviewer':
                        $redirectUrl = 'interviewer_dashboard.php';
                        break;
                    case 'process officer':
                        $redirectUrl = 'po_dashboard.php';
                        break;
                    default:
                        $alertType = 'error';
                        $alertMessage = 'Unknown role.';
                        break;
                }

                if (!isset($alertType)) {
                    echo '<script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Toastify({
                                    text: "Login successful, redirecting...",
                                    duration: 1000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "linear-gradient(to right, #1d2e28, #18392b)",
                                }).showToast();
                                setTimeout(function() {
                                    window.location.href = "' . htmlspecialchars($redirectUrl, ENT_QUOTES, 'UTF-8') . '";
                                }, 1000);
                            });
                          </script>';
                }
            } else {
                $alertType = 'error';
                $alertMessage = 'Incorrect password.';
            }
        }
        $stmt->close();
        $conn->close();
    }

    if (isset($alertType) && $alertType === 'error') {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Toastify({
                        text: "' . htmlspecialchars($alertMessage, ENT_QUOTES, 'UTF-8') . '",
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#8B0000",
                    }).showToast();
                });
              </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Princess Joy Database Management System</title>
  <?php include 'header_scripts.php'; ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <link rel="shortcut icon" href="dist/img/xchire-logo.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<section class="login-section">
  <div class="container-fluid h-100">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-12 col-lg-10 col-xl-8">
        <div class="login-card">
          <div class="row g-0 h-100">
            <!-- Left Panel - Login Form -->
            <div class="col-lg-6 login-form-panel">
              <div class="login-form-container">
                
                <!-- Logo Section -->
                <div class="logo-section">
                  <img src="dist/img/xchire.png" alt="Princess Joy Logo" class="logo">
                </div>

                <!-- Header -->
                <div class="login-header">
                  <h1 class="login-title">Welcome Back</h1>
                  <p class="login-subtitle">Princess Joy Database Management System</p>
                </div>

                <!-- Login Form -->
                <form method="post" action="" class="login-form">
                  <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-wrapper">
                      <input 
                        type="text" 
                        id="username"
                        name="username" 
                        class="form-input" 
                        placeholder="Enter your username"
                        required
                        autocomplete="username"
                      >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                      <input 
                        type="password" 
                        id="password"
                        name="password" 
                        class="form-input" 
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password"
                      >
                    </div>
                  </div>

                  <button type="submit" name="login" class="login-btn">
                    <span class="btn-text">Sign In</span>
                    <i class="fas fa-arrow-right"></i>
                  </button>
                </form>

                <!-- Additional Link -->
                <div class="additional-links">
                  <a href="agent_lst.php" class="agent-link">AGENT Panel to encode new Applicant</a>
                </div>

              </div>
            </div>

            <!-- Right Panel - Image -->
            <div class="col-lg-6 login-image-panel">
              <div class="image-overlay">
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer_scripts.php'; ?>

<style>
:root {
  --primary-green: #1d2e28;
  --secondary-green: #18392b;
  --light-green: #2a4a35;
  --accent-green: #3d5c47;
  --text-dark: #2c3e50;
  --text-light: #6c757d;
  --text-muted: #8e9aaf;
  --white: #ffffff;
  --light-gray: #f8f9fa;
  --border-color: #e9ecef;
  --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.08);
  --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.12);
  --shadow-heavy: 0 20px 60px rgba(0, 0, 0, 0.15);
  --border-radius: 12px;
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  font-weight: 400;
  line-height: 1.6;
  color: var(--text-dark);
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  min-height: 100vh;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.login-section {
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding: 2rem 0;
}

.login-card {
  background: var(--white);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-heavy);
  overflow: hidden;
  min-height: 600px;
  max-width: 1000px;
  margin: 0 auto;
  border: 1px solid var(--border-color);
  transition: var(--transition);
}

.login-card:hover {
  box-shadow: 0 25px 70px rgba(0, 0, 0, 0.18);
}

/* Left Panel - Form */
.login-form-panel {
  display: flex;
  align-items: center;
  padding: 0;
  background: var(--white);
}

.login-form-container {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
  padding: 3rem 2.5rem;
}

.logo-section {
  text-align: center;
  margin-bottom: 2.5rem;
}

.logo {
  width: 160px;
  height: auto;
  transition: var(--transition);
}

.logo:hover {
  transform: scale(1.02);
}

.login-header {
  text-align: center;
  margin-bottom: 2.5rem;
}

.login-title {
  font-size: 1.875rem;
  font-weight: 700;
  color: var(--primary-green);
  margin-bottom: 0.5rem;
  letter-spacing: -0.02em;
}

.login-subtitle {
  font-size: 0.95rem;
  color: var(--text-light);
  font-weight: 400;
  line-height: 1.5;
  margin: 0;
}

.login-form {
  width: 100%;
}

.form-group {
  margin-bottom: 1.75rem;
}

.form-label {
  display: block;
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--text-dark);
  margin-bottom: 0.5rem;
  letter-spacing: 0.01em;
}

.input-wrapper {
  position: relative;
}

.form-input {
  width: 100%;
  padding: 0.875rem 1rem;
  font-size: 0.95rem;
  font-weight: 400;
  color: var(--text-dark);
  background: var(--white);
  border: 1.5px solid var(--border-color);
  border-radius: 8px;
  transition: var(--transition);
  outline: none;
}

.form-input:focus {
  border-color: var(--primary-green);
  box-shadow: 0 0 0 3px rgba(29, 46, 40, 0.1);
  transform: translateY(-1px);
}

.form-input::placeholder {
  color: var(--text-muted);
  font-weight: 400;
}

.login-btn {
  width: 100%;
  padding: 0.95rem 1.5rem;
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--white);
  background: linear-gradient(135deg, var(--primary-green) 0%, var(--secondary-green) 100%);
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: var(--transition);
  position: relative;
  overflow: hidden;
  letter-spacing: 0.02em;
  margin-top: 0.5rem;
}

.login-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(29, 46, 40, 0.3);
}

.login-btn:active {
  transform: translateY(0);
}

.login-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: var(--transition);
}

.login-btn:hover::before {
  left: 100%;
}

.btn-text {
  position: relative;
  z-index: 1;
}

.additional-links {
  margin-top: 2rem;
  text-align: center;
  border-top: 1px solid var(--border-color);
  padding-top: 1.5rem;
}

.agent-link {
  color: var(--primary-green);
  text-decoration: none;
  font-size: 0.875rem;
  font-weight: 500;
  transition: var(--transition);
  position: relative;
}

.agent-link:hover {
  color: var(--secondary-green);
  text-decoration: none;
}

.agent-link::after {
  content: '';
  position: absolute;
  width: 0;
  height: 2px;
  bottom: -2px;
  left: 50%;
  background: var(--secondary-green);
  transition: var(--transition);
  transform: translateX(-50%);
}

.agent-link:hover::after {
  width: 100%;
}

/* Right Panel - Image */
.login-image-panel {
  position: relative;
  background-image: url('dist/img/client.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 600px;
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(29, 46, 40, 0.3) 0%, rgba(24, 57, 43, 0.4) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 3rem 2.5rem;
}

.overlay-content {
  color: var(--white);
}

.overlay-title {
  font-size: 1.75rem;
  font-weight: 700;
  margin-bottom: 1rem;
  line-height: 1.3;
  letter-spacing: -0.02em;
}

.overlay-description {
  font-size: 1rem;
  opacity: 0.9;
  line-height: 1.6;
  font-weight: 400;
  margin: 0;
}

/* Responsive Design */
@media (max-width: 991.98px) {
  .login-card {
    margin: 1rem;
    min-height: auto;
  }
  
  .login-form-container {
    padding: 2.5rem 2rem;
  }
  
  .login-image-panel {
    min-height: 300px;
    order: -1;
  }
  
  .image-overlay {
    align-items: center;
    text-align: center;
    padding: 2rem;
  }
  
  .overlay-title {
    font-size: 1.5rem;
  }
  
  .overlay-description {
    font-size: 0.9rem;
  }
}

@media (max-width: 767.98px) {
  .login-section {
    padding: 1rem 0;
  }
  
  .login-form-container {
    padding: 2rem 1.5rem;
  }
  
  .login-title {
    font-size: 1.625rem;
  }
  
  .logo {
    width: 140px;
  }
}

@media (max-width: 575.98px) {
  .login-form-container {
    padding: 1.5rem 1rem;
  }
  
  .login-title {
    font-size: 1.5rem;
  }
  
  .form-input {
    padding: 0.75rem 0.875rem;
  }
  
  .login-btn {
    padding: 0.875rem 1.25rem;
  }
}

/* Loading state for button */
.login-btn.loading {
  pointer-events: none;
  opacity: 0.8;
}

.login-btn.loading .btn-text::after {
  content: '';
  display: inline-block;
  width: 16px;
  height: 16px;
  margin-left: 8px;
  border: 2px solid transparent;
  border-top: 2px solid var(--white);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Focus management for accessibility */
.form-input:focus,
.login-btn:focus,
.agent-link:focus {
  outline: 2px solid var(--primary-green);
  outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
  .login-card {
    border: 2px solid var(--text-dark);
  }
  
  .form-input {
    border-width: 2px;
  }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Add loading state to login button on form submission (but don't prevent submission)
  const loginForm = document.querySelector('.login-form');
  const loginBtn = document.querySelector('.login-btn');
  
  if (loginForm && loginBtn) {
    loginForm.addEventListener('submit', function(e) {
      // Don't prevent default - let the form submit normally
      loginBtn.classList.add('loading');
      // Don't disable the button as it might prevent form submission
    });
  }
  
  // Add smooth focus transitions
  const inputs = document.querySelectorAll('.form-input');
  inputs.forEach(input => {
    input.addEventListener('focus', function() {
      this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
      this.parentElement.classList.remove('focused');
    });
  });
});
</script>

</body>
</html>