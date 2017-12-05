<?php 
include_once('template/header.php');
include_once('class/kategori.php');
include_once('class/barang.php');
$kategori = new kategori();
$barang = new barang();
$data_kategori = $kategori->tampil_data();
if(isset($_POST['tombol']))
    {
          $lokasi_file    = $_FILES['gambar']['tmp_name'];
          $nama_file      = $_FILES['gambar']['name'];
          $acak           = rand(1,9999);
          $nama_file_unik = $acak.$nama_file;
          $dir_upload   = "uploads/";
          $file_upload  = $dir_upload . $nama_file_unik;
          if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $file_upload))
          {
              $data = array(
                "id_kategori"=>$_POST['id_kategori'],
                "barang"=>$_POST['barang'],
                "gambar"=>$nama_file_unik,
                "harga"=>$_POST['harga']);              
              if($barang->tambah($data))
              {
                  header("location:tampil_barang.php");
              }
              else
              {
                  $error = "Gagal Menambah Data Barang";
              }
              
          }
          else
          {
            $error = "Gagal Upload Gambar";
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
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-10">
      <select class="form-control" name="id_kategori">
        <?php 
        while ($row = mysqli_fetch_object($data_kategori))
        {
          ?>
          <option value="<?php echo $row->id_kategori_barang; ?>"><?php echo $row->kategori; ?></option>
          <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" name="barang" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Gambar</label>
    <div class="col-sm-10">
      <input type="file" name="gambar" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Harga</label>
    <div class="col-sm-10">
      <input type="text" name="harga" class="form-control">
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