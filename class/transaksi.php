<?php
include_once('koneksi.php'); 
include_once('barang.php'); 
class transaksi extends koneksi
{

	function cek_stok($id_barang,$jumlah)
	{
		$stok = $this->stok($id_barang);
		if($jumlah <= $stok)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function stok($id_barang)
	{
		$query = $this->con->query("select stok from vw_stok_barang where id_barang='$id_barang'");
		$hasil2 = $query->fetch_array();
		return $hasil2['stok'];
	}

	function transaksi_keluar($id_barang)
	{
		$query = $this->con->query("select sum(jumlah) as jumlah from tb_transaksi where status='keluar' and id_barang='$id'");
		$hasil = $query->fetch_array();
		return $hasil->jumlah;
	}


	function tampil_data()
	{
		$result = $this->con->query("select * from vw_transaksi");
		return $result;
	}
	function tambah($data)
	{
		$barang = new barang();
		$status = $this->con->real_escape_string($data['status']);
		$id_barang = $this->con->real_escape_string($data['id_barang']);
		$jumlah = $this->con->real_escape_string($data['jumlah']);
		$tgl = $this->con->real_escape_string($data['tgl']);
		$harga = $barang->tampil_harga($id_barang);
		$username = 'admin';

		$query = $this->con->query("insert into tb_transaksi (status,id_barang,jumlah,harga,username,tgl) values ('$status','$id_barang','$jumlah','$harga','$username','$tgl')");
		return $query;
	}

	function cek_transaksi($id)
	{
		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("select * from tb_transaksi where id_transaksi='$id'");
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
		$query = $this->con->query("select * from tb_transaksi where id_transaksi='$id'");
		return $query->fetch_array();
	}

	function edit($data)
	{

		$id_transaksi = $this->con->real_escape_string($data['id']);
		$status = $this->con->real_escape_string($data['status']);
		$id_barang = $this->con->real_escape_string($data['id_barang']);
		$jumlah = $this->con->real_escape_string($data['jumlah']);
		$username = $this->con->real_escape_string($data['username']);
		$tgl = $this->con->real_escape_string($data['tgl']);

		$query = $this->con->query("update tb_transaksi set status='$status',id_barang='$id_barang',jumlah='$jumlah',username='$username',tgl='$tgl' where id_transaksi='$id_transaksi'");
		return $query;
	}

	function hapus($id)
	{
		$id = $this->con->real_escape_string($id);
		$query = $this->con->query("delete from tb_transaksi where id_transaksi='$id'");
		return $query;
	}


}
?>