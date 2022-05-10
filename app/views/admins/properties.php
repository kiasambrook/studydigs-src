<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container py-3">

    <? echo flash('property_delete'); ?>

        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT;?>admins"><i class="fa fa-arrow-left"></i> Back</a>
        <h1>View Properties</h1>

        <? 
        // if property database is empty
        if($data['properties'] == "") : ?>

        <div class="mt-3 text-center">
            <p class="lead text-start">Uh-oh! No properties found...</p>
            <img class="img img-fluid" src="<? echo URLROOT;?>img/empty_properties.svg" alt="Empty street">
        </div>
        <? 
        // if messages exist loop through and display
        else : ?>
        <p class="lead">The full list of properties stored on StudyDigs.</p>

        <div class="table-responsive text-center">
            <table id="propertiesTable" class="table table-hover table-striped table-borderless ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Company</th>
                        <th>Flat</th>
                        <th>Building</th>
                        <th>Address1</th>
                        <th>Address2</th>
                        <th>Town</th>
                        <th>Postcode</th>
                        <th>Upload Date</th>
                        <th>Rent</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <?  foreach($data['properties'] as $property) : ?>

                <tr>
                    <td>
                        <? echo ucWords($property['propertyId']); ?>
                    </td>
                    <td>
                        <? echo ucWords($property['name']); ?>
                    </td>
                    <td>
                        <? echo ucWords($property['flat_number']); ?>
                    </td>
                    <td>
                        <? echo ucWords($property['building_number']); ?>
                    </td>
                    <td>
                        <? echo ucWords($property['propertyAddress1']); ?>
                    </td>
                    <td>
                        <? echo ucWords($property['propertyAddress2']); ?>
                    </td>
                    <td>
                        <? echo ucWords($property['propertyTown']); ?>
                    </td>
                    <td>
                        <? 
                   $postcode = substr_replace($property['propertyPostcode'], ' ' . substr($property['propertyPostcode'], -3), -3);
                   // display address
                   echo  strtoupper($postcode);?>
                    </td>
                    <td>
                        <?
                        $uploadDate = strtotime($property['upload_date']);
                        echo date( 'd-m-y  H:i', $uploadDate );?>
                    </td>
                    <td>
                        <? echo $property['monthly_cost']; ?>pcm
                    </td>
                    <td >
                    <button type="button" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?php echo $property['id']; ?>"
                            class="link link-danger btn"><i class="fa fa-trash fa-lg"></i></button>
                    </td>

                </tr>

                <!-- Delete property modal -->
                <div class="modal fade" id="deleteModal<?php echo $property['id']; ?>" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">
                                    Are you sure you want to delete property 
                                    <? echo $property['propertyId'];?>?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-danger">
                                This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <a type="button"
                                    href="<? echo URLROOT;?>admins/deleteProperty/<? echo $property['propertyId'];?>"
                                    class="btn btn-danger">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>


                <? endforeach;?>

            </table>
        </div>
        <? endif; ?>
    </div>
</main>

<script type="application/javascript">
$(document).ready(function() {
    $('#propertiesTable').DataTable({
        "pageLength": 10,
        "order": [
            [0, 'asc']
        ]
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>