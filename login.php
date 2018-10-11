<?php
session_start();
include("conn.php");
$username = $_POST['username'];
$password = $_POST['password'];

$login_query_string = "SELECT * FROM users WHERE username = '".$username."' AND password = ".$password.";";
$query_login = mysqli_query($conn, $login_query_string);
if (!$query_login) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$row = mysqli_fetch_array($query_login);
if($row){
    $_SESSION['id'] = $row['id'];
	$_SESSION['name'] = $row['name'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['status'] = $row['status'];
    session_write_close();
    printf('<script> alert("Welcome %s!"); window.location.replace("/OnlineStore/index.php");</script>',$_SESSION['name']);

}else{
	//echo '<script> alert("Something went wrong!"); window.location.replace("/OnlineStore/index.php"); </script>';
}

?>