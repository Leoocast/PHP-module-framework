<?php 
  $path    = $_SERVER['DOCUMENT_ROOT'] . "/arkcms/admin/includes/views/";

  $files = scandir($path);
  $files = array_diff(scandir($path), array('.', '..'));
?>
<!-- <link rel="stylesheet" href="/arkcms/admin/includes/helper/errors/error.css"> -->
<script src="/arkcms/admin/includes/helper/errors/error.js"></script>
<div class="overlay"></div>

<div style='color:; font-size: 1em; margin-top:50px;'>
    <center>
        <div class="row zTop">
            <div class='col-md-12 zTop'>
                <i style='' class='fas fa-exclamation-triangle fa-5x'></i>
                <div style='color:; font-size: 2em; margin-top: 15px;'>
                    <b>View: <?=$folder?>/<?=$file?>.php</b> not found
                </div>
            </div>
        </div>
    </center>
</div>