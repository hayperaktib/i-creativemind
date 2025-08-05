<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0">
            <!-- Modal Header -->
            <div class="modal-header bg-gradient-primary border-0">
                <h5 class="modal-title font-weight-bold text-white" id="updateProfileModalLabel">
                    <i class="fas fa-user-edit mr-2"></i>Update Profile
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
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
                                     alt="Profile Photo" class="rounded-circle shadow-lg profile-image"
                                     style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #fff;">
                            <?php else: ?>
                                <div class="default-avatar rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-lg"
                                     style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 2.5rem; font-weight: 600; border: 4px solid #fff;">
                                    <?php
                                    $initials = '';
                                    if (!empty($firstname)) $initials .= strtoupper(substr($firstname, 0, 1));
                                    if (!empty($lastname)) $initials .= strtoupper(substr($lastname, 0, 1));
                                    echo $initials ?: 'U';
                                    ?>
                                </div>
                            <?php endif; ?>
                            <!-- Camera overlay for photo upload -->
                            <div class="photo-overlay" onclick="document.getElementById('profile_photo').click()">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-1 font-weight-bold text-dark">
                            <?php echo htmlspecialchars(trim($firstname . ' ' . $lastname)) ?: 'No name provided'; ?>
                        </h5>
                        <span class="badge badge-success-custom px-3 py-2">
                            <i class="fas fa-crown mr-1"></i>Super Administrator
                        </span>
                    </div>
                </div>

                <!-- Update Form -->
                <form action="superadmin_update_profile.php" method="POST" enctype="multipart/form-data" id="profileUpdateForm">
                    <div class="row">
                        <!-- Left Column - Personal Information -->
                        <div class="col-lg-7">
                            <div class="card card-modern h-100">
                                <div class="card-header bg-white border-bottom-0">
                                    <h6 class="text-dark font-weight-bold mb-0">
                                        <i class="fas fa-user mr-2 text-primary"></i>Personal Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstname" class="form-label">
                                                <i class="fas fa-user-circle mr-1 text-muted"></i>First Name
                                            </label>
                                            <input type="text" class="form-control form-control-modern" id="firstname" name="firstname"
                                                   value="<?php echo htmlspecialchars($firstname); ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lastname" class="form-label">
                                                <i class="fas fa-user-circle mr-1 text-muted"></i>Last Name
                                            </label>
                                            <input type="text" class="form-control form-control-modern" id="lastname" name="lastname"
                                                   value="<?php echo htmlspecialchars($lastname); ?>" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="contact_number" class="form-label">
                                            <i class="fas fa-phone mr-1 text-muted"></i>Contact Number
                                        </label>
                                        <input type="tel" class="form-control form-control-modern" id="contact_number" name="contact_number"
                                               value="<?php echo htmlspecialchars($contact_number); ?>" placeholder="+63 XXX XXX XXXX">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope mr-1 text-muted"></i>Email Address
                                        </label>
                                        <div class="email-display-container">
                                            <input type="text" class="form-control form-control-readonly" id="email_display"
                                                   value="<?php echo !empty($email) ? htmlspecialchars($email) : 'No email address linked to this account'; ?>"
                                                   readonly>
                                            <small class="form-text text-muted mt-1">
                                                <i class="fas fa-lock mr-1"></i>
                                                Email address cannot be changed from this form
                                            </small>
                                        </div>
                                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="profile_photo" class="form-label">
                                            <i class="fas fa-image mr-1 text-muted"></i>Profile Photo
                                        </label>
                                        <input type="file" class="form-control form-control-modern" id="profile_photo" name="profile_photo"
                                               accept="image/*" style="display: none;">
                                        <div class="custom-file-upload" onclick="document.getElementById('profile_photo').click()">
                                            <i class="fas fa-cloud-upload-alt mr-2"></i>
                                            <span id="file-name">Choose a new profile photo</span>
                                        </div>
                                        <small class="form-text text-muted">Supported formats: JPG, PNG, GIF (Max: 2MB)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Security Settings -->
                        <div class="col-lg-5">
                            <div class="card card-modern h-100">
                                <div class="card-header bg-white border-bottom-0">
                                    <h6 class="text-dark font-weight-bold mb-0">
                                        <i class="fas fa-shield-alt mr-2 text-warning"></i>Security Settings
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info-custom mb-3" role="alert">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Leave password fields blank if you don't want to change your password.
                                    </div>

                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">
                                            <i class="fas fa-key mr-1 text-muted"></i>Current Password
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-modern" id="current_password"
                                                   name="current_password" placeholder="Enter current password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">
                                            <i class="fas fa-lock mr-1 text-muted"></i>New Password
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-modern" id="new_password"
                                                   name="new_password" placeholder="Enter new password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Minimum 8 characters with letters and numbers</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">
                                            <i class="fas fa-check-circle mr-1 text-muted"></i>Confirm New Password
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-modern" id="confirm_password"
                                                   name="confirm_password" placeholder="Confirm new password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirm_password">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="password-feedback" class="password-feedback mt-2" style="display: none;">
                                        <div class="strength-meter">
                                            <div class="strength-meter-fill"></div>
                                        </div>
                                        <small class="strength-text text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-white border-top-0">
                <button type="button" class="btn btn-secondary-custom" onclick="closeModal()">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
                <button type="submit" form="profileUpdateForm" class="btn btn-success-custom">
                    <i class="fas fa-save mr-2"></i>Update Profile
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Modal Styling */
#updateProfileModal .modal-content {
    border-radius: 20px;
    overflow: hidden;
    border: none;
}

#updateProfileModal .modal-dialog {
    max-width: 1000px;
}

/* Header Styling */
.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem;
    border: none;
}

.modal-title {
    font-size: 1.4rem;
    font-weight: 600;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.close {
    font-size: 1.5rem;
    opacity: 0.8;
    transition: all 0.3s ease;
    color: white;
    text-shadow: none;
}

.close:hover {
    opacity: 1;
    transform: scale(1.1);
    color: white;
}

/* Profile Section Enhanced */
.profile-avatar {
    position: relative;
    display: inline-block;
}

.profile-image {
    transition: all 0.3s ease;
}

.photo-overlay {
    position: absolute;
    bottom: 0;
    right: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content-center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 3px solid white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}

.photo-overlay:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.25);
}

.default-avatar {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    transition: all 0.3s ease;
}

.default-avatar:hover {
    transform: scale(1.05);
}

/* Enhanced Card Styling */
.card-modern {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    background: white;
}

.card-modern:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    transform: translateY(-2px);
}

.card-header {
    padding: 1.25rem 1.5rem 1rem;
    background: white !important;
    border-bottom: 2px solid #f8f9fa;
}

.card-body {
    padding: 1.5rem;
}

/* Enhanced Form Controls */
.form-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.form-control-modern {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background-color: #fafafa;
}

.form-control-modern:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background-color: white;
    outline: none;
}

.form-control-modern:hover:not(:focus) {
    border-color: #cbd5e0;
    background-color: white;
}

/* Readonly field styling */
.form-control-readonly {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
    color: #718096;
    cursor: not-allowed;
}

/* Custom File Upload */
.custom-file-upload {
    border: 2px dashed #cbd5e0;
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
    color: #4a5568;
    font-weight: 500;
}

.custom-file-upload:hover {
    border-color: #667eea;
    background: #f0f4ff;
    color: #667eea;
}

/* Enhanced Alert */
.alert-info-custom {
    background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
    border: none;
    border-radius: 10px;
    color: #234e52;
    font-size: 0.85rem;
    padding: 0.75rem 1rem;
    border-left: 4px solid #38b2ac;
}

/* Enhanced Badges */
.badge-success-custom {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    color: white;
    font-size: 0.8rem;
    font-weight: 500;
    border-radius: 20px;
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 10px rgba(72, 187, 120, 0.3);
}

/* Enhanced Buttons */
.btn {
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
    text-transform: none;
    position: relative;
    overflow: hidden;
}

.btn-success-custom {
    background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
}

.btn-success-custom:hover {
    background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(72, 187, 120, 0.4);
    color: white;
}

.btn-secondary-custom {
    background: #718096;
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(113, 128, 150, 0.3);
}

.btn-secondary-custom:hover {
    background: #4a5568;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(113, 128, 150, 0.4);
    color: white;
}

/* Input Groups */
.input-group .btn {
    border-radius: 0 12px 12px 0;
    border: 2px solid #e2e8f0;
    border-left: none;
    background: white;
    color: #718096;
    padding: 0.75rem 1rem;
}

.input-group .btn:hover {
    background: #f7fafc;
    color: #4a5568;
    border-color: #cbd5e0;
}

.input-group .form-control-modern {
    border-radius: 12px 0 0 12px;
}

/* Password Strength */
.password-feedback {
    margin-top: 0.75rem;
}

.strength-meter {
    height: 6px;
    background: #e2e8f0;
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.strength-meter-fill {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 3px;
}

/* Strength colors with gradients */
.strength-weak { 
    background: linear-gradient(90deg, #fc8181 0%, #f56565 100%); 
}
.strength-fair { 
    background: linear-gradient(90deg, #f6ad55 0%, #ed8936 100%); 
}
.strength-good { 
    background: linear-gradient(90deg, #4fd1c7 0%, #38b2ac 100%); 
}
.strength-strong { 
    background: linear-gradient(90deg, #68d391 0%, #48bb78 100%); 
}

/* Footer Enhancement */
.modal-footer {
    padding: 1.5rem;
    background: #f8f9fa;
    border: none;
}

/* Validation States */
.is-valid {
    border-color: #48bb78 !important;
    box-shadow: 0 0 0 3px rgba(72, 187, 120, 0.1) !important;
}

.is-invalid {
    border-color: #f56565 !important;
    box-shadow: 0 0 0 3px rgba(245, 101, 101, 0.1) !important;
}

/* Responsive Design */
@media (max-width: 992px) {
    .modal-dialog {
        margin: 0.5rem;
        max-width: calc(100% - 1rem);
    }

    #updateProfileModal .col-lg-7,
    #updateProfileModal .col-lg-5 {
        margin-bottom: 1.5rem;
    }

    .card-modern .h-100 {
        height: auto !important;
    }
}

@media (max-width: 768px) {
    .modal-footer {
        flex-direction: column-reverse;
        gap: 0.5rem;
    }

    .modal-footer .btn {
        width: 100%;
        margin: 0;
    }

    .profile-avatar {
        margin-bottom: 1rem;
    }
}

/* Loading States */
.btn.loading {
    position: relative;
    color: transparent;
}

.btn.loading::after {
    content: "";
    position: absolute;
    width: 20px;
    height: 20px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.modal.show .modal-dialog {
    animation: fadeIn 0.3s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced modal close function with proper cleanup
    window.closeModal = function() {
        const modal = $('#updateProfileModal');
        
        // Clear all form data
        resetForm();
        
        // Hide modal with proper cleanup
        modal.modal('hide');
        
        // Ensure backdrop is removed
        setTimeout(function() {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
        }, 300);
    };

    // Reset form function
    function resetForm() {
        // Clear password fields
        document.getElementById('current_password').value = '';
        document.getElementById('new_password').value = '';
        document.getElementById('confirm_password').value = '';
        
        // Reset password field types
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
        const strengthIndicator = document.getElementById('password-feedback');
        if (strengthIndicator) {
            strengthIndicator.style.display = 'none';
        }
        
        // Clear validation classes
        document.querySelectorAll('.is-valid, .is-invalid').forEach(function(element) {
            element.classList.remove('is-valid', 'is-invalid');
        });

        // Reset file input display
        document.getElementById('file-name').textContent = 'Choose a new profile photo';
    }

    // Enhanced file input handling
    document.getElementById('profile_photo').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose a new profile photo';
        document.getElementById('file-name').textContent = fileName;
        
        // Show preview if image
        if (e.target.files[0] && e.target.files[0].type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const profileImg = document.querySelector('.profile-image, .default-avatar');
                if (profileImg) {
                    if (profileImg.tagName === 'IMG') {
                        profileImg.src = e.target.result;
                    } else {
                        // Replace default avatar with image
                        const newImg = document.createElement('img');
                        newImg.src = e.target.result;
                        newImg.className = 'rounded-circle shadow-lg profile-image';
                        newImg.style.cssText = 'width: 100px; height: 100px; object-fit: cover; border: 4px solid #fff;';
                        profileImg.parentNode.replaceChild(newImg, profileImg);
                    }
                }
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Enhanced password toggle
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                this.setAttribute('aria-label', 'Hide password');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                this.setAttribute('aria-label', 'Show password');
            }
        });
    });

    // Enhanced password strength checker
    const newPasswordInput = document.getElementById('new_password');
    const strengthIndicator = document.getElementById('password-feedback');
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

        // Length checks
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

    // Enhanced password confirmation validation
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

    // Enhanced form validation
    document.getElementById('profileUpdateForm').addEventListener('submit', function(e) {
        const submitBtn = document.querySelector('button[type="submit"]');
        const currentPassword = document.getElementById('current_password').value;
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        // Add loading state
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        // Password validation
        if (currentPassword || newPassword || confirmPassword) {
            if (!currentPassword) {
                alert('Please enter your current password.');
                e.preventDefault();
                document.getElementById('current_password').focus();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return false;
            }

            if (!newPassword) {
                alert('Please enter a new password.');
                e.preventDefault();
                document.getElementById('new_password').focus();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert('New passwords do not match.');
                e.preventDefault();
                document.getElementById('confirm_password').focus();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return false;
            }

            if (newPassword.length < 8) {
                alert('New password must be at least 8 characters long.');
                e.preventDefault();
                document.getElementById('new_password').focus();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return false;
            }
        }

        // File size validation
        const fileInput = document.getElementById('profile_photo');
        if (fileInput.files[0]) {
            const fileSize = fileInput.files[0].size / 1024 / 1024; // Convert to MB
            if (fileSize > 2) {
                alert('Profile photo must be less than 2MB.');
                e.preventDefault();
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                return false;
            }
        }

        // If validation passes, show success message
        setTimeout(function() {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        }, 2000);
    });

    // Enhanced modal event handlers
    $('#updateProfileModal').on('show.bs.modal', function() {
        // Add any pre-show logic here
        document.body.style.overflow = 'hidden';
    });

    $('#updateProfileModal').on('shown.bs.modal', function() {
        // Focus on first input when modal is shown
        document.getElementById('firstname').focus();
    });

    $('#updateProfileModal').on('hide.bs.modal', function() {
        // Reset form when modal is hidden
        resetForm();
    });

    $('#updateProfileModal').on('hidden.bs.modal', function() {
        // Ensure proper cleanup
        document.body.style.overflow = '';
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    });

    // Handle escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('#updateProfileModal').hasClass('show')) {
            closeModal();
        }
    });

    // Handle backdrop click
    $('#updateProfileModal').on('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Additional close button handlers
    document.querySelectorAll('[data-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            closeModal();
        });
    });

    // Input focus effects
    document.querySelectorAll('.form-control-modern').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Real-time validation for required fields
    ['firstname', 'lastname'].forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('input', function() {
                if (this.value.trim().length > 0) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });
        }
    });

    // Phone number formatting
    const phoneInput = document.getElementById('contact_number');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            // Format as +63 XXX XXX XXXX for Philippine numbers
            if (value.startsWith('63')) {
                value = value.substring(2);
            }
            if (value.startsWith('0')) {
                value = value.substring(1);
            }
            
            if (value.length > 0) {
                if (value.length <= 3) {
                    value = `+63 ${value}`;
                } else if (value.length <= 6) {
                    value = `+63 ${value.substring(0, 3)} ${value.substring(3)}`;
                } else {
                    value = `+63 ${value.substring(0, 3)} ${value.substring(3, 6)} ${value.substring(6, 10)}`;
                }
            }
            
            e.target.value = value;
        });
    }
});

// Global functions for external access
window.openUpdateProfileModal = function() {
    $('#updateProfileModal').modal('show');
};

window.closeUpdateProfileModal = function() {
    closeModal();
};
</script>