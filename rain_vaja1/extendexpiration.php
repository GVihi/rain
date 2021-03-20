<?php
include_once("glava.php");

function get_ad($id){
	global $conn;
	$id = mysqli_real_escape_string($conn, $id);
	$query = "SELECT ads.*, users.username FROM ads LEFT JOIN users ON users.id = ads.user_id WHERE ads.id = $id;";
	$res = $conn->query($query);
	if($obj = $res->fetch_object()){
		return $obj;
	}
	return null;
}

$id = $_GET["id"];
$oglas = get_ad($id);
if($oglas == null){
	echo "Oglas ne obstaja.";
	die();
}

if(isset($_SESSION)){
	if ($_SESSION["USER_NAME"] != $oglas->username){
    echo "Only ad owners can edit ads!";
    }else{
        global $conn;
        $query = "UPDATE ads SET expires= NOW() + INTERVAL 30 DAY WHERE id='$id';";
	if($conn->query($query)){
        
	}
	else{
		echo mysqli_error($conn);
	}
        header("Location: index.php");
    }
}
?>