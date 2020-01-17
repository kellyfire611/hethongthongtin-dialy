<?php
require_once ("Controller/dbcontroller.php");
$db_handle = new DBController();
if (! empty($_POST["tinh_id"])) {
    $query = "SELECT * FROM quanhuyen WHERE idtinhtp= '" . $_POST["tinh_id"] . "'";
    $results = $db_handle->runQuery($query);
    ?>
<option value disabled selected>Chọn huận/huyện</option>
<?php
    foreach ($results as $state) {
        ?>
<option value="<?php echo $state["idquanhuyen"]; ?>"><?php echo $state["tenquanhuyen"]; ?></option>
<?php
    }
}
?>