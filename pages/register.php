<?php
include '../config.php';
include '../function.php';
// Kiem tra session
if(isset($_SESSION['username'])){
	header("Location: ".CLIENT_URL);
	die;
}

if(isset($_POST['btn-register'])){
	if(!isset($_POST['username']) || empty($_POST['username'])){
		$err = "Chưa nhập tài khoản";
	}
	elseif(!isset($_POST['password']) || empty($_POST['password'])){
		$err = "Chưa nhập mật khẩu";
	}
	elseif(!isset($_POST['re-password']) || empty($_POST['re-password'])){
		$err = "Chưa nhập lại mật khẩu";
	}
	elseif(isset($_POST['password']) && isset($_POST['password']) && $_POST['password'] != $_POST['re-password']){
		$err = "Hai mật khẩu không khớp";
	}
	elseif(!isset($_POST['email']) || empty($_POST['email'])){
		$err = "Chưa nhập email";
	}
	else{
		// Check existed
		$result = getAPI(SERVER_URL.'checkExistedUsername.php?username='.$_POST['username']);
		if ($result) {
			$err = "Tên đăng nhập đã được đăng ký, chọn tên đăng nhập khác";
		} else {
			$result = getAPI(SERVER_URL.'checkExistedEmail.php?email='.$_POST['email']);
			if ($result) {
				$err = "Email đã được đăng ký, chọn email khác";
			} else {
				$result = getAPI(SERVER_URL.'addUser.php?username='.$_POST['username'].'&password='.$_POST['password'].'&email='.$_POST['email']);
				if ($result) {
					$success = "Đăng ký thành công. Hãy quay lại trang đăng nhập!";
					unset($_POST);
				} else {
					$err = "Đăng ký không thành công. Đã xảy ra lỗi!";
					
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Đăng ký</title>
	<?php include '../skin/layouts/css.php'; ?>
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
			<p class="login-box-msg">- Vui lòng điền đủ thông tin bên dưới! -</p>
			<?php if(isset($err)){ ?>
				<p class="text-danger">
                	<?php echo $err; ?>
              	</p>
			<?php } ?>
			<?php if(isset($success)){ ?>
				<p class="text-success">
                	<?php echo $success; ?>
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
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="re-password" value="<?php echo ((isset($_POST['re-password'])) ? $_POST['re-password'] : ''); ?>">
					<span class="fa fa-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo ((isset($_POST['email'])) ? $_POST['email'] : ''); ?>">
					<span class="fa fa-envelope form-control-feedback"></span>
				</div>

				<div class="row">
					<div class="col-xs-8">
						<a href="<?php echo CLIENT_URL ?>" class="btn-link">&larr; Đăng nhập</a>
					</div>
					<div class="col-xs-4">
						<button type="submit" name="btn-register" class="btn btn-info btn-block btn-flat">Đăng ký</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include '../skin/layouts/js.php'; ?>
</body>
</html>
