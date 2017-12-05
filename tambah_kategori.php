<?php
include_once('template/header.php'); 
include_once('class/kategori.php');
$kategori = new kategori();

if(isset($_POST['tombol']))
{
        $data = array(
          "kategori"=>$_POST['kategori'],
          "keterangan"=>$_POST['keterangan']);
        if($kategori->tambah($data))
        {
          header("location:tampil_kategori.php");             
        }
        else
        {
          $error = "Data Gagal di Tambahkan";
        }

}
?>

<div class="container-fluid">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Tambah Kategori</h3>
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
      <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Kategori">
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="keterangan"></textarea>
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