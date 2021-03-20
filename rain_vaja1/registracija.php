<?php
include_once('glava.php');

// Funkcija preveri, ali v bazi obstaja uporabnik z določenim imenom in vrne true, če obstaja.
function username_exists($username){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM users WHERE username='$username'";
	$res = $conn->query($query);
	return mysqli_num_rows($res) > 0;
}

// Funkcija ustvari uporabnika v tabeli users. Poskrbi tudi za ustrezno šifriranje uporabniškega gesla.
function register_user($username, $password, $name, $surname, $email, $address, $zip, $phone, $gender, $age){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$name = mysqli_real_escape_string($conn, $name);
	$surname = mysqli_real_escape_string($conn, $surname);
	$email = mysqli_real_escape_string($conn, $email);
	$address = mysqli_real_escape_string($conn, $address);
	$zip = mysqli_real_escape_string($conn, $zip);
	$phone = mysqli_real_escape_string($conn, $phone);
	$gender = mysqli_real_escape_string($conn, $gender);
	$age = mysqli_real_escape_string($conn, $age);
	$pass = sha1($password);
	/* 
		Tukaj za hashiranje gesla uporabljamo sha1 funkcijo. V praksi se priporočajo naprednejše metode, ki k geslu dodajo naključne znake (salt).
		Več informacij: 
		http://php.net/manual/en/faq.passwords.php#faq.passwords 
		https://crackstation.net/hashing-security.htm
	*/
	$query = "INSERT INTO users (username, password, name, surname, email, address, zip, phone, gender, age) VALUES ('$username', '$pass',
			 '$name', '$surname', '$email', '$address', '$zip', '$phone', '$gender', '$age');";
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
	/*
		VALIDACIJA: preveriti moramo, ali je uporabnik pravilno vnesel podatke (unikatno uporabniško ime, dolžina gesla,...)
		Validacijo vnesenih podatkov VEDNO izvajamo na strežniški strani. Validacija, ki se izvede na strani odjemalca (recimo Javascript), 
		služi za bolj prijazne uporabniške vmesnike, saj uporabnika sproti obvešča o napakah. Validacija na strani odjemalca ne zagotavlja
		nobene varnosti, saj jo lahko uporabnik enostavno zaobide (developer tools,...).
	*/
	//Preveri če se gesli ujemata
	if($_POST["password"] != $_POST["repeat_password"]){
		$error = "Gesli se ne ujemata.";
	}
	//Preveri ali uporabniško ime obstaja
	else if(username_exists($_POST["username"])){
		$error = "Uporabniško ime je že zasedeno.";
	}
	//Podatki so pravilno izpolnjeni, registriraj uporabnika
	else if(register_user($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"],
			 $_POST["email"], $_POST["address"], $_POST["zip"], $_POST["phone"], $_POST["gender"], $_POST["age"],)){
		header("Location: prijava.php");
		die();
	}
	//Prišlo je do napake pri registraciji
	else{
		$error = "Prišlo je do napake med registracijo uporabnika.";
	}
}

?>
	<h2>Registracija</h2>
	<form action="registracija.php" method="POST">
	<table>
		<tr>
			<td><label>(Obvezno) Ime </label></td> <td><input type="text" name="name"/></td>
		</tr>
		<tr>
			<td><label>(Obvezno) Priimek </label></td><td> <input type="text" name="surname"/> </td>
		</tr>
		<tr>
			<td><label>(Obvezno) Uporabniško ime</label><t/d><td><input type="text" name="username" /> </td>
		</tr>
		<tr>
			<td><label>(Obvezno) Geslo</label></td><td><input type="password" name="password" /> </td>
		</tr>
		<tr>
			<td><label>(Obvezno) Ponovi geslo</label></td><td><input type="password" name="repeat_password" /> </td>
		</tr>
		<tr>
			<td><label>(Obvezno) Email </label></td><td> <input type="email" name="email"/> </td>
		</tr>
		<tr>
			<td><label> Naslov </label></td><td> <input type="text" name="address"/> </td>
		</tr>
		<tr>
			<td><label> Posta </label></td><td> <input type="number" name="zip"/> </td>
		</tr>
		<tr>
			<td><label> Telefonska st. </label></td><td> <input type="number" name="phone"/> </td>
		</tr>
		<tr>
			<td><label> Spol </label></td><td> <input type="radio" name="gender" value="moski"/> <label>Moški</label> 
			<input type="radio" name="gender" value="zenska"/><label>Ženska</label> </td>
		</tr>
		<tr>
			<td><label> Starost </label></td><td> <input type="number" name="age"/> </td>
		</tr>
		<tr>
			<td><input type="submit" name="poslji" value="Pošlji" /></td>
		</tr>
		<label><?php echo $error; ?></label>
	</table>
	</form>
<?php
include_once('noga.php');
?>