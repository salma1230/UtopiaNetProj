<?php
//connection to database is stored in variable '$conn'
$conn = mysqli_connect('localhost', 'root', '', 'chatwall');

//If no connection can be established display error message.
if(!$conn){
        die ("Connection Terminated! by Die() function". mysqLi_connect_error());

    }
