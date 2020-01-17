
<?php 
				require_once("dbcontroller.php");
				$db_handle = new DBController();
				$ktra='2';
				$query1 ="SELECT * FROM tinhthanh";
				$results1= $db_handle->runQuery($query1);
		?>
<select name="diemden_ten">
	
		<?php
		foreach($results1 as $row1) {
		?>
			<option value="<?php echo $row1['idtinhtp'];?>"
			<?php
			if($row1['idtinhtp']==$ktra){
				echo   "selected";} 

			?>><?php echo $row1['tentinhtp']; 

			?> </option>
					
	<?php
			}
			?>
</select>