<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container py-3">

        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT; ?>admins/universities"><i class="fa fa-arrow-left"></i> Back</a>
        <h1>Add New University</h1>
        <p class="lead">Complete the form below to add a new university to the website.</p>

        <section class="bg-white pb-3 pt-2">
            <form action="<? echo URLROOT; ?>admins/adduniversity" method="POST" class="row" enctype="multipart/form-data">
                <div class="col-lg-6">

                    <!-- name  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="name">Name: <sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-lg w-100 <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="Name...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>

                    <!-- address1  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="address1">Address 1: <sup>*</sup></label>
                        <input type="text" name="address1" class="form-control form-control-lg w-100 <?php echo (!empty($data['address1_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['address1']; ?>" placeholder="Address 1...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['address1_err']; ?></span>
                    </div>

                    <!-- address2  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="address2">Address Line 2 (optional): <sup></sup></label>
                        <input type="text" name="address2" class="form-control form-control-lg w-100" value="<?php echo $data['address2']; ?>" placeholder="Address 2...">
                        </input>
                    </div>

                    <!-- town  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="town">Town: <sup>*</sup></label>
                        <input type="text" name="town" class="form-control form-control-lg w-100 <?php echo (!empty($data['town_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['town']; ?>" placeholder="Town...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['town_err']; ?></span>
                    </div>

                    <!-- postcode  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="postcode">Postcode: <sup>*</sup></label>
                        <input type="text" name="postcode" class="form-control form-control-lg w-100 <?php echo (!empty($data['postcode_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['postcode']; ?>" placeholder="Postcode...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['postcode_err']; ?></span>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-primary text-light">
                </div>
            </form>
        </section>

    </div>
</main>


<?php require APPROOT . '/views/inc/footer.php'; ?>