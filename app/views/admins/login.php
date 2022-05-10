<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="login-clean bg-light p-5 row ">
    <form method="POST" action="<? echo URLROOT; ?>admins/login" class="form-control bg-white w-25 align-middle mx-auto p-4 rounded shadow col-xs-8">
        <div class="illustration text-center">
            <i class="fa fa-lock fa-5x my-3 text-primary"></i>
        </div>
        <h4 class="text-center mb-3">Admin Login</h4>
        
        <!-- username -->
        <div class="mb-3">
            <input class="border-0 form-control form-control-lg bg-light <?php echo (!empty($data['username_err'])) ? 'is-invalid' : '';?>"
                value="<?php echo $data['username']; ?>" type="text" name="username" placeholder="Username...">
            <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
        </div>

        <!--password -->
        <div class="mb-3">
            <input class="border-0 form-control form-control-lg bg-light <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>"
                value="<?php echo $data['password']; ?>" type="password" name="password" placeholder="Password...">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>

        <!-- button -->
        <div class="mb-3">
            <button class="btn btn-primary text-light d-block w-100 p-2" type="submit">Log In</button>
        </div>
        <a class="link link-primary small " href="#">Forgot your password?</a>

        <p class="text-danger text-center mt-3">Only site admins can access the admin dashboard, you can find the business account login <a href="users/login" class="link link-primary">here</a>.</p>

    </form>
    
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>