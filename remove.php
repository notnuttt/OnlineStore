<?php
	include("conn.php");
	$id = $_REQUEST['id'];
	$sqldelete = 'DELETE FROM `menu` WHERE ID = "'.$id.'";';

	if($query = mysqli_query($conn, $sqldelete)){
		header("Location: index.php");
	}else{
		echo '<script> alert("Delete Item Failed!); </script>';
	}

	$conn->close();

?>