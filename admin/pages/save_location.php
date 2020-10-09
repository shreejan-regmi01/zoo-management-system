<?php
if (!isset($_SESSION['authenticated'])) {
    header("Location:admin_login");
}

$locationTable = new Table('locations');

if(isset($_GET['l_id'])){
    $locationQ = $locationTable->findInDatabase('location_id', $_GET['l_id']);
    $location = $locationQ->fetch();
}else{
    $location=[];
}


if (isset($_POST['submit'])) {
    unset($_POST['submit']);

    if (!isset($_POST['location_archived']))
        $_POST['location_archived'] = 'false';

    $locationTable->saveInDatabase($_POST, 'location_id');
    header('Location:save_location?msg=Location Data Saved&type=success');
}

$title = "Claybrook Zoo - Save Location";
$content = loadTemplate('../templates/location_form_template.php', ['location'=>$location]);
