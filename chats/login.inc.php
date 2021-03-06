<?php

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
      if($pwd_hash == true){
    $_SESSION['id'] = $row['id'];
    header("Location: chats.php?loginsuccess");
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
  $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
  $sql = "INSERT INTO users(username, password) VALUES('$username', '$pwd_hash')";
  $result = $conn->query($sql);
}
else{}
}




?>
