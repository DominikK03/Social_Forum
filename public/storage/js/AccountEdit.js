$(document).ready(function () {
    $('.change-password-btn').click(function () {
        $('#password-form').toggleClass('d-none');
        $('.invalid-feedback').hide();
        $('.success-password').hide();
        $('.invalid-password').hide();
        $('#newPassword, #confirmPassword').removeClass('is-invalid is-valid');
        $('.save-password-btn').attr('disabled', 'disabled');
    });

    function validatePassword(password) {
        const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        return re.test(password);
    }

    $('#passwordChangeForm').on('submit', function (e) {
        e.preventDefault();
        const currentPassword = $('#currentPassword').val();
        const newPassword = $('#newPassword').val();
        const confirmPassword = $('#confirmPassword').val();


        if (newPassword !== confirmPassword) {
            $('#confirmPassword').addClass('is-invalid');
            $('#confirmPassword').next('.invalid-feedback').show();
            return;
        }

        var formData = {
            currentPassword: currentPassword,
            newPassword: newPassword,
            confirmPassword: confirmPassword
        };

        $.ajax({
            url: '/passwordChange',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.success) {
                    $('#password-form').addClass('d-none');
                    $(".success-password").removeAttr('hidden').show().addClass('text-success');

                } else {
                    if (response.message === "Invalid password") {
                        $(".invalid-password").text("Invalid password.").show().addClass('text-danger');
                    }
                }
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });
});
