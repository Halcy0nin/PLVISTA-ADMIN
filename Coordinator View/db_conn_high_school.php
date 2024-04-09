<?php
    //connect to database (using the parameters localhost, username,password and database to be used)
$conn = mysqli_connect('localhost','sdoadmin','admin', 'sdo_high_schools_ict_equipment');

//check connection
if (!$conn){
    echo 'Connection ERROR: ' . mysqli_connect_error();
}
?>