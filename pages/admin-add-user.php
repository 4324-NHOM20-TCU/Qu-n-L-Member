<?php
if($_SESSION['role']!=2){
	header("Location: ?page=404");
	die;
}
if(isset($_POST['submit-add-user'])) {
	if (empty($_POST['username'])) {
		$err = "Bạn chưa nhập Tài khoản";
	} elseif (strlen($_POST['username']) < 5) {
		$err = "Tài khoản phải có ít nhất 5 ký tự";
	} elseif (empty($_POST['password'])) {
		$err = "Bạn chưa nhập Mật khẩu";
	} elseif (empty($_POST['repassword'])) {
		$err = "Bạn chưa nhập lại mật khẩu";
	} elseif ($_POST['repassword']!=$_POST['password']) {
		$err = "Hai mật khẩu không khớp";
	} elseif (empty($_POST['email'])) {
		$err = "Bạn chưa nhập Email";
	} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$err = "Email không đúng định dạng";
	}else{
		// Check existed
		$result = getAPI(SERVER_URL.'checkExistedUsername.php?username='.$_POST['username']);
		if ($result) {
			$err = "Tên đăng nhập đã được đăng ký, chọn tên đăng nhập khác";
		} else {
			$result = getAPI(SERVER_URL.'checkExistedEmail.php?email='.$_POST['email']);
			if ($result) {
				$err = "Email đã được đăng ký, chọn email khác";
			} else {
				$result = getAPI(SERVER_URL.'addUser.php?username='.$_POST['username'].'&password='.$_POST['password'].'&email='.$_POST['email'].'&role='.$_POST['role']);
				if ($result) {
					unset($_POST);
					$success = "Thêm tài khoản thành công!";
				} else {
					$err = "Thêm tài khoản không thành công. Đã xảy ra lỗi!";
				}
			}
		}
	}
}
?>
<div class="content-wrapper">
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Thêm tài khoản mới</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-8 col-xs-12">
						<a href="?page=list-users" class="btn btn-default btn-sm"><em class="fa  fa-angle-double-left"></em>&nbsp;&nbsp;Hủy bỏ</a>
					</div>
				</div>
				<hr>
				<form method="POST">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="form-group">
								<label>Tài khoản <span class="text-danger">*</span></label>
								<input name="username" class="form-control" placeholder="Tài khoản" type="text" value="<?php echo ((isset($_POST['username'])) ? $_POST['username'] : ''); ?>">
							</div>
							<div class="form-group">
								<label>Mật khẩu <span class="text-danger">*</span></label>
								<input name="password" class="form-control" placeholder="Mật khẩu" type="password" value="<?php echo ((isset($_POST['password'])) ? $_POST['password'] : ''); ?>">
							</div>
							<div class="form-group">
								<label>Nhập lại mật khẩu <span class="text-danger">*</span></label>
								<input name="repassword" class="form-control" placeholder="Nhập lại mật khẩu" type="password" value="<?php echo ((isset($_POST['repassword'])) ? $_POST['repassword'] : ''); ?>">
							</div>
							<div class="form-group">
								<label>Email <span class="text-danger">*</span></label>
								<input name="email" class="form-control" placeholder="Email" type="text" value="<?php echo ((isset($_POST['email'])) ? $_POST['email'] : ''); ?>">
							</div>

							<div class="form-group">
								<label>Phân quyền <span class="text-danger">*</span></label>
								<br>
								<select name="role" style="width: 120px;">
									<option value="1" <?php echo ((isset($_POST['role'])&&$_POST['role']==2) ? '' : 'selected'); ?>>Thành viên</option>
									<option value="2" <?php echo ((isset($_POST['role'])&&$_POST['role']==2) ? 'selected' : ''); ?>>Admin</option>
								</select>
							</div>
						</div>
					</div>
					<hr>
					<?php if(isset($err)){ ?>
						<div class="row">
							<div class="col-xs-12">
								<p class="text-danger"><?php echo $err; ?></p>
							</div>
						</div>
					<?php } ?>

					<?php if(isset($success)){ ?>
						<div class="row">
							<div class="col-xs-12">
								<p class="text-success"><?php echo $success; ?></p>
							</div>
						</div>
					<?php } ?>
					<div class="row">
						<div class="col-xs-2 pull-left">
							<input name="submit-add-user" type="submit" class="btn btn-success" value="Thêm">
						</div>
					</div>
				</form>

			</div>
		</div>
	</section>
</div>