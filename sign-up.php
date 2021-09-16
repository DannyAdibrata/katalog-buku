<?php
    include "config/koneksi.php";
    include "library/controller.php";

    $go = new controller;
    $tabel = "login";
    @$password = base64_encode($_POST['pass']);//enkripsi pake metode base64
    @$field = array('username'=>$_POST['user'], 'password'=>$password);
    $redirect = "login.php";
    @$where = "id =  $_GET[id]";
    
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

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <form method="post" class="mt-5">
            <div class="form-floating mb-3">
                <input type="text" name="user" value="<?php echo @$edit['username'] ?>" class="form-control" id="floatingUsername" placeholder="Username">
                <label for="floatingUsername">Username</label>
            </div>
            <div class="form-floating">
                <input type="text" name="pass" value="<?php echo base64_decode(@$edit['password']) ?>" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto pt-5">
                <?php if(@$_GET['id']==""){ ?>
                            <button class="btn btn-primary" type="submit" name="simpan" value="SIMPAN">Simpan</button>
                        <?php }else{?>
                            <button class="btn btn-primary" type="submit" name="ubah" value="UBAH">Ubah</button>
                        <?php } ?>  
            </div>
        </form>
    </div>
</body>
</html>