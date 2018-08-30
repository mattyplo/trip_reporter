<?php

  function find_all_subjects() { 
    global $db;
    $sql = "SELECT * FROM TripReport ";
    $sql .= "ORDER BY TripReportMileage ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_report_by_id($id) {
      global $db;
      $sql = "SELECT * FROM TripReport ";
      $sql .= "WHERE TripReportKey='" . db_escape($db, $id) . "'";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $report = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      return $report;
  }

  function validate_report($report) {
      
      $errors = [];
      
      // trip report name
      if(is_blank($report['TripReportName'])) {
        $errors[] = "Trip report name cannot be blank.";
      } elseif(!has_length($report['TripReportName'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Report name must be between 2 and 255 characters.";
      }
      
      if(!is_numeric($report['TripReportMileage'])) {
        $errors[] = "Mileage must be numeric.";
      }
      // mileage must be greater than zero
      elseif(!is_greater_then_zero($report['TripReportMileage'])) {
        $errors[] = "Mileage must be greater than zero.";
      }
      
      // running into a validation error with date
      /*
      // date check
      if(!has_proper_date_format($report['date'])) {
        $errors[] = "Must have proper date format! mmddyyyy";
      }
      */
      
      // location
      if(is_blank($report['TripReportLocation'])) {
        $errors[] = "Trip location cannot be blank.";
      } elseif(!has_length($report['TripReportLocation'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Report location must be between 2 and 255 characters.";
      }
      
      //code for report
      if(is_blank($report['TripReportReport'])) {
        $errors[] = "Trip report cannot be blank.";
      } elseif(!has_length($report['TripReportReport'], ['min' => 2, 'max' => 2000])) {
        $errors[] = "Report must be between 2 and 2000 characters.";
      }
      
      return $errors;
  }

  function insert_report($report) {
      global $db;
      
      $errors = validate_report($report);
      if(!empty($errors)) {
        return $errors;
      }
      
      $sql = "INSERT INTO TripReport ";
      $sql .= "(TripReportName, TripReportMileage, TripReportDate, TripReportLocation, TripReportAuthorUserId, TripReportReport) ";
      $sql .= "VALUES (";
      $sql .= "'" . db_escape($db, $report['TripReportName']) . "',";
      $sql .= "'" . db_escape($db, $report['TripReportMileage']) . "',";
      $sql .= "'" . db_escape($db, $report['TripReportDate']) . "',";
      $sql .= "'" . db_escape($db, $report['TripReportLocation']) . "',";
      $sql .= "'" . db_escape($db, $report['TripReportAuthorUserId']) . "',";
      $sql .= "'" . db_escape($db, $report['TripReportReport']) . "'";
      $sql .= ")";
      $result = mysqli_query($db, $sql);
      
      if($result) {
          return true;
      } else {
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
  }

function update_report($report) {
    global $db;
    
    $errors = validate_report($report);
    if(!empty($errors)) {
      return $errors;
    }
    
    $sql = "UPDATE TripReport SET ";
    $sql .= "TripReportName='" . db_escape($db, $report['TripReportName']) . "', ";
    $sql .= "TripReportMileage='" . db_escape($db, $report['TripReportMileage']) . "', ";
    $sql .= "TripReportDate='" . db_escape($db, $report['TripReportDate']) . "', ";
    $sql .= "TripReportLocation='" . db_escape($db, $report['TripReportLocation']) . "', ";
    $sql .= "TripReportReport='" . db_escape($db, $report['TripReportReport']) . "' ";
    $sql .= "WHERE TripReportKey='" . db_escape($db, $report['TripReportKey']) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    // for UPDATE statements. result is true/false
    if($result) {
        return true;
    } else {
        //UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_report($id) {
    
    global $db;
   
    $sql = "DELETE FROM TripReport ";
    $sql .= "WHERE TripReportKey='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    
    // for DELETE statements, $result is true/false
    if($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

// Users

function find_user_by_username($username) {
  global $db;
    
  $sql = "SELECT * FROM Users ";
  $sql .= "WHERE UserUserName='" . db_escape($db, $username) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $user;  // returns an assoc. array
}

function find_user_by_id($id) {
  global $db;
    
  $sql = "SELECT * FROM Users ";
  $sql .= "WHERE UserId='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $user;  // returns an assoc. array
}

function insert_user($user) {
  global $db;
    
  $errors = validate_user($user);
  if(!empty($errors)) {
    return $errors;
  }
    
  $hashed_password = password_hash($user['UserPassword'], PASSWORD_BCRYPT);
    
  $sql = "INSERT INTO Users ";
  $sql .= "(UserUserName, UserFirstName, UserLastName, UserEmail, UserPassword) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $user['UserUserName']) . "',";
  $sql .= "'" . db_escape($db, $user['UserFirstName']) . "',";
  $sql .= "'" . db_escape($db, $user['UserLastName']) . "',";
  $sql .= "'" . db_escape($db, $user['UserEmail']) . "',";
  $sql .= "'" . db_escape($db, $hashed_password) . "' ";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  if($result) {
    return true;
  } else {
    // INSERT failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
    
  function update_user($user) {
    global $db;
      
    $password_sent = !is_blank($user['UserPassword']);
      
    $errors = validate_user($user, ['password_required' => $password_sent]);
    if(!empty($errors)) {
      return $errors;
    }
      
    $hashed_password = password_hash($user['UserPassword'], PASSWORD_BCRYPT);
      
    $sql = "UPDATE Users SET ";
    $sql .= "UserFirstName='" . db_escape($db, $user['UserFirstName']) . "', ";
    $sql .= "UserLastName='" . db_escape($db, $user['UserLastName']) . "', ";
    $sql .= "UserEmail='" . db_escape($db, $user['UserEmail']) . "', ";
    if($password_sent) {
      $sql .= "UserPassword='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "UserUserName='" . db_escape($db, $user['UserUserName']) . "' ";
    $user .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
      
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
    


function validate_user($user, $options=[]) {
  
  $errors = [];
  $password_required = $options['password_required'] ?? true;
    
  // username
  if(is_blank($user['UserUserName'])) {
    $errors[] = "Username cannot be blank.";
  } elseif (!has_length($user['UserUserName'], ['min' => 3, 'max' => 255])) {
    $errors[] = "Username must be between 3 and 255 characters.";
  } elseif (!has_unique_username($user['UserUserName'], $user['UserId'] ?? 0)) {
    $errors[] = "Username must be unique.";
  }
    
  // first name
  if(is_blank($user['UserFirstName'])) {
    $errors[] = "First name cannot be blank.";
  } elseif (!has_length($user['UserFirstName'], ['min' => 2, 'max' => 255])) {
    $errors[] = "First name must be between 2 and 255 characters.";
  }
    
  // last name
  if(is_blank($user['UserLastName'])) {
    $errors[] = "Last name cannot be blank.";
  } elseif (!has_length($user['UserLastName'], ['min' => 2, 'max' => 255])) {
    $errors[] = "Last name must be between 2 and 255 characters.";
  }  
  
  // email
  if(is_blank($user['UserEmail'])) {
    $errors[] = "Email cannot be blank.";
  } elseif (!has_length($user['UserEmail'], array('max' => 255))) {
    $errors[] = "Email must be under 255 characters.";
  } elseif (!has_valid_email_format($user['UserEmail'])) {
    $errors[] = "Email must have correct format.";
  }
    
  // password
  if($password_required) {
    if(is_blank($user['UserPassword'])) {
      $errors[] = "Password cannot be blank.";
    } elseif (!has_length($user['UserPassword'], ['min' => 8, 'max' => 255])) {
      $errors[] = "Password must be between 8 and 255 characters.";
    } elseif (!preg_match('/[A-Z]/', $user['UserPassword'])) {
      $errors[] = "Password must contain at least 1 uppercase letter";
    } elseif (!preg_match('/[a-z]/', $user['UserPassword'])) {
      $errors[] = "Password must contain at least 1 lowercase letter";
    } elseif (!preg_match('/[0-9]/', $user['UserPassword'])) {
      $errors[] = "Password must contain at least 1 number";
    } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['UserPassword'])) {
      $errors[] = "Password must contain at least 1 symbol";
    }

    if(is_blank($user['UserConfirmPassword'])) {
      $errors[] = "Confirm password cannot be blank.";
    } elseif ($user['UserPassword'] !== $user['UserConfirmPassword']) {
      $errors[] = "Password and confirm password must match.";
    }
  }
      
  return $errors;

}

?>