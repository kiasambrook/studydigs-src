<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 text-center text-sm-start pt-4">
    <div class="container">


        <section class="bg-white pb-3 pt-2">
            <!-- breadcrumb menu -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>"><span>Home</span></a></li>
                <li class="breadcrumb-item active">
                    <span><?php echo ucwords($data['university']->name); ?></span>
                </li>
            </ol>
            <h4>Nearby Properties for
                <? echo ucwords($data['university']->name); ?>
            </h4>
            <p class="lead">View properties within a ten mile radius of your university.</p>
            <div class="row">
                <aside class="p-3 col-lg-4">
                    <!-- Filters -->
                    <div class="border rounded-0 shadow-sm bg-light p-4 border-1" id="sidebar">
                        <h4>Filter search</h4>
                        <p>Use the filters below to narrow your search.</p>
                        <form action="<? echo URLROOT; ?>pages/results/<? echo $data['town']; ?>" method="POST">
                            <h6 class="mt-3">Number of bedrooms</h6>
                            <div id="bedrooms" class="input-group">
                                <select class="form-select mx-1" name="min_bedrooms">
                                    <optgroup label="Min bedrooms">
                                        <option value="any">Any</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </optgroup>
                                </select>
                                <select class="form-select mx-1" name="max_bedrooms">
                                    <optgroup label="Max bedrooms">
                                        <option value="any">Any</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </optgroup>
                                </select>
                            </div>
                            <h6 class="mt-3">Number of bathrooms</h6>
                            <select name="bathrooms" class="form-select mx-1 form-control form-select w-50"
                                id="bathrooms">
                                <optgroup label="Bathrooms">
                                    <option value="any">Any</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </optgroup>
                            </select>
                            <h6 class="mt-3">Price Per Month (Per person)</h6>
                            <select name="rent" class="form-select mx-1 form-control form-select w-50">
                                <optgroup label="Max price">
                                    <option value="any" selected="">Any</option>
                                    <option value="100">£100</option>
                                    <option value="200">£200</option>
                                    <option value="300">£300</option>
                                    <option value="400">£400</option>
                                    <option value="500">£500</option>
                                    <option value="750">£750</option>
                                    <option value="1000">£1000</option>
                                    <option value="1500">£1500</option>
                                    <option value="3000">£3000</option>
                                </optgroup>
                            </select>
                            <h6 class="mt-3">Extras amenities&nbsp;</h6>
                            <div id="checkboxes" class="row text-start">
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="bills" id="bills-included">
                                    <label class="form-check-label" for="bills-included">Bills included</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="wifi">
                                    <label class="form-check-label" for="wifi">WiFi</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="parking">
                                    <label class="form-check-label" for="car-space">Parking space</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="dual_occupancy"><label
                                        class="form-check-label" for="dual_occupancy">Dual
                                        occupancy</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="pets">
                                    <label class="form-check-label" for="pets">Pets</label>
                                </div>
                                <div class="form-check col-xl-6">
                                    <input class="form-check-input" type="checkbox" name="washing">
                                    <label class="form-check-label" for="washing">Washing
                                        machine</label>
                                </div>
                            </div>

                            <!-- filter buttons -->
                            <div class="btn-group mt-4" role="group">
                                <input class="btn btn-primary me-2 rounded-1 border-0 text-light" type="submit"
                                    value="Apply"></input>
                                <button class="btn btn-danger rounded-1 border-0" type="reset">Clear</button>
                            </div>
                        </form>
                    </div>
                </aside>

                <!-- Property list -->
                <div id="content" class="px-3 col-lg-8">
                    <div id="properties" class="row my-3">
                        <?php
                        if (count($data['properties']) != 0) :
                            // Loop through properties and display them in a card
                            foreach ($data['properties'] as $property => $value) : ?>
                        <div class="col-12 card shadow-sm border-1 mb-3">
                            <a class="text-decoration-none text-dark"
                                href="<?php echo URLROOT; ?>pages/property/<?php echo $value['propertyId']; ?>">
                                <!-- Card body -->
                                <div id="card-body" class="p-0 row">
                                    <img class="border rounded-0 col-sm-4 p-0 col-xs-8"
                                        src="<?php echo  URLROOT . $value['file_location']; ?>" alt="Feature image of the property">
                                    <div id="text" class="col-sm-8">
                                        <h5 class="px-2 pt-3">
                                            <? echo $value['bedrooms'] . ' Bed ' . ucwords($value['propertyType']); ?>
                                        </h5>
                                        <h6 class="px-2 py-1">£<?php echo $value['monthly_cost']; ?>pcm</h6>
                                        <h6 class="card-title px-2">
                                            <? echo $value['bedrooms']; ?>
                                            <i class="fa fa-bed"></i>
                                            <? echo $value['bathrooms']; ?>
                                            <i class="fa fa-bath"></i>
                                        </h6>
                                        <p class="ps-2 lead">
                                            <?php
                                                    // Add a space to the middle of the postcode
                                                    $postcode = substr_replace($value['postcode'], ' ' . substr($value['postcode'], -3), -3);
                                                    // display address
                                                    echo ucwords($value['address1'] . ', ' . $value['town']) . ',  ' . strtoupper($postcode);; ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- Card footer -->
                            <div id="footer" class="card-footer d-flex bg-white align-middle">
                                <p class="w-100">
                                    Listed on <?php
                                                        // format date
                                                        $phpdate = strtotime($value['upload_date']);
                                                        $dateFormat = date('d F Y', $phpdate);
                                                        echo $dateFormat; ?>
                                </p>

                                <div class="d-flex mr-auto">
                                    <!-- add email and phone here-->
                                </div>
                            </div>
                        </div>
                        <?php endforeach;
                        else : // if no properties found 
                            ?>
                        <div class="text-center">
                            <h4>Zero Properties found!</h4>
                            <img class="w-50    " alt="No properties found" src="<?php echo URLROOT; ?>img/empty.svg">
                        </div>
                        <? endif;
                        ?>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>