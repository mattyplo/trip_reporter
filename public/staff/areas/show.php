<?php require_once('../../../private/initialize.php'); ?>
<?php 
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; //PHP > 7.0

$area = find_report_by_id($id);

?>


<?php $page_title = 'Show Area'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/areas/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject show">
        
        <h1>Hike: <?php echo h($area['TripReportName']); ?></h1>

        <div class="attributes">
          <dl>
            <dt>Hike Name</dt>
            <dd><?php echo h($area['TripReportName']); ?></dd>
          </dl>
          <dl>
            <dt>Mileage</dt>
            <dd><?php echo h($area['TripReportMileage']); ?></dd>
          </dl>
          <dl>
            <dt>Date</dt>
            <dd><?php echo h($area['TripReportDate']); ?></dd>
          </dl>
          <dl>
            <dt>Location</dt>
            <dd><?php echo h($area['TripReportLocation']); ?></dd>
          </dl>
          <dl>
            <dt>Report</dt>
            <dd><?php echo h($area['TripReportReport']); ?></dd>
          </dl>
        </div>
        
    </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>