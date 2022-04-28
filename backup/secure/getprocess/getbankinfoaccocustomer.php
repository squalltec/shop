<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_customer_bank` WHERE `tbl_customer_idtbl_customer`='$record' AND `status`=1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

?>
<div class="form-group row mb-0 mt-0">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Account No :</label>
    <label for="inputEmail3" class="col-sm-8 col-form-label"><?php echo $row['accountno']; ?></label>
</div>
<div class="form-group row mb-0 mt-0">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Account Name :</label>
    <label for="inputEmail3" class="col-sm-8 col-form-label"><?php echo $row['accountname']; ?></label>
</div>
<div class="form-group row mb-0 mt-0">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Bank :</label>
    <label for="inputEmail3" class="col-sm-8 col-form-label"><?php echo $row['bank']; ?></label>
</div>
<div class="form-group row mb-0 mt-0">
    <label for="inputEmail3" class="col-sm-4 col-form-label">Branch :</label>
    <label for="inputEmail3" class="col-sm-8 col-form-label"><?php echo $row['branch']; ?></label>
</div>