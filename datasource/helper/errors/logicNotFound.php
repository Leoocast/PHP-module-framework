<?php 
  $path    = $_SERVER['DOCUMENT_ROOT'] . "/arkcms/includes/logic/";

  $files = scandir($path);
  $files = array_diff(scandir($path), array('.', '..'));
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="error.css">

<div class="overlay"></div>
<div class="zTop">
    <div class="" style='color:; font-size: 2em; margin-top:50px;'>
        <center>
            <div class="row">
                <div class='zTop col-md-12'>
                    <i style='' class='fas fa-exclamation-triangle fa-5x'></i>
                    <div style='color:; font-size: 2em; margin-top: 15px;'>
                        <b><?=$file?></b> not found
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px;" class="row ">
                <div class='col-md-4'></div>
                <div class='col-md-4'>
                    <div class="zContent card">
                        <div class="card-header">
                            Your logic files:
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-body text-left">
                                    <i style="margin-bottom: 10px;" class="fas fa-folder-open"></i>
                                    <?php foreach($files as $i => $_file): 
                                        $_file = explode('.php', $_file)[0];
                                        ?>
                                    <p style="margin-left: 25px;" class="card-text"><i class="fas fa-file"></i><?= " $_file" ?></p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <img style="margin: 8px; float:right;" src="https://66.media.tumblr.com/56125d980d3cb73aabceb1e9a79cd0fa/tumblr_mn6jgdtG9B1r02erqo2_250.png" 
                                alt="" height="200">
                            <div>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'></div>
                <div class="text-right card-footer text-muted">
                    <a href="#">View documentation</a>
                </div>
            </div>
        </center>
    </div>
</div>