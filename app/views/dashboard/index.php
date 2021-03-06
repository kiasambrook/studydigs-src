<?php require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/filters.php';
require APPROOT . '/views/inc/modals.php'; ?>

<main class="p-3 text-center text-sm-start pt-4">
    <div class="container">
        <h2>Welcome, <?php echo $data['name']; ?>!</h2>
        <p class="lead pt-1">Below is a list of properties that <?php echo $data['company_name']; ?> has uploaded to
            StudyDigs, here you can upload, edit, and delete your propeties.</p>

        <section class="bg-white pb-3 pt-2">
            <div class="row">
                <aside class="p-3 col-lg-4">

                    <!-- Upload button -->
                    <div class="mb-3">
                        <a class="btn btn-primary w-100 text-light" href="<?php echo URLROOT; ?>dashboard/addproperty">
                            <i class="fa fa-upload"></i> Upload New Property
                        </a>
                    </div>

                    <? // display filters
                    callFilters('dashboard/filters'); ?>

                </aside>

                <!-- Property list -->
                <div id="content" class="px-3 col-lg-8">
                    <div id="properties" class="row my-3">
                        <?php
                        echo flash('edit_property');
                        if (count($data['properties']) != 0) :
                            // Loop through properties and display them in a card
                            foreach ($data['properties'] as $property) : ?>
                                <div class="col-12 card shadow-sm border-1 mb-3">
                                    <a class="text-decoration-none text-dark" href="<?php echo URLROOT; ?>dashboard/property/<?php echo $property->propertyId; ?>">
                                        <!-- Card body -->
                                        <div id="card-body" class="p-0 row">
                                            <img class="border rounded-0 col-sm-4 p-0 col-xs-8" src="<?php echo URLROOT .  $property->file_location; ?>" alt="Property feature image">
                                            <div id="text" class="col-sm-8">
                                                <h5 class="px-2 pt-3">
                                                    <? echo $property->bedrooms . ' Bed ' . ucwords($property->propertyType); ?>
                                                </h5>
                                                <h6 class="px-2 py-1">??<?php echo $property->monthly_cost; ?>pcm</h6>
                                                <h6 class="card-title px-2">
                                                    <? echo $property->bedrooms; ?>
                                                    <i class="fa fa-bed"></i>
                                                    <? echo $property->bathrooms; ?>
                                                    <i class="fa fa-bath"></i>
                                                </h6>
                                                <p class="ps-2 lead">
                                                    <?php
                                                    // Add a space to the middle of the postcode
                                                    $postcode = substr_replace($property->postcode, ' ' . substr($property->postcode, -3), -3);
                                                    // display address
                                                    echo ucwords($property->address1 . ', ' . $property->town) . ',  ' . strtoupper($postcode);; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Card footer -->
                                    <div id="footer" class="card-footer d-flex bg-white align-items-center">
                                        <p class="w-100 align-center">
                                            Listed on <?php
                                                        // format date
                                                        $phpdate = strtotime($property->upload_date);
                                                        $dateFormat = date('d F Y', $phpdate);
                                                        echo $dateFormat; ?>
                                        </p>

                                        <div class="d-flex mr-auto align-items-center">
                                            <!-- edit button -->
                                            <a href="<?php echo URLROOT; ?>dashboard/edit/<?php echo $property->propertyId; ?>" class="p-0 link-success btn align-middle" role="button">
                                                <i class="fa fa-edit fa-lg"></i>
                                            </a>
                                            <!-- delete button -->
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $property->propertyId; ?>" class=" link-danger btn link align-top"><i class="fa fa-trash fa-lg"></i></button>
                                        </div>
                                    </div>
                                </div>

                            <?php deleteModal('property', $property->propertyId, 'dashboard/delete/');

                            endforeach;
                        else : // if no properties found 
                            ?>
                            <div class="text-center">
                                <h4>Zero Properties found!</h4>
                                <p>Start filling out your portfolio by uploading some properties.</p>
                                <img class="w-50" src="<?php echo URLROOT; ?>img/empty.svg" alt="No properties found">
                            </div>
                        <? endif;
                        ?>
                    </div>
                </div>
            </div>

        </section>
    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>