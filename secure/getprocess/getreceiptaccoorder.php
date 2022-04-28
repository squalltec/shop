<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT `filepath` FROM `tbl_order_payment_receipt` WHERE `status`=1 AND `tbl_order_idtbl_order`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

?>
<img src="../<?php echo $row['filepath'] ?>" class="img-fluid">