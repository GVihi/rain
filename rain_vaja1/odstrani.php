<?php
include_once('glava.php');

function remove_ad($id){
    global $conn;
	$id = mysqli_real_escape_string($conn, $id);
    $query = "DELETE FROM ads WHERE id = $id;";
    if($conn->query($query)){
		echo "Success";
	}
	else{
		echo mysqli_error($conn);
	}
    return null;
}

if(!isset($_GET["id"])){
	echo "Manjkajoči parametri.";
	die();
}

$id = $_GET["id"];
remove_ad($id);
//header("Location: index.php");
?>