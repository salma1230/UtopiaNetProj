<?php
$username = "" ;

function getlogin($conn){
if(isset($_POST['loginSubmit'])){
if(isset($_SESSION['id'])){
echo "You are already logged in. Please Log Out first";
}else{
echo "You are not logged in";
$username = $_POST['username'];
$pwd = $_POST['password'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0){
    if($row = $result->fetch_assoc()){
    $pwd_hash = password_verify($pwd, $row['password']);
    $roomID = $row['roomID'];
    $_SESSION['roomID'] = $roomID;
    if($pwd_hash == true){
    $_SESSION['id'] = $row['id'];
    header("Location: chats.php?loginsuccess$roomID");
  }
}
}
}
}
}

function userLogout(){
if(isset($_POST['logoutSubmit'])){
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
$_SESSION=array();
exit();
}

}

function reg($conn){
if(isset($_POST['loginSubmit'])){
  $username = $_POST['username'];
  $pwd = $_POST['password'];
  $roomID = readable_random_string();
  $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
  $sql = "INSERT INTO users(username, password, roomID) VALUES('$username', '$pwd_hash', '$roomID')";
  $result = $conn->query($sql);
}
else{}
}

/**
 * Generates human-readable string.
 *
 * param string $length Desired length of random string.
 *
 * retuen string Random string.
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

function validRoom($conn){

  if(isset($_POST['roomIDSubmit'])){
$roomID = $_POST['roomID'];
$sql = "SELECT * FROM users WHERE roomID = '$roomID'";
$result = $conn->query($sql);
if(mysqli_num_rows($result)){
    $_SESSION['roomID'] = $roomID;
    header("Location: chats.php?$roomID");
}
else{
  echo "<p>This roomID does not exist. Please try again.</p>";
}

}
}

?>
