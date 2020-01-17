<div class="content">
<?php
//include('View/chitiet.php');
?>
</div>
<?php
if(isset($_GET['xem'])){
	$tam=$_GET['xem'];
}else {
		$tam='';
		include('View/chitiet.php');

}if($tam=='dacsan'){
	include('View/admin_dacsan.php');
}elseif($tam=='dacsan1'){
	include('admin_dacsan.php');
}elseif($tam=='diemthamquan'){
	include('View/admin_diemthamquan.php');
}elseif($tam=='add_diemthamquan'){
	include('View/add_diemthamquan.php');
}elseif($tam=='edit_diemthamquan'){
	include('View/edit_diemthamquan.php');
}elseif($tam=='del_diemthamquan'){
	include('View/del_diemthamquan.php');
}elseif($tam=='add_dacsan_dtq'){
	include('View/add_dacsan_dtq.php');
}
elseif($tam=='tourdulich'){
	include('View/admin_tourdulich.php');
}elseif($tam=='add_dacsan'){
	include('View/add_dacsan.php');
}elseif($tam=='edit_dacsan'){
	include('View/edit_dacsan.php');
}elseif($tam=='del_dacsan'){
	include('View/del_dacsan.php');
}elseif($tam=='add_tourdulich'){
	include('View/add_tourdulich.php');
}
elseif($tam=='edit_tourdulich'){
	include('View/edit_tourdulich.php');
}elseif($tam=='xly_add_dacsan_dtq'){
	include('Controller/xly_add_dacsan_dtq.php');
}elseif($tam=='del_dacsan_dtq'){
	include('Controller/del_dacsan_dtq.php');
}
elseif($tam=='add_diemthamquan_tourdulich'){
	include('View/add_diemthamquan_tourdulich.php');
}


?>
</div>
</div>
<div class="clear"></div>