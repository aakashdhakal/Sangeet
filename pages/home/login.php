<dialog id="loginForm">
    <div class="max-width">
        <button class="close-dialog-btn" id="closeLoginForm">
            <iconify-icon icon="system-uicons:cross"></iconify-icon> </button>
        <h2>Login</h2>
        <div class="error-container">
            <p class="error-text">Username already Exists</p>
        </div>
        <div class="forms-container">

            <form action="#" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="harilama">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder=" ">
                    <button class="toggle-password-visibility" type="button">
                        <iconify-icon icon="fluent:eye-24-regular"></iconify-icon></button>
                </div>
                <p class="forgot-password-show">Forgot Password?</p>
                <button type="submit" class="primary-btn">Login</button>
                <p>Don't have an account?&nbsp;&nbsp;<a href="#" id="signupFromLogin">Sign Up</a></p>
            </form>
        </div>
    </div>
</dialog>