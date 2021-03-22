<!--enostaven pogled za prikaz enega oglasa -->
<!-- ta se nahaja v spremenljivki $oglas, ki smo jo pripravili v kontrolerju -->
<script>
  function get(){
        var id = <?php echo $oglas->id; ?>;
        $.get("http://localhost/rain_vaja2/api/rest.php/comments/"+id ,function(data){
              console.log(data);
              var comments = JSON.parse(JSON.stringify(data));
              comments.forEach(comment => {
                $( "#komentarji" ).append( "<div class='card'><div class='card-body'><p>"+comment.name+"@"+comment.date+" </p><p> "+comment.comment+"</p></div></div>" )
              });
        });
    }

    function post(){
        var id = <?php echo $oglas->id; ?>;
        var comment = {
          name: $("#name").val(),
          email: $("#email").val() ,
          comment:$("#comment").val(),
          addid: id,
          iduser: " "
        }
        console.log(comment);
        $.post("http://localhost/rain_vaja2/api/rest.php/comments/",comment ,function(data){
              console.log(data);
        });
    }

    


</script>

 <div id="nalozi" class="panel panel-default">
  <div class="panel-heading"><h2><?php echo $oglas->naslov; ?></h2><span class="label label-primary">Datum objave: <?php echo $oglas->datumObjave; ?></span></div>
  <div class="panel-body">Vsebina: <?php echo $oglas->vsebina; ?></div>
  <img src="data:image/jpg;base64, <?php $img_data = base64_encode($oglas->image); echo $img_data;?>" width="400"/>

  
  <div id="komentarji">

  </div>
  <iframe onload="get()" style="display: none;"></iframe>

  <div class="mb-3">
    <label for="ime" class="form-label">Ime</label>
    <input type="text" id="name" class="form-control" value="<?php if(isset($_SESSION["USER_NAME"])){ echo $_SESSION["USER_IME"];} ?>" >
  </div>
  <div class="mb-3">
    <label for="ime" class="form-label">Email</label>
    <input type="text" id="email" class="form-control" value="<?php if(isset($_SESSION["USER_NAME"])){ echo $_SESSION["USER_EMAIL"];} ?>" >
  </div>
  <div class="mb-3">
    <label for="ime" class="form-label">Comment</label>
    <input type="text" id="comment" class="form-control" >
  </div>
  <button class="btn btn-primary" onclick="post();">Dodaj komentar</button>
</div> 
