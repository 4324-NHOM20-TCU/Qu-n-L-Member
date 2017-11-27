<?php
include 'config.php';
include 'function.php';

// Kiem tra session
if(!isset($_SESSION['username'])){

	if(isset($_POST['btn-login'])){
		if(!isset($_POST['username']) || empty($_POST['username'])){
			$errLogin = "Chưa nhập tài khoản";
		}
		elseif(!isset($_POST['password']) || empty($_POST['password'])){
			$errLogin = "Chưa nhập mật khẩu";
		}
		else{
			// Check login
			$result = getAPI(SERVER_URL.'checkLogin.php?username='.$_POST['username'].'&password='.$_POST['password']);
			if ($result) {
				// getUser : username
				$user = (array) getAPI(SERVER_URL.'getUserByUsername.php?username='.$_POST['username']);
				$_SESSION['userId'] = $user['id'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['role'] = $user['role'];

				header("Location: ".CLIENT_URL);
				die;

			} else {
				$errLogin = "Tài khoản hoặc mật khẩu không đúng.";
			}
		}
	}

	include 'pages/login.php';
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo (($_SESSION['role']==2) ? 'Admin' : 'Member'); ?></title>
	<?php include 'skin/layouts/css.php'; ?>
</head>
<body class="hold-transition skin-yellow sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="<?php echo CLIENT_URL; ?>" class="logo">
				<span class="logo-mini"><strong>Group 20</strong></span>
				<span class="logo-lg">GROUP <strong>20</strong></span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
		      		Chào, <strong><?php echo $_SESSION['username'] ?></strong>!&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo CLIENT_URL; ?>pages/logout.php" class="btn btn-danger btn-xs"><em class="fa fa-power-off"></em>&nbsp;&nbsp;Đăng xuất</a>
		      	</div>
			</nav>
		</header>
		<?php
			if($_SESSION['role'] == 2){
				include 'skin/layouts/admin-sidebar.php';
			}else{
				include 'skin/layouts/member-sidebar.php';
			}
		?>
		<?php
			// include file
			if(isset($_GET['page'])){
				if($_SESSION['role'] == 2){
					$page = 'pages/admin-'.$_GET['page'].'.php';
				}else{
					$page = 'pages/member-'.$_GET['page'].'.php';
				}
				if(!file_exists($page)){
					include 'pages/404.php';
				}else{
					include $page;
				}
			}else{
				include 'pages/default.php';
			}
		?>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			Copyright &copy; 2017 by <strong>GROUP 20</strong> (GRUOP 20).
		</footer>
	</div>
	<?php include 'skin/layouts/js.php'; ?>
</body>
</html>