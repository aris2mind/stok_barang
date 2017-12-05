<!DOCTYPE html>
<html lang="en">
<head>
	<title>Belajar Bootstrap</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="assets/bootstrap/js/jquery-3.2.1.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/bootstrap/js/datatable/datatables.min.css"/>
    <script type="text/javascript" src="assets/bootstrap/js/datatable/datatables.min.js"></script>


    <link rel="stylesheet" type="text/css" href="assets/jquery-ui/jquery-ui.css"/>
    <script type="text/javascript" src="assets/jquery-ui/jquery-ui.js"></script>

    <script>
    $(document).ready(function(){
      $('.data').DataTable();

      $( function() {
        $( "#tgl" ).datepicker({ dateFormat: 'yy-mm-dd' });
      } );
    });
    </script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://warungbelajar.com">Stok Barang</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="tampil_kategori.php">Kategori</a></li>
            <li><a href="tampil_barang.php">Barang</a></li>
            <li><a href="tampil_user.php">User</a></li>
          </ul>
        </li>
        <li><a href="#">Transaksi</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Report <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Barang Masuk</a></li>
            <li><a href="#">Barang Keluar</a></li>
            <li><a href="#">Stok Barang</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nama User <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Edit Profil</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>