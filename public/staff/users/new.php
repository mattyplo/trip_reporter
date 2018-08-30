<?php

require_once('../../../private/initialize.php');

if(is_post_request()) {

  $user = [];
  $user['UserUserName'] = $_POST['username'] ?? '';
  $user['UserFirstName'] = $_POST['first_name'] ?? '';
  $user['UserLastName'] = $_POST['last_name'] ?? '';
  $user['UserEmail'] = $_POST['email'] ?? '';
  $user['UserPassword'] = $_POST['password'] ?? '';
  $user['UserConfirmPassword'] = $_POST['confirm_password'] ?? '';
    
  $result = insert_user($user);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The user was created successfully.';
    redirect_to(url_for('/staff/users/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }
    
} else {
  //display the blank form
  $user = [];
  $user['UserFirstName'] = '';
  $user['UserLastName'] = '';
  $user['UserEmail'] = '';
  $user['UserUserName'] = '';
  $user['UserPassword'] = '';
  $user['UserConfirmPassword'] = '';
}

?>

<?php $page_title = 'Create User'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/users/index.php'); ?>">&laquo; Back to Users</a>
    
  <div class="user new">
    <h1>Create User</h1>
      
    <?php echo display_errors($errors); ?>
    
    <form action="<?php echo url_for('/staff/users/new.php'); ?>" method="post">
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="" /></dd>
      </dl>  
      <dl>
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="" /></dd>
      </dl> 
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="" /></dd>
      </dl> 
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="" /></dd>
      </dl> 
      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl> 
      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <p>
        Passwords should be at least 8 characters and include at least one uppercase letter, lowercase letter, number, and symbol.  
      </p>
      <div id="operations">
        <input type="submit" value="Create User" />  
      </div>
    </form>
  </div>
    
</div>