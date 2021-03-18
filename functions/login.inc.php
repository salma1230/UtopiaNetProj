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
      $pwd = $_POST['password'];
      //Selects the row from the database with matching username
      $sql = "SELECT * FROM users WHERE username = '$username'";
      $result = $conn->query($sql);
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
      $pwd = $_POST['password'];
      //Selects the row from the database with matching username
      $sql = "SELECT * FROM users WHERE username = '$username'";
      $result = $conn->query($sql);
     //If there is an existing user with that username in the 'users' table, error messag displayed
      if(mysqli_num_rows($result) > 0){
     echo "There is already a user logged in with that name: Please enter another username";
   }
     else{
      //create a random word for roomID and set it to the user.
      $roomID = readable_random_string();
      $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users(username, password, roomID) VALUES('$username', '$pwd_hash', '$roomID')";
      $result = $conn->query($sql);
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
  //Select any user from the database with matching roomID
  $sql = "SELECT * FROM users WHERE roomID = '$roomID'";
  $result = $conn->query($sql);
  //If user with matching roomID exists create a roomID session and redirect to 'chats.php' page
      if(mysqli_num_rows($result)){
      $_SESSION['roomID'] = $roomID;
      header("Location: chats.php?$roomID");
       }
   //if roomID does not exist display error message
      else{
      echo "<p>This roomID does not exist. Please try again.</p>";
      }

  }
  else{
    return False;
  }
}


?>
