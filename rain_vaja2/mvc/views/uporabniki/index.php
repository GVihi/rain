<p>Seznam vseh oglasov</p>
<!-- pogled za pregeld vseh oglasov-->
<!-- na vrhu damu uporabniku gumb, s katerim proži akcijo dodaj, da lahko dodaja nove uporabnike -->
<a href="?controller=oglasi&action=dodaj" class="btn btn-primary">Dodaj <i class="fas fa-plus"></i></a>
<div class="table-dark-responsive">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Surname</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($uporabniki as $uporabnik) { ?>
    <tr>
      <td><?php echo $uporabnik->name ?></td>
      <td><?php echo $uporabnik->surname ?></td>
      <td><?php echo $uporabnik->email ?></td>
      <td><a href="?controller=uporabniki&action=profil&id=<?php echo $uporabnik->id ?>" class="btn btn-primary">Profil <i class="fas fa-plus"></i></a></td>
      <td><a href="?controller=uporabnikii&action=odstrani&id=<?php echo $uporabnik->id ?>" class="btn btn-primary">Odstrani <i class="fas fa-plus"></i></a></td>
      <td><a href="?controller=uporabniki&action=uredi&id=<?php echo $uporabnik->id ?>" class="btn btn-primary">Uredi <i class="fas fa-plus"></i></a></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>

