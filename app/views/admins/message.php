<?php require APPROOT . '/views/inc/header.php'; ?>

<main class="p-3 p-lg-0 p-lg-3 text-center text-sm-start">
    <div class="container pt-3">
        <a class="btn btn-secondary mb-3" href="<?php echo URLROOT;?>admins/messages"><i class="fa fa-arrow-left"></i> Back</a>

        <h2 class="my-3">View Message</h2>
        <div class=" ">
            <p >FROM:
                <? echo $data['message']->name;?>
            </p>
            <p >DATE RECEIVED:
                <?
            $sentDate = strtotime($data['message']->sent_date);
            echo date( 'd M Y - H:ia', $sentDate );;?>
            </p>
        </div>
        <h6>SUBJECT:
            <? echo $data['message']->subject;?>
        </h6>
        <hr>
        <p class="">
            <? echo $data['message']->message;?>
        </p>

        <hr>

        <a class="btn btn-primary text-light" href="mailto:<? echo $data['message']->email;?>?subject=<? echo $data['message']->subject;?>" target="_BLANK"><i class="fa fa-reply"></i> Reply</a>
        <a class="btn btn-danger text-light" href="<? echo URLROOT;?>admins/deleteMessage/<? echo $data['message']->id;?>"><i class="fa fa-trash"></i> Delete</a>

    

    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>