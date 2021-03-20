<?php
    include_once("glava.php");

    function get_oglasi(){
        global $conn;
        $query = "SELECT ads.*, users.username FROM ads LEFT JOIN users ON users.id = ads.user_id;";
        $res = $conn->query($query);
        $oglasi = array();
        while($oglas = $res->fetch_object()){
            array_push($oglasi, $oglas);
        }
        return $oglasi;
    }
    
    //Preberi oglase iz baze
    $oglasi = get_oglasi();

    foreach($oglasi as $oglas){
        if($oglas->username == $_SESSION["USER_NAME"]){
        $img_data = base64_encode($oglas->image);
        ?>
            <div class="oglas">
                <h4><?php echo $oglas->title;?></h4>
                <p>Opis:<?php echo $oglas->description;?></p>
                <img src="data:image/jpg;base64, <?php echo $img_data;?>" width="400"/><br> <br>
                <a href="odstrani.php?id=<?php echo $oglas->id;?>"><button>Odstrani oglas</button></a>
				<a href="extendexpiration.php?id=<?php echo $oglas->id;?>"><button>Podaljšaj zapadlost</button></a>
				<a href="uredi.php?id=<?php echo $oglas->id;?>"><button>Uredi oglas</button></a>
            </div>
        <?php
            
        }
        
    }
?>