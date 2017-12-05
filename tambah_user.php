<?php 
include_once('template/header.php');


include_once('class/user.php');
$user = new user();
if(isset($_POST['tombol']))
    {
        $username = $_POST['username'];
        if($user->cek_username($username))
        {
          //jika username sudah ada
          $error = "Username Sudah digunakan sebelumnya gunakan Username Lain";
        }
        else
        {
              $data = array(
                "username"=>$_POST['username'],
                "password"=>$_POST['password'],
                "nama"=>$_POST['nama'],
                "tipe"=>$_POST['tipe']);
              if($user->tambah($data))
              {
                  header("location:tampil_user.php");
              }
              else
              {
                  $error = "Data Gagal Ditambahkan";
              }
        }

              
    }
?>


<div class="container-fluid">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Tambah User</h3>
  </div>
  <div class="panel-body">
    <?php 
    if(isset($error))
    {
      ?>
        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
      <?php     
    }
    ?>
  <form class="form-horizontal" method="post" action="">
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username">
    </div>
  </div>
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password">
    </div>
  </div>
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Tipe</label>
    <div class="col-sm-10">
      <select name="tipe" class="form-control">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" name="nama" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="tombol" value="Simpan" class="btn btn-info">
    </div>
  </div>
</form>
  </div>
</div>
</div>
<?php include_once('template/footer.php'); ?>