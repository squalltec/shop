<?php 
require_once('../../connection/db.php');

$fromnoorder=$_POST['fromnoorder'];
$tonoorder=$_POST['tonoorder'];

$sql="SELECT * FROM `tbl_order` WHERE `acceptstatus`=1 AND `status`=1 AND `idtbl_order` BETWEEN '$fromnoorder' AND '$tonoorder'";
$result=$conn->query($sql);
?>
<div class="scrollbar pb-3" id="style-2">
<table class="table table-striped table-bordered table-sm small nowrap" id="tblordersheet">
    <thead>
        <tr>
            <th colspan="2">ORDER  DETAILS</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="8">DELIVERD BY</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <th>DATE</th>
            <th>ORDER NO</th>
            <th>FDE TRA#</th>
            <th class="text-right">AMOUNT</th>
            <th class="text-right">NET TOTAL</th>
            <th>FDE</th>
            <th>DO</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>FINAL CHECKED BY</th>
            <th>SIG</th>
            <th>CASH REC</th>
            <th>REMARKS</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row=$result->fetch_assoc()){
        ?>
        <tr>
            <td nowrap>&nbsp;</td>
            <td nowrap><?php echo $row['idtbl_order']; ?></td>
            <td nowrap><?php echo $row['trackingnum']; ?></td>
            <td class="text-right" nowrap><?php echo $row['total']; ?></td>
            <td class="text-right" nowrap><?php echo $row['nettotal']; ?></td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
            <td nowrap>&nbsp;</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>