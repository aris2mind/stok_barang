<?php 
include_once('template/header.php');


include_once('class/transaksi.php');
include_once('class/barang.php');
$transaksi = new transaksi();
$barang = new barang();
$data_barang = $barang->tampil_data();
if(isset($_POST['tombol']))
    {
              if($_POST['status'] == "keluar")
              {
                    if($transaksi->cek_stok($_POST['id_barang'],$_POST['jumlah']))
                    {
                          $data = array(
                            "status"=>$_POST['status'],
                            "id_barang"=>$_POST['id_barang'],
                            "jumlah"=>$_POST['jumlah'],
                            "tgl"=>$_POST['tgl']);
                          if($transaksi->tambah($data))
                          {
                              header("location:tampil_transaksi.php");
                          }
                          else
                          {
                              $error = "Data Gagal Ditambahkan";
                          }
                    }
                    else
                    {
                          $error = "Jumlah Melebihi Stok"; 
                    }
              }
              else
              {
                          $data = array(
                            "status"=>$_POST['status'],
                            "id_barang"=>$_POST['id_barang'],
                            "jumlah"=>$_POST['jumlah'],
                            "username"=>$_POST['username'],
                            "tgl"=>$_POST['tgl']);
                          if($transaksi->tambah($data))
                          {
                              header("location:tampil_transaksi.php");
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
    <label for="kategori" class="col-sm-2 control-label">Status Transaksi</label>
    <div class="col-sm-10">
      <select name="status" class="form-control">
        <option value="masuk">Masuk</option>
        <option value="keluar">Keluar</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Barang</label>
    <div class="col-sm-10">
      <select name="id_barang" class="form-control">
        <?php 
        while ($row = mysqli_fetch_object($data_barang))
        {
          ?>
          <option value="<?php echo $row->id_barang; ?>"><?php echo $row->barang; ?></option>
          <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Jumlah</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="jumlah">
    </div>
  </div>
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Tanggal Transaksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="tgl" id="tgl">
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