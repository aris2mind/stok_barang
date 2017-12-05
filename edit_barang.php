<?php 
include_once('template/header.php');


include_once('class/barang.php');
include_once('class/kategori.php');
$barang = new barang();
$kategori = new kategori();



$data_kategori = $kategori->tampil_data();
if(!empty($_GET['id']))
{
  $id = $_GET['id'];
  if($barang->cek_id($id))
  {
    $data = $barang->get_by_id($id);
  }
  else
  {
    header("location:tampil_barang.php");
  }
}
else
{
    header("location:tampil_barang.php");
}



if(isset($_POST['tombol']))
    {
      $data['id_barang'] = $_POST['id_barang'];
      $data['id_kategori'] = $_POST['id_kategori'];
      $data['barang'] = $_POST['barang'];
      $data['harga'] = $_POST['harga'];


      if(isset($_FILES['gambar']['tmp_name']))
      {
        $old_data     = $barang->get_by_id($data['id_barang']);
        $old_gambar   = $old_data['gambar'];
        $lokasi_file    = $_FILES['gambar']['tmp_name'];
            $nama_file      = $_FILES['gambar']['name'];
            $acak           = rand(1,9999);
            $nama_file_unik = $acak.$nama_file;
            $dir_upload   = "uploads/";
            $file_upload  = $dir_upload . $nama_file_unik;
            if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $file_upload))
            {
              unlink("uploads/".$old_gambar);
              $data['gambar'] = $nama_file_unik;              
            }
      }
        if($barang->edit($data))
        {
          header("location:tampil_barang.php");          
        }
        else
        {
          $error = "Data Gagal di Edit";
        }

    }




?>
<div class="container-fluid">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Barang</h3>
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
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-10">
      <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
      <select class="form-control" name="id_kategori">
        <?php 
        while ($row = mysqli_fetch_object($data_kategori))
        {
          ?>
          <option value="<?php echo $row->id_kategori_barang; ?>"
            <?php
            if($row->id_kategori_barang == $data['id_kategori'])
            {
              echo " Selected";
            }
            ?>
            ><?php echo $row->kategori; ?></option>
          <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" name="barang" class="form-control" value="<?php echo $data['barang']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Gambar</label>
    <div class="col-sm-10">
      <img src="uploads/<?php echo $data['gambar']; ?>" width="150">
      <input type="file" name="gambar" class="form-control">
    </div>
  </div>
    <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Harga</label>
    <div class="col-sm-10">
      <input type="text" name="harga" class="form-control" value="<?php echo $data['harga']; ?>">
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