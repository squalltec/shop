<?php 
require_once('../../connection/db.php');

$productID=$_POST['productID'];
$removestatus=$_POST['removestatus'];

$sql="SELECT `idtbl_product_images`, `imagepath` FROM `tbl_product_images` WHERE `tbl_product_idtbl_product`='$productID' AND `status`=1";
$result=$conn->query($sql);
?>
<table class="table table-striped table-bordered table-sm" id="productimagetable">
    <tbody>
        <?php while($row=$result->fetch_assoc()){ ?>
        <tr>
            <td>
                <img src="<?php echo "../".$row['imagepath'] ?>" width="150" height="150">
            </td>
            <td class="text-center">
                <button class="btn btn-outline-danger btn-sm btnremoveimage <?php if($removestatus==0){echo 'd-none';} ?>" id="<?php echo $row['idtbl_product_images'] ?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>