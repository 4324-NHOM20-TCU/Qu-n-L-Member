<?php
if($_SESSION['role']!=2){
	header("Location: ?page=404");
	die;
}

$id = $_GET['id'];
$user = getAPI(SERVER_URL.'getUserById.php?id='.$id);

if(isset($_POST['submit-edit-user'])) {
	if (empty($_POST['username'])) {
		$err = "Bạn chưa nhập Tài khoản";
	} elseif (strlen($_POST['username']) < 5) {
		$err = "Tài khoản phải có ít nhất 5 ký tự";
	} elseif ((!empty($_POST['password']) || !empty($_POST['repassword'])) && $_POST['repassword']!=$_POST['password']) {
		$err = "Hai mật khẩu không khớp";
	} elseif (empty($_POST['email'])) {
		$err = "Bạn chưa nhập Email";
	} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$err = "Email không đúng định dạng";
	}else{
		$result = getAPI(SERVER_URL.'checkExistedEmail.php?email='.$_POST['email'].'&id='.$id);
		if ($result) {
			$err = "Email đã được đăng ký, chọn email khác";
		} else {
			$result = getAPI(SERVER_URL.'updateUser.php?id='.$id.'&username='.$_POST['username'].'&password='.$_POST['password'].'&email='.$_POST['email'].'&role='.$_POST['role']);
			if ($result) {
				unset($_POST);
				$user = getAPI(SERVER_URL.'getUserById.php?id='.$id);
				$success = "Cập nhật khoản thành công!";
			} else {
				$err = "Cập nhật tài khoản không thành công. Đã xảy ra lỗi!";
			}
		}
	}
}
?>
<div class="content-wrapper">
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Sửa thông tin tài khoản</h3>
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
								<input name="username" class="form-control" placeholder="Tài khoản" type="text" value="<?php echo ((isset($_POST['username'])) ? $_POST['username'] : $user['username']); ?>" readonly>
							</div>
							<div class="form-group">
								<label>Email <span class="text-danger">*</span></label>
								<input name="email" class="form-control" placeholder="Email" type="text" value="<?php echo ((isset($_POST['email'])) ? $_POST['email'] : $user['email']); ?>">
							</div>

							<div class="form-group">
								<label>Phân quyền <span class="text-danger">*</span></label>
								<br>
								<select name="role" style="width: 120px;">
									<option value="1" <?php echo (((isset($_POST['role'])&&$_POST['role']==2) || ($user['role']==2)) ? '' : 'selected'); ?>>Thành viên</option>
									<option value="2" <?php echo (((isset($_POST['role'])&&$_POST['role']==2) || ($user['role']==2)) ? 'selected' : ''); ?>>Admin</option>
								</select>
							</div>
							<hr>
							<div class="form-group">
								<label>Mật khẩu <small><em>(không đổi thì để trống)</em></small></label>
								<input name="password" class="form-control" placeholder="Mật khẩu" type="password" value="<?php echo ((isset($_POST['password'])) ? $_POST['password'] : ''); ?>">
							</div>
							<div class="form-group">
								<label>Nhập lại mật khẩu <small><em>(không đổi thì để trống)</em></small></label>
								<input name="repassword" class="form-control" placeholder="Nhập lại mật khẩu" type="password" value="<?php echo ((isset($_POST['repassword'])) ? $_POST['repassword'] : ''); ?>">
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
							<input name="submit-edit-user" type="submit" class="btn btn-warning" value="Lưu lại">
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>