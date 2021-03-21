<?php
class Comment {
  
  public $id;
  public $name;
  public $email;
  public $date;
  public $comment;
  public $iduser;
  public $addid;

  //konstruktor
  public function __construct($id, $name, $email, $date, $comment, $iduser, $addid) {
    $this->id      = $id;
    $this->name  = $name;
    $this->email = $email;
    $this->date = $date;
    $this->comment = $comment;
    $this->iduser = $iduser;
    $this->addid = $addid;

  }
    public static function vsi($db, $id) {
    $list = [];
    
    $result = mysqli_query($db,"SELECT * FROM comments WHERE addid='$id'");


    while($row = mysqli_fetch_assoc($result)){
      $list[] = new Comment($row['id'], $row['name'], $row['email'],$row['date'],$row['comment'],$row['iduser'],$row['addid']);
    }
    
        //statična metoda vrača seznam objektov iz baze
    return $list;
  }

  public static function dodaj($db, $name, $email, $date, $comment, $iduser, $addid){
    if ($stmt = mysqli_prepare($db, "Insert into comments (name, email, date, comment, iduser, addid) Values ('$name','$email',now(), '$comment', '$iduser', '$addid')")) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
  }
}

  
 
}
?>