<?php
date_default_timezone_set('Europe/London');
include '../functions/dbh.inc.php';
include '../functions/chat.inc.php';

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ChatWall</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"
  </head>
  <body>
<?php
$cid = $_POST['cid'];
$uid = $_POST['uid'];
$date = $_POST['date'];
$message = $_POST['message'];



echo "<form method='POST' action='".deleteComments($conn)."'>
<input type = 'hidden' name='cid' value ='".$cid."'></input>
<input type = 'hidden' name='uid' value ='".$uid."'></input>
<input type = 'hidden' name='date' value = '".$date."'></input>
<textarea name = 'message'>".$message."</textarea><br>
<button type = 'submit' name = 'commentSubmit' >Edit</button>
</form>";
?>

  </body>
</html>
