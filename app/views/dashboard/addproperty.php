<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 text-center text-sm-start pt-4">
    <div class="container">
        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT; ?>dashboard"><i class="fa fa-arrow-left"></i> Back</a>
        <h2>Add Property to Portfolio</h2>
        <p class="lead pt-1">Complete the form below to add a new property to your porfolio.</p>

        <section class="bg-white pb-3 pt-2">
            <form action="<? echo URLROOT; ?>dashboard/addproperty" method="POST" class="row" enctype="multipart/form-data">
                <div class="col-lg-6">
                    <!--Property details form -->
                    <h4>Property Details</h4>

                    <!-- property type input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="property_type">Property Type: <sup>*</sup></label>
                        <select name="property_type" class="form-select form-select-lg w-100 <?php echo (!empty($data['property_type_err'])) ? 'is-invalid' : ''; ?>">
                            <option value="na" disabled selected>Property Type...</option>
                            <?php foreach ($data['property_types'] as $type) : ?>
                                <option value="<? echo $type->type; ?>">
                                    <? echo ucwords($type->type); ?>
                                </option>
                            <? endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $data['property_type_err']; ?></span>
                    </div>

                    <!-- house number input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="house_number">House Number or Name: <sup>*</sup></label>
                        <input type="text" name="house_number" class="form-control form-control-lg w-100 <?php echo (!empty($data['house_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['house_number']; ?>" placeholder="House number/name...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['house_number_err']; ?></span>
                    </div>

                    <!-- flat number input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="flat_number">Flat number (optional):</label>
                        <input type="text" name="flat_number" class=" w-100 form-control form-control-lg" value="<?php echo $data['flat_number']; ?>" placeholder="Flat number...">
                        </input>
                    </div>

                    <!-- street  input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="street">Street: <sup>*</sup></label>
                        <input type="text" name="street" class="form-control form-control-lg w-100 <?php echo (!empty($data['street_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['street']; ?>" placeholder="Street...">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['street_err']; ?></span>
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
                </div>

                <div class="col-lg-6">
                    <h4>Tenancy Details</h4>

                    <!-- availability input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="availability">Availability Date: <sup>*</sup></label>
                        <input type="date" name="availability" class="form-control form-control-lg w-100 <?php echo (!empty($data['availability_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['availability']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['availability_err']; ?></span>
                    </div>

                    <!-- min_contract_length input
                        TODO: fix month/year formatting -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="min_contract_length">Minimum Contract Length:</label>
                        <input type="number" name="min_contract_length" class="form-control form-control-lg w-100 <?php echo (!empty($data['min_contract_length_err'])) ? 'is-invalid' : ''; ?>" placeholder="Min Contract Length..." value="<?php echo $data['min_contract_length']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['min_contract_length_err']; ?></span>
                    </div>

                    <!-- max input
                        TODO: fix month/year formatting -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="max_contract_length">Maximum Contract Length:</label>
                        <input type="number" name="max_contract_length" class="form-control form-control-lg w-100 <?php echo (!empty($data['max_contract_length_err'])) ? 'is-invalid' : ''; ?>" placeholder="Max Contract Length..." value="<?php echo $data['max_contract_length']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['max_contract_length_err']; ?></span>
                    </div>

                    <!-- deposit input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="deposit">Deposit:</label>
                        <input step="100" type="number" name="deposit" class="form-control form-control-lg w-100 <?php echo (!empty($data['deposit_err'])) ? 'is-invalid' : ''; ?>" placeholder="Deposit..." value="<?php echo $data['deposit']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['deposit_err']; ?></span>
                    </div>

                    <!-- monthly_rent input -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="monthly_rent">Monthly Rent:
                            <sup>*</sup></label>
                        <input step="100" type="number" name="monthly_rent" class="form-control form-control-lg w-100 <?php echo (!empty($data['monthly_rent_err'])) ? 'is-invalid' : ''; ?>" placeholder="Monthly Rent..." value="<?php echo $data['monthly_rent']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['monthly_rent_err']; ?></span>
                    </div>

                    <!-- on market check -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="market">Place property on the market? <sup>*</sup></label>
                        <select name="market" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1" selected>Yes</option>
                        </select>
                    </div>
                    <!-- tenancy info -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="tenancy">Tenancy Information:</label>
                        <textarea name="tenancy" placeholder="Tenancy Information..." class="form-control form-control-lg" rows="3"></textarea>
                    </div>
                </div>

                <!-- Amemities -->
                <div id="amenities" class="col-lg-6 my-4 row">
                    <h4>Property Amenities</h4>
                    <!-- bedrooms input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="bedrooms">Bedrooms: <sup>*</sup></label>
                        <input type="number" name="bedrooms" class="form-control form-control-lg w-100 <?php echo (!empty($data['bedrooms_err'])) ? 'is-invalid' : ''; ?>" placeholder="Bedrooms..." value="<?php echo $data['bedrooms']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['bedrooms_err']; ?></span>
                    </div>

                    <!-- bathrooms input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="bathrooms">Bathrooms:
                            <sup>*</sup></label>
                        <input type="number" name="bathrooms" class="form-control form-control-lg w-100 <?php echo (!empty($data['bathrooms_err'])) ? 'is-invalid' : ''; ?>" placeholder="Bathrooms..." value="<?php echo $data['bathrooms']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['bathrooms_err']; ?></span>
                    </div>

                    <!-- ensuites input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="ensuites">Ensuites:
                            <sup>*</sup></label>
                        <input type="number" name="ensuites" class="form-control form-control-lg w-100 <?php echo (!empty($data['ensuites_err'])) ? 'is-invalid' : ''; ?>" placeholder="Ensuites..." value="<?php echo $data['ensuites']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['ensuites_err']; ?></span>
                    </div>

                    <!-- double_beds input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="double_beds">Double Beds:</label>
                        <input type="number" name="double_beds" class="form-control form-control-lg w-100 <?php echo (!empty($data['double_beds_err'])) ? 'is-invalid' : ''; ?>" placeholder="Double Beds..." value="<?php echo $data['double_beds']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['double_beds_err']; ?></span>
                    </div>

                    <!-- parking_space input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="parking_space">Parking Spaces:</label>
                        <input type="number" name="parking_space" class="form-control form-control-lg w-100 <?php echo (!empty($data['parking_space_err'])) ? 'is-invalid' : ''; ?>" placeholder="Parking Spaces..." value="<?php echo $data['parking_space']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['parking_space_err']; ?></span>
                    </div>

                    <!-- Garden input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="garden">Garden: <sup>*</sup></label>
                        <select name="garden" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <!-- washing_machine input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="washing_machine">Washing Machine: <sup>*</sup></label>
                        <select name="washing_machine" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <!-- wifi input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="wifi">Wifi: <sup>*</sup></label>
                        <select name="wifi" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <!-- pets input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="pets">Pets: <sup>*</sup></label>
                        <select name="pets" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <!-- dual_occupancy input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="dual_occupancy">Dual Occupancy: <sup>*</sup></label>
                        <select name="dual_occupancy" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <!-- lockable_bedrooms input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="lockable_bedrooms">Bedroom Locks: <sup>*</sup></label>
                        <select name="lockable_bedrooms" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <!-- bills_included input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="bills_included">Bills included: <sup>*</sup></label>
                        <select name="bills_included" class="form-select form-select-lg w-100">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 my-4">
                    <img class="img-fluid d-none d-md-block w-100" src="<?php echo URLROOT; ?>/img/amenities.svg" alt="Amenities adjustments">
                </div>


                <div id="images" class="col-lg-12  row">
                    <h4>Property Images</h4>
                    <!-- feature image input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="feature_image">Feature Image:</label>
                        <input type="file" name="feature_image" class="form-control w-100 form-control-lg  <?php echo (!empty($data['feature_image_err'])) ? 'is-invalid' : ''; ?>" placeholder="Feature Image..." value="<?php echo $data['feature_image']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['feature_image_err']; ?></span>
                    </div>

                    <!-- floorplan image input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="floorplan_image">Floorplan Image:</label>
                        <input type="file" name="floorplan_image" class="form-control  form-control-lg w-100  <?php echo (!empty($data['floorplan_image_err'])) ? 'is-invalid' : ''; ?>" placeholder="Feature Image..." value="<?php echo $data['floorplan_image']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['floorplan_image_err']; ?></span>
                    </div>

                    <!-- house image input -->
                    <div class="form-group mb-3 col-lg-6">
                        <label class="form-label" for="house_images[]">House Images:</label>
                        <input type="file" name="house_images[]" class="form-control  form-control-lg  <?php echo (!empty($data['house_images_err'])) ? 'is-invalid' : ''; ?>" placeholder="Feature Image..." multiple value="<?php echo $data['house_images']; ?>">
                        </input>
                        <span class="invalid-feedback"><?php echo $data['house_images_err']; ?></span>
                    </div>

                </div>

                <input type="submit" value="Submit" class=" btn btn-primary text-light col-lg-1 m-2 ">
                <input type="reset" value="Reset" class=" btn btn-danger col-lg-1 m-2 ">

            </form>

        </section>
    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>