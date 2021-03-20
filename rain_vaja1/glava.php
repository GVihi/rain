<head>
<style>
div {
	border: 1px solid black;
	padding: 5px;
	width: 25%;
	margin: 5px;
}
</style>
</head>

<?php
	session_start();
	
	//Seja poteče po 30 minutah - avtomatsko odjavi neaktivnega uporabnika
	if(isset($_SESSION['LAST_ACTIVITY']) && time() - $_SESSION['LAST_ACTIVITY'] < 1800){
		session_regenerate_id(true);
	}
	$_SESSION['LAST_ACTIVITY'] = time();
	
	//Poveži se z bazo
	$conn = new mysqli('localhost', 'root', '', 'vaja1');
	//Nastavi kodiranje znakov, ki se uporablja pri komunikaciji z bazo
	$conn->set_charset("UTF8");
?>
<html>
<head>
	<title>Vaja 1</title>
</head>
<body>
	<h1>Oglasnik</h1>
	<nav>
		<ul>
			<li><a href="index.php">Domov</a></li>
			<?php
			if(isset($_SESSION["USER_ID"])){
				?>
				<li><a href="objavi.php">Objavi oglas</a></li>
				<li><a href="mojioglasi.php">Moji oglasi</a></li>
				<li><a href="odjava.php">Odjava</a></li>
				<li><a href="iskanje.php">Iskanje</a></li>
				<?php
				echo "Hello " . $_SESSION["USER_NAME"];
			} else{
				?>
				<li><a href="prijava.php">Prijava</a></li>
				<li><a href="registracija.php">Registracija</a></li>
				<li><a href="iskanje.php">Iskanje</a></li>
				<?php
			}
			?>
		</ul>
	</nav>
	<hr/>