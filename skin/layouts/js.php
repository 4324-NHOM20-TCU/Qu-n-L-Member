<script src="<?php echo CLIENT_URL; ?>skin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo CLIENT_URL; ?>skin/js/jquery-ui.min.js"></script>
<script src="<?php echo CLIENT_URL; ?>skin/js/bootstrap.min.js"></script>
<script src="<?php echo CLIENT_URL; ?>skin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo CLIENT_URL; ?>skin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo CLIENT_URL; ?>skin/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo CLIENT_URL; ?>skin/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo CLIENT_URL; ?>skin/js/app.min.js"></script>

<script>
	$('#tbListData').dataTable({
		ordering : false
	});

	$("select").select2();

	$('#datepicker').datepicker({
      	autoclose: true
    });

</script>