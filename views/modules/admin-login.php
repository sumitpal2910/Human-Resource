<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Human</b> Resource</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body ">
            <div class="alert text-center">
                <h3>Admin Login</h3>
            </div>

            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="adminLoginEmail" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="adminLoginPassword" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="adminLoginBtn" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <?php
            $login = new AdminController();
            $login->ctlrLoginAdmin();
            ?>

            <div class="row mt-5 mb-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <a href="login" class="btn btn-success btn-block btn-sm">Go to Employee Panel</a>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>