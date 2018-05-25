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

# getting Attending count
function getAttendingCount($code){
  global $conn;

  $query = "SELECT * FROM tickets WHERE code = '$code'";
  $row_count = mysqli_query($conn, $query);
  $row_count = mysqli_num_rows($row_count);

  return $row_count;
}

# function that adds s to the end.
function addS($time){
  if ($time != 1) {
    $s = 's';
  }else {
    $s = '';
  }

  return $s;
}

# function to get difference in time
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


# link to profile
function profileLink($link=''){
  if (isset($_SESSION['user'])) {
    echo '<a href="'.$link.'profile"><li>profile</li></a>';
  }elseif (isset($_SESSION['admin'])) {
    echo '<a href="'.$link.'admin"><li>profile</li></a>';
  }elseif (isset($_SESSION['superadmin'])) {
    echo '<a href="'.$link.'superadmin"><li>profile</li></a>';
  }
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
        <p><b>Attending: </b>".getAttendingCount($code)."</p>
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
        <p><b>Attending:</b>".getAttendingCount($code)."</p>
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

        if ($password == $hash) {
          $_SESSION['user'] = $username;
          header('Location: ../profile');
        }else {
         echo '<p class="error">Invalid login details</p>';
       }
     }else {
       $query = "SELECT username, password FROM administrators WHERE username = '$username'";
       $result = $conn->query($query);

       if($result->num_rows == 1){
         while($row = $result->fetch_assoc()) {
               $username = $row['username'];
               $hash = $row['password'];
             }

             if ($password == $hash) {

               if ($username == 'superadmin') {
                 header('Location: ../superadmin');
                 $_SESSION['superadmin'] = $username;
               }else {
                 header('Location: ../admin');
                 $_SESSION['admin'] = $username;
               }
             } else {
               echo '<p class="error">Invalid login details</p>';
             }
       }else if($result->num_rows < 1){
         echo '<p class="error">That username does not exist</p>';
       }
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
            $password = $password;
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
      <p><b>Attending:</b>".getAttendingCount($code)."</p>
      <form class='ui-form' action='' method='post'>
        <input type='submit' name='confirm-ticket' value='generate ticket'>
      </form>
    </div>";
  }
}


# get user tickets
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
        <p><b>Attending:</b>".getAttendingCount($code)."</p>
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
        <p><b>Attending:</b>".getAttendingCount($code)."</p>
        <br><a href='?deleteevent=$code'>delete event</a><a style='background-color:#34ca66;border:2px solid #34ca66;' href='new-event/?editevent=$code'>edit event</a><br><br>
      </div>";
    }
  }else if($result->num_rows < 1){
    echo "
    <div class='empty-data'>
      <h3>You have not uploaded any events</h3><br><br>
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

# function to get all Events
function getAllEvents(){
  global $conn;

  $sql = "SELECT * FROM events";
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
        <p><b>Attending:</b>".getAttendingCount($code)."</p>
      </div>";
    }
  }else if($result->num_rows < 1){
    echo "
    <div class='empty-data'>
      <h3>You have not uploaded any events</h3><br><br>
      <a href='new-event'>add new event</a>
    </div>";
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

# admin security
function adminSecurity($path=''){
  if (!isset($_SESSION['admin'])) {
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

/*
--------------------------------------------
view messages
--------------------------------------------
*/
// GET MESSAGES
function getMessages(){

  global $conn;

  $sql = "SELECT * FROM messages ORDER BY date DESC";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
    # get fields into variables
    while($row = $result->fetch_assoc()){
      $id = $row['message_id'];
      $name = $row['name'];
      $email = $row['email'];
      $phone = $row['phone'];
      $message = $row['message'];
      $date = date_format(new dateTime($row['date']), "jS M Y H:i:s");

      echo "
      <div class='message'>
        <p style='text-transform:capitalize;'><b>Message From:</b> $name</p>
        <p>$message</p>
        <p><b>Phone: </b>$phone</p>
        <p><b>Date posted: </b>$date</p></br>
        <a href='issue-order/?name=$name&phone=$phone'>issue order</a>
      </div>";
    }
  }else if($result->num_rows < 1){
    echo "
    <div class='empty-data'>
      <h3>You do not have any new messages</h3><br><br>
    </div>";
  }
}

// INSERT NEW MESSAGE
function newMessage(){
  global $conn;

  $errors = array();

  if (isset($_POST['send-message'])) {

    if ($_POST['name'] != '') {
      $name = $_POST['name'];
    }else {
      $errors[] = "<p class='error'>Name cannot be empty</p>";
    }

    if ($_POST['email'] == '') {
      $errors[] = "<p class='error'>Email cannot be empty</p>";
    }else {
      $email = $_POST['email'];
    }

    if ($_POST['phone'] == '') {
      $errors[] = "<p class='error'>Phone nunmber cannot be empty</p>";
    }else {
      $phone = $_POST['phone'];
    }

    if ($_POST['message'] == '') {
      $errors[] = "<p class='error'>message cannot be empty</p>";
    }else {
      $message = $_POST['message'];
    }

    if ($errors == []) {
      #Inserting the user's data into our database
      $sql = "INSERT INTO messages (name, email, phone, message)
      VALUES ('$name', '$email', '$phone', '$message')";

      if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Message sent successfully</p>";
        header('refresh:2; url=../contacts');
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

/*
--------------------------------------------
INVENTORY FUNCTIONS
--------------------------------------------
*/
function getInventory(){

  global $conn;
  $c = 0;

  $sql = "SELECT * FROM inventory ORDER BY item ASC";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $c += 1;
    $id = $row['item_id'];
    $item = $row['item'];
    $count = $row['count'];
    $price = $row['single_item_price'];

    echo "
      <tr>
        <td>$c</td>
        <td class='cap'>$item</td>
        <td>$count</td>
        <td>$price</td>
        <td style='width:10%'><a href='?edit=$id'>edit</a></td>
        <td style='width:10%'><a href='?delete=$id'>delete</a></td>
      </tr>
    ";
  }
}

/*
--------------------------------------------
ADD NEW ITEM
--------------------------------------------
*/
function addNewItem(){

  global $conn;
  $errors = array();

  if (isset($_POST['add-item'])) {

    if ($_POST['item'] != '') {
      $item = $_POST['item'];
    }else {
      $errors[] = "<p class='error'>item cannot be empty</p>";
    }

    if ($_POST['price'] == '') {
      $errors[] = "<p class='error'>price cannot be empty</p>";
    }else {
      $price = $_POST['price'];
    }

    if ($_POST['count'] == '') {
      $errors[] = "<p class='error'>count cannot be empty</p>";
    }else {
      $count = $_POST['count'];
    }

    if ($errors == []) {
      #Inserting the user's data into our database
      $sql = "INSERT INTO inventory (item, count, single_item_price)
      VALUES ('$item', '$count', '$price')";

      if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Item added successfully</p>";
        header('refresh:2; url=../inventory');
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


/*
--------------------------------------------
EDIT ITEM
--------------------------------------------
*/
function editItem($id){

  global $conn;
  $errors = array();

  if (isset($_POST['edit-item'])) {

    if ($_POST['item'] != '') {
      $item = $_POST['item'];
    }else {
      $errors[] = "<p class='error'>item cannot be empty</p>";
    }

    if ($_POST['price'] == '') {
      $errors[] = "<p class='error'>price cannot be empty</p>";
    }else {
      $price = $_POST['price'];
    }

    if ($_POST['count'] == '') {
      $errors[] = "<p class='error'>count cannot be empty</p>";
    }else {
      $count = $_POST['count'];
    }

    if ($errors == []) {
      $sql = "UPDATE inventory SET `item` = '$item', `count` = '$count',  `single_item_price`='$price' WHERE item_id = $id";

      if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Item added successfully</p>";
        header('refresh:2; url=../inventory');
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

/*
--------------------------------------------
ORDERS
--------------------------------------------
*/
// ORDERS DISPLAY
function displayOrders(){
  global $conn;

  $sql = "SELECT * FROM inventory ORDER BY item ASC";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $id = $row['item_id'];
    $item = $row['item'];
    $count = $row['count'];
    $price = $row['single_item_price'];

    echo "
    <tr>
      <td>$item</td>
      <td><input type='checkbox' name='check$item' value='$item'></td>
      <td><input  name='value$item' type='text' value='$count' placeholder='number of items'></td>
    </tr>
    ";
  }
}

// MAKE ORDER
function makeOrder(){

  global $conn;
  $errors = array();
  $item_array = array();
  $success = null;
  $fail = null;

  if (isset($_POST['make-order'])) {

    # name
    if ($_POST['name'] != '') {
      $name = $_POST['name'];
    }else {
      $errors[] = "<p class='error'>name cannot be empty</p>";
    }

    # phone number
    if ($_POST['phone'] == '') {
      $errors[] = "<p class='error'>phone number cannot be empty</p>";
    }else {
      $phone = $_POST['phone'];
    }

    # items
    $sql = "SELECT * FROM inventory";
    $result = $conn->query($sql);

    # get fields into variables
    while($row = $result->fetch_assoc()){
      $id = $row['item_id'];
      $item = $row['item'];
      $dbcount = $row['count'];
      $price = $row['single_item_price'];

      if (isset($_POST['check'.$item])) {
        $item = $_POST['check'.$item];
        $value = $_POST['value'.$item];

        $new_count = $dbcount - $value;

        if ($value > checkLimit($item)) {
          $errors[] = "<p class='error'>$item count more than limit</p>";
        }

        if (checkLimit($item) == 0) {
          $errors[] = "<p class='error'>$item count is zero</p>";
        }


        $item_array[]  = array('item' => $item, 'value' => $value, 'newcount' => $new_count);
      }
    }

    if (empty($item_array)) {
      $errors[] = "<p class='error'>you have not picked an item</p>";
    }


    # date
    if ($_POST['date'] == '') {
      $errors[] = "<p class='error'>date cannot be empty</p>";
    }else {
      $event_date = $_POST['date'];
    }



    if ($errors == []) {

      $code = stringShuffle($divide = 4);

      for ($i=0; $i < count($item_array); $i++) {
        $item = $item_array[$i]['item'];
        $count = $item_array[$i]['value'];
        $new_count = $item_array[$i]['newcount'];

        $sql = "INSERT INTO orders (code, item, count, name, number, event_date)
        VALUES ('$code', '$item', '$count', '$name', '$phone', '$event_date')";

        if ($conn->query($sql) === TRUE) {
          $sql = "UPDATE inventory SET `count` = '$new_count' WHERE item = '$item'";
          if ($conn->query($sql) === TRUE) {
            $success = true;
          }else {
            $success = null;
          }
        }else {
          $success = null;
        }
      }

      if ($success == true) {
        echo "<p class='success'>Order made successfully</p>";
        header('refresh:2; url=../orders');
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

// FUNCTION GET ORDERS
function getOrders(){
  global $conn;
  $code_array = array();
  $total = null;

  $sql = "SELECT * FROM orders GROUP BY code ORDER BY order_id DESC";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $code_array[] = $row['code'];
  }

  foreach ($code_array as $code) {
    echo "<div class='col-sm-10 order'>
    <H4><b>ORDER CODE: </b> ".strtoupper($code)."</h4>
    <table border='1'>
    <tr>
    <td>#</td>
    <td>item</td>
    <td>count</td>
    <td>price (Ksh)</td>
    </tr>
    ";
    $sql = "SELECT * FROM orders WHERE code = '$code'";
    $result = $conn->query($sql);

    # get fields into variables
    $c = 0;

    while($row = $result->fetch_assoc()){
      $c += 1;
      $id = $row['order_id'];
      $code = $row['code'];
      $item = $row['item'];
      $count = $row['count'];
      $name = $row['name'];
      $number = $row['number'];
      $event_date = $row['event_date'];
      $date = date_format(new dateTime($row['date_posted']), "jS M Y H:i:s");
      $status = $row['status'];

      $price = $count * getItemPrice($item);

      $total += $price;

      echo "
        <tr>
        <td>$c</td>
        <td>$item</td>
        <td>$count</td>
        <td>$price</td>
        </tr>
      ";
    }
    echo "
    <tr>
    <td><b>#</b></td>
    <td><b>Total Charge</b></td>
    <td><b>-</b></td>
    <td><b>$total</b></td>
    </tr>
    </table>
    <br><br>
    <p><b>ORDER BY: </b> $name - $number</p>
    <p><b>EVENT DATE: </b>$event_date</p>
    <p><b>date posted: </b> $date</p>

    <form class='ui-form' method='post' action=''>
    <input type='hidden' name='returncode' value='$code'>
    ".getButton($status)."
    </form>
    </div>";


  }
}

# function to get Item price
function getItemPrice($item){
  global $conn;

  $sql = "SELECT * FROM inventory WHERE item = '$item'";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $price = $row['single_item_price'];
  }

  return $price;
}


# check limit function
function checkLimit($item){
  global $conn;

  $sql = "SELECT * FROM inventory WHERE item = '$item'";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $count = $row['count'];
  }

  return $count;
}

# function to get return button
function getButton($status){
  if ($status == 0) {
    $value = "<input type='submit' name='make-return' value='make return'>";
  }else {
    $value = "<input type='button' disabled value='returned'>";
  }

  return $value;
}

# make return
function makeReturn(){
  global $conn;

  if (isset($_POST['make-return'])) {

    $returncode = $_POST['returncode'];

    $sql = "SELECT * FROM orders WHERE code = '$returncode'";
    $result = $conn->query($sql);

    # get fields into variables
    while($row = $result->fetch_assoc()){
      $item = $row['item'];
      $ordercount = $row['count'];

      $new_count = checkLimit($item) + $ordercount;

      $sql = "UPDATE inventory SET `count` = '$new_count' WHERE item = '$item'";
      if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE orders SET `status` = 1 WHERE code = '$returncode'";
        if ($conn->query($sql) === TRUE) {
          header('refresh:2; url=../orders');
        }else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
}

// call return function
makeReturn();

function deleteItem(){

  global $conn;

  if (isset($_GET['delete']) && $_GET['delete'] != '') {

    $id = $_GET['delete'];

    $sql = "DELETE FROM inventory WHERE item_id = $id";
    if ($conn->query($sql) === TRUE) {
      echo "<p class='success'>Deletion successful</p>";
      header('refresh:2; url=../invoice');
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}


/*
--------------------------------------------
SUPER ADMINISTRATOR FUNCTIONS
--------------------------------------------
*/

# get Administrators
function getAdministrators(){
  global $conn;
  $count = 0;

  $sql = "SELECT * FROM administrators";
  $result = $conn->query($sql);

  # get fields into variables
  while($row = $result->fetch_assoc()){
    $count += 1;
    $id = $row['admin_id'];
    $name = $row['name'];
    $username = $row['username'];

    echo "
    <tr>
      <td>$count</td>
      <td>$name</td>
      <td>$username</td>
      <td><a href='?delete-admin=$id'>delete</a></td>
    </tr>";
  }
}


# add staff account
function addStaffAccount(){

  global $conn;
  $errors = array();

  if (isset($_POST['add-admin'])) {
    # full name
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
          $password = $password;
        }else {
          $errors[] = "<p class='error'>Passwords are not similar</p>";
        }

      }
    }else {
      $errors[] = "<p class='error'>password is required</p>";
    }

    if ($errors == []) {
      $sql = "INSERT INTO administrators (name, username, password)
      VALUES ('$name', '$username', '$password')";

      if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Staff added successfully</p>";
        header('refresh:2; url=../superadmin');
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

// DELETE ADMINISTRATOR
function deleteAdmin(){

  global $conn;

  if (isset($_GET['delete-admin']) && $_GET['delete-admin'] != '') {

    $id = $_GET['delete-admin'];

    $sql = "DELETE FROM administrators WHERE admin_id = $id";
    if ($conn->query($sql) === TRUE) {
      echo "<p class='success'>Deletion successful</p>";
      header('refresh:2; url=../superadmin');
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}

# super admin security
function superAdminSecurity($path=''){
  if (!isset($_SESSION['superadmin'])) {
    header('location: '.$path.'login');
  }
}



 ?>
