<?php
session_start();
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];

$fromdate=date("Y-m-d", strtotime($_POST['fromdate']));
$todate=date("Y-m-d", strtotime($_POST['todate']));

$sqltotalsale="SELECT SUM(`total`) AS `total`, SUM(`qty`) AS `qty`, `tbl_product_idtbl_product` FROM `tbl_order_detail` WHERE `tbl_order_idtbl_order` IN (SELECT `idtbl_order` FROM `tbl_order` WHERE `status`=1 AND `acceptstatus`=1 AND `orderdate` BETWEEN '$fromdate' AND '$todate') GROUP BY `tbl_product_idtbl_product`";
$resulttotalsale=$conn->query($sqltotalsale);

$totqty=0;
$totsale=0;
?>
<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered table-sm" id="tablecommission">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-center">Sale Qty</th>
                    <th class="text-right">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($rowtotalsale=$resulttotalsale->fetch_assoc()){ 
                    $productID=$rowtotalsale['tbl_product_idtbl_product'];

                    if($productID>1){
                        $sqlproductlist="SELECT `productname` FROM `tbl_product` WHERE `idtbl_product`='$productID'";
                        $resultproductlist=$conn->query($sqlproductlist);
                        $rowproductlist=$resultproductlist->fetch_assoc();

                        $totqty=$totqty+$rowtotalsale['qty'];
                        $totsale=$totsale+$rowtotalsale['total'];
                ?>
                <tr>
                    <td><?php echo $rowproductlist['productname']; ?></td>
                    <td class="text-center"><?php echo $rowtotalsale['qty']; ?></td>
                    <td class="text-right"><?php echo number_format($rowtotalsale['total'], 2); ?></td>
                </tr>
                <?php }} ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th class="text-center"><?php echo $totqty; ?></th>
                    <th class="text-right"><?php echo number_format($totsale, 2); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>