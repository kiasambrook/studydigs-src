<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container py-3">

        <? echo flash('university_add'); ?>
        <? echo flash('university_delete'); ?>

        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT;?>admins"><i class="fa fa-arrow-left"></i> Back</a>
        <h1>View Universities</h1>

        <a href="<? echo URLROOT;?>admins/adduniversity" class="btn btn-primary my-3 text-light">Add a University</a>

        <? 
        // if property database is empty
        if($data['universities'] == "") : ?>

        <div class="mt-3 text-center">
            <p class="lead text-start">Uh-oh! No universities found...</p>
            <img class="img img-fluid" src="<? echo URLROOT;?>img/empty_properties.svg" alt="Empty street">
        </div>
        <? 
        // if messages exist loop through and display
        else : ?>
        <p class="lead">The full list of universities registered with StudyDigs.</p>

        <div class="table-responsive text-center">
            <table id="universitiesTable" class="table table-hover table-striped table-borderless ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Address2</th>
                        <th>Town</th>
                        <th>Postcode</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <?  foreach($data['universities'] as $university) : ?>

                <tr>
                    <td>
                        <? echo ucWords($university['id']); ?>
                    </td>
                    <td>
                        <? echo ucWords($university['name']); ?>
                    </td>
                    <td>
                        <? echo ucWords($university['address1']); ?>
                    </td>
                    <td>
                        <? echo $university['address2']; ?>
                    </td>

                    <td>
                        <? echo ucWords($university['town']); ?>
                    </td>
                    <td>
                        <?
                            $postcode = substr_replace($university['postcode'], ' ' . substr($university['postcode'], -3), -3);
                            // display address
                            echo  strtoupper($postcode);?>
                    </td>
                    <td>
                        <? echo ucWords($university['longitude']); ?>
                    </td>                    <td>
                        <? echo ucWords($university['latitude']); ?>
                    </td>

                    <td>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?php echo $university['id']; ?>"
                            class="link link-danger btn"><i class="fa fa-trash fa-lg"></i></button>
                    </td>
                </tr>

                <!-- Delete university modal -->
                <div class="modal fade" id="deleteModal<?php echo $university['id']; ?>" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">
                                    Are you sure you want to delete
                                    <? echo $university['name'];?>?
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
                                    href="<? echo URLROOT;?>admins/deleteUniversity/<? echo $university['id'];?>"
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
    $('#universitiesTable').DataTable({
        "pageLength": 10,
        "order": [
            [0, 'asc']
        ]
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>