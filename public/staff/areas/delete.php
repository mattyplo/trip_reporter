<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/areas/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

    $result = delete_report($id);
    $_SESSION['message'] = 'The page was deleted successfully.';
    redirect_to(url_for('/staff/areas/index.php'));
    
} else {
    $report = find_report_by_id($id);
}

?>

<?php $page_title = "Delete Report"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/areas/index.php'); ?>">&laquo; Back to List</a>

    <div class="report delete">
      <h1>Delete Page</h1>
      <p>Are you sure you want to delete this report?</p>
      <p class="item"><?php echo h($report['TripReportName']); ?></p>
        
      <form action="<?php echo url_for('/staff/areas/delete.php?id=' . h(u($report['TripReportKey']))); ?>" method="post">
        <div id="operations">
          <input type="submit" name="commit" value="Delete Report" />  
        </div>
      </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>