<dialog id="signupForm">
    <div class="max-width">
        <button class="close-dialog-btn" id="closeSignupForm">
            <iconify-icon icon="system-uicons:cross"></iconify-icon> </button>
        <h2>Sign Up</h2>
        <div class="error-container">
            <p class="error-text">Username already Exists</p>
        </div>
        <div class="forms-container">
            <form method="POST" class="signup-form">
                <div class="auth-details">
                    <div class="input-group">
                        <div class="form-group">
                            <input type="text" name="username" id="signupUsername" placeholder="mynameiskhan">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="signupEmail" placeholder="name@email.com"
                                autocomplete="off">
                            <label for="email">Email</label>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="signupPassword" autocomplete="off"
                                placeholder="Min 8 characters">
                            <label for="password">Password</label>
                            <button class="toggle-password-visibility" type="button">
                                <iconify-icon icon="fluent:eye-24-regular"></iconify-icon> </button>
                        </div>
                    </div>
                    <button class="primary-btn" id="sendOtp">Next</button>
                    <p>Already have an account? <a href="#" id="loginFromSignup">Login</a></p>
                </div>
                <div class="otp-verify">
                    <p>We have sent a verification code to your email. Please enter the code to verify your email</p>
                    <div class="form-group otp-group">
                        <!-- one digit per input -->
                        <input type="number" name="otp[]" id="otp1" maxlength="1" autocomplete="off">
                        <input type="number" name="otp[]" id="otp2" maxlength="1" autocomplete="off">
                        <input type="number" name="otp[]" id="otp3" maxlength="1" autocomplete="off">
                        <input type="number" name="otp[]" id="otp4" maxlength="1" autocomplete="off">
                        <input type="number" name="otp[]" id="otp5" maxlength="1" autocomplete="off">
                        <input type="number" name="otp[]" id="otp6" maxlength="1" autocomplete="off">
                    </div>
                    <p class="resend-otp">Didn't Receive the code? <button class="resend" type="button">Resend
                            Code</button>
                    </p>
                    <button class="primary-btn" id="verifyOtp">Verify</button>
                </div>
                <div class="personal-info">
                    <div class="full-name">
                        <div class="form-group">
                            <input type="text" name="firstName" id="firstName" placeholder="Jhon">
                            <label for=" firstName">First Name</label>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastName" id="lastName" placeholder="Doe">
                            <label for="lastName">Last Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" id="datepicker" name="dob" placeholder="Select Date of Birth">
                        <label for="datepicker">Date of Birth</label>
                    </div>
                    <div class="form-group">
                        <p class="input-title">Gender</p>
                        <div class="custom-select">
                            <div class="select-display-container">
                                <p class="select-display">Male</p>
                                <iconify-icon icon="mage:caret-down"></iconify-icon>
                            </div>
                            <input type="hidden" name="gender" id="gender" value="male">
                            <ul class="select-options">
                                <li class="select-option" data-value="male">Male</li>
                                <li class="select-option" data-value="female">Female</li>
                                <li class="select-option" data-value="other">Other</li>
                        </div>
                    </div>
                    <div class="image-upload-area">
                        <p>Profile Picture</p>
                        <div class="custom-image-upload"
                            style="background-image: url('<?php echo get_url('/public/images/profile-pics/default.jpg'); ?>');">
                            <input type="file" id="profilePic" name="profile_pic" class="image-upload" accept="image/*">
                            <label for="profilePic">Browse Files</label>
                        </div>
                    </div>

                    <button class="primary-btn" type="submit">Sign Up</button>
                </div>
            </form>

        </div>
    </div>
</dialog>