
@if(isset($notification) && date('Y-m-d') < $notification->expiration && strlen($notification)>100)

    <div  class="row" >
    <div  class="col-lg-12" >

        <div class="alert notification-alert" role="alert">
        <span id="instruction">
            <?php
                $notification = str_replace("&lt;", "<", $notification->content);
                $notification = str_replace("&gt;", ">", $notification);
                echo $notification;
            ?>
        </span></br>
        </div>
    </div>
</div>
@endif