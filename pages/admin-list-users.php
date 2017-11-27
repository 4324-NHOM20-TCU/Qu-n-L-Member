<?php
if($_SESSION['role']!=2){
	header("Location: ?page=404");
	die;
}
$listMember = (array) getAPI(SERVER_URL.'getAllUser.php');
?>
<div class="content-wrapper">
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Danh sách tài khoản</h3>
			</div>
			<div class="box-body">
				<?php if($listMember){ ?>
					<table id="tbListData" class="table table-bordered table-striped table-hover">
					    <thead>
					        <tr>
					            <th>#</th>
					            <th>Username</th>
					            <th>Email</th>
					            <th class="text-center">Quyền hạn</th>
					            <th class="text-center">Trạng thái</th>
					            <th class="text-center">Thao tác</th>
					        </tr>
					    </thead>
					    <tbody>
					    <?php foreach ($listMember as $i => $item){ ?>
					        <tr>
					        	<td><?php echo $i+1; ?></td>
					        	<td><?php echo $item['username']; ?></td>
					        	<td><?php echo $item['email']; ?></td>
					        	<td class="text-center"><?php echo (($item['role']==2)?'<span class="text-success">Admin</span>':'<span class="text-danger">Member</span>'); ?></td>
					        	<td class="text-center"><?php echo (($item['status']==1)?'<span class="text-success">Active</span>':'<span class="text-danger">Banned</span>'); ?></td>
					        	<td class="text-center">
					        		<a href="<?php echo CLIENT_URL; ?>?page=edit-user&id=<?php echo $item['id']; ?>" class="btn btn-warning btn-xs"><em class="fa fa-pencil"></em>&nbsp;&nbsp;Sửa</a>
					        		&nbsp;&nbsp;
					        		<a href="<?php echo CLIENT_URL; ?>?page=delete-user&id=<?php echo $item['id']; ?>" class="btn btn-danger btn-xs"><em class="fa fa-trash"></em>&nbsp;&nbsp;Xóa</a>
					        	</td>
					        </tr>
					    <?php } ?>
					    </tbody>
					    <tfoot>
					        <tr>
					            <th>ID</th>
					            <th>Username</th>
					            <th>Email</th>
					            <th class="text-center">Quyền hạn</th>
					            <th class="text-center">Trạng thái</th>
					            <th class="text-center">Thao tác</th>
					        </tr>
					    </tfoot>
					</table>
				<?php } ?>
			</div>
		</div>
	</section>
</div>