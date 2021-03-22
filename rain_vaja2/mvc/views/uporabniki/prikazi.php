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