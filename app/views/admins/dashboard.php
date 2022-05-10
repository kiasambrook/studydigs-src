<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container pt-3">
        <? echo flash('message_delete'); ?>
        <h1>Welcome back,
            <? echo $data['name'];?>!
        </h1>
        <p class="lead">Welcome to the admin dashboard, here you can view the site's stored data, bug reports, and messages submitted by users.</p>

        <section id="actions" class="py-3 row text-center d-flex justify-content-center gy-2">
            <a class="col-md-3 btn-info  btn p-3 shadow-sm m-3 col-8 text-decoration-none text-dark"
                href="<? echo URLROOT;?>admins/properties">
                <h4 class="py-1">Properties</h4><i class="fa fa-5x fa-home h3 py-1"></i>
                <p class="py-1">View all uploaded properties</p>
            </a>
            <a class="col-md-3 btn-info btn p-3 shadow-sm m-3 col-8 text-decoration-none text-dark"
                href="<? echo URLROOT;?>admins/companies">
                <h4 class="py-1">Companies</h4><i class="fa fa-5x fa-briefcase h3 py-1"></i>
                <p class="py-1">View all registered companies</p>
            </a>
            <a class="col-md-3 btn-info btn p-3 shadow-sm m-3 col-8 text-decoration-none text-dark"
                href="<? echo URLROOT;?>admins/users">
                <h4 class="py-1">Users</h4><i class="fa fa-5x fa-users h3 py-1"></i>
                <p class="py-1">View all registered users</p>
            </a>
            <a class="col-md-3 btn-info btn p-3 shadow-sm m-3 col-8 text-decoration-none text-dark"
                href="<? echo URLROOT;?>admins/universities">
                <h4 class="py-1">Universities</h4><i class="fa fa-5x fa-graduation-cap h3 py-1"></i>
                <p class="py-1">View all stored universities</p>
            </a>
            <a class="col-md-3 btn-info btn p-3 shadow-sm m-3 col-8 text-decoration-none text-dark" href="https://analytics.google.com/analytics/web/#/p313877584/reports/intelligenthome">
                <h4 class="py-1">Metrics</h4><i class="fa fa-5x fa-chart-bar h3 py-1"></i>
                <p class="py-1">View metric data on Google Analytics</p>
            </a>
        </section>
        <section id="messages" class="d-flex flex-column py-3">
            <h3>Messages</h3>
            <? if($data['messages'] == "") : ?>

            <div class="mt-3 text-center">
                <p class="lead text-start">Your inbox is empty...</p>
            </div>

            <? 
        // if messages exist loop through and display
        else : ?>
            <p>You have
                <? echo $data['unreadMessages'];?> unread message<? if($data['unreadMessages'] != 1) { echo 's';}?>
            </p>


            <? foreach($data['messages'] as $message) : ?>
            <div class="row border-bottom mt-3 text-start">
                <a href="<? echo URLROOT;?>admins/message/<? echo $message->id;?>"
                    class="col-md-1 me-3 link link-primary text-md-center col-2">
                    <? if($message->opened == 1) : ?>
                    <i class="fa fa-envelope-open-o"></i>

                    <? else : ?>
                    <i class="fa fa-envelope "></i>
                    <? endif?>
                </a>

                <p class="col-md-2 me-3 col-3">FROM:
                    <? echo $message->name;?>
                </p>
                <p class="col-lg-2 me-3 col-md-4 col-3">
                    <? echo $message->subject;?>
                </p>
                <p class="text-nowrap col-md-3 me-5 d-lg-inline d-none">
                    <? echo $message->short_message;?>...
                </p>
                <p class="col-lg-2 me-3 col-2">
                    <a href="mailto:<? echo $message->email;?>?subject=<? echo $message->subject;?>" target="_BLANK">
                        <i class="fa fa-reply me-3 "></i></a>
                    <a href="<?php echo URLROOT;?>admins/deleteMessage/<? echo $message->id;?>"><i
                            class="fa fa-trash link-danger link me-3"></i></a>
                </p>

            </div>
            <? endforeach; ?>
            <p class="my-2 text-end"><a class="link link-primary" href="<? echo URLROOT;?>admins/messages">View all</a>
                <? endif;?>

            </p>
        </section>
    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>