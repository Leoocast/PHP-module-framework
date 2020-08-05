<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . "/datasource/helper/routes.php");
    loadLogic('travels');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>

<?php 
    $test = GetViajes();

    print_r($test);
?>