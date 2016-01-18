<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Penjualan Optik</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   
   

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-2" id="formlogin" action='login_validasi.php' method="POST">
                          <fieldset>
                                <div class="form-group">
                                    <p><?php 
//kode php ini kita gunakan untuk menampilkan pesan eror
if (!empty($_GET['error'])) {
	if ($_GET['error'] == 1) {
		echo ("Username dan Password belum diisi!");
	} else if ($_GET['error'] == 2) {
		echo ("Pengguna ini tidak terdaftar !");
	}
}
?>
                                      <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit"  name="submit" class="btn btn-primary">
	<i class="glyphicon glyphicon-log-in"></i> Masuk </button> 
    <button type="reset" class="btn btn-warning">
    <i class="glyphicon glyphicon-off"></i> Reset</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

</body>

</html>
