<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<li class="header">DANH MỤC MENU</li>
			
			<li class="<?php echo ((!isset($_GET['page']))?'active ':''); ?>treeview">
				<a href="<?php echo CLIENT_URL; ?>">
					<i class="fa fa-dashboard"></i> <span>Trang chủ</span>
				</a>
			</li>
			
			<li class="<?php echo ((isset($_GET['page'])&&($_GET['page']=='profile'))?'active ':''); ?>treeview">
				<a href="?page=profile">
					<i class="fa fa-info"></i> <span>Thông tin tài khoản</span>
				</a>
			</li>
		</ul>
	</section>
</aside>