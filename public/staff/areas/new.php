<?php 

require_once('../../../private/initialize.php');

require_login();

$userId = $_SESSION['user_id'];

if(is_post_request()) {
    
    $report = [];
    $report['TripReportName'] = $_POST['report_name'] ?? '';
    $report['TripReportMileage'] = $_POST['mileage'] ?? '';
    $report['TripReportDate'] = $_POST['date'] ?? '';
    $report['TripReportLocation'] = $_POST['location'] ?? '';
    $report['TripReportReport'] = $_POST['report_report'] ?? '';
    $report['TripReportAuthorUserId'] = $userId;
    
    $result = insert_report($report);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = 'The trip report was created successfully.';
      redirect_to(url_for('/staff/areas/show.php?id=' . $new_id));
    } else {
      $errors = $result;
    }
    
} else {
    
    $report = [];
    $report['TripReportName'] = '';
    $report['TripReportMileage'] = '';
    $report['TripReportDate'] = '';
    $report['TripReportLocation'] = '';
    $report['TripReportReport'] = '';
    
}

?>

<?php $page_title = 'Create Report'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/areas/index.php'); ?>">&laquo; Back to List</a>

  <div class="report new">
    <h1>Create Report</h1>

    <?php echo display_errors($errors); ?>
      
    <form action="<?php echo url_for('/staff/areas/new.php'); ?>" method="post">
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
        <dd><input type="date" name="date" /></dd>
      </dl>
      <dl>
        <dt>Location</dt>
        <dd><input type="text" name="location" value="<?php echo h($report['TripReportLocation']); ?>"/></dd>
      </dl>
      <dl>
        <dt>Report</dt>
        <dd><input type="text" name="report_report" value="<?php echo h($report['TripReportReport']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Report" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
