<?php
require_once ("Controller/dbcontroller.php");
$db_handle = new DBController();
if (! empty($_POST["huyen_id"])) {
	 $query="SELECT a.idtinhtp,a.tentinhtp FROM tinhthanh as a, quanhuyen as b WHERE a.idtinhtp = b.idtinhtp AND idquanhuyen = '" . $_POST["huyen_id"] . "'";
    $results = $db_handle->runQuery($query);
    ?>
<!-- <option value disabled selected>Chọn tỉnh/thành phố</option> -->
<?php
    foreach ($results as $state) {
        ?>
<option value="<?php echo $state["idtinhtp"]; ?>"><?php echo $state["tentinhtp"]; ?></option>
<?php
    }
}
?>