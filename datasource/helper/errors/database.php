<script>
    document.getElementById('loader').remove();
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/arkcms/admin/includes/helper/helper.php"); ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/dd1a87f7c1.js"></script>
<link rel="stylesheet" href="/arkcms/admin/includes/helper/errors/error.css">
<script src="/arkcms/admin/includes/helper/errors/error.js"></script>

<div class="overlay"></div>
<div class="zTop">
    <div class="" style='color:; font-size: 2em; margin-top:50px;'>
        <center>
            <div class="row">
                <div class='zTop col-md-12'>
                    <i style='' class='fas fa-database fa-2x'></i>
                    <div style='color:; font-size: 2em; margin-top: 15px;'>
                       <h1>
                         <?= $message ?>
                       </h1>
                       <hr>
                       <h2>
                            <?=  $content != "" ? $content : ""  ?>
                       </h2>
                       <h2>Config: <a class="text-info">admin/includes/config/PDO.php</a></h2>
                    </div><br>
                <a href="/arkcms/index.php" class="btn btn-info">Try again</a>
                </div>
            </div>
        </center>
    </div>
</div>

<script>
$("#loader").remove();
</script>