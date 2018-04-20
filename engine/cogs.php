<?php

# function clean our data
function clean_input($data) {
  $data = str_replace("'", "`", $data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


# function to get current date
function getCurrentDate(){
  date_default_timezone_set('Africa/Nairobi');
  $date = date('Y-m-d H:i:s');

  return $date;
}


# funtion to shuffle string
function stringShuffle($divide = 4){
  $string = 'abcdefghijklmnopqrst0123456789';

  $string = str_shuffle($string);

  $code = substr($string, 0, strlen($string)/$divide);

  return $code;
}

#function that adds s to the end.
function addS($time){
  if ($time != 1) {
    $s = 's';
  }else {
    $s = '';
  }

  return $s;
}

#difference in time
function timeSpan($date){

  date_default_timezone_set('Africa/Nairobi');
  $current_date = date('Y-m-d');

  $seconds  = strtotime($date) - strtotime(date($current_date));

    $months = floor($seconds / (3600*24*30));
    $day = floor($seconds / (3600*24));
    $hours = floor($seconds / 3600);
    $mins = floor(($seconds - ($hours*3600)) / 60);
    $secs = floor($seconds % 60);

    if($seconds < 60)
        $time = $secs." second".addS($secs)." to go";
    else if($seconds < 60*60 )
        $time = $mins." min".addS($mins)." to go";
    else if($seconds < 24*60*60)
        $time = $hours." hour".addS($hours)." to go";
    else if($seconds < 30*24*60*60)
        $time = $day." day".addS($day)." to go";
    else
        $time = $months." month".addS($months)." to go";

    return $time;
}

/*
--------------------------------------------
  events functionality
--------------------------------------------
*/
# upload event function
function uploadEvent(){

  global $conn;

  $date = getCurrentDate();
  $username = $_SESSION['user'];

  if (isset($_POST['post-event'])) {
    $errors = array();

    # confirm name is not empty
    if ($_POST['name'] == '') {
      $errors[] = "<p class='error'>You haven't entered the event name</p>";
    }else {
      $name = clean_input($_POST['name']);
    }

    # confirm description is not empty
    if ($_POST['description'] == '') {
      $errors[] = "<p class='error'>You haven't entered a description</p>";
    }else {
      $description = clean_input($_POST['description']);
    }

    $event = $_POST['event'];

    # confirm message is not empty
    if ($_POST['event-date'] == '') {
      $errors[] = "<p class='error'>You haven't entered the date</p>";
    }else {
      $event_date = clean_input($_POST['event-date']);
    }

    # confirm message is not empty
    if ($_POST['entry-fee'] == '') {
      $entry_fee = 'Free Entry';
    }else {
      $entry_fee = clean_input($_POST['entry-fee']);
    }

    # confirm message is not empty
    if ($_POST['venue'] == '') {
      $errors[] = "<p class='error'>You haven't entered a venue</p>";
    }else {
      $venue= clean_input($_POST['venue']);
    }

    $code = stringShuffle();

    if ($errors == []) {
      $sql = "INSERT INTO events (code, name, description, event, eventdate, entryfee, venue, timestamp, postedby) VALUES('$code', '$name', '$description', '$event', '$event_date', '$entry_fee', '$venue', '$date', '$username')";

      if ($conn->query($sql) === TRUE){
        echo "<p class='success'>Event post successful</p>";
        header('refresh:2; url=../../');
      }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }else {
      foreach ($errors as $error) {
        echo $error;
      }
    }
  }
}

# edit event
function editEvent($code){

  global $conn;

  if (isset($_POST['edit-event'])) {
    $errors = array();

    # confirm name is not empty
    if ($_POST['name'] == '') {
      $errors[] = "<p class='error'>You haven't entered the event name</p>";
    }else {
      $name = clean_input($_POST['name']);
    }

    # confirm description is not empty
    if ($_POST['description'] == '') {
      $errors[] = "<p class='error'>You haven't entered a description</p>";
    }else {
      $description = clean_input($_POST['description']);
    }

    $event = $_POST['event'];

    # confirm message is not empty
    if ($_POST['event-date'] == '') {
      $errors[] = "<p class='error'>You haven't entered the date</p>";
    }else {
      $event_date = clean_input($_POST['event-date']);
    }

    # confirm message is not empty
    if ($_POST['entry-fee'] == '') {
      $entry_fee = 'Free Entry';
    }else {
      $entry_fee = clean_input($_POST['entry-fee']);
    }

    # confirm message is not empty
    if ($_POST['venue'] == '') {
      $errors[] = "<p class='error'>You haven't entered a venue</p>";
    }else {
      $venue= clean_input($_POST['venue']);
    }

    if ($errors == []) {
      $sql = "UPDATE events SET `name` = '$name', `description` = '$description',  `event`='$event', `eventdate`='$event_date', `entryfee` = '$entry_fee', `venue` = '$venue' WHERE code = '$code'";

      if ($conn->query($sql) === TRUE){
        echo "<p class='success'>Event edited successful</p>";
        header('refresh:2; url=../');
      }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }else {
      foreach ($errors as $error) {
        echo $error;
      }
    }
  }
}


# event upload and edit button
function echoButton(){
  if (isset($_GET['editevent'])) {
    $value = '<input type="submit" name="edit-event" value="edit event">';
  }else {
    $value = '<input type="submit" name="post-event" value="post event">';
  }

  return $value;
}

# get events function
function getEvents(){

  global $conn;

  if (isset($_GET['link']) && $_GET['link'] != '') {
    $link = strtolower($_GET['link']);

    $sql = "SELECT * FROM events WHERE event = '$link' ORDER BY eventdate DESC";
    $result = $conn->query($sql);

    # get fields into variables
    while($row = $result->fetch_assoc()){
      $code = $row['code'];
      $name = $row['name'];
      $description = $row['description'];
      $event = $row['event'];
      $event_date = $row['eventdate'];
      $entry_fee = $row['entryfee'];
      $venue = $row['venue'];

      echo "
      <div class='event'>
        <a href='?link=$event' class='kando'>#$event</a>
        <h3>$name</h3>
        <p style='padding:1% 0%'>$description</p>
        <p><b>Entry Fee: </b><span class='fee'>Ksh $entry_fee</span></p>
        <p><b>Venue: </b>$venue</p>
        <p><b>Date: </b>$event_date</p>
        <br><a href='profile/ticket?ticket_number=$code'>get ticket</a>  <span class='kando' style='background-color:#34ca66;'>".timeSpan($event_date)."</span><br><br>
      </div>";
    }
  }else {
    $sql = "SELECT * FROM events ORDER BY eventdate ASC";
    $result = $conn->query($sql);

    # get fields into variables
    while($row = $result->fetch_assoc()){
      $code = $row['code'];
      $name = $row['name'];
      $description = $row['description'];
      $event = $row['event'];
      $event_date = $row['eventdate'];
      $entry_fee = $row['entryfee'];
      $venue = $row['venue'];

      echo "
      <div class='event'>
        <a href='?link=$event' class='kando'>#$event</a>
        <h3>$name</h3>
        <p style='padding:1% 0%'>$description</p>
        <p><b>Entry Fee: </b><span class='fee'>Ksh $entry_fee</span></p>
        <p><b>Venue: </b>$venue</p>
        <p><b>Date: </b>$event_date</p>
        <br><a href='profile/ticket?ticket_number=$code'>get ticket</a>  <span class='kando' style='background-color:#34ca66;'>".timeSpan($event_date)."</span><br><br>
      </div>";
    }
  }
}

/*
--------------------------------------------
login and registration
--------------------------------------------
*/
# function to login the user
function loginUser(){
  if (isset($_POST['login'])) {
    global $conn;

    $errors = array(); #initialize array to store our errors

    #username
    if($_POST['username'] != ''){
      $username = clean_input($_POST['username']);
    }else {
      $errors[] = "<p class='error'>username is required</p>";
    }

    #password
    if($_POST['password'] != ''){
      $password = (clean_input($_POST['password']));
    }else {
      $errors[] = "<p class='error'>password is required</p>";
    }

    if($errors == []){
      $query = "SELECT username, password FROM users WHERE username = '$username'";
      $result = $conn->query($query);

      if($result->num_rows == 1){
        while($row = $result->fetch_assoc()) {
              $username = $row['username'];
              $hash = $row['password'];
            }

            if (password_verify($password, $hash)) {

              $_SESSION['user'] = $username;

              if ($username == 'admin') {
                header('Location: ../admin');
              }else {
                header('Location: ../profile');
              }

            } else {
              echo '<p class="error">Invalid login details</p>';
            }
      }else if($result->num_rows < 1){
        echo '<p class="error">That username does not exist</p>';
      }
    }else{
      foreach ($errors as $error) {
        echo $error;
      }
    }
  }
}

  # register user function
  function registerUser(){

    global $conn;

    $current_date = getCurrentDate();

    if (isset($_POST['register'])) {
      $errors = array(); #initialize array to store our errors

      # username
      if($_POST['name'] != ''){
        $name = clean_input($_POST['name']);
      }else {
        $errors[] = "<p class='error'>Full name is required</p>";
      }

      # username
      if($_POST['username'] != ''){
        $username = clean_input($_POST['username']);
      }else {
        $errors[] = "<p class='error'>username is required</p>";
      }

      #password
      if($_POST['password'] != ''){
        $password = clean_input($_POST['password']);

        if (strlen($password) < 6) {
          $errors[] = "<p class='error'>password cannot be less than 6 characters</p>";
        }else {

          # confirm password
          if($_POST['password2'] != ''){
            $password2 = clean_input($_POST['password2']);
          }else {
            $errors[] = "<p class='error'>Please confirm your password</p>";
          }

          if ($password == $password2) {
            $password = password_hash($password, PASSWORD_BCRYPT);
          }else {
            $errors[] = "<p class='error'>Passwords are not similar</p>";
          }

        }
      }else {
        $errors[] = "<p class='error'>password is required</p>";
      }


      # when no errors exist
      if($errors == []){

        $sql = "SELECT username FROM users where username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "<p class='error'>That account already exists</p>";
        }else {

          #Inserting the user's data into our database
          $sql = "INSERT INTO users ( name, username, password, dor)
          VALUES ('$name', '$username', '$password', '$current_date')";

          if ($conn->query($sql) === TRUE) {

            $_SESSION['user'] = $username;
            echo "<p class='success'>Registration successful</p>";
            header('refresh:2; url=../');

          }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }

      }else {
        foreach ($errors as $error) {
          echo $error;
        }
      }
    }
  }

/*
--------------------------------------------
generate ticket
--------------------------------------------
*/
# function to get ticket
function getTicket($code){
  global $conn;

  $username = $_SESSION['user'];

  $serial_code = strtoupper(stringShuffle() . $username);

  $sql = "SELECT * FROM events WHERE code = '$code'";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $name = $row['name'];
    $description = $row['description'];
    $event = $row['event'];
    $event_date = $row['eventdate'];
    $entry_fee = $row['entryfee'];
    $venue = $row['venue'];


    echo "
    <div class='ticket'>
      <p>".generateTicket($code, $serial_code, $username)."</p>
      <h3>".strtoupper($name)."</h3><br>
      <p><b>Serial code: </b>#" . $serial_code ."</p>
      <p><b>Entry Fee: </b><span class='fee'>Ksh $entry_fee</span></p>
      <p><b>Venue: </b>$venue</p>
      <p><b>Date: </b>$event_date  <span style='background-color:#34ca66;color:#fff; border-radius:3px; paddding:3%!important;'>".timeSpan($event_date)."</span></p>
      <form class='ui-form' action='' method='post'>
        <input type='submit' name='confirm-ticket' value='generate ticket'>
      </form>
    </div>";
  }
}

function myTickets($code, $username, $serial_code){
  global $conn;

  $sql = "SELECT * FROM events WHERE code = '$code'";
  $result = $conn->query($sql);

  # get fields into variables
    while($row = $result->fetch_assoc()){
      $name = $row['name'];
      $description = $row['description'];
      $event = $row['event'];
      $event_date = $row['eventdate'];
      $entry_fee = $row['entryfee'];
      $venue = $row['venue'];


      echo "
      <div class='ticket'>
        <h3>".strtoupper($name)."</h3><br>
        <p><b>Serial code: </b>#" . $serial_code ."</p>
        <p><b>Entry Fee: </b><span class='fee'>Ksh $entry_fee</span></p>
        <p><b>Venue: </b>$venue</p>
        <p><b>Date: </b>$event_date  <span style='background-color:#34ca66;color:#fff; border-radius:3px; paddding:3!important%;'>".timeSpan($event_date)."</span></p>
        <br><a href='?deleteticket=$serial_code'>cancel ticket</a><br><br>
      </div>";
    }
  }

# function to get all tickets
function getTickets(){

  global $conn;
  $username = $_SESSION['user'];

  $sql = "SELECT * FROM tickets WHERE username = '$username' ORDER BY id DESC";
  $result = $conn->query($sql);

  # get fields into variables
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $code = $row['code'];
      $serial_code = $row['serial_code'];
      $username = $row['username'];

      myTickets($code, $username, $serial_code);
    }
  }else if($result->num_rows < 1){
    echo "
    <div class='empty-data'>
      <h3>You do not have any new tickets</h3><br><br>
      <a href='../../'>get ticket</a>
    </div>";
  }

}

# add ticket to db
function generateTicket($code, $serial_code, $username){

  global $conn;

  if (isset($_POST['confirm-ticket'])) {

    $current_date = getCurrentDate();

    #Inserting the user's data into our database
    $sql = "INSERT INTO tickets (code, serial_code, username, timestamp)
    VALUES ('$code', '$serial_code', '$username', '$current_date')";

    if ($conn->query($sql) === TRUE) {
      echo "<p class='success'>Ticket generation successful</p>";
      header('refresh:2; url=../ticket');
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

# function to delete ticket
function deleteTicket($ticket){
  global $conn;

  $sql = "DELETE FROM tickets WHERE serial_code = '$ticket'";
  if ($conn->query($sql) === TRUE) {

    echo "<p class='success'>Ticket deletion successful</p>";
    header('refresh:2; url=../ticket');

  }else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

/*
--------------------------------------------
my events
--------------------------------------------
*/
# function to get user's events
function getMyEvents(){
  global $conn;

  $username = $_SESSION['user'];

  $sql = "SELECT * FROM events WHERE postedby = '$username'";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
    # get fields into variables
    while($row = $result->fetch_assoc()){
      $code = $row['code'];
      $name = $row['name'];
      $description = $row['description'];
      $event = $row['event'];
      $event_date = $row['eventdate'];
      $entry_fee = $row['entryfee'];
      $venue = $row['venue'];


      echo "
      <div class='ticket'>
        <h3>".strtoupper($name)."</h3><br>
        <p><b>Entry Fee: </b><span class='fee'>Ksh $entry_fee</span></p>
        <p><b>Venue: </b>$venue</p>
        <p><b>Date: </b>$event_date  <span style='background-color:#34ca66;color:#fff; border-radius:3px; paddding:1%;'>".timeSpan($event_date)."</span></p>
        <br><a href='?deleteevent=$code'>delete event</a><a style='background-color:#34ca66;border:2px solid #34ca66;' href='new-event/?editevent=$code'>edit event</a><br><br>
      </div>";
    }
  }else if($result->num_rows < 1){
    echo "
    <div class='empty-data'>
      <h3>You do not uploaded any events</h3><br><br>
      <a href='new-event'>add new event</a>
    </div>";
  }
}

# function to delete event
function deleteEvent($code){

  global $conn;

  $sql = "DELETE FROM events WHERE code = '$code'";

  if ($conn->query($sql) === TRUE) {
    $sql = "DELETE FROM tickets WHERE code = '$code'";

    if ($conn->query($sql) === TRUE) {

      echo "<p class='success'>Event deletion successful</p>";
      header('refresh:2; url=../profile');

    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


/*
--------------------------------------------
profile security and logout function
--------------------------------------------
*/

# user security function
function userSecurity($path=''){
  if (!isset($_SESSION['user'])) {
    header('location: '.$path.'login');
  }
}

# logout function
function endSession($path=''){
  if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ".$path."");
  }
}

 ?>
