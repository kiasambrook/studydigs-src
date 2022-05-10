<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container py-3">

    <? echo flash('company_delete'); ?>

        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT;?>admins"><i class="fa fa-arrow-left"></i> Back</a>
        <h1>View Companies</h1>

        <? 
        // if property database is empty
        if($data['companies'] == "") : ?>

        <div class="mt-3 text-center">
            <p class="lead text-start">Uh-oh! No companies found...</p>
            <img class="img img-fluid" src="<? echo URLROOT;?>img/empty_properties.svg" alt="Empty street">
        </div>
        <? 
        // if messages exist loop through and display
        else : ?>
        <p class="lead">The full list of companies registered with StudyDigs.</p>

        <div class="table-responsive text-center">
            <table id="companiesTable" class="table table-hover table-striped table-borderless ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Address2</th>
                        <th>Town</th>
                        <th>Postcode</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Fees Paid</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <?  foreach($data['companies'] as $company) : ?>

                <tr>
                <td>
                        <? echo ucWords($company['id']); ?>
                    </td>
                    <td>
                        <? echo ucWords($company['name']); ?>
                    </td>
                    <td>
                        <? echo ucWords($company['address1']); ?>
                    </td>
                    <td>
                        <? echo ucWords($company['address2']); ?>
                    </td>
                    <td>
                        <? echo $company['town']; ?>
                    </td>

                    <td>
                    <? 
                   $postcode = substr_replace($company['postcode'], ' ' . substr($company['postcode'], -3), -3);

                   echo  strtoupper($postcode);?>
                    </td>
                    <td>
                        <? echo ucWords($company['telephone']); ?>
                    </td>
                    <td>
                        <? echo $company['email']; ?>
                    </td>

                    <td>
                        <? 
                        if($company['fees_paid'] == 1){
                            echo 'Yes';
                        }
                        else{
                            echo 'No';
                        }?>
                    </td>
                    <td>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?php echo $company['id']; ?>"
                            class="link link-danger btn"><i class="fa fa-trash fa-lg"></i></button>
                    </td>
                </tr>

                <!-- Delete company modal -->
                <div class="modal fade" id="deleteModal<?php echo $company['id']; ?>" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">
                                    Are you sure you want to delete
                                    <? echo $company['name'];?>?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-danger">
                               WARNING: This action will also delete all properties and users that are associated with this company. This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <a type="button"
                                    href="<? echo URLROOT;?>admins/deleteCompany/<? echo $company['id'];?>"
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
    $('#companiesTable').DataTable({
        "pageLength": 10,
        "order": [
            [0, 'asc']
        ]
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>