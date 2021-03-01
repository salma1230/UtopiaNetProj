<?php

function getlogin($conn){
if(isset($_POST['loginSubmit'])){
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

function userLogout(){


}




?>
