<?php

// Kiem tra session
if(isset($_SESSION['username'])){
	header("Location: ".CLIENT_URL);
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng nhập</title>
	<?php include 'skin/layouts/css.php'; ?>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?php echo CLIENT_URL; ?>">
				<img src="<?php echo CLIENT_URL; ?>skin/img/logo.png" alt="LOGO" width="150"><br>
				NHÓM <b>20</b>
			</a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">- Mời bạn nhập thông tin tài khoản -</p>
			<?php if(isset($errLogin)){ ?>
				<p class="text-danger">
                	<?php echo $errLogin; ?>
              	</p>
			<?php } ?>
			<form action="" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Tài khoản" name="username" value="<?php echo ((isset($_POST['username'])) ? $_POST['username'] : ''); ?>">
					<span class="fa fa-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Mật khẩu" name="password" value="<?php echo ((isset($_POST['password'])) ? $_POST['password'] : ''); ?>">
					<span class="fa fa-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-4">
						<button type="submit" name="btn-login" class="btn btn-info btn-block btn-flat">Đăng nhập</button>
					</div>
					<div class="col-xs-8">
						<a href="<?php echo CLIENT_URL ?>pages/register.php" class="btn-link pull-right">Đăng ký tài khoản &rarr;</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include 'skin/layouts/js.php'; ?>
</body>
</html>
