<?php include_once('template/header.php'); ?>
<?php include_once('class/kategori.php'); ?>

<?php 
$kategori = new kategori();
$data = $kategori->tampil_data();


if(isset($_GET['hapus_id']))
{
  if($kategori->cek_id($_GET['hapus_id']))
  {
    if($kategori->hapus($_GET['hapus_id']))
    {
      header("location:tampil_kategori.php");
    }
    else
    {
      $error = "Gagal Menghapus Data";      
    }
  }
  else
  {
    header("location:tampil_kategori.php");
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
    <h3 class="panel-title">Data Kategori</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
    <a href="tambah_kategori.php"><button class="btn btn-info">Tambah</button></a>
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
    		  <th>Katerangan</th>
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
          <td><?php echo $row->keterangan; ?></td>
          <td>
          <a href="edit_kategori.php?id=<?php echo $row->id_kategori_barang; ?>"><button class="btn btn-success btn-sm">
          <span class="glyphicon glyphicon-pencil"></span> Edit 
          </button></a>

          <a href="tampil_kategori.php?hapus_id=<?php echo $row->id_kategori_barang; ?>"><button class="btn btn-danger btn-sm delete">
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