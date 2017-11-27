<?php
if ($_SESSION['role']!=2) {
	header("Location: ?page=404"); // trả về 404
	die;
}

$id = $_GET['id'];
$user = getAPI(SERVER_URL.'getUserById.php?id='.$id);

if (isset($_POST['submit-del-user'])) {
	$result = getAPI(SERVER_URL.'deleteUser.php?id='.$id);
	if ($result) {
		header("Location: ?page=list-users");
	} else {
		$err = "Xóa tài khoản không thành công. Đã xảy ra lỗi!";
	}
}
?>
<div class="content-wrapper">
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">BẠN CÓ CHẮC CHẮN MUỐN XÓA TÀI KHOẢN?</h3>
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
								<input name="username" class="form-control" placeholder="Tài khoản" type="text" value="<?php echo $user['username']; ?>" readonly>
							</div>
							<div class="form-group">
								<label>Email <span class="text-danger">*</span></label>
								<input name="email" class="form-control" placeholder="Email" type="text" value="<?php echo $user['email']; ?>" readonly>
							</div>

							<div class="form-group">
								<label>Phân quyền <span class="text-danger">*</span></label>
								<br>
								<select name="role" style="width: 120px;" disabled>
									<option value="1" <?php echo (($user['role'] != 1) ? '' : 'selected'); ?>>Thành viên</option>
									<option value="2" <?php echo (($user['role'] == 2) ? 'selected' : ''); ?>>Admin</option>
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
					<div class="row">
						<div class="col-xs-2 pull-left">
							<input name="submit-del-user" type="submit" class="btn btn-danger" value="Xóa">
						</div>
					</div>
				</form>

			</div>
		</div>
	</section>
</div>