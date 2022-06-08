<script type="text/javascript" src="{{asset('ball_journal/js/jquery_latest_3_1.js')}}"></script>
<script type="text/javascript" src="{{asset('ball_journal/js/pooper.js')}}"></script>
<script type="text/javascript" src="{{asset('ball_journal/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('ball_journal/js/myJS_part_for_every_page.js')}}"></script>
<?php

if(Auth::check()) {
    $user = Auth::user();
    if ($user->isAn('ball-technician-admin')) { ?>
        <script type="text/javascript" src="{{asset('ball_journal/js/myJS_part_for_admin_view.js')}}"></script>
  <?php  }
}
?>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
