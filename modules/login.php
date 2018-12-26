<div style="padding-left: 7rem;padding-right: 7rem;padding-top: 2rem;">
<form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Johndoe@gmail.com" name="email"
    pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum)\b">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
  </div>
  <button type="submit" name="btnLogin" class="btn btn-primary" value="login" autofocus>Submit</button>
</form>
</div>
<div style="margin-left: 12%;margin-top: 10px;">Tidak Punya Akun? <a href="index.php?i=register">Register Here.</a></div>

<?php 
if (isset($_POST['btnLogin']))
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  if (!empty($email) && !empty($pass)) {
    $queryLogin="SELECT * FROM klien where email='$email' && password='$pass'";
    $db->setQuery($queryLogin);
    $data=$db->loadObject();
      if ($data==NULL) {
        $db->messages="Email atau password anda salah!";
      }
      else{$db->LoginKlien($email);}
      }
  else{$db->messages="Email atau password tidak boleh kosong!";}
}

if ($db->messages) 
{
  echo "<br><div class='text-center p-t-115' style='color: red'>".$db->messages."</div>"; 
}
 ?>
