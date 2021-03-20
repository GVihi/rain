<?php 
include_once('glava.php');

//Funkcija izbere oglas s podanim ID-jem. Doda tudi uporabnika, ki je objavil oglas.
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
//Base64 koda za sliko (hexadecimalni zapis byte-ov iz datoteke)
$img_data = base64_encode($oglas->image);
?>
	<div class="oglas">
		<h4><?php echo $oglas->title;?></h4>
		<p><?php echo $oglas->description;?></p>
		<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/>
		<p>Objavil: <?php echo $oglas->username; ?></p>
		<?php
		if(isset($_SESSION)){
			if($_SESSION["USER_NAME"] == $oglas->username){
				?>
				<a href="odstrani.php?id=<?php echo $oglas->id;?>"><button>Odstrani oglas</button></a>
				<a href="extendexpiration.php?id=<?php echo $oglas->id;?>"><button>Podaljšaj zapadlost</button></a>
				<a href="uredi.php?id=<?php echo $oglas->id;?>"><button>Uredi oglas</button></a>
				<?php
			}
		}
		?>
		<a href="index.php"><button>Nazaj</button></a>
	</div>
	<hr/>
	<?php

include_once('noga.php');
?>