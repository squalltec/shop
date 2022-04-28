<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sqldelivery="SELECT * FROM `tbl_order_delivery` WHERE `tbl_order_idtbl_order`='$record'";
$resultdelivery=$conn->query($sqldelivery);
$rowdelivery=$resultdelivery->fetch_assoc();
?>
<table class="table table-borderless tableprint" style="width:5.5in">
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td class="">&nbsp;</td>
        <td class="pt-4 pl-0" style="text-transform: uppercase;font-size: 12px;line-height: 1.2;">
            <div class="pl-0" style="margin-left:-15px;height:1.6in">
            <?php echo 'Order No: PO00'.$record.'<br>' ?>
            <?php echo $rowdelivery['name'].'<br>';?>
            <?php echo $rowdelivery['addressone'].'<br>'.$rowdelivery['addresstwo'].'<br>'.$rowdelivery['city'].'<br>';?>
            <?php echo $rowdelivery['mobile'].' / '.$rowdelivery['mobiletwo'];?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-transform: uppercase;font-size: 12px;line-height: 1.2;padding-top:45px;">Cosmetic</td>
    </tr>
</table>
<!-- <div class="row" style="font-size:16px;">
    <div class="col">&nbsp;</div>
    <div class="col-4"><?php //echo $rowdelivery['name'];?></div>
</div>
<div class="row" style="font-size:16px;">
    <div class="col">&nbsp;</div>
    <div class="col-4"><?php //echo $rowdelivery['addressone'].'<br>'.$rowdelivery['addresstwo'].'<br>'.$rowdelivery['city'];?></div>
</div>
<div class="row" style="font-size:16px;">
    <div class="col">&nbsp;</div>
    <div class="col-4"><?php //echo $rowdelivery['mobile'].' / '.$rowdelivery['mobiletwo'];?></div>
</div> -->