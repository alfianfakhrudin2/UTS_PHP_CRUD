<?php
require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="asset/img/logolur.svg">
	<!-- Css Gue -->
	<link rel="stylesheet" href="asset/css/modif.css">
	<title>Update page</title>
	<style type="text/css">
		.wrapper {
			width: 500px;
			margin: 0 auto;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<div>
			<?php
			if ($_GET['id_pembelian'] == null) {
				header("location:index.php");
			}
			$id_pembelian = $_GET['id_pembelian'];
			$script = "SELECT * FROM fakhrudin WHERE id_pembelian = $id_pembelian";
			$query = mysqli_query($conn, $script);
			$data = mysqli_fetch_array($query);
			if (isset($_POST['submit'])) {
				if (isset($_FILES['cover'])) {
					$id_pembelian = $_POST['id_pembelian'];
                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $hp = $_POST['hp'];
                    $tgl_transaksi = $_POST['tgl_transaksi'];
                    $jenis_barang = $_POST['jenis_barang'];
                    $nama_barang = $_POST['nama_barang'];
                    $jumlah = $_POST['jumlah'];
                    $harga = $_POST['harga'];
                    $file_tmp = $_FILES['cover']['tmp_name'];

					if ($file_tmp == null) {
						$cover = $data['cover'];
						$script = "UPDATE fakhrudin SET nama='$nama', id_pembelian='$id_pembelian', alamat='$alamat', hp='$hp', tgl_transaksi='$tgl_transaksi', jenis_barang='$jenis_barang', nama_barang='$nama_barang', jumlah='$jumlah', harga='$harga' ,cover='$cover' WHERE id_pembelian=$id_pembelian";
					} else {
						$type = pathinfo($file_tmp, PATHINFO_EXTENSION);
						$data = file_get_contents($file_tmp);
						$cover = 'data:/asset/img/' . $type . ';base64,' . base64_encode($data);
						$script = "UPDATE fakhrudin SET nama='$nama', id_pembelian='$id_pembelian', alamat='$alamat', hp='$hp', tgl_transaksi='$tgl_transaksi', jenis_barang='$jenis_barang', nama_barang='$nama_barang', jumlah='$jumlah', harga='$harga' ,cover='$cover' WHERE id_pembelian=$id_pembelian";
					}

					$query = mysqli_query($conn, $script);
					if ($query) {
						header("location: index.php");
					} else {
						echo "Gagal mengupload data";
					}
				}
			}
			?>
		</div>
		<div class="container-fluid">
			<div class="wrapper">
				<div class="row">
					<div class="col-md-12">
						<div class="page_header" style="color:whitesmoke; margin-top: 15px;">
							<h2>Edit produk <?php echo $data['nama_barang']; ?></h2>
						</div>
						<p style="color:whitesmoke;">Silahkan isi data pada form dibawah ini</p>
						<form method="post" enctype="multipart/form-data">
							<div class="form-group" style="color:whitesmoke;">
								<label> id pembelian </label>
								<input type="number" class="form-control" name="id_pembelian" value="<?= $data['id_pembelian'] ?>">
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label> nama pembelian </label>
								<input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>">
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label> alamat pembelian </label>
								<input type="text" class="form-control" name="alamat" value="<?= $data['alamat'] ?>">
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label> hp pembelian </label>
								<input type="number" class="form-control" name="hp" value="<?= $data['hp'] ?>">
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label> tanggal pembelian </label>
								<input type="date" class="form-control" name="tgl_transaksi" value="<?= $data['tgl_transaksi'] ?>">
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label>Jenis barang</label>
								<select name="jenis_barang" class="form-control">
                                    <option>Pilih</option>
                                    <option value="alat tulis">alat tulis</option>
                                    <option value="elektronik">elektronik</option>  
								</select>
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label> nama barang </label>
								<input type="text" class="form-control" name="nama_barang" value="<?= $data['nama_barang'] ?>">
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label> jumlah pembelian </label>
								<input type="number" class="form-control" name="jumlah" value="<?= $data['jumlah'] ?>">
							</div>
                            <div class="form-group" style="color:whitesmoke;">
								<label> harga barang </label>
								<input type="number" class="form-control" name="harga" value="<?= $data['harga'] ?>">
							</div>
							
							<div class="form-group" style="color:whitesmoke;">
								<label> Cover Buku </label>
								<input type="file" class="form-control" name="cover">
							</div>
							<input type="submit" class="btn" style="margin-top: 16px; font-size: 15px; color: whitesmoke; background: #00ABB3; margin-left: 137px;  width: 100px;" name="submit" value="Submit">
							<a href="index.php" type="submit" style="margin-top: 16px; background: #C9BBCF; width: 100px;" class="btn">Cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br><br><br>
	</div>


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>