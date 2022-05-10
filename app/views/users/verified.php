<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-5 p-lg-0 p-lg-5 text-center text-sm-start">
        <div class="container pt-3">
            <section class="border rounded-0 d-md-flex align-items-center bg-light border-1 shadow-lg p-3 my-3 row">
            <div class="col-md-5"><img class="img-fluid d-none d-md-block w-100" src="<?php echo URLROOT;?>/img/verified.svg" alt="Image of email being verified"></div>

                <div class="d-flex flex-column align-items-md-start align-items-center col-md-7">
                    <h1>Thanks for verifying your email!</h1>
                    <p class="lead">Using your email and password, you can login into your account <a class="link" href="<?php echo URLROOT;?>users/login" >here</a>.</p>   
                </div>

               
            </section>
        </div>
    </main>


<?php require APPROOT . '/views/inc/footer.php'; ?>