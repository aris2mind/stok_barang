<?php include_once('template/header.php'); ?>
<?php include_once('class/kategori.php'); ?>

<?php 
$kategori = new kategori();

if(!empty($_GET['id']))
{
  $id = $_GET['id'];
  if($kategori->cek_id($id))
  {
    $data = $kategori->get_by_id($id);
  }
  else
  {
    header("location:tampil_kategori.php");
  }
}
else
{
    header("location:tampil_kategori.php");
}

if(isset($_POST['tombol']))
{
      $data = array(
        "id_kategori"=>$_POST['id_kategori'],
        "kategori"=>$_POST['kategori'],
        "keterangan"=>$_POST['keterangan']
      );
      if($kategori->edit($data))
      {
        header("location:tampil_kategori.php");
      }
      else
      {
        $error = "Data Gagal di Update";
      }
}




?>
<div class="container-fluid">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Update Kategori</h3>
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
    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-10">
      <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori']; ?>">
      <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Kategori" value="<?php echo $data['kategori']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="keterangan"><?php echo $data['keterangan']; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="tombol" value="Update" class="btn btn-info">
    </div>
  </div>
</form>
  </div>
</div>
</div>
<?php include_once('template/footer.php'); ?>