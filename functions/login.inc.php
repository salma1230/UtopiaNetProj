<?php

/**
 * Validates user login attempt
 *
 * param: connection to database ''$conn'
 *
 * return: None.
 */

function getlogin($conn){
  //If user selects button named 'loginSubmit'
if(isset($_POST['loginSubmit'])){
  //Checks if the user is already logged in and displays appropiate erorr message
    if(isset($_SESSION['id'])){
       echo "You are already logged in. Please Log Out first";
      }
   //If no user is logged in
    else{
      //Retrieve the username and password inputted by the user
      $username = $_POST['username'];
      //sanitize username by only allowing strings and letters
      $username_sanitized = str_ireplace(["!", ")", "DROP", ";", "=", "UNION", "/" , "*"]," ", $username);
      $username1 = preg_replace('/\s+/', '', $username);
      if(!empty($username1)){
        $pwd = $_POST['password'];
        //Selects the row from the database with matching username
        $sql = "SELECT * FROM users WHERE username = '$username_sanitized'";
        $result = $conn->query($sql);
      }
     //If there is an existing user with that username in the 'users' table
      if(mysqli_num_rows($result) > 0){
          if($row = $result->fetch_assoc()){
          //Verify the user's password matched that of the password stored in the 'user' table.
          $pwd_hash = password_verify($pwd, $row['password']);
          //Retrieve the roomID assigned to the user
          $roomID = $row['roomID'];
          //Store the roomID in a session
          $_SESSION['roomID'] = $roomID;
          //If the password is true
          if($pwd_hash == true){
          //create an ID session and redirect to the 'chats.php' page.
          $_SESSION['id'] = $row['id'];
          header("Location: chats.php?loginsuccess");
        }
        else{
          echo "Incorrect Password. Please try again";
        }
          }
      }
      else{
      echo "That username does not exist";
      }
    }
  }
  else{
    return False;
  }
}


/**
 * Logs user out of the system.
 *
 * param: connection to database ''$conn'
 *
 * return: None
 */

function userLogout(){
  //if the user selects the logout button
  if(isset($_POST['logoutSubmit'])){
  //Destroy all sessions
  session_start();
  session_unset();
  session_destroy();
  //Redirect to the main page
  header("Location: ../index.php");
  //Empty the session array
  $_SESSION=array();
  exit();
   }
   else{
     return False;
   }

}

/**
 * Registers a new user to the 'users' Table.
 *
 * param: connection to database ''$conn'
 *
 * return: None
 */
function reg($conn){
if(isset($_POST['regSubmit'])){
  //Checks if the user is already logged in and displays appropiate erorr message
    if(isset($_SESSION['id'])){
       echo "You are already registered.";
      }
   //If no user is logged in
    else{
      //Retrieve the username and password inputted by the user
      $username = $_POST['username'];
      //sanitize username by only allowing strings and letters
      $username_sanitized = str_ireplace(["!", ")", "DROP", ";", "=", "UNION", "/" , "*"]," ", $username);
      $username1 = preg_replace('/\s+/', '', $username_sanitized);
      //if usename is empty return message
     if(empty($username1)){
       $errormsg = "Error:NoUsernameEntered";
        echo "A valid username has not been entered";
       return False;
     }
      $pwd = $_POST['password'];
      $email = $_POST['email'];

      //Selects the row from the database with matching username
      $sql = "SELECT * FROM users WHERE username = '$username_sanitized'";
      $result = $conn->query($sql);

     //If there is an existing user with that username in the 'users' table, error messag displayed
      if(mysqli_num_rows($result) > 0){
     echo "There is already a user logged in with that name: Please enter another username";
   }
     else{
      //create a random word for roomID and set it to the user.
      $roomID = readable_random_string();
      $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
      // Remove all illegal characters from email
      $email2 = filter_var($email, FILTER_SANITIZE_EMAIL);
      if(filter_var($email2, FILTER_VALIDATE_EMAIL)){
      $sql = "INSERT INTO users(username,email, password, roomID) VALUES('$username_sanitized', '$email', '$pwd_hash', '$roomID')";
      $result = $conn->query($sql);
      header("Location: ../chats/teacherLogin.php");
    }
    else{
      echo "invalid email";
    }
  }
   }
}
   else {
     return False;
   }
}

/**
 * Generates human-readable string.
 *
 * param string $length Desired length of random string.
 *
 * return string Random string.
 */
function readable_random_string($length = 6)
{
    $string = '';
    $vowels = array("a","e","i","o","u");
    $consonants = array(
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
    );

    $max = $length / 2;
    for ($i = 1; $i <= $max; $i++)
    {
        $string .= $consonants[rand(0,19)];
        $string .= $vowels[rand(0,4)];
    }

    return $string;
}


/**
 * Validates user's that arent logged in have entered an existing roomID to enter the chatpage.
 *
 * param: connection to database ''$conn'
 *
 * return: None
 */
function validRoom($conn){
  //if user has selected the button 'roomIDSubmit'
  if(isset($_POST['roomIDSubmit'])){
  //Retrieve the roomID
  $roomID = $_POST['roomID'];
  //sanitize roomID by only allowing strings
  $roomID_sanitized = preg_replace("/[^A-Za-z0-9?!]/",'',$roomID);
  $roomID = preg_replace('/\s+/', '', $roomID_sanitized);
  if(!empty($roomID)){
  //Select any user from the database with matching roomID
  $sql = "SELECT * FROM users WHERE roomID = '$roomID_sanitized'";
  $result = $conn->query($sql);
  //If user with matching roomID exists create a roomID session and redirect to 'chats.php' page
      if(mysqli_num_rows($result)>0){
      $_SESSION['roomID'] = $roomID_sanitized;
      header("Location: chats.php?$roomID_sanitized");
       }
   //if roomID does not exist display error message
      else{
      echo "This roomID does not exist. Please try again.";
      }
}
else{
  echo "No ID has been entered. Please provide the room ID.";
}
  }
  else{
    return False;
  }
}

/**
 * Sends Email when User has forgotten their password
 *
 * param: connection to database ''$conn'
 *
 * return: None
 */

function sendEmail($conn){
  if(isset($_POST['emailSubmit'])){

  $to = $_POST['email'];
  // Remove all illegal characters from email
  $email = filter_var($to, FILTER_SANITIZE_EMAIL);
    if(!empty($to) && filter_var($email, FILTER_VALIDATE_EMAIL) ){
    //Select any user from the database with matching email
    $sql = "SELECT * FROM users WHERE email = '$to'";
    $result = $conn->query($sql);
    //If user with matching email exists send email to reset password.
        if(mysqli_num_rows($result)> 0){
        $_SESSION['email'] = $to;
        $subject = "Reset Password";
        $txt = "Please click the link below to reset your password";
        $headers = "From: utopianetproject@gmail.com" . "\r\n";

        mail($to,$subject,$txt,$headers);
        header("Location: teacherLogin.php");

         }
     //if email does not exist display error message
        else{
        echo $to;
        echo "An account with this email does not exist. Please register to use UtopiaNet.";
        }
  }
  else{
    echo "No email has been entered. Please provide an email.";
  }

    }
}

function resetpassword($conn){
  if(isset($_POST['newPasswordSubmit'])){

    $email1  =  $_POST['email'];
    // Remove all illegal characters from email
    $email2 = filter_var($email1, FILTER_SANITIZE_EMAIL);
    $newPwd = $_POST['password'];
    $newPwd2 = $_POST['password2'];

    if(($newPwd == $newPwd2) && !empty($newPwd) && filter_var($email2, FILTER_VALIDATE_EMAIL) ){
    $pwd_hash = password_hash($newpwd, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$pwd_hash' WHERE email = '$email1'";
    $result = $conn->query($sql);
    }
    else{
      echo "empty password.";
    }
}
}

?>
