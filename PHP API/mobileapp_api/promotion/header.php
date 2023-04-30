<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>Spectraz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?time=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css?time=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
    <script src="https://kit.fontawesome.com/ac9b11d13d.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    
    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.ui.min.js"></script>

</head>

<body>
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<?php
if (@$_GET['action'] == "success") {
    ?>
    <div class="statusBar success">Operation has been successfully</div>
    <?php
}
if (@$_GET['action'] == "error") {
    ?>
    <div class="statusBar error">There is some error</div>
    <?php
}
?>



