<?php 
require_once('../../connection/db.php');

$productID=$_POST['productID'];

$sql="SELECT `listimagepath` FROM `tbl_product` WHERE `idtbl_product`='$productID' AND `status`=1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
?>
<img src="../<?php echo $row['listimagepath'] ?>" class="img-fluid">