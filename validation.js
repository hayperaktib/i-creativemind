$(document).ready(function() {
    $('#txtvalidid1').hide();
    $('#txtreligion1').hide();
    
    $('#txtvalidid').on('change', function() {
        const selectedValue = $(this).val();
        if (selectedValue === 'Other') {
            $('#txtvalidid1').show().attr('placeholder', 'Please specify ID type').prop('required', true);
        } else if (selectedValue !== '') {
            $('#txtvalidid1').show().attr('placeholder', 'ID Number').prop('required', true);
        } else {
            $('#txtvalidid1').hide().prop('required', false).val('');
        }
    });
    
 
    $('#txtreligion').on('change', function() {
        const selectedValue = $(this).val();
        if (selectedValue === 'Other') {
            $('#txtreligion1').show().attr('placeholder', 'Please specify religion').prop('required', true);
        } else if (selectedValue !== '' && selectedValue !== 'Religion') {
            $('#txtreligion1').hide().prop('required', false).val('');
        } else {
            $('#txtreligion1').hide().prop('required', false).val('');
        }
    });

    $('#txtdob').on('change', function() {
        const dob = new Date($(this).val());
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        
        $('#txtage').val(age);
    });
    
    $('#txtcontact, #txtcontact_number_emergency').on('input', function() {
        let value = $(this).val().replace(/\D/g, ''); 
        
        if (value.length > 11) {
            value = value.substring(0, 11);
        }
        
        if (value.length >= 4) {
            value = value.substring(0, 4) + '-' + value.substring(4);
        }
        if (value.length >= 9) {
            value = value.substring(0, 9) + '-' + value.substring(9);
        }
        
        $(this).val(value);
    });
    
    $('#txtlast, #txtfirst, #txtmiddle, #txtfathersname, #txtfathersfname, #txtfathersmname, #txtmothersname, #txtmothersfname, #txtmothersmname, #txthusbandsname, #txthusbandsfname, #txthusbandsmname').on('input', function() {
        const value = $(this).val();
        const namePattern = /^[a-zA-Z\s]*$/;
        
        if (!namePattern.test(value)) {
            $(this).val(value.replace(/[^a-zA-Z\s]/g, ''));
            showValidationMessage($(this), 'Only letters and spaces are allowed');
        } else {
            clearValidationMessage($(this));
        }
    });
    
    $('#txtyears, #txtchildren').on('input', function() {
        const value = $(this).val();
        if (!/^\d*$/.test(value)) {
            $(this).val(value.replace(/\D/g, ''));
            showValidationMessage($(this), 'Only numbers are allowed');
        } else {
            clearValidationMessage($(this));
        }
    });
    
    $('#txtcivilstatus').on('change', function() {
        const status = $(this).val();
        const husbandFields = $('#txthusbandsname, #txthusbandsfname, #txthusbandsmname');
        
        if (status === 'Single') {
            husbandFields.prop('required', false).val('').closest('.col-md-4').hide();
        } else if (status === 'Married') {
            husbandFields.prop('required', true).closest('.col-md-4').show();
        } else {
            husbandFields.prop('required', false).closest('.col-md-4').show();
        }
    });
    
    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
    
    $('#txtdate_issued, #txtdate_expired').on('change', function() {
        const issueDate = new Date($('#txtdate_issued').val());
        const expireDate = new Date($('#txtdate_expired').val());
        const today = new Date();
        
        if ($('#txtdate_issued').val() && $('#txtdate_expired').val()) {
            if (expireDate <= issueDate) {
                showValidationMessage($('#txtdate_expired'), 'Expiry date must be after issue date');
            } else {
                clearValidationMessage($('#txtdate_expired'));
            }
        }
        
        if ($('#txtdate_expired').val() && expireDate < today) {
            showValidationMessage($('#txtdate_expired'), 'Passport appears to be expired');
        }
    });
    
    $('form').on('submit', function(e) {
        let isValid = true;
        const requiredFields = $(this).find('[required]');
        
        $('.validation-message').remove();
        $('.is-invalid').removeClass('is-invalid');
        
        requiredFields.each(function() {
            if (!$(this).val().trim()) {
                showValidationMessage($(this), 'This field is required');
                isValid = false;
            }
        });
        
        const phoneFields = $('#txtcontact, #txtcontact_number_emergency');
        phoneFields.each(function() {
            const phone = $(this).val().replace(/\D/g, '');
            if (phone.length < 10 || phone.length > 11) {
                showValidationMessage($(this), 'Please enter a valid phone number');
                isValid = false;
            }
        });
        
        const age = parseInt($('#txtage').val());
        if (age < 18 || age > 65) {
            showValidationMessage($('#txtage'), 'Age must be between 18 and 65');
            isValid = false;
        }
        
        const passportNumber = $('#txtpassport_number').val();
        if (passportNumber && passportNumber.length < 6) {
            showValidationMessage($('#txtpassport_number'), 'Please enter a valid passport number');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            
            const firstError = $('.is-invalid').first();
            if (firstError.length) {
                $('html, body').animate({
                    scrollTop: firstError.offset().top - 100
                }, 500);
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please correct the errors in the form before submitting.',
                confirmButtonColor: '#0f5132'
            });
        } else {
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
        }
    });
    
    function showValidationMessage(element, message) {
        element.addClass('is-invalid');
        element.next('.validation-message').remove();
        element.after('<div class="validation-message text-danger" style="font-size: 11px; margin-top: 2px;">' + message + '</div>');
    }
    
    function clearValidationMessage(element) {
        element.removeClass('is-invalid');
        element.next('.validation-message').remove();
    }
    
    $('#txtcivilstatus').trigger('change');
    
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            .is-invalid {
                border-color: #dc3545 !important;
                box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            }
            .validation-message {
                display: block;
                width: 100%;
                margin-top: 0.25rem;
                font-size: 0.875em;
                color: #dc3545;
            }
            .form-control:focus {
                border-color: #0f5132;
                box-shadow: 0 0 0 0.2rem rgba(15, 81, 50, 0.25);
            }
        `)
        .appendTo('head');
});