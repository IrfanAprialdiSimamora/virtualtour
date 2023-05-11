<?php
   session_start();
   include("koneksi.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($koneksi,$_POST['user']);
      $mypassword = mysqli_real_escape_string($koneksi,$_POST['passcode']); 
      
      $login =mysqli_query ($koneksi,"SELECT * FROM tb_user 
      WHERE user = '$myusername' and passcode = '$mypassword'");
      $cek=mysqli_num_rows($login);	
      if($cek > 0) {
        $data=mysqli_fetch_assoc($login);
        $level = $data['level'];
         if($level=="admin"){
         $_SESSION['user'] = $myusername;
         $_SESSION['namalengkap']="namalengkap";
         $_SESSION['level']="level";
         header("location: admin/dassbord.php");
         }
        else{
            header("location: login.php");
        }
   }
   else {
    $error = "Username atau password yang anda masukkan salah!";
 }
}
?>
<!DOCTYPE html> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="stile.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">

  </head>
   <body>
   <div align="center">
	<div class="col-md-4 col-md-offset-4 form-login">
   <div class="outter-form-login">
   <i class="fa-solid fa-image m-2"></i>
        <div class="logo-login">
        </div>
            <form action="" class="inner-login" method="post">
            <h4 class="text-center title-login">VIRTUAL REALITY TOUR POLMAN</h4><br/>
                <div class="form-group">
                    <input type="text" class="form-control" name="user" placeholder="Username">
                </div>
                  <br>
                <div class="form-group">
                    <input type="password" class="form-control" name="passcode" placeholder="Password">
                </div>
                  <br>
                <input type="submit" class="btn btn-block btn-custom-green" value="LOGIN" />
            </form>
            <?php
//menampilkan pemberitahuan kesalahan jika terjadi kesalahan
if(isset($error)) {
  echo $error;
}
?>
        </div>
    </div>
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
   </body>
</html>