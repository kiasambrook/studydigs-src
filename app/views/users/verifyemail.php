<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-5 p-lg-0 p-lg-5 text-center text-sm-start">
        <div class="container pt-3">
            <section class="border rounded-0 d-md-flex align-items-center bg-light border-1 shadow-lg p-3 my-3 row">
                <div class="d-flex flex-column align-items-md-start align-items-center col-md-7">
                    <h1>Welcome to StudyDigs, <?php echo $data['user_name'];?>!</h1>
                    <h3>One more thing...</h3>
                    <p class="lead">Before you can login, you must first verify your email address. Just click the link we have sent to your email address <span class="text-primary"><?php echo $data['user_email'];?></span>. Don't forget to check your spam box for the email or request it to be <a class="link" href="<?php echo URLROOT;?>users/verify" >resent</a>.</p>   
                    
                    <p class="lead">Once your email is verified, you can proceed to <a href="<?php echo URLROOT;?>users/login" class="link">login here</a>.</p>
                </div>

                <div class="col-md-5"><img class="img-fluid d-none d-md-block w-100" src="<?php echo URLROOT;?>/img/verify_email.svg" alt="Email being sent"></div>
            </section>
        </div>
    </main>


<?php require APPROOT . '/views/inc/footer.php'; ?>