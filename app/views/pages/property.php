<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/modals.php'; ?>

<main class="p-3 p-lg-0 pt-lg-3 text-center text-sm-start">
    <div class="container">

        <!-- breadcrumb menu -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a
                    href="<?php echo URLROOT . "pages/search/" . $data['property']->town; ?>"><span><?php echo ucwords($data['property']->town); ?></span></a>
            </li>
            <li class="breadcrumb-item active">
                <span><?php echo ucwords($data['property']->bedrooms . ' bed ' . $data['property']->propertyType); ?></span>
            </li>
        </ol>

        <!-- image slider -->
        <header id="content" class="row g-3">
            <h2 class="py-2">
                <?php echo ucwords($data['property']->bedrooms . ' bed ' . $data['property']->propertyType); ?></h2>

            <div class="col-lg-7 col-sm-12 p-0 me-lg-1">
                <div id="carouselExampleIndicators" class="carousel slide me-2" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <? // loop through and display house images 
                        $count = 0;
                        foreach ($data['images'] as $image) : ?>

                        <div class="carousel-item 
                        <?php
                        // set the current option to active
                            if ($count == 0) {
                                echo "active";
                            } else {
                                echo " ";
                            }
                        ?>" data-interval="2000">
                            <img src="<?php echo URLROOT . $image->file_location; ?>" class="d-block w-100" alt="Image of the inside of the house">
                        </div>
                        <?php
                            $count++;
                        endforeach; ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon link-primary" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>
            </div>

            <!-- landlord information -->
            <div
                class="border rounded-0 shadow col-lg-4 p-3 h-100 col-sm-12 ms-lg-1 d-flex flex-column align-items-end">
                <div id="landlord-details" class="row">
                    <div id="text" class="col-6 row mx-1">
                        <h4 class="pb-0 mb-0">
                            <? echo $data['property']->name; ?>
                        </h4><a class="text-dark color-underline" href="<? echo URLROOT;?>pages/company/<?echo $data['property']->companyId?>">View
                            Porfolio</a>
                    </div><img class="col-5 mx-1" src="<? echo URLROOT . $data['property']->logo_file_location; ?>" alt="Landlord logo">
                </div>
                <div class="bg-light my-3 d-flex justify-content-center p-2 w-100">
                    <a href="tel:<? echo  $data['property']->telephone; ?>" class="link-primary color-underline mx-3 nav-link" type="button">
                        <i class="fa fa-phone"></i> Phone
                    </a>
                    <a class="link-primary color-underline mx-3 nav-link" href="mailto:<? echo $data['property']->email; ?>" target="_BLANK" type="button">
                        <i class="fa fa-envelope"></i> Email
                    </a>
                </div>
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#reportModal">
                    <i class="fa fa-flag"></i>
                    Report</button>
                    <?php infoModal('<h4>Report Property</h4>', 
                    '<form method="POST" action="'.URLROOT.'pages/report/'.$data['property']->propertyId .'">
                        <div class="mb-3">
                            <label class="form-label" for="reason">Reason for report</label>
                            <select required name="subject" class="form-select form-select-lg">
                                <option selected disabled value="">Please select</option>
                                <option value="harassment">Harassment</option>
                                <option value="misleading">Misleading content</option>
                                <option value="offensive">Offensive content</option>
                                <option value="phishing">Phishing</option>
                                <option value="spam">Spam</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="details">Please add further details</label>
                            <textarea name="message" class="form-control" rows=3 id="details"></textarea>
                        </div>', 
                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger"></input>
                    </form>', 
                    "reportModal")?>
            </div>
        </header>

        <!-- rent and location -->
        <section id="property-information" class="row py-3">
            <h2>
                £<? echo $data['property']->monthly_cost ?>pcm
            </h2>
            <button type="button" data-bs-toggle="modal" data-bs-target="#tenancyModal" class="link link-primary col-md-1 text-nowrap p-0 btn mx-2 text-decoration-underline">Tenancy information</button>
            <?php infoModal('<h4>Tenancy Information</h4>','<p>'.$data['property']->tenancy_info.'</p>', "", "tenancyModal")?>

            <h4 class="my-2"><?php echo ucwords($data['property']->bedrooms . ' bed ' . $data['property']->propertyType); ?></h4>
            <p> <?php
                // Add a space to the middle of the postcode
                $postcode = substr_replace($data['property']->propertyPostcode, ' ' . substr($data['property']->propertyPostcode, -3), -3);
                // display address
                echo ucwords($data['property']->propertyAddress1 . ', ' . $data['property']->propertyTown) . ',  ' . strtoupper($postcode);; ?>
            </p>
            <!-- floorplan button -->
            <? if(!empty($data['floorplan'])) : ?>
                 <button type="button" data-bs-toggle="modal" data-bs-target="#floorplanModal" class="btn btn-primary text-light col-md-1 mx-2">Floorplan</i></button>
                 <?php infoModal('','<img src="' . URLROOT . $data['floorplan']->file_location . '" alt="Floorplan of the property" class="img-fluid img">', "", "floorplanModal")?>      
            <? endif;?>
        </section>
        <hr>

        <!-- amenities -->
        <section id="amenities" class="py-3">
            <h3>Amenities</h3>
            <p class="lead">The property has the following:</p>
            <div class="col-md-6 row pb-4">
                <div class="col-md-6">
                    <p>
                        <i class="fa fa-bed"></i>
                        <? echo $data['property']->bedrooms . " bedroom";

                        if ($data['property']->bedrooms > 1) {
                            echo "s";
                        }
                        ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        <i class="fa fa-bath"></i>
                        <? echo $data['property']->bathrooms . " bathroom";

                        if ($data['property']->bathrooms > 1) {
                            echo "s";
                        }
                        ?>
                    </p>
                </div>


                <?php foreach ($data['amenities'] as $key => $value) { ?>
                <div class="col-md-6">
                    <p>

                        <? // get matching icon
                            switch ($key) {
                                case 'ensuite':
                                    $icon = 'shower';
                                    break;
                                case 'double_bed':
                                    $icon = 'bed';
                                    break;
                                case 'parking_space':
                                    $icon = 'car';
                                    break;
                                case 'garden':
                                    $icon = 'leaf';
                                    break;
                                case 'washing_machine':
                                    $icon = 'tint';
                                    break;
                                case 'pets':
                                    $icon = 'paw';
                                    break;
                                case 'wifi':
                                    $icon = 'wifi';
                                    break;
                                case 'dual_occupancy':
                                    $icon = 'users';
                                    break;
                                case 'lockable_bedrooms':
                                    $icon = 'lock';
                                    break;
                                case 'bills_included':
                                    $icon = 'money';
                                    break;
                            }

                            $key = ucwords($key);
                            $key = str_replace('_', ' ', $key);
                            ?>



                        <i class="fa fa-<? echo $icon; ?>"></i>
                        <? if ($value == 0) :
                                echo 'No ' . $key;
                            elseif ($key == 'Pets' && $value == 1) :
                                echo $key . ' allowed';
                            elseif (($key == 'Lockable bedrooms' || $key == 'Dual occupancy') && $value >= 1) :
                                echo $key . ' avaliable';
                            elseif ($key == 'Bills included' && $value >= 1) :
                                echo $key;
                            elseif ($value == 1) :
                                echo $value . ' ' . $key . ' avaliable';
                            elseif ($value > 1) :
                                echo $value . ' ' . $key . 's avaliable';
                            else :
                                echo  $key . ' avaliable';
                            endif;
                            ?>
                    </p>
                </div>
                <?  } ?>
            </div>
        </section>
        <hr>

        <!-- address -->
        <section class="py-3">
            <h3>Location</h3>
            <div class="row">

                <div class="col-md-5">
                    <div id="map" class="map" style=" width: 100%; height: 100%;"></div>
                    <script>
                    loadMap();

                    // function creates map
                    function loadMap() {
                        var centerCoords = [ <? echo $data['property']->longitude; ?> , <? echo $data[
                            'property']->latitude; ?>
                        ];

                        mapboxgl.accessToken =
                            'pk.eyJ1Ijoia2lhc2FteiIsImEiOiJja3p0cTU2MXY2MzQ2Mm9vMWllMHdnMjcwIn0.aCZ3_K7HV_Mu5Ln9Vr_XiQ';
                        var map = new mapboxgl.Map({
                            container: 'map',
                            center: centerCoords,
                            zoom: 15,
                            style: 'mapbox://styles/mapbox/streets-v11'
                        });

                        const marker = new mapboxgl.Marker()
                            .setLngLat(centerCoords)
                            .addTo(map);
                    }
                    </script>
                </div>

                <div class="col-md-6">
                    <h4>Travelling Times to Closest Universities</h4>
                    <!-- loop through universities that are nearby -->
                    <? foreach ($data['universities'] as $university) : ?>
                    <p class="lead">
                        <? echo $university['name']; ?>
                    </p>
                    <div class="row">
                        <div class="col-sm-5">
                            <p><i class="fa fa-blind"></i>
                                <? // get walking times 
                                $walking = @file_get_contents('https://api.mapbox.com/directions-matrix/v1/mapbox/walking/' . $data['property']->longitude . ',' . $data['property']->latitude . ';' . $university['longitude'] . ',' . $university['latitude'] . '?access_token=pk.eyJ1Ijoia2lhc2FteiIsImEiOiJja3p0cTU2MXY2MzQ2Mm9vMWllMHdnMjcwIn0.aCZ3_K7HV_Mu5Ln9Vr_XiQ');

                                if($walking === FALSE) {
                                    ?>Unknown walk

                                <? }
                                else { 
                                    $walking = json_decode($walking, false);
                                    echo round($walking->durations[0][1] / 60); ?> min walk
                                    <? };?>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p><i class="fa fa-bicycle"></i> 
                            <? // get cycling times
                                $cycling = @file_get_contents('https://api.mapbox.com/directions-matrix/v1/mapbox/cycling/' . $data['property']->longitude . ',' . $data['property']->latitude . ';' . $university['longitude'] . ',' . $university['latitude'] . '?access_token=pk.eyJ1Ijoia2lhc2FteiIsImEiOiJja3p0cTU2MXY2MzQ2Mm9vMWllMHdnMjcwIn0.aCZ3_K7HV_Mu5Ln9Vr_XiQ');
                                if($cycling === FALSE) {
                                    ?>Unknown cycle

                                <? }
                                else { 
                                    $cycling = json_decode($cycling, false);
                                    echo round($cycling->durations[0][1] / 60); ?> min cycle
                                    <? };?>
                        </div>
                        <div class="col-sm-6">
                            <p><i class="fa fa-car"></i>
                            <? // get drive times
                                $driving = @file_get_contents('https://api.mapbox.com/directions-matrix/v1/mapbox/driving/' . $data['property']->longitude . ',' . $data['property']->latitude . ';' . $university['longitude'] . ',' . $university['latitude'] . '?access_token=pk.eyJ1Ijoia2lhc2FteiIsImEiOiJja3p0cTU2MXY2MzQ2Mm9vMWllMHdnMjcwIn0.aCZ3_K7HV_Mu5Ln9Vr_XiQ');
                                if($driving === FALSE) {
                                    ?>Unknown drive

                                <? }
                                else { 
                                    $driving = json_decode($driving, false);
                                    echo round($driving->durations[0][1] / 60); ?> min drive
                                    <? };?>
                        </div>
                    </div>
                    <? endforeach; ?>
                    <p class="small">* Distance times may vary *</p>
                </div>
            </div>
        </section>
    </div>
</main>




<?php require APPROOT . '/views/inc/footer.php'; ?>