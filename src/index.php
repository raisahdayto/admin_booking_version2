<?php include 'connect/session_check.php'; ?>
<?php include 'layouts/head-main.php'; ?>

    <head>
        <title>Sign In | Velzon - Admin & Dashboard Template</title>
        <?php include 'layouts/title-meta.php'; ?>
        <?php include 'layouts/head-css.php'; ?>
    </head>

    <?php include 'layouts/body.php'; ?>
        <div class="login_page p-0 g-0 ">
            <div class="row login-container">
                <div class="col container-one">
                    <div class="">
                        <div class="main-container">
                            <div class="logo-container ms-2">
                                <img src="assets/img/login/logo.svg" class="img2" alt="Logo">
                            </div>                            
                            <img src="assets/img/login/left.avif" width="half" class="img" alt="Left Image">
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col container-two container d-flex justify-content-center align-items-center">
                    <div class="sub-container" style="background-color: #FAFAFA;">
                        <h2 class="pt-5 ps-5 fw-bold" style="color: #0683D7;">ADMIN</h2>
                        <div class="ps-5 pe-5 pt-3">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label class="chromaphobic fw-medium">Username</label><br>
                                <input type="username" name="usernameLogin" class="form-control bg-white" style="color: #8D97B0">
                            </div>
                            <div class="mb-2">
                                <label class="chromaphobic fw-medium">Password</label><br>
                                <input type="password" name="passwordLogin" class="form-control bg-white" style="color: #8D97B0">
                                <div class="small text-danger" id="loginMessage"></div>
                            </div>
                            <div>
                                <p class="mt-3">Please contact admin to change your credentials.</p>
                            </div>

                            <div class="container">
                            </div>
                            <div class="row p-0 mt-5">
                                <label class="chromaphobic"></label>
                                <span>
                                <input type="hidden" name="action" id="admin_login" value="admin_login">
                                <button id="submit" class="login-button-position mb-5 p-1" type="submit">
                                    <span class="btn login-button">LOG IN</span>
                                </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>
        <?php include 'layouts/vendor-scripts.php'; ?>
        <script src="assets/js/pages/passwordLogin-addon.init.js"></script>
        <script src="assets/js/signin.js"></script>
    </body>
</html>