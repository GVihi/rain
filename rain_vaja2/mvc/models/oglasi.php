<?php

//model za oglas, ki vsebuje lasntosti, ki definirajo strukturo oglasa 
//in metode, ki vračajo podatke iz trajne hrambe ali jih tja zapisujejo
//v tem razredu so vse metode statične, lahko pa bi bile tudi običajne, pri čemer bi potrem bilo potrebno vsakič ustvarjat objekt


class Oglas {
  
  public $id;
  public $naslov;
  public $vsebina;
  public $datumObjave;
  public $image;

  //konstruktor
  public function __construct($id, $naslov, $vsebina,$datumObjave, $image) {
    $this->id      = $id;
    $this->naslov  = $naslov;
    $this->vsebina = $vsebina;
    $this->datumObjave=$datumObjave;
    $this->image = $image;
  }


    //metoda, ki iz baze vrne vse oglase
  public static function vsi() {
    $list = [];
      //dobimo objekt, ki predstavlja povezavo z bazo
    $db = Db::getInstance();
      //izvedemo query
    $result = mysqli_query($db,'SELECT * FROM ads');

//v zanki ustvarjamo nove objekte in jih dajemo v seznam
    while($row = mysqli_fetch_assoc($result)){
      $list[] = new Oglas($row['id'], $row['title'], $row['description'],$row['datepublished'], $row['image']);
    }
    
        //statična metoda vrača seznam objektov iz baze
    return $list;
  }

  //metoda, ki vrne en oglas z specifičnim id-jem iz baze
  public static function najdi($id) {

    $id = intval($id);
    
    $db = Db::getInstance();
    $result = mysqli_query($db,"SELECT * FROM ads where id=$id");
    $row = mysqli_fetch_assoc($result);
    return new Oglas($row['id'], $row['title'], $row['description'],$row['datepublished'], $row['image']);
  }
  

    //metoda, ki doda nov oglas v bazo

  public static function dodaj($naslov,$vsebina, $image) {
    
    $db = Db::getInstance();

    //Preberemo vsebino (byte array) slike
	  $img_file = file_get_contents($image["tmp_name"]);
	//Pripravimo byte array za pisanje v bazo (v polje tipa LONGBLOB)
	  $img_file = mysqli_real_escape_string($db, $img_file);
    
    
	  //primer query-a s prepared statementom

    if ($stmt = mysqli_prepare($db, "Insert into ads (title, description, datepublished, image) Values (?,?,now(), '$img_file');")) {
			//dodamo parametre po vrsti namesto vprašajev
			//s string, i integer ,d double, b blob
     mysqli_stmt_bind_param($stmt, "ss",$naslov,$vsebina);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
   }
   
   //dobimo nazaj informacijo o ID-ju, ki ga je generiral SQL strežnik
   $id=mysqli_insert_id($db);
   
    //z uporabo metode najdi, najdemo celoten, na novo ustvarjen oglas, in ga vrnemo kontrolerju
   return Oglas::najdi($id);
 }

 public static function extendexpiration($id){
    $db = Db::getInstance();
    $query = "UPDATE ads SET expires=NOW() + INTERVAL 30 DAY WHERE id=$id;";
    //mysqli_stmt_execute($query);
    $db->query($query);
 }
 
}
?>