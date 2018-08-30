<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

    // Handle form values sent by new.php

    $report_name = $_POST['report_name'] ?? '';
    $mileage = $_POST['mileage'] ?? '';
    $date = $_POST['date'] ?? '';
    $location = $_POST['location'] ?? '';
    $report_report = $_POST['report_report'] ?? '';

    $result = insert_report($report_name, $mileage, $date, $location, $report_report);
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/areas/show.php?id=' .$new_id));
    
} else {
    redirect_to(url_for('/staff/areas/new.php'));
}

?>
