<?php
include_once('koneksi.php'); 
class kategori extends koneksi
{
	function tampil_data()
	{
		$result = $this->con->query("select * from tb_kategori_barang");
		return $result;
	}
	function tambah($data)
	{
		$kategori = $this->con->real_escape_string($data['kategori']);
		$keterangan = $this->con->real_escape_string($data['keterangan']);
		$query = $this->con->query("insert into tb_kategori_barang (kategori,keterangan) values ('$kategori','$keterangan')");
		return $query;
		/*
		$query = $this->con->prepare("INSERT INTO tb_kategori (kategori,keterangan) values (?,?)");
		$query->bind_param('ss',$kategori,$keterangan);
		$kategori = $data['kategori'];
		$keterangan = $data['keterangan'];
		$query->execute();
		*/
	}

	function cek_id($id)
	{
		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("select * from tb_kategori_barang where id_kategori_barang='$id'");
		if($query->num_rows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}


		/*
		$query = $this->con->prepare("select * from tb_kategori where id_kategori=?");
		$query->bind_param('i',$id);
		$query->execute();
		$query->store_result();
		if($query->num_rows > 0)
		{
			return TRUE;
		} 
		else
		{
			return FALSE;
		}
		*/
	}

	function get_by_id($id)
	{	

		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("select * from tb_kategori_barang where id_kategori_barang='$id'");
		return $query->fetch_array();
		/*
		$query = $this->con->prepare("select * from tb_kategori where id_kategori=?");
		$query->bind_param('i',$id);
		$query->execute();
		$data = $query->get_result();
		return mysqli_fetch_array($data);
		*/
	}

	function edit($data)
	{
		$kategori = $this->con->real_escape_string($data['kategori']);
		$id_kategori = $this->con->real_escape_string($data['id_kategori']);
		$keterangan = $this->con->real_escape_string($data['keterangan']);

		$query = $this->con->query("update tb_kategori_barang set kategori='$kategori',keterangan='$keterangan' where id_kategori_barang='$id_kategori'");
		if($query)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function hapus($id)
	{
		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("delete from tb_kategori_barang where id_kategori_barang='$id'");
		if($query)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
?>