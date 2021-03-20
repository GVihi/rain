<?php
include_once('glava.php');

// Funkcija vstavi nov oglas v bazo. Preveri tudi, ali so podatki pravilno izpolnjeni. 
// Vrne false, če je prišlo do napake oz. true, če je oglas bil uspešno vstavljen.
function publish($title, $desc, $img, $category){
	global $conn;
	$title = mysqli_real_escape_string($conn, $title);
	$desc = mysqli_real_escape_string($conn, $desc);
	$user_id = $_SESSION["USER_ID"];

	//Preberemo vsebino (byte array) slike
	$img_file = file_get_contents($img["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	$img_file = mysqli_real_escape_string($conn, $img_file);
	
	//NOW() datum objave, NOW() + INTERVAL 30 DAY datum zapadlosti
	$query = "INSERT INTO ads (title, description, user_id, image, category, datepublished, expires)
				VALUES('$title', '$desc', '$user_id', '$img_file', '$category', NOW(), NOW() + INTERVAL 30 DAY);";
	if($conn->query($query)){
		return true;
	}
	else{
		//Izpis MYSQL napake z: echo mysqli_error($conn); 
		return false;
	}
	
	/*
	//Pravilneje bi bilo, da sliko shranimo na disk. Poskrbeti moramo, da so imena slik enolična. V bazo shranimo pot do slike.
	//Paziti moramo tudi na varnost: v mapi slik se ne smejo izvajati nobene scripte (če bi uporabnik naložil PHP kodo). Potrebno je urediti ustrezna dovoljenja (permissions).
		
		$imeSlike=$photo["name"]; //Pazimo, da je enolično!
		//sliko premaknemo iz začasne poti, v neko našo mapo, zaradi preglednosti
		move_uploaded_file($photo["tmp_name"], "slika/".$imeSlike);
		$pot="slika/".$imeSlike;		
		//V bazo shranimo $pot
	*/
}

$error = "";
if(isset($_POST["poslji"])){
	if(publish($_POST["title"], $_POST["description"], $_FILES["image"], $_POST["category"])){
		header("Location: index.php");
		die();
	}
	else{
		$error = "Prišlo je do našpake pri objavi oglasa.";
	}
}

//Če user ni prijavljen ne more objaviti oglasa
//Vrnemo na index.php
if(!isset($_SESSION["USER_ID"])){
	header('Location: ' . "index.php");
}
?>
	<h2>Objavi oglas</h2>
	<form action="objavi.php" method="POST" enctype="multipart/form-data">
	<table>
		<tr>
			<td><label>Naslov</label></td><td><input type="text" name="title" /></td>
		</tr>
		<tr>
			<td><label>Vsebina</label></td><td><textarea name="description" rows="10" cols="50"></textarea></td>
		</tr>
		<tr>
			<td><label>Slika</label></td><td><input type="file" name="image" /></td>
		</tr>
		<tr>
			<td><label>Kategorija</label></td><td><select id="category" name="category">
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
include_once('noga.php');
?>