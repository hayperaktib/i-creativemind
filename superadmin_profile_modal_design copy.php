<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <!-- Modal Header -->
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title font-weight-bold text-dark" id="updateProfileModalLabel">
                    <i class="fas fa-user-edit mr-2 text-success"></i>Update Profile
                </h5>
                <button type="button" class="close text-muted" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body bg-light p-4">
                <!-- Profile Display Section -->
                <div class="text-center mb-4">
                    <div class="position-relative d-inline-block">
                        <div class="profile-avatar">
                            <?php if (!empty($profile_photo) && file_exists($profile_photo)): ?>
                                <img src="<?php echo htmlspecialchars($profile_photo); ?>"
                                     alt="Profile Photo" class="rounded-circle shadow-sm"
                                     style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #14452f;">
                            <?php else: ?>
                                <div class="default-avatar rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                     style="width: 100px; height: 100px; background: linear-gradient(135deg, #4a90e2, #6a7ec2); color: white; font-size: 2.5rem; font-weight: 600; border: 3px solid #14452f;">
                                    <?php
                                    $initials = '';
                                    if (!empty($firstname)) $initials .= strtoupper(substr($firstname, 0, 1));
                                    if (!empty($lastname)) $initials .= strtoupper(substr($lastname, 0, 1));
                                    echo $initials ?: 'U';
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h6 class="mb-1 font-weight-bold text-dark">
                            <?php echo htmlspecialchars(trim($firstname . ' ' . $lastname)) ?: 'No name provided'; ?>
                        </h6>
                        <span class="badge badge-success px-3 py-1">Super Admin</span>
                    </div>
                </div>

                <!-- Update Form -->
                <form action="superadmin_update_profile.php" method="POST" enctype="multipart/form-data" id="profileUpdateForm">
                    <!-- Personal Information Section -->
                    <div class="bg-white rounded p-4 shadow-sm mb-3">
                        <h6 class="text-dark font-weight-bold mb-3 border-bottom pb-2">
                            <i class="fas fa-user mr-2 text-success"></i>Personal Information
                        </h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstname" class="form-label text-dark font-weight-medium">First Name</label>
                                <input type="text" class="form-control form-control-modern" id="firstname" name="firstname"
                                       value="<?php echo htmlspecialchars($firstname); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastname" class="form-label text-dark font-weight-medium">Last Name</label>
                                <input type="text" class="form-control form-control-modern" id="lastname" name="lastname"
                                       value="<?php echo htmlspecialchars($lastname); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_number" class="form-label text-dark font-weight-medium">Contact Number</label>
                                <input type="tel" class="form-control form-control-modern" id="contact_number" name="contact_number"
                                       value="<?php echo htmlspecialchars($contact_number); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-dark font-weight-medium">Email Address</label>
                                <div class="email-display-container">
                                    <input type="text" class="form-control form-control-readonly" id="email_display"
                                           value="<?php echo !empty($email) ? htmlspecialchars($email) : 'No email address linked to this account'; ?>"
                                           readonly>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Email address cannot be changed from this form
                                    </small>
                                </div>
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profile_photo" class="form-label text-dark font-weight-medium">Profile Photo</label>
                            <input type="file" class="form-control form-control-modern" id="profile_photo" name="profile_photo"
                                   accept="image/*">
                            <small class="form-text text-muted">Supported formats: JPG, PNG, GIF (Max: 2MB)</small>
                        </div>
                    </div>

                    <!-- Password Change Section -->
                    <div class="bg-white rounded p-4 shadow-sm">
                        <h6 class="text-dark font-weight-bold mb-3 border-bottom pb-2">
                            <i class="fas fa-lock mr-2 text-success"></i>Change Password (Optional)
                        </h6>
                        <div class="alert alert-info alert-sm mb-3" role="alert">
                            <i class="fas fa-info-circle mr-2"></i>
                            Leave password fields blank if you don't want to change your password.
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="current_password" class="form-label text-dark font-weight-medium">Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-modern" id="current_password"
                                           name="current_password" placeholder="Enter current password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-sm toggle-password" type="button" data-target="current_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password" class="form-label text-dark font-weight-medium">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-modern" id="new_password"
                                           name="new_password" placeholder="Enter new password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-sm toggle-password" type="button" data-target="new_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Minimum 8 characters required</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label text-dark font-weight-medium">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-modern" id="confirm_password"
                                           name="confirm_password" placeholder="Confirm new password">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-sm toggle-password" type="button" data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="password-strength" class="password-strength mt-2" style="display: none;">
                            <div class="strength-meter">
                                <div class="strength-meter-fill"></div>
                            </div>
                            <small class="strength-text text-muted"></small>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white border-top-0 px-4 py-3">
                <button type="button" class="btn btn-light border mr-2" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
                <button type="submit" form="profileUpdateForm" class="btn btn-success">
                    <i class="fas fa-save mr-2"></i>Update Profile
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Modal Content Styling */
#updateProfileModal .modal-content {
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    padding: 1.5rem 1.5rem 1rem;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
}

.close {
    font-size: 1.5rem;
    opacity: 0.7;
    transition: opacity 0.2s;
    color: #6c757d;
}

.close:hover {
    opacity: 1;
    color: #343a40;
}

/* Profile Display Styling */
.default-avatar {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Form Styling */
.form-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
}

.font-weight-medium {
    font-weight: 500;
}

.form-control-modern {
    border: 1px solid #c8d3dd;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background-color: #fcfdfe;
}

.form-control-modern:focus {
    border-color: #14452f;
    box-shadow: 0 0 0 0.2rem rgba(20, 69, 47, 0.15);
    background-color: #fff;
}

.form-control-modern:hover:not(:focus) {
    border-color: #aeb9c3;
    background-color: #fff;
}

/* Readonly email field styling */
.form-control-readonly {
    border: 1px solid #c8d3dd;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    background-color: #e9f0f7;
    color: #6c757d;
    cursor: not-allowed;
}

.email-display-container .form-text {
    margin-top: 0.25rem;
}

/* Alert styling */
.alert-sm {
    padding: 0.5rem 0.75rem;
    font-size: 0.8125rem;
    border-radius: 6px;
    border: none;
    background-color: #e6f7ff;
    color: #007bff;
}

.alert-sm .fas {
    font-size: 0.75rem;
}

/* Input groups */
.input-group .btn {
    border-radius: 0 8px 8px 0;
    border-left: none;
}

.toggle-password {
    background-color: transparent;
    border-color: #c8d3dd;
    color: #6c757d;
    transition: all 0.2s ease;
}

.toggle-password:hover {
    background-color: #f0f4f8;
    color: #495057;
}

/* Password strength indicator */
.password-strength {
    margin-top: 0.5rem;
}

.strength-meter {
    height: 4px;
    background-color: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-meter-fill {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

/* Strength colors */
.strength-weak { background-color: #dc3545; }
.strength-fair { background-color: #ffc107; }
.strength-good { background-color: #17a2b8; }
.strength-strong { background-color: #28a745; }

/* Button styling */
.btn {
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.5rem 1.25rem;
    transition: all 0.2s ease;
}

.btn-success {
    background-color: #14452f;
    border-color: #14452f;
}

.btn-success:hover {
    background-color: #0f3a27;
    border-color: #0f3a27;
    transform: translateY(-1px);
}

.btn-outline-secondary {
    border-color: #c8d3dd;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background-color: #f0f4f8;
    border-color: #aeb9c3;
}

/* Theme colors */
.text-success {
    color: #14452f !important;
}

.badge-success {
    background-color: #14452f;
}

.border-bottom {
    border-color: #e9ecef !important;
}

.input-group-append .btn:focus {
    box-shadow: none;
}

/* Utility classes */
.mr-2 { margin-right: 0.5rem; }
.me-1 { margin-right: 0.25rem; }

/* Responsive design */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 1rem;
    }

    .modal-footer {
        flex-direction: column-reverse;
    }

    .modal-footer .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .modal-footer .btn:last-child {
        margin-bottom: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Password strength checker
    const newPasswordInput = document.getElementById('new_password');
    const strengthIndicator = document.getElementById('password-strength');
    const strengthMeter = document.querySelector('.strength-meter-fill');
    const strengthText = document.querySelector('.strength-text');

    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;

            if (password.length === 0) {
                strengthIndicator.style.display = 'none';
                return;
            }

            strengthIndicator.style.display = 'block';
            const strength = calculatePasswordStrength(password);
            updateStrengthIndicator(strength);
        });
    }

    function calculatePasswordStrength(password) {
        let score = 0;

        // Length check
        if (password.length >= 8) score += 1;
        if (password.length >= 12) score += 1;

        // Character variety checks
        if (/[a-z]/.test(password)) score += 1;
        if (/[A-Z]/.test(password)) score += 1;
        if (/[0-9]/.test(password)) score += 1;
        if (/[^A-Za-z0-9]/.test(password)) score += 1;

        return Math.min(score, 4);
    }

    function updateStrengthIndicator(strength) {
        const levels = ['strength-weak', 'strength-fair', 'strength-good', 'strength-strong'];
        const texts = ['Weak', 'Fair', 'Good', 'Strong'];
        const widths = ['25%', '50%', '75%', '100%'];

        // Remove all strength classes
        strengthMeter.className = 'strength-meter-fill';

        if (strength > 0) {
            strengthMeter.classList.add(levels[strength - 1]);
            strengthMeter.style.width = widths[strength - 1];
            strengthText.textContent = `Password strength: ${texts[strength - 1]}`;
        }
    }

    // Password confirmation validation
    const confirmPasswordInput = document.getElementById('confirm_password');

    if (confirmPasswordInput && newPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            const newPassword = newPasswordInput.value;
            const confirmPassword = this.value;

            if (confirmPassword.length > 0) {
                if (newPassword === confirmPassword) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            } else {
                this.classList.remove('is-valid', 'is-invalid');
            }
        });
    }

    // Form validation before submit (maintain original detailed validation logic)
    document.getElementById('profileUpdateForm').addEventListener('submit', function(e) {
        const currentPassword = document.getElementById('current_password').value;
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        // If any password field is filled, all password fields must be filled
        if (currentPassword || newPassword || confirmPassword) {
            if (!currentPassword) {
                alert('Please enter your current password.');
                e.preventDefault();
                document.getElementById('current_password').focus();
                return false;
            }

            if (!newPassword) {
                alert('Please enter a new password.');
                e.preventDefault();
                document.getElementById('new_password').focus();
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert('New passwords do not match.');
                e.preventDefault();
                document.getElementById('confirm_password').focus();
                return false;
            }

            if (newPassword.length < 8) {
                alert('New password must be at least 8 characters long.');
                e.preventDefault();
                document.getElementById('new_password').focus();
                return false;
            }
        }
    });

    // Clear password fields when modal is closed (ensure jQuery compatibility)
    $(document).ready(function() {
        $('#updateProfileModal').on('hidden.bs.modal', function () {
            // Clear password fields
            document.getElementById('current_password').value = '';
            document.getElementById('new_password').value = '';
            document.getElementById('confirm_password').value = '';
            
            // Reset password field types to password
            ['current_password', 'new_password', 'confirm_password'].forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                const button = document.querySelector('[data-target="' + fieldId + '"]');
                if (field && button) {
                    const icon = button.querySelector('i');
                    if (field.type === 'text') {
                        field.type = 'password';
                        if (icon) {
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    }
                }
            });

            // Hide password strength indicator
            if (strengthIndicator) {
                strengthIndicator.style.display = 'none';
            }
            
            // Clear validation classes
            document.querySelectorAll('.is-valid, .is-invalid').forEach(function(element) {
                element.classList.remove('is-valid', 'is-invalid');
            });
        });
    });
});
</script>