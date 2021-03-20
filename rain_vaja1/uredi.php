<?php
include_once('glava.php');

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

if(!isset($_GET["id"])){
	echo "Manjkajoči parametri.";
	die();
}

$id = $_GET["id"];
$oglas = get_ad($id);
if($oglas == null){
	echo "Oglas ne obstaja.";
	die();
}

function publish($title, $desc, $img, $category, $id){
	global $conn;
	$title = mysqli_real_escape_string($conn, $title);
	$desc = mysqli_real_escape_string($conn, $desc);
	$user_id = $_SESSION["USER_ID"];

	//Preberemo vsebino (byte array) slike
	$img_file = file_get_contents($img["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	$img_file = mysqli_real_escape_string($conn, $img_file);
	
	//NOW() datum objave, NOW() + INTERVAL 30 DAY datum zapadlosti
	$query = "UPDATE ads SET title='$title', description='$desc', image='$img_file', category='$category' WHERE id='$id';";
	if($conn->query($query)){
		return true;
	}
	else{
		echo mysqli_error($conn);
		return false;
	}
	
}

$error = "";
if(isset($_POST["poslji"])){
	if(publish($_POST["title"], $_POST["description"], $_FILES["image"], $_POST["category"], $id)){
		header("Location: index.php");
		die();
	}
	else{
		$error = "Prišlo je do našpake pri objavi oglasa.";
	}
}

//Če user ni prijavljen ne more objaviti oglasa
//Vrnemo na index.php
if(isset($_SESSION)){
	if ($_SESSION["USER_NAME"] != $oglas->username){
    echo "Only ad owners can edit ads!";
    }else{

    ?>
	<h2>Objavi oglas</h2>
	<form action="uredi.php?id=<?php echo $oglas->id ?>" method="POST" enctype="multipart/form-data">
	<table>
		<tr>
			<td><label>Naslov</label></td><td><input type="text" name="title" value="<?php echo $oglas->title; ?>" /></td>
		</tr>
		<tr>
			<td><label>Vsebina</label></td><td><textarea name="description" rows="10" cols="50"><?php echo $oglas->description; ?></textarea></td>
		</tr>
		<tr>
			<td><label>Slika</label></td><td><input type="file" name="image" /></td>
		</tr>
		<tr>
			<td><label>Kategorija</label></td><td><select id="category" name="category">
                <option value="" disabled selected>Izberi</option>
				 <option value="computers">Računalništvo</option>
				 <option value="cars">Avtomobilstvo</option>
				 <option value="furniture">Pohištvo</option>
				 </select></td>
		</tr>
		<tr>
			<td><input type="submit" name="poslji" value="Objavi" /></td>
		<tr>
	</table>
		<label><?php echo $error; ?></label>
	</form>
<?php
}
}



?>