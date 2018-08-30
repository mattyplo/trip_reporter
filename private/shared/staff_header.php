<?php
    if(!isset($page_title)) { $page_title = ''; }
?>


<!doctype html>

<html lang="en">
  <head>
    <title>Trip Reports Inc. - <?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
  </head>

  <body>
      <header>
          <h1>Trip Reports</h1>
      </header>
      
      <navigation>
          <ul>
            <li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
            <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
            <li><a href="<? echo url_for('/staff/logout.php'); ?>">Login / Logout</a></li>
          </ul>
      </navigation>
      
      <?php echo display_session_message(); ?>