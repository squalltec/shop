<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_customer` WHERE `idtbl_customer`='$record' AND `status`=1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$sqladdtypeone="SELECT `address1`, `address2`, `city`, `country` FROM `tbl_customer_address` WHERE `type`=1 AND `status`=1 AND `tbl_customer_idtbl_customer`='$record'";
$resultaddtypeone=$conn->query($sqladdtypeone);
$rowaddtypeone=$resultaddtypeone->fetch_assoc();

$sqladdtypetwo="SELECT `address1`, `address2`, `city`, `country` FROM `tbl_customer_address` WHERE `type`=2 AND `status`=1 AND `tbl_customer_idtbl_customer`='$record'";
$resultaddtypetwo=$conn->query($sqladdtypetwo);
$rowaddtypetwo=$resultaddtypetwo->fetch_assoc();

?>
<h6 class="title-style small"><span>Personal Infrmation</span></h6>
<table class="table table-striped border-0 table-sm small">
    <tbody>
        <tr>
            <td width="30%">Full Name</td>
            <td width="5%">:</td>
            <td><?php echo $row['fullname']; ?></td>
        </tr>
        <tr>
            <td width="30%">Mobile</td>
            <td width="5%">:</td>
            <td><?php echo $row['phone']; ?></td>
        </tr>
        <tr>
            <td width="30%">Email</td>
            <td width="5%">:</td>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <tr>
            <td width="30%">Ref Code</td>
            <td width="5%">:</td>
            <td><?php echo $row['refcode']; ?></td>
        </tr>
        <tr>
            <td width="30%">Join Date</td>
            <td width="5%">:</td>
            <td><?php echo $row['joindate']; ?></td>
        </tr>
    </tbody>
</table>
<h6 class="title-style small"><span>Billing Address</span></h6>
<table class="table table-striped border-0 table-sm small">
    <tbody>
        <tr>
            <td width="30%">Address 1</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypeone['address1']; ?></td>
        </tr>
        <tr>
            <td width="30%">Address 2</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypeone['address2']; ?></td>
        </tr>
        <tr>
            <td width="30%">City</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypeone['city']; ?></td>
        </tr>
        <tr>
            <td width="30%">Country</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypeone['country']; ?></td>
        </tr>
    </tbody>
</table>
<h6 class="title-style small"><span>Shipping Address</span></h6>
<table class="table table-striped border-0 table-sm small">
    <tbody>
        <tr>
            <td width="30%">Address 1</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypetwo['address1']; ?></td>
        </tr>
        <tr>
            <td width="30%">Address 2</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypetwo['address2']; ?></td>
        </tr>
        <tr>
            <td width="30%">City</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypetwo['city']; ?></td>
        </tr>
        <tr>
            <td width="30%">Country</td>
            <td width="5%">:</td>
            <td><?php echo $rowaddtypetwo['country']; ?></td>
        </tr>
    </tbody>
</table>