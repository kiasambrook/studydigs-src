<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 text-center text-sm-start pt-4">
    <div class="container">
        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT; ?>dashboard"><i class="fa fa-arrow-left"></i>
            Back</a>
        <h2>Edit Account</h2>
        <p class="lead pt-1">Make changes to the text boxes below to update your account.</p>

        <section class="bg-white pb-3 pt-2">
            <form action="<? echo URLROOT; ?>dashboard/editAccount" method="POST"
                class="row" enctype="multipart/form-data">
                <div class="col-lg-6">
                    <!--User details form -->
                    <h4>User Details</h4>

                    <!-- first name input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="first_name">First Name:</label>
                        <input type="text" name="first_name"
                            class="form-control form-control-lg w-100 <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $data['user']->first_name; ?>" placeholder="First name...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['first_name_err']; ?></span>
                    </div>

                    <!-- last name input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="last_name">Last Name:</label>
                        <input type="text" name="last_name" class=" w-100 form-control form-control-lg"
                            value="<?php echo ucwords($data['user']->last_name); ?>" placeholder="Last name...">
                        </input>
                    </div>

                    <!-- email  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email:</label>
                        <input type="email" name="email"
                            class="form-control form-control-lg w-100 <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $data['user']->email; ?>" placeholder="Email...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>

                    <div class="col-lg-6 my-4">
                        <img class="img-fluid d-none d-md-block w-100 mx-5"
                            src="<?php echo URLROOT; ?>/img/edit_profile.svg" alt="profile editing">
                    </div>
                </div>

                <div class="col-lg-6">
                    <h4>Company Details</h4>
                    <!-- company name -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="company_name">Company Name:</label>
                        <input type="text" name="company_name" class="form-control form-control-lg w-100"
                            value="<?php echo ucwords($data['company']->name); ?>" placeholder="Name...">
                        </input>
                    </div>

                    <!-- address1  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="address1">Address Line 1: <sup></sup></label>
                        <input type="text" name="address1" class="form-control form-control-lg w-100"
                            value="<?php echo ucwords($data['company']->address1); ?>" placeholder="Address 1...">
                        </input>
                    </div>

                    <!-- address2  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="address2">Address Line 2 (optional): <sup></sup></label>
                        <input type="text" name="address2" class="form-control form-control-lg w-100"
                            value="<?php echo ucwords($data['company']->address2); ?>" placeholder="Address 2...">
                        </input>
                    </div>

                    <!-- town  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="town">Town: <sup>*</sup></label>
                        <input type="text" name="town" class="form-control form-control-lg w-100"
                            value="<?php echo ucwords($data['company']->town); ?>" placeholder="Town...">
                        </input>
                    </div>

                    <!-- postcode  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="postcode">Postcode: <sup>*</sup></label>
                        <input type="text" name="postcode"
                            class="form-control form-control-lg w-100 <?php echo (!empty($data['postcode_err'])) ? 'is-invalid' : ''; ?>"
                            value="<?php echo ucwords($data['company']->postcode); ?>" placeholder="Postcode...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['postcode_err']; ?></span>
                    </div>

                    <!-- email  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="company_email">Company Email:</label>
                        <input type="email" name="company_email" class="form-control form-control-lg w-100"
                            value="<?php echo $data['company']->email; ?>" placeholder="Email...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>

                    <!-- telephone  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="telephone">Company Telephone:</label>
                        <input type="tel" name="telephone" class="form-control form-control-lg w-100"
                            value="<?php echo $data['company']->telephone; ?>" placeholder="Telephone...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['telephone_err']; ?></span>
                    </div>

                </div>



                <input type="submit" value="Submit" class=" btn btn-primary text-light col-lg-1 m-2 ">
                <input type="reset" value="Reset" class=" btn btn-danger col-lg-1 m-2 ">

            </form>

        </section>
    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>