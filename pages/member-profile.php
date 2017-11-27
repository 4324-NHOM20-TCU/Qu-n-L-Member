<?php
$user = (array) getAPI(SERVER_URL.'getUserByUsername.php?username='.$_SESSION['username']);
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-3 col-xs-12">
				<div class="box box-info">
					<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="<?php echo CLIENT_URL; ?>skin/img/logo.png" alt="User profile picture">
					<h3 class="profile-username text-center"><?php echo $_SESSION['username'];?></h3>
					<p class="text-muted text-center"><?php echo (($_SESSION['role']==2)?'Admin':'Member') ;?></p>					
					</div>
				</div>
			</div>
			<div class="col-md-9 col-xs-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Thông tin tài khoản</h3>
					</div>
					<div class="box-body">
						<div class="row" style="margin-top: 10px;">
							<div class="col-xs-3">
								Tài khoản
							</div>
							<div class="col-xs-9">
								<strong><?php echo $user['username']; ?></strong>
							</div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<div class="col-xs-3">
								Email
							</div>
							<div class="col-xs-9">
								<strong><?php echo $user['email']; ?></strong>
							</div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<div class="col-xs-3">
								Phân quyền
							</div>
							<div class="col-xs-9">
								<strong><?php echo (($user['role']==2)?'<span class="text-success">Admin</span>':'<span class="text-danger">Member</span>') ;?></strong>
							</div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<div class="col-xs-3">
								Trạng thái
							</div>
							<div class="col-xs-9">
								<strong><?php echo (($user['status']==1)?'<span class="text-success">Active</span>':'Banned') ;?></strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>