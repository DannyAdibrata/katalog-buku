<?php
    include "config/koneksi.php";
    include "library/controller.php";

    $go = new controller();

    $tabel = "login";
    @$username = $_POST['user'];
    @$password = base64_encode($_POST['pass']);
    $redirect = "dashboard.php";

    if(isset($_POST['login'])){
        $go->login($con, $tabel, $username, $password, $redirect);
    }

    if(isset($_POST['signup'])){
        $go->login($con, $tabel, $username, $password, $redirect);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>Dashboard</title>
</head>

<body class="text-center">
    <div class="container">
        <main class="form-login">
            <form style="width:100%" method="post">
            <br>
            <br>
            <br>
            <br>
            <br>
                <h1 class="h3 mb-3 fw-normal">Login</h1>

                <div class="form-floating pb-4">
                <input type="text" name="user" class="form-control" id="floatingUsername" placeholder="Username" required>
                <label for="floatingUsername">Username</label>
                </div>
                <div class="form-floating pb-2">
                <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mx-auto p-3">
                <label>
                    <input type="checkbox" value="remember-me" class="mx-auto"> Remember me
                </label>
                </div>
                <button class="btn btn-secondary" type="submit" name="login" value="LOGIN">Login</button>
                <div class="mt-3">
                    <a href="sign-up.php" class="btn btn-danger" role="button" tab-index="-1">Sign-up</a>
                </div>
            </form>
            
        </main>
    </div>
</body> 
</html>