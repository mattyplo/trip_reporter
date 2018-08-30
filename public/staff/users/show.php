<?php require_once('../../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php

$id = $_GET['id'] ?? '1';
$user = find_user_by_id($id);

?>

<?php $page_title = 'Show User'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="user show">

    <h1>User: <?php echo h($user['UserUserName']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/users/edit.php?id=' . h(u($user['UserId']))); ?>">Edit</a>
      <a class="action" href="<?php echo url_for('/staff/users/delete.php?id=' . h(u($user['UserId']))); ?>">Delete</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($user['UserFirstName']); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($user['UserLastName']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user['UserEmail']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user['UserUserName']); ?></dd>
      </dl>
    </div>

  </div>

</div>
