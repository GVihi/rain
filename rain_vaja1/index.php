<?php
include_once('glava.php');

// Funkcija prebere oglase iz baze in vrne polje objektov
function get_oglasi(){
	global $conn;
	$query = "SELECT * FROM ads ORDER BY expires DESC;"; //Sortitanje po datumu oddaje
	$res = $conn->query($query);
	$oglasi = array();
	while($oglas = $res->fetch_object()){
		array_push($oglasi, $oglas);
	}
	return $oglasi;
}

//Preberi oglase iz baze
$oglasi = get_oglasi();
$showexp = 0;

if(isset($_POST["poslji"])){
	if($_POST["showexpired"] == "Yes"){
	?>
	<form action="index.php" method="POST" enctype="multipart/form-data">
		<input type="checkbox" name="showexpired" value="No"> <label>Pokaži samo veljavne oglase</label> <br>
		<label>Kategorija </label></td><td><select id="category" name="category">
				 <option value="computers">Računalništvo</option>
				 <option value="cars">Avtomobilstvo</option>
				 <option value="furniture">Pohištvo</option>
				 </select> <br>
		<input type="submit" name="poslji" value="Objavi" />
	</form>
	<?php
	}else{
		?>
		<form action="index.php" method="POST" enctype="multipart/form-data">
			<input type="checkbox" name="showexpired" value="Yes"> <label>Pokaži pretečene oglase</label> <br>
			<label>Kategorija </label></td><td><select id="category" name="category">
				 <option value="computers">Računalništvo</option>
				 <option value="cars">Avtomobilstvo</option>
				 <option value="furniture">Pohištvo</option>
				 </select> <br>
			<input type="submit" name="poslji" value="Potrdi" />
		</form>
	<?php
	}
	if($_POST["showexpired"] == "Yes"){
		$showexp = 1;
	}else{
		$showexp = 0;
	}
}else{
	?>
	<form action="index.php" method="POST" enctype="multipart/form-data">
		<input type="checkbox" name="showexpired" value="Yes"> <label>Pokaži pretečene oglase</label> <br>
		<label>Kategorija </label></td><td><select id="category" name="category">
				 <option value="computers">Računalništvo</option>
				 <option value="cars">Avtomobilstvo</option>
				 <option value="furniture">Pohištvo</option>
				 </select> <br>
		<input type="submit" name="poslji" value="Potrdi" />
	</form>
	<?php
}



//Izpiši oglase
//Doda link z GET parametrom id na oglasi.php za gumb 'Preberi več'
foreach($oglasi as $oglas){
	$img_data = base64_encode($oglas->image);
	$datenow = date("Y-m-d");
	$addate = strtotime($oglas->datepublished);
	$addate = date("Y-m-d", $addate);

	if(isset($_POST["category"])){
		if($_POST["category"] == $oglas->category){
			if($showexp == 1){
				?>
					<div class="oglas">
						<h4><?php echo $oglas->title;?></h4>
						<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="200"/> <br>
						<a href="oglas.php?id=<?php echo $oglas->id;?>"><button>Preberi več</button></a>
					</div>
				<?php
		}else{
			if(!($datenow > $addate)){
			?>
				<div class="oglas">
					<h4><?php echo $oglas->title;?></h4>
					<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="200"/> <br>
					<a href="oglas.php?id=<?php echo $oglas->id;?>"><button>Preberi več</button></a>
				</div>
			<?php
			}
		}
		}
	}else{

	if($showexp == 1){
			?>
				<div class="oglas">
					<h4><?php echo $oglas->title;?></h4>
					<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="200"/> <br>
					<a href="oglas.php?id=<?php echo $oglas->id;?>"><button>Preberi več</button></a>
				</div>
			<?php
	}else{
		if(!($datenow > $addate)){
		?>
			<div class="oglas">
				<h4><?php echo $oglas->title;?></h4>
				<img src="data:image/jpg;base64, <?php echo $img_data;?>" width="200"/> <br>
				<a href="oglas.php?id=<?php echo $oglas->id;?>"><button>Preberi več</button></a>
			</div>
		<?php
		}
	}
}
}


include_once('noga.php');
?>