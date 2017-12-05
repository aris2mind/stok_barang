<?php include_once('template/header.php'); ?>
<?php include_once('class/barang.php'); ?>

<?php 
$barang = new barang();
$data = $barang->tampil_data();

if(isset($_GET['hapus_id']))
{
  if($barang->cek_id($_GET['hapus_id']))
  {
    if($barang->hapus($_GET['hapus_id']))
    {
      header("location:tampil_barang.php");
    }
    else
    {
      $error = "Gagal Menghapus Data";      
    }
  }
  else
  {
    header("location:tampil_barang.php");
  }
}
?>

<script type="text/javascript">
  $(document).ready(function(){
  $(".delete").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
  });
</script>


<div class="container-fluid">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Data Barang</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
    <a href="tambah_barang.php"><button class="btn btn-info">Tambah</button></a>
    <hr/>
    <?php 
    if(isset($error))
    {
      ?>
        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
      <?php     
    }
    ?>
    <table class="table table-bordered table-hover data">
    	<thead>
    		<tr class="active">
    			<th>No</th>
    			<th>Kategori</th>
    		  <th>Barang</th>
          <th>Gambar</th>
          <th>Harga</th>
          <th>Action</th>
    		</tr>
    	</thead>
    	<tbody>
      <?php 
      $no = 1;
      if($data->num_rows > 0)
      {
        while ($row = mysqli_fetch_object($data))
        {
          ?>
          <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row->kategori; ?></td>
          <td><?php echo $row->barang; ?></td>
          <td><img class="img-thumbnail" src="uploads/<?php echo $row->gambar; ?>" width="150"></td>
          <td><?php echo $row->harga; ?></td>
          <td>
          <a href="edit_barang.php?id=<?php echo $row->id_barang; ?>"><button class="btn btn-success btn-sm">
          <span class="glyphicon glyphicon-pencil"></span> Edit 
          </button></a>

          <a href="tampil_barang.php?hapus_id=<?php echo $row->id_barang; ?>"><button class="btn btn-danger btn-sm delete">
          <span class="glyphicon glyphicon-trash"></span> Hapus 
          </button></a>
          </td>
          
          </tr>
          <?php
          $no++;
        }
      }
      ?>
    	</tbody>
    </table>
    </div>
  </div>
</div>
</div>
<?php include_once('template/footer.php'); ?>