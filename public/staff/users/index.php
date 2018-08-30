<?php

require_once('../../../private/initialize.php');
require_login();
$user = find_user_by_id($_SESSION['user_id']);

?>

<?php $page_title = 'User Home'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="user info">
    <h1>User: <?php echo $user['UserUserName']; ?></h1>
      
    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/users/edit.php'); ?>">Edit User Information</a>  
    </div>
      
    <h2>First Name: <?php echo $user['UserFirstName']; ?></h2>
    <h2>Last Name: <?php echo $user['UserLastName']; ?></h2>
    <h2>Email: <?php echo $user['UserEmail']; ?></h2>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>