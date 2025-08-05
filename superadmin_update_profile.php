<?php
session_start();
include 'conn.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Initialize response variables
$success = false;
$error_message = '';

try {
    // Start transaction
    mysqli_begin_transaction($conn);
    
    // Handle password change if provided
    $password_updated = false;
    if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        // Validate new password
        if ($new_password !== $confirm_password) {
            throw new Exception('New passwords do not match.');
        }
        
        if (strlen($new_password) < 8) {
            throw new Exception('New password must be at least 8 characters long.');
        }
        
        // Verify current password
        $verify_sql = "SELECT password FROM users WHERE user_id = ?";
        $verify_stmt = mysqli_prepare($conn, $verify_sql);
        mysqli_stmt_bind_param($verify_stmt, "i", $user_id);
        mysqli_stmt_execute($verify_stmt);
        $verify_result = mysqli_stmt_get_result($verify_stmt);
        
        if ($verify_result && mysqli_num_rows($verify_result) > 0) {
            $user_data = mysqli_fetch_assoc($verify_result);
            $stored_password = $user_data['password'];
            
            // Verify current password
            if (!password_verify($current_password, $stored_password)) {
                throw new Exception('Current password is incorrect.');
            }
            
            // Hash new password
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $password_updated = true;
        } else {
            throw new Exception('User not found.');
        }
        
        mysqli_stmt_close($verify_stmt);
    }
    
    // Update user information
    if ($password_updated) {
        // Update with password
        $update_sql = "UPDATE users SET firstname = ?, lastname = ?, contact_number = ?, email = ?, password = ? WHERE user_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "sssssi", $firstname, $lastname, $contact_number, $email, $new_password_hash, $user_id);
    } else {
        // Update without password
        $update_sql = "UPDATE users SET firstname = ?, lastname = ?, contact_number = ?, email = ? WHERE user_id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "ssssi", $firstname, $lastname, $contact_number, $email, $user_id);
    }
    
    if (!mysqli_stmt_execute($update_stmt)) {
        throw new Exception('Failed to update user information.');
    }
    
    mysqli_stmt_close($update_stmt);
    
    // Handle profile photo upload
    $photo_updated = false;
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/";
        
        // Create uploads directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_tmp = $_FILES['profile_photo']['tmp_name'];
        $file_name = $_FILES['profile_photo']['name'];
        $file_size = $_FILES['profile_photo']['size'];
        $file_error = $_FILES['profile_photo']['error'];
        
        // Validate file
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($file_tmp);
        
        if (!in_array($file_type, $allowed_types)) {
            throw new Exception('Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.');
        }
        
        // Check file size (2MB limit)
        if ($file_size > 2 * 1024 * 1024) {
            throw new Exception('File size too large. Maximum size is 2MB.');
        }
        
        // Generate unique filename
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_filename = uniqid() . '.' . $file_extension;
        $target_file = $upload_dir . $unique_filename;
        
        // Move uploaded file
        if (move_uploaded_file($file_tmp, $target_file)) {
            // Update profile photo path in database
            $photo_sql = "UPDATE users SET profile_photo = ? WHERE user_id = ?";
            $photo_stmt = mysqli_prepare($conn, $photo_sql);
            mysqli_stmt_bind_param($photo_stmt, "si", $target_file, $user_id);
            
            if (!mysqli_stmt_execute($photo_stmt)) {
                throw new Exception('Failed to update profile photo in database.');
            }
            
            mysqli_stmt_close($photo_stmt);
            $photo_updated = true;
        } else {
            throw new Exception('Failed to upload profile photo.');
        }
    }
    
    // Commit transaction
    mysqli_commit($conn);
    $success = true;
    
    // Update session data
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($conn);
    $error_message = $e->getMessage();
}

// Close connection
mysqli_close($conn);

// Redirect with appropriate message
if ($success) {
    $message = 'Profile updated successfully!';
    if ($password_updated) {
        $message .= ' Password has been changed.';
    }
    if ($photo_updated) {
        $message .= ' Profile photo has been updated.';
    }
    
    // Store success message in session
    $_SESSION['update_success'] = $message;
    header('Location: superadmin_dashboard.php?update=success');
} else {
    // Store error message in session
    $_SESSION['update_error'] = $error_message;
    header('Location: superadmin_dashboard.php?update=error');
}

exit();
?>