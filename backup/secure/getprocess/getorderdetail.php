<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_order` WHERE `idtbl_order`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$canceluser=$row['tbl_user_idtbl_user'];

$sqlcanceluser="SELECT `name` FROM `tbl_user` WHERE `idtbl_user`='$canceluser'";
$resultcanceluser=$conn->query($sqlcanceluser);
$rowcanceluser=$resultcanceluser->fetch_assoc();

$sqldetail="SELECT * FROM `tbl_order_detail` WHERE `tbl_order_idtbl_order`='$record'";
$resultdetail=$conn->query($sqldetail);

$sqldelivery="SELECT * FROM `tbl_order_delivery` WHERE `tbl_order_idtbl_order`='$record'";
$resultdelivery=$conn->query($sqldelivery);
$rowdelivery=$resultdelivery->fetch_assoc();

$cusID=$row['tbl_customer_idtbl_customer'];
$sqlbank="SELECT * FROM `tbl_customer_bank` WHERE `status`=1 AND `tbl_customer_idtbl_customer`='$cusID'";
$resultbank=$conn->query($sqlbank);
$rowbank=$resultbank->fetch_assoc();
?>
<div class="row">
    <div class="col-12">
        <table class="w-100 tableprint">
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td class="text-right"><img src="images/billlogo.png" width="80" height="80" class="img-fluid"></td>
                    <td colspan="4" class="text-center small align-middle">
                        <h2 class="font-weight-light m-0">Herbline LK</h2>
                        63/46/1/1, Dambahena Rd,Maharagama.<br>
                        Tel: (+94) 76 990 9990 info@Herbline.Lk
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>            
        </table>
    </div>
</div>
<h3><?php echo 'PO00'.$record; ?></h3>
<table class="table table-striped table-bordered table-sm small">
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th class="text-center">Qty</th>
            <th class="text-right">Unit Price</th>
            <th class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; while($rowdetail=$resultdetail->fetch_assoc()){ $explode=explode('-', $rowdetail['product']); ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rowdetail['product'] ?><span class="fa-pull-right"><?php echo end($explode); ?></span></td>
            <td class="text-center"><?php echo $rowdetail['qty'] ?></td>
            <td class="text-right"><?php echo number_format($rowdetail['price'],2) ?></td>
            <td class="text-right"><?php echo number_format($rowdetail['total'],2) ?></td>
        </tr>
        <?php $i++;} ?>
    </tbody>
</table>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Total :</div>
    <div class="col-2 text-right font-weight-bold small <?php if($rowdelivery['otherdeliverystatus']==1){echo 'bg-info-soft';} ?>"><?php echo number_format($row['total'],2) ?></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Discount :</div>
    <div class="col-2 text-right font-weight-bold small"><?php if($row['dropdiscountstatus']==1){echo number_format('0',2);}else{echo number_format($row['discount'],2);} ?></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Ship Cost :</div>
    <div class="col-2 text-right font-weight-bold small"><?php echo number_format($row['shipcost'],2) ?></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Booklet Cost :</div>
    <div class="col-2 text-right font-weight-bold small"><?php echo number_format($row['booklet'],2) ?></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">&nbsp;</div>
    <div class="col-2 text-right font-weight-bold small"><hr class="border-dark"></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Net Total :</div>
    <div class="col-2 text-right font-weight-bold small"><?php if($row['dropdiscountstatus']==1){echo number_format(($row['total']+$row['shipcost']+$row['booklet']),2);}else{echo number_format(($row['nettotal']),2);} ?></div>
</div>
<div class="row">
    <div class="col-12 font-weight-bold small"><hr class="border-dark my-1"></div>
    <div class="col-12 font-weight-bold small text-right">
        <?php if($row['paystatus']==1){echo 'Payment done.';}else{echo "COD";} ?>
    </div>
</div>
<div class="row">
    <div class="col-12"><h6 class="title-style small"><span>Delivery Information</span></h6></div>
    <div class="col-2 small">Name:</div>
    <div class="col-10 small"><?php echo $rowdelivery['name'];?></div>
    <div class="col-2 small">Mobile 1:</div>
    <div class="col-10 small"><?php echo $rowdelivery['mobile'];?></div>
    <div class="col-2 small">Mobile 2:</div>
    <div class="col-10 small"><?php echo $rowdelivery['mobiletwo'];?></div>
    <div class="col-2 small">Address:</div>
    <div class="col-10 small"><?php echo $rowdelivery['addressone'].'<br>'.$rowdelivery['addresstwo'].'<br>'.$rowdelivery['city'];?></div>
    <div class="col-2 small">Narration:</div>
    <div class="col-10 small"><?php echo $row['narration'];?></div>
</div>
<?php if($row['status']==2){ ?>
<div class="row">
    <div class="col-12 text-center">
        <div class="alert alert-danger"><?php echo $row['cancelreason'].' - Cancel by '.$rowcanceluser['name']; ?></div>
    </div>
</div>
<?php } ?>
<!-- <div class="row">
    <div class="col-12"><h6 class="title-style small"><span>Bank Information</span></h6></div>
    <div class="col-3">Account Name:</div>
    <div class="col-9"><?php echo $rowbank['accountname'];?></div>
    <div class="col-3">Account:</div>
    <div class="col-9"><?php echo $rowbank['accountno'];?></div>
    <div class="col-3">Bank:</div>
    <div class="col-9"><?php echo $rowbank['bank'];?></div>
    <div class="col-3">Branch:</div>
    <div class="col-9"><?php echo $rowbank['branch'];?></div>
</div> -->