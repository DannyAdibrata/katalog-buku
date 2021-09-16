<?php 
    include "config/koneksi.php";
    include "library/controller.php";
    $go = new controller();
    $tabel = "buku";
    @$field = array('kode_buku'=>$_POST['Kode_buku'],
                    'judul'=>$_POST['Judul'],
                    'pengarang'=>$_POST['Pengarang'],
                    'penerbit'=>$_POST['Penerbit'],
                    'tahun_terbit'=>$_POST['Tahun_terbit']);
    $redirect = '?menu=input-buku';
    @$where = "id_buku = $_GET[id]";

    $query = mysqli_query($con, "SELECT max(kode_buku) as kode_buku FROM buku");
    @$data = mysqli_fetch_array($query);
    @$kodeBarang = $data['kode_buku'];
    $urutan = (int) substr($kodeBarang, 9, 9);
    $urutan++;
    $huruf = "BKU";
    $kodeBarang = $huruf . sprintf("%09s", $urutan);

    if(isset($_POST['simpan'])){
        $go->simpan($con, $tabel, $field, $redirect);
    }
    if(isset($_GET['hapus'])){
        $go->hapus($con, $tabel, $where, $redirect);
    }
    if(isset($_GET['edit'])){
        $edit = $go->edit($con, $tabel, $where);
    }
    if(isset($_POST['ubah'])){
        $go->ubah($con, $tabel, $field, $where, $redirect);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <title>Dashboard</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="input-buku.php">Input Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user.php">Akun</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
       
    <br>

    <form method="post" class="mx-auto pb-5">
            <table align="center" class="table table-dark table-striped" style="width:90%">
                <tr>
                    <td>Kode Buku</td>
                    <td>:</td>
                    <td><input class="form-control" type="text" name="Kode_buku" value="<?php if(@$edit['kode_buku']==null){echo $kodeBarang;}else{ echo @$edit['kode_buku'];}?>" readonly></td>
                </tr>
                <tr>
                    <td>Judul Buku</td>
                    <td>:</td>
                    <td><input class="form-control" type="text" name="Judul" value="<?php echo @$edit['judul'] ?>" required></td>
                </tr>
                <tr>
                    <td>Pengarang</td>
                    <td>:</td>
                    <td><input class="form-control" type="text" name="Pengarang" value="<?php echo @$edit['pengarang'] ?>" required></td>
                </tr>
                <tr>
                    <td>Penerbit</td>
                    <td>:</td>
                    <td><input class="form-control" type="text" name="Penerbit" value="<?php echo @$edit['penerbit'] ?>" required></td>
                </tr>
                <tr>
                    <td>Tahun Terbit</td>
                    <td>:</td>
                    <td><input class="form-control" type="text" name="Tahun_terbit" value="<?php echo @$edit['tahun_terbit'] ?>" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <?php if(@$_GET['id']==""){ ?>
                                <button class="btn btn-primary col-6 mt-3" type="submit" name="simpan" value="SIMPAN">Simpan</button>
                            <?php }else{?>
                                <button class="btn btn-primary" type="submit" name="ubah" value="UBAH">Ubah</button>
                            <?php } ?>  
                    </td>
                </tr>
            </table>
        
            <table align="center" border="1" id="tabel-data" class="table table-dark table-striped" style="width:90%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>    
                    <?php 
                        $data = $go->tampil($con, $tabel);
                        $no = 0;
                        if($data==""){
                            echo "<tr><td colspan = '4'>No Record</td></tr>";
                        }else{
                        foreach($data as $r){
                        $no++
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $r['kode_buku'] ?></td>
                        <td><?php echo $r['judul'] ?></td>
                        <td><?php echo $r['pengarang'] ?></td>
                        <td><?php echo $r['penerbit'] ?></td>
                        <td><?php echo $r['tahun_terbit'] ?></td>
                        <td><button type="submit" class="btn btn-warning"><a style="text-decoration:none; color:white" href="?menu=dashboard&hapus&id=<?php echo $r['id_buku'] ?>" onclick="return confirm('Hapus Data?')">Hapus</a></button></td>
                        <td><button type="submit" class="btn btn-dark"><a style="text-decoration:none; color:white; hover" href="?menu=dashboard&edit&id=<?php echo $r['id_buku'] ?>">Edit</a></button></td>                
                    </tr>
                    <?php }  } ?>
                </tbody>
            </table>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable();
        } );
    </script>
</body>
</html>