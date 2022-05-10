<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container pt-3">
        <? echo flash('message_delete'); ?>

        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT;?>admins"><i class="fa fa-arrow-left"></i> Back</a>
        <h1>View Messages</h1>


        <? 
        // if inbox is empty
        if($data['messages'] == "") : ?>

        <div class="mt-3 text-center">
            <p class="lead text-start">The inbox is empty, phew!</p>
            <img class="img img-fluid" src="<? echo URLROOT;?>img/empty_inbox.svg" alt="Empty inbox">
        </div>
        <? 
        // if messages exist loop through and display
        else : ?>
        <p class="lead">Below is a list of all messages sent by users to the admins.</p>
        <?
        foreach($data['messages'] as $message) : ?>
        <div class="row border-bottom mt-3 text-start">
            <a href="<? echo URLROOT;?>admins/message/<? echo $message->id;?>"
                class="col-md-1 me-3 link link-primary text-md-center col-2">
                <? if($message->opened == 1) : ?>
                <i class="fa fa-envelope-open-o"></i>

                <? else : ?>
                <i class="fa fa-envelope"></i>
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
                <a href="<?php echo URLROOT;?>admins/deleteMessage/<? echo $message->id;?>">
                    <i class="fa fa-trash link-danger link me-3"></i>
                </a>
            </p>

        </div>
        <? endforeach;
        endif; ?>

    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>