<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-5 p-lg-0 p-lg-5 text-center text-sm-start">
        <div class="container pt-3">
            <section class="border rounded-0 d-md-flex align-items-center bg-light border-1 shadow-lg p-3 my-3 row">
                <div class="col-md-5"><img class="img-fluid d-none d-md-block w-100" src="<?php echo URLROOT;?>/img/register.svg" alt="A person registering on the site"></div>
                <div class="d-flex flex-column align-items-md-start align-items-center col-md-7">
                    <h1>Create an agent account</h1>
                    <p class="lead">Use the form below to sign up with StudyDigs and to begin advertising your properties today!</p>
                    <form class="w-75 d-flex flex-column justify-content-between" method="POST" action="<?php echo URLROOT; ?>users/register">

                        <!-- first name input -->
                        <div class="form-group my-2">
                            <label class="form-label visually-hidden" for="fname">First name: <sup>*</sup></label>
                            <input placeholder="First name..." type="text" name="fname" class="form-control form-control-lg <?php echo (!empty($data['fname_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['fname']; ?>">
                            <span class="invalid-feedback"><?php echo $data['fname_err']; ?></span>
                        </div>

                        <!-- last name input -->
                        <div class="form-group my-2">
                            <label class="form-label visually-hidden" for="lname">Last name: <sup>*</sup></label>
                            <input placeholder="Last name..." type="text" name="lname" class="form-control form-control-lg <?php echo (!empty($data['lname_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['lname']; ?>">
                            <span class="invalid-feedback"><?php echo $data['lname_err']; ?></span>
                        </div>

                         <!-- email input -->
                        <div class="form-group my-2">
                            <label  class="form-label visually-hidden" for="email">Email: <sup>*</sup></label>
                            <input placeholder="Email..." type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>

                        <!-- password input -->
                        <div class="form-group my-2">
                            <label  class="form-label visually-hidden" for="password">Password: <sup>*</sup></label>
                            <input placeholder="Password..." type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>

                        <!-- confirm password input -->
                        <div class="form-group my-2">
                            <label  class="form-label visually-hidden" for="confirm_password">Confirm password: <sup>*</sup></label>
                            <input placeholder="Confirm password..." type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['confirm_password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>
                    
                        <!-- Terms and condition check -->
                        <div class="form-check">
                            <input class="form-check-input <?php echo (!empty($data['checkbox_err'])) ? 'is-invalid' : '';?>" type="checkbox" id="terms" name="terms">
                            <label class="form-check-label" for="terms">I agree to the 
                                <a class="color-underline link-dark" href="terms.html">terms and conditions</a>
                            </label>
                            <span class="invalid-feedback"><?php echo $data['checkbox_err']; ?></span>
                        </div>
                        
                        <button class="btn btn-primary text-light align-self-md-end my-2" type="submit">Register
                        </button>
                        <p class="my-2">Already have an account? 
                            <a class="link-dark color-underline" href="<?php echo URLROOT; ?>users/login">Login here</a>
                        </p>
                    </form>
                </div>
            </section>
        </div>
    </main>


<?php require APPROOT . '/views/inc/footer.php'; ?>