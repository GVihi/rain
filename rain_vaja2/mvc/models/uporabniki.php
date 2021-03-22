<?php
    class Uporabnik{
        public $id;
        public $username;
        public $password;
        public $repeat_password;
        public $name;
        public $surname;
        public $email;
        public $address;
        public $zip;
        public $phone;
        public $gender;
        public $age;
        public $admin;

        public function __construct($id, $username, $password, $name, $surname, $email, $address, $zip, $phone, $gender, $age, $admin){
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->repeat_password = $password;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->address = $address;
            $this->zip = $zip;
            $this->phone = $phone;
            $this->gender = $gender;
            $this->age=$age;
            $this->admin = $admin;
        }

        public static function register($username, $password, $name, $surname, $email, $address, $zip, $phone, $gender, $age){
            $conn = Db::getInstance();

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
	
            $query = "INSERT INTO users (username, password, name, surname, email, address, zip, phone, gender, age) VALUES ('$username', '$pass',
			 '$name', '$surname', '$email', '$address', '$zip', '$phone', '$gender', '$age');";
	        
            $conn->query($query);
    } 

     public static function vsi() {
        $list = [];
        $db = Db::getInstance();
        $result = mysqli_query($db,'SELECT * FROM users');


        while($row = mysqli_fetch_assoc($result)){
        $list[] = new Uporabnik($row['id'], $row['username'], " " ,$row['name'], $row['surname'], $row['email'], $row['address'], $row['zip'], $row['phone'], $row['gender'], $row['age'], $row['admin']);
    }
    
        return $list;
     }

     public static function najdiEnega($id){

        $id = intval($id);
    
        $db = Db::getInstance();
        $result = mysqli_query($db,"SELECT * FROM users where id=$id");
        $row = mysqli_fetch_assoc($result);
        return new Uporabnik($row['id'], $row['username'], " " ,$row['name'], $row['surname'], $row['email'], $row['address'], $row['zip'], $row['phone'], $row['gender'], $row['age'], $row['admin']);
        
     }

     public static function posodobiurejenga($id, $username, $password, $name, $surname, $email, $address, $zip, $phone, $gender, $age){
        $conn = Db::getInstance();
        $pass = sha1($password);
        $query = "UPDATE users SET username='$username', password='$pass', name='$name', surname='$surname', email='$email', address='$address', zip='$zip', phone='$phone',
        gender='$gender', age='$age' WHERE id='$id';";

        $conn->query($query);
     }

     public static function prijava($username, $password){
         $db = Db::getInstance();

        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
        $pass = sha1($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
        $result = $db->query($query);

        if($user = $result->fetch_object()){
            return $user;
        }
        return false;
     }

     public static function rmusera($id){
        $db = Db::getInstance();
        $query = "DELETE FROM users WHERE id=$id;";
        $db->query($query);
     }
    }
?>