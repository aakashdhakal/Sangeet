<dialog id="resetPassword">
    <div class="max-width">
        <button class="close-dialog-btn" id="closeResetPasswordForm">
            <iconify-icon icon="system-uicons:cross"></iconify-icon> </button>
        <h2>Reset Password</h2>
        <div class="error-container">
            <p class="error-text">Username already Exists</p>
        </div>
        <div class="forms-container">
            <form action="#" method="POST" class="get-email">
                <p>
                    Enter your email to reset your password
                </p>
                <div class="form-group">
                    <input type="email" name="email" id="resetPasswordEmail" placeholder=" ">
                    <label for="email">Email</label>
                </div>
                <button type="submit" class="primary-btn">Next</button>
            </form>
            <form action="#" method="POST" class="otp-verify">
                <p>Enter the OTP sent to your email</p>
                <div class="form-group otp-group">
                    <!-- one digit per input -->
                    <input type="number" name="otp[]" maxlength="1" autocomplete="off" required>
                    <input type="number" name="otp[]" maxlength="1" autocomplete="off" required>
                    <input type="number" name="otp[]" maxlength="1" autocomplete="off" required>
                    <input type="number" name="otp[]" maxlength="1" autocomplete="off" required>
                    <input type="number" name="otp[]" maxlength="1" autocomplete="off" required>
                    <input type="number" name="otp[]" maxlength="1" autocomplete="off" required>
                </div>
                <p class="resend-otp">Didn't Receive the code? <button class="resend" type="button">Resend</button>
                </p>
                <button type="submit" class="primary-btn">Verify</button>
            </form>
            <form action="" method="post" class="reset-password">
                <div class="form-group">
                    <input type="password" name="password" id="resetPassword" autocomplete="off" placeholder=" ">
                    <label for="password">New Password</label>
                    <button class="toggle-password-visibility" type="button">
                        <iconify-icon icon="fluent:eye-24-regular"></iconify-icon> </button>
                </div>
                <div class="form-group">
                    <input type="password" name="confirmPassword" id="resetConfirmPassword" autocomplete="off"
                        placeholder=" ">
                    <label for="confirmPassword">Confirm Password</label>
                    <button class="toggle-password-visibility" type="button">
                        <iconify-icon icon="fluent:eye-24-regular"></iconify-icon> </button>
                </div>
                <button type="submit" class="primary-btn">Reset Password</button>
            </form>
        </div>
</dialog>