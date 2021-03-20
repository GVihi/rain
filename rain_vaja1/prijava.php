<?php
include_once('glava.php');

function validate_login($username, $password){
	global $conn;
	$username = mysqli_real_escape_string($conn, $username);
	$pass = sha1($password);
	$query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
	$res = $conn->query($query);
	if($user_obj = $res->fetch_object()){
		return $user_obj->id;
	}
	return -1;
}

$error="";
if(isset($_POST["poslji"])){
	//Preveri prijavne podatke
	if(($user_id = validate_login($_POST["username"], $_POST["password"])) >= 0){
		//Zapomni si prijavljenega uporabnika v seji in preusmeri na index.php
		$_SESSION["USER_ID"] = $user_id;
		$_SESSION["USER_NAME"] = $_POST["username"];
		header("Location: index.php");
		die();
	} else{
		$error = "Prijava ni uspela.";
	}
}
?>
	<h2>Prijava</h2>
	<form action="prijava.php" method="POST">
		<table>
			<tr>
				<td><label>Uporabniško ime</label></td><td><input type="text" name="username" /> </td>
			</tr>
			<tr>
				<td><label>Geslo</label></td><td><input type="password" name="password" /> </td>
			</tr>
			<tr>
				<td><input type="submit" name="poslji" value="Pošlji" /> </td>
			</tr>
		</table>
		<label><?php echo $error; ?></label>
	</form>
<?php
include_once('noga.php');
?>