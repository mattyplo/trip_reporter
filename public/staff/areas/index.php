<?php require_once('../../../private/initialize.php'); ?>

<?php

  $subject_set = find_all_subjects();

?>

<?php $page_title = 'Areas'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>Subjects</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/areas/new.php'); ?>">Create New Trip Report</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>Trip Report Author</th>
        <th>Trip Name</th>
        <th>Mileage</th>
  	    <th>Area</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
        <?php
        $user = find_user_by_id($subject['TripReportAuthorUserId']);
        ?>
        <tr>
          <td><?php echo $user['UserUserName']; ?></td>
          <td><?php echo $subject['TripReportName']; ?></td>
          <td><?php echo $subject['TripReportMileage']; ?></td>
          <td><?php echo $subject['TripReportLocation']; ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/areas/show.php?id=' . h(u($subject['TripReportKey']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/areas/edit.php?id=' . h(u($subject['TripReportKey']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/areas/delete.php?id=' . h(u($subject['TripReportKey']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php
      mysqli_free_result($subject_set);
    ?>
    
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
