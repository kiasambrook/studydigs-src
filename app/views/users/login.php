<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
        <div class="container pt-3">
            <section class="border rounded-0 d-md-flex align-items-center bg-light border-1 shadow-lg p-3 my-3 row">
                <div class="d-flex flex-column align-items-md-start align-items-center col-md-7">
                    <h1>Login</h1>
                    <p class="lead">To access your account and manage your portfolio, use the sign-in form below.</p>
                    <form class="w-75 d-flex flex-column justify-content-between" method="POST" action="<?php echo URLROOT;?>users/login">

                        <!-- email input -->
                        <div class="form-group my-2">
                            <label class="sr-only" for="email">Email: <sup>*</sup></label>
                            <input type="email" placeholder="Email..." name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>

                        <!-- password input -->
                        <div class="form-group my-2">
                            <label class="sr-only" for="password">Password: <sup>*</sup></label>
                            <input type="password" placeholder="Password..."  name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                    
                        <a class="my-2 link-primary link " href="<?php echo URLROOT;?>users/forgot">Forgotten my password</a>
                    
                        <button class="btn btn-primary text-white align-self-md-end my-2" type="submit">Login</button>
                        <p class="my-2">No account? No worries, you can <a class="link-primary" href="<?php echo URLROOT;?>users/register">register here!</a></p>
                    </form>
                </div>

                <div class="col-md-5 p-3"><img class="img-fluid d-none d-md-block w-100" src="<?php echo URLROOT;?>/img/login.svg" alt="A person entering their login details"></div>
            </section>
        </div>
    </main>


<?php require APPROOT . '/views/inc/footer.php'; ?>