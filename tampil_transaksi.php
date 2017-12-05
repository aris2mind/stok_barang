<?php include_once('template/header.php'); ?>
<?php include_once('class/transaksi.php'); ?>

<?php 
$transaksi = new transaksi();
$data = $transaksi->tampil_data();

if(isset($_GET['hapus_id']))
{
  if($transaksi->cek_id($_GET['hapus_id']))
  {
    if($transaksi->hapus($_GET['hapus_id']))
    {
      header("location:tampil_transaksi.php");
    }
    else
    {
      $error = "Gagal Menghapus Data";      
    }
  }
  else
  {
    header("location:tampil_transaksi.php");
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
    <h3 class="panel-title">Data Transaksi</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
    <a href="tambah_transaksi.php"><button class="btn btn-info">Tambah</button></a>
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
    			<th>Status</th>
    		  <th>Barang</th>
          <th>Jumlah</th>
          <th>User Entry</th>
          <th>Tanggal</th>
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
          <td><?php echo $row->status; ?></td>
          <td><?php echo $row->barang; ?></td>
          <td><?php echo $row->jumlah; ?></td>
          <td><?php echo $row->nama; ?></td>
          <td><?php echo $row->tgl; ?></td>
          <td>
          <a href="edit_transaksi.php?id=<?php echo $row->id_transaksi; ?>"><button class="btn btn-success btn-sm">
          <span class="glyphicon glyphicon-pencil"></span> Edit 
          </button></a>

          <a href="tampil_transaksi.php?hapus_id=<?php echo $row->id_transaksi; ?>"><button class="btn btn-danger btn-sm delete">
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