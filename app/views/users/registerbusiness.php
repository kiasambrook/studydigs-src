<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-5 p-lg-0 p-lg-5 text-center text-sm-start">
        <div class="container pt-3">
            <?php echo flash('register_business'); ?>
            <section class="border rounded-0 d-md-flex align-items-center bg-light border-1 shadow-lg p-3 my-3 row">
                <div class="d-flex flex-column align-items-md-start align-items-center col-md-7">
                    <h1>Register a Business</h1>
                    <p class="lead">Before you can access your account, you need to provide some details about your business in the form below.</p>
                    <form class="w-75 d-flex flex-column justify-content-between" method="POST" action="<?php echo URLROOT; ?>users/registerbusiness" enctype="multipart/form-data">

                        <!-- name input -->
                        <div class="form-group my-2">
                            <label class="form-label sr-only" for="name">Business name: <sup>*</sup></label>
                            <input placeholder="Business name..." type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>

                        <!-- address 1 input -->
                        <div class="form-group my-2">
                            <label class="form-label sr-only" for="address">Address: <sup>*</sup></label>
                            <input placeholder="Address..." type="text" name="address" class="form-control form-control-lg <?php echo (!empty($data['address_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['address']; ?>">
                            <span class="invalid-feedback"><?php echo $data['address']; ?></span>
                        </div>

                         <!-- address 2 input -->
                        <div class="form-group my-2">
                            <label  class="form-label sr-only" for="address2">Address 2: <sup>*</sup></label>
                            <input placeholder="Address 2..." type="text" name="address2" class="form-control form-control-lg <?php echo (!empty($data['address2_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['address2']; ?>">
                            <span class="invalid-feedback"><?php echo $data['address2_err']; ?></span>
                        </div>

                        <!-- town input -->
                        <div class="form-group my-2">
                            <label  class="form-label sr-only" for="town">Town: <sup>*</sup></label>
                            <input placeholder="Town..." type="text" name="town" class="form-control form-control-lg <?php echo (!empty($data['town_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['town']; ?>">
                            <span class="invalid-feedback"><?php echo $data['town_err']; ?></span>
                        </div>

                        <!-- postcode input -->
                        <div class="form-group my-2">
                            <label  class="form-label sr-only" for="postcode">Postcode: <sup>*</sup></label>
                            <input placeholder="Postcode..." type="text" name="postcode" class="form-control form-control-lg <?php echo (!empty($data['postcode_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['postcode']; ?>">
                            <span class="invalid-feedback"><?php echo $data['postcode_err']; ?></span>
                        </div>

                        <!-- telephone input -->
                        <div class="form-group my-2">
                            <label  class="form-label sr-only" for="telephone">Business telephone: <sup>*</sup></label>
                            <input placeholder="Business telephone..." type="tel" name="telephone" class="form-control form-control-lg <?php echo (!empty($data['telephone_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['telephone']; ?>">
                            <span class="invalid-feedback"><?php echo $data['telephone_err']; ?></span>
                        </div>
                    
                        <!-- email input -->
                        <div class="form-group my-2">
                            <label  class="form-label sr-only" for="email">Business email: <sup>*</sup></label>
                            <input placeholder="Business email..." type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>

                        <!-- file input -->
                        <div class="form-group my-2">
                            <h6  class="form-label" for="logo">Business logo:</h6>
                            <input name="logo" id="logo" accept="image/png, image/jpeg" type="file" class="form-control  <?php echo (!empty($data['file_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['file']; ?>">
                            <span class="invalid-feedback"><?php echo $data['file_err']; ?></span>
                        </div>

                        <button class="btn btn-primary text-light align-self-md-end my-2" type="submit">Continue
                        </button>
                    </form>
                </div>

                <div class="col-md-5"><img class="img-fluid d-none d-md-block w-100" src="<?php echo URLROOT;?>/img/business_register.svg" alt="A business"></div>
            </section>
        </div>
    </main>


<?php require APPROOT . '/views/inc/footer.php'; ?>