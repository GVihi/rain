<form action="?controller=uporabniki&action=shrani" method="POST">
  <div class="mb-3">
    <label for="ime" class="form-label">Ime</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
  </div>
  <div class="mb-3">
    <label for="priimek" class="form-label">Priimek</label>
    <input type="text" name="surname" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="uporabnisko" class="form-label">Uporabniško ime</label>
    <input type="text" name="username" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="repassword" class="form-label">Ponovi geslo</label>
    <input type="password" name="repeat_password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Naslov</label>
    <input type="text" name="address" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="zip" class="form-label">Posta</label>
    <input type="number" name="zip" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Telefonska st.</label>
    <input type="number" name="phone" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-check">
    <input type="radio" name="gender" value="moski" class="form-check-input" id="exampleInputPassword1">
    <label class="form-check-label">Moški</label>
    </div>
    <div class="form-check">
    <input type="radio" name="gender" value="zenska" class="form-check-input" id="exampleInputPassword1">
    <label class="form-check-label">Ženska</label>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Starost</label>
    <input type="number" name="age" class="form-control" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary">Poslji</button>
</form>