<?php
include_once('koneksi.php'); 
class barang extends koneksi
{
	function tampil_data()
	{
		$result = $this->con->query("select * from vw_barang");
		return $result;
	}
	function tampil_harga($id_barang)
	{
		$query = $this->con->query("select harga from tb_barang where id_barang='$id_barang'");
		$hasil = $query->fetch_array();
		return $hasil['harga'];
	}
	function tambah($data)
	{
		$id_kategori = $this->con->real_escape_string($data['id_kategori']);
		$barang = $this->con->real_escape_string($data['barang']);
		$gambar = $this->con->real_escape_string($data['gambar']);
		$harga = $this->con->real_escape_string($data['harga']);
		$query = $this->con->query("insert into tb_barang (id_kategori,barang,gambar,harga) values ('$id_kategori','$barang','$gambar','$harga')");

		//$query2 = "insert into tb_barang (id_kategori,barang,gambar,harga) values ('$id_kategori','$barang','$gambar','$harga')";
		return $query;
	}

	function cek_id($id)
	{
		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("select * from tb_barang where id_barang='$id'");
		if($query->num_rows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_by_id($id)
	{	
		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("select * from tb_barang where id_barang='$id'");
		return $query->fetch_array();
	}

	function edit($data)
	{
		$id_barang = $this->con->real_escape_string($data['id_barang']);
		$id_kategori = $this->con->real_escape_string($data['id_kategori']);
		$barang = $this->con->real_escape_string($data['barang']);
		$harga = $this->con->real_escape_string($data['harga']);
		$q = "update tb_barang set id_kategori='$id_kategori',barang='$barang', harga='$harga' ";

		if(isset($data['gambar']))
		{
			$gambar = $this->con->real_escape_string($data['gambar']);
			$q .= ", gambar='$gambar'";			
		}

		$q .= " where id_barang='$id_barang'";
		$query = $this->con->query($q);
		return $query;
	}

	function hapus($id)
	{
		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("delete from tb_barang where id_barang='$id'");
		return $query;
	}

}
?>