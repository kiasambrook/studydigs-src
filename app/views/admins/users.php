<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container py-3">

    <? echo flash('user_delete'); ?>

        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT;?>admins"><i class="fa fa-arrow-left"></i> Back</a>
        <h1>View Users</h1>

        <? 
        // if property database is empty
        if($data['users'] == "") : ?>

        <div class="mt-3 text-center">
            <p class="lead text-start">Uh-oh! No users found...</p>
            <img class="img img-fluid" src="<? echo URLROOT;?>img/empty_properties.svg" alt="Empty street">
        </div>
        <? 
        // if messages exist loop through and display
        else : ?>
        <p class="lead">The full list of users registered with StudyDigs.</p>

        <div class="table-responsive text-center">
            <table id="usersTable" class="table table-hover table-striped table-borderless ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Verified</th>
                        <th>Creation Date</th>
                        <th>Company</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <?  foreach($data['users'] as $user) : ?>

                <tr>
                    <td>
                        <? echo ucWords($user['userId']); ?>
                    </td>
                    <td>
                        <? echo ucWords($user['first_name']); ?>
                    </td>
                    <td>
                        <? echo ucWords($user['last_name']); ?>
                    </td>
                    <td>
                        <? echo $user['userEmail']; ?>
                    </td>
                    <td>
                        <? 
                        if($user['verified'] == 1){
                            echo 'Yes';
                        }
                        else{
                            echo 'No';
                        }?>
                    </td>
                    <td>
                        <? echo ucWords($user['creation_date']); ?>
                    </td>
                    <td>
                        <? echo ucWords($user['name']); ?>
                    </td>
                    <td>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?php echo $user['userId']; ?>"
                            class="link link-danger btn"><i class="fa fa-trash fa-lg"></i></button>
                    </td>
                </tr>

                <!-- Delete user modal -->
                <div class="modal fade" id="deleteModal<?php echo $user['userId']; ?>" tabindex="-1"
                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">
                                    Are you sure you want to delete the user 
                                    <? echo $user['first_name'] . ' ' . $user['last_name'];?>?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-danger">
                               WARNING: This action will NOT delete the user's associated company or properties. This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <a type="button"
                                    href="<? echo URLROOT;?>admins/deleteUser/<? echo $user['userId'];?>"
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
    $('#usersTable').DataTable({
        "pageLength": 10,
        "order": [
            [0, 'asc']
        ]
    });
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>