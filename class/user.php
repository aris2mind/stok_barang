<?php
include_once('koneksi.php'); 
class user extends koneksi
{
	function tampil_data()
	{
		$result = $this->con->query("select * from tb_user");
		return $result;
	}
	function tambah($data)
	{
		$username = $this->con->real_escape_string($data['username']);
		$password = password_hash($this->con->real_escape_string($data['password']),PASSWORD_DEFAULT);
		$tipe = $this->con->real_escape_string($data['tipe']);
		$nama = $this->con->real_escape_string($data['nama']);
		$query = $this->con->query("insert into tb_user (username,password,nama,tipe) values ('$username','$password','$nama','$tipe')");
		return $query;
	}

	function cek_username($username)
	{
		$username = $this->con->real_escape_string($username);
		$query = $this->con->query("select * from tb_user where username='$username'");
		if($query->num_rows > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function get_by_id($username)
	{	
		$username = $this->con->real_escape_string($username);
		$query = $this->con->query("select * from tb_user where username='$username'");
		return $query->fetch_array();
	}

	function edit($data)
	{
		$username = $this->con->real_escape_string($data['username']);
		$tipe = $this->con->real_escape_string($data['tipe']);
		$nama = $this->con->real_escape_string($data['nama']);
		
		$q = "update tb_user set nama='$nama',tipe='$tipe'";

		if(! empty($data['password']))
		{
			$password = password_hash($this->con->real_escape_string($data['password']),PASSWORD_DEFAULT);
			$q .= ", password='$password' ";
		}
		$q .=" where username='$username'";
		//echo $q;

		$query = $this->con->query($q);
		return $query;
	}

	function hapus($username)
	{
		$username = $this->con->real_escape_string($username);
		$query = $this->con->query("delete from tb_user where username='$username'");
		return $query;
	}


}
?>