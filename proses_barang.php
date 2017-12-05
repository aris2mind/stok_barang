<?php 
include_once('template/header.php');
include_once('class/barang.php');
$barang = new barang();
if(isset($_GET['aksi']))
{
	$aksi = $_GET['aksi'];
	if($aksi == "tambah")
	{
		if(isset($_POST['tombol']))
		{
			$lokasi_file    = $_FILES['gambar']['tmp_name'];
	        $nama_file      = $_FILES['gambar']['name'];
	        $acak           = rand(1,9999);
	        $nama_file_unik = $acak.$nama_file;
	        $dir_upload 	= "uploads/";
	        $file_upload 	= $dir_upload . $nama_file_unik;
	        move_uploaded_file($_FILES["gambar"]["tmp_name"], $file_upload);
		    $data = array(
		      	"id_kategori"=>$_POST['id_kategori'],
		      	"barang"=>$_POST['barang'],
		  		"gambar"=>$nama_file_unik);
		    $barang->tambah($data);
		    header("location:tampil_barang.php");
		    
		}
	}
	elseif($aksi == "edit")
	{
		if(isset($_POST['tombol']))
		{
			$data['id_barang'] = $_POST['id_barang'];
			$data['id_kategori'] = $_POST['id_kategori'];
			$data['barang'] = $_POST['barang'];


			if(isset($_FILES['gambar']['tmp_name']))
			{
				$old_data 		= $barang->get_by_id($data['id_barang']);
				$old_gambar		= $old_data['gambar'];
				$lokasi_file    = $_FILES['gambar']['tmp_name'];
		        $nama_file      = $_FILES['gambar']['name'];
		        $acak           = rand(1,9999);
		        $nama_file_unik = $acak.$nama_file;
		        $dir_upload 	= "uploads/";
		        $file_upload 	= $dir_upload . $nama_file_unik;
		        if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $file_upload))
		        {
			        unlink("uploads/".$old_gambar);
					$data['gambar'] = $nama_file_unik;		        	
		        }
			}
		    $barang->edit($data);
		    header("location:tampil_barang.php");
		}
	}
	elseif($aksi == "hapus")
	{
		  $id = $_GET['id'];
		  $barang->hapus($id);
		  header("location:tampil_barang.php");
	}	
}
else
{
	header("location:tampil_kategori.php");
}
?>