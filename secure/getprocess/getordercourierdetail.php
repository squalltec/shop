<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];
$totalweight=0;

$sqlorder="SELECT `nettotal`, `paystatus`, `trackingno` FROM `tbl_order` WHERE `idtbl_order`='$record'";
$resultorder=$conn->query($sqlorder);
$roworder=$resultorder->fetch_assoc();

$sqldelivery="SELECT * FROM `tbl_order_delivery` WHERE `tbl_order_idtbl_order`='$record'";
$resultdelivery=$conn->query($sqldelivery);
$rowdelivery=$resultdelivery->fetch_assoc();

$sqlweight="SELECT `weight` FROM `tbl_product` WHERE `idtbl_product` IN (SELECT `tbl_product_idtbl_product` FROM `tbl_order_detail` WHERE `status`=1 AND `tbl_order_idtbl_order`='$record')";
$resultweight=$conn->query($sqlweight);
while($rowweight=$resultweight->fetch_assoc()){
    $totalweight+=$rowweight['weight'];
}

$weightkg=$totalweight/1000;
$weightkg=floor($weightkg);
?>
<table class="table table-borderless tableprint" style="">
    <tr>
        <td colspan="2">
            <table class="table table-bordered table-sm text-center mb-0">
                <tr>
                    <td class="border border-dark text-dark p-1" width="50%">Sales Order</td>
                    <td class="border border-dark text-dark p-1">Market Place</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="text-center pt-0 px-0">
            <img alt="<?php echo $roworder['trackingno']; ?>" src="barcode/barcode.php?f=png&s=ean-128&d=<?php echo $roworder['trackingno']; ?>&sx=2&sy=0.8&pl=0&pr=0" />
            <!-- <img alt="<?php echo $roworder['trackingno']; ?>" src="barcode/barcode.php?codetype=Code128&size=50&text=<?php echo $roworder['trackingno']; ?>&print=true" /> -->
        </td>
    </tr>
    <tr>
        <td colspan="2" class="pt-0 pb-0">
            <table class="table table-bordered table-sm text-center mt-0 mb-0 small">
                <tr>
                    <td rowspan="4" class="border border-dark text-dark p-1" width="50%">
                        <img src="images/login.png">
                    </td>
                    <td class="border border-dark text-dark p-1 font-weight-bold small" width="50%"><?php echo 'Order No: PO00'.$record.'<br>' ?></td>
                </tr>
                <tr>
                    <td class="border border-dark text-dark p-1 small"><?php echo $weightkg; ?> KG</td>
                </tr>
                <tr>
                    <td class="border border-dark text-dark p-1 small"><?php if($roworder['paystatus']==0){echo 'COD';}else{echo 'Non COD';} ?></td>
                </tr>
                <tr>
                    <td class="border border-dark text-dark p-1 font-weight-bold small">LKR <?php if($roworder['paystatus']==0){echo number_format($roworder['nettotal'], 2);}else{echo '0';} ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="py-1">
            <table class="table table-bordered table-sm mb-1 small mb-0">
                <tr>
                    <td rowspan="2" class="border border-dark text-dark p-0 text-center align-middle" width="50%">
                        <img src="barcode/barcode.php?s=qrl&d=<?php echo $roworder['trackingno']; ?>&sf=6">
                    </td>
                    <td class="border border-dark text-dark p-1 small">
                        <?php echo $rowdelivery['name'].'<br>';?>
                        <?php echo $rowdelivery['address'].'<br>'.$rowdelivery['city'].'<br>';?>
                        <?php echo $rowdelivery['mobile'].' / '.$rowdelivery['mobile2'];?>
                    </td>
                </tr>
                <tr>
                    <td class="border border-dark text-dark p-1 small">
                        Laol Mart<br>
                        Shipper Address<br>
                        603 Gamameda Road<br>
                        Katunayaka,Western,Gampaha,Negombo
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="py-1">
            <table class="table table-bordered table-sm text-center mb-0 small mt-0">
                <tr>
                    <td class="border border-dark text-dark p-1 align-middle" width="50%">Pickup</td>
                    <td class="border border-dark text-dark p-1 small">AWB Print<br>Date:<?php echo date('Y-m-d') ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>