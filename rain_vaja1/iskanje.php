<?php
    include_once("glava.php");

    // Funkcija prebere oglase iz baze in vrne polje objektov
    function get_oglasi($string){
	global $conn;
	$query = "SELECT ads.*, users.username, users.email FROM ads LEFT JOIN users ON users.id = ads.user_id  WHERE ads.title LIKE '%$string%'  OR ads.description LIKE '%$string%';";
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}

    if(isset($_POST["poslji"])){
        if(isset($_POST["search"])){
            //Preberi oglase iz baze
            $oglasi = get_oglasi($_POST["search"]);
        }
    }

    ?>
        <form action="iskanje.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="search"> <input type="submit" name="poslji" value="Išči" />
        </form>
    <?php
if(isset($oglasi)){
foreach($oglasi as $oglas){
	$img_data = base64_encode($oglas->image);
    ?>
		<div class="oglas">
            <h4><?php echo $oglas->title;?></h4>
		    <p>Opis:<?php echo $oglas->description;?></p>
		    <p>Objavil:<?php echo $oglas->username;?></p>
		    <p>Kontakt: <?php echo $oglas->email;?></p>
		    <img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/><br> <br>
		</div>
	<?php
		
		
	
}
}
?>