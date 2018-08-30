<?php 

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/areas/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
    
    // Handle form values sent by new.php
    $report = [];
    $report['TripReportKey'] = $id;
    $report['TripReportName'] = $_POST['report_name'] ?? '';
    $report['TripReportMileage'] = $_POST['mileage'] ?? '';
    $report['TripReportDate'] = $_POST['date'] ?? '';
    $report['TripReportLocation'] = $_POST['location'] ?? '';
    $report['TripReportReport'] = $_POST['report_report'] ?? '';

    $result = update_report($report);
    if($result === true) {
      $_SESSION['message'] = 'The trip report was edited successfully.';
      redirect_to(url_for('/staff/areas/show.php?id=' . $id));
    } else {
      $errors = $result;
    }

} else {
    
    $report = find_report_by_id($id);
    
}

?>

<?php $page_title = 'Edit Area'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/areas/index.php'); ?>">&laquo; Back to List</a>

  <div class="report edit">
    <h1>Edit Report</h1>

    <?php echo display_errors($errors); ?>
      
    <form action="<?php echo url_for('/staff/areas/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Report Name</dt>
        <dd><input type="text" name="report_name" value="<?php echo h($report['TripReportName']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Mileage</dt>
        <dd><input type="text" name="mileage" value="<?php echo h($report['TripReportMileage']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Date</dt>
        <dd><input type="date" name="date" value="<?php echo h($report['TripReportDate']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Location</dt>
        <dd><input type="text" name="location" value="<?php echo h($report['TripReportLocation']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Report</dt>
        <dd><input type="text" name="report_report" value="<?php echo h($report['TripReportReport']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Area" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
