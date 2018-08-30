<?php

require_once('../../../private/initialize.php');
require_login();

$user = find_user_by_id($_SESSION['user_id']);

if(is_post_request()) {
  $user['UserFirstName'] = $_POST['first_name'] ?? '';
  $user['UserLastName'] = $_POST['last_name'] ?? '';
  $user['UserEmail'] = $_POST['email'] ?? '';
  $user['UserUserName'] = $_POST['username'] ?? '';
  $user['UserPassword'] = $_POST['password'] ?? '';
  $user['confirm_password'] = $_POST['confirm_password'] ?? '';
    
  $result = update_user($user);
  
}
