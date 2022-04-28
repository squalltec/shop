<?php 
include "include/header.php";  

$sql="SELECT * FROM `tbl_product` WHERE `status` IN (1,2)";
$result =$conn-> query($sql); 

$sqlcategory="SELECT `idtbl_product_category`, `product_category` FROM `tbl_product_category` WHERE `status`=1";
$resultcategory=$conn->query($sqlcategory);

include "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include "include/menubar.php"; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header page-header-light bg-white shadow">
                <div class="container-fluid">
                    <div class="page-header-content py-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                            <span>Product</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-5">
                                <form action="process/productprocess.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">Product*</label>
                                        <input id="productName" type="text" name="productName" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Short Description</label>
                                            <textarea class="form-control form-control-sm ckeditor" name="shortdesc" id="shortdesc"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Description</label>
                                            <textarea class="form-control form-control-sm ckeditor" name="maindesc" id="maindesc"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Specification</label>
                                            <textarea class="form-control form-control-sm ckeditor" name="specification" id="specification"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Category*</label>
                                            <select class="form-control form-control-sm" name="category" id="category" required>
                                                <option value="">Select</option>
                                                <?php if($resultcategory->num_rows > 0) {while ($rowcategory = $resultcategory-> fetch_assoc()) { ?>
                                                <option value="<?php echo $rowcategory['idtbl_product_category'] ?>"><?php echo $rowcategory['product_category'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark mt-2">Sale Price</label>
                                            <input id="saleprice" type="text" name="saleprice" class="form-control form-control-sm" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Product Images</label>
                                            <input type="file" name="productimages[]" id="productimages" class="form-control form-control-sm" multiple  style="padding-bottom:32px;">
                                            <small id="" class="form-text text-danger">Image size 800X800 Pixel</small>
                                        </div>
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">List Image</label>
                                            <input type="file" name="productlistimages" id="productlistimages" class="form-control form-control-sm"  style="padding-bottom:32px;" required>
                                            <small id="" class="form-text text-danger">Image size 452X452 Pixel</small>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" id="submitBtn" class="btn btn-outline-primary btn-sm px-5 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add</button>
                                    </div>
                                    <input type="hidden" name="recordOption" id="recordOption" value="1">
                                    <input type="hidden" name="recordID" id="recordID" value="">
                                </form>
                            </div>
                            <div class="col-7">
                                <div class="scrollbar pb-3" id="style-2">
                                    <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Sale Price</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($result->num_rows > 0) {while ($row = $result-> fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $row['idtbl_product'] ?></td>
                                                <td><?php echo $row['productname'] ?></td>
                                                <td><?php $typeID=$row['tbl_product_category_idtbl_product_category']; $sqltype="SELECT `product_category` FROM `tbl_product_category` WHERE `idtbl_product_category`='$typeID'"; $resulttype =$conn-> query($sqltype); $rowtype = $resulttype-> fetch_assoc(); echo $rowtype['product_category']; ?></td>
                                                <td><?php echo number_format($row['price'], 2) ?></td>
                                                <td class="text-right">
                                                    <?php if($row['disstatus']==1){ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=1" onclick="return confirm('Are you sure you want to discount this product?');" target="_self" class="btn btn-outline-dark btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Discount Product"><i data-feather="check"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=2" onclick="return confirm('Are you sure you want to remove discount this product?');" target="_self" class="btn btn-outline-danger btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Discount Product"><i data-feather="x-square"></i></a>
                                                    <?php } ?>
                                                    <?php if($row['newstatus']==1){ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=3" onclick="return confirm('Are you sure you want to discount this product?');" target="_self" class="btn btn-outline-dark btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="New Product"><i data-feather="check"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=4" onclick="return confirm('Are you sure you want to remove discount this product?');" target="_self" class="btn btn-outline-danger btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="New Product"><i data-feather="x-square"></i></a>
                                                    <?php } ?>
                                                    <?php if($row['weekstatus']==1){ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=5" onclick="return confirm('Are you sure you want to discount this product?');" target="_self" class="btn btn-outline-dark btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Week Deals Product"><i data-feather="check"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=6" onclick="return confirm('Are you sure you want to remove discount this product?');" target="_self" class="btn btn-outline-danger btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Week Deals Product"><i data-feather="x-square"></i></a>
                                                    <?php } ?>
                                                    <?php if($row['topstatus']==1){ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=7" onclick="return confirm('Are you sure you want to discount this product?');" target="_self" class="btn btn-outline-dark btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Top Rated Product"><i data-feather="check"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="process/statuschangeproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=8" onclick="return confirm('Are you sure you want to remove discount this product?');" target="_self" class="btn btn-outline-danger btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Top Rated Product"><i data-feather="x-square"></i></a>
                                                    <?php } ?>

                                                    <button class="btn btn-outline-secondary btn-sm btnlistview" id="<?php echo $row['idtbl_product'] ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View list image"><i data-feather="image"></i></button>
                                                    <button class="btn btn-outline-dark btn-sm btnview" id="<?php echo $row['idtbl_product'] ?>"><i data-feather="image"></i></button>
                                                    <button class="btn btn-outline-primary btn-sm btnEdit <?php if($editcheck==0){echo 'd-none';} ?>" id="<?php echo $row['idtbl_product'] ?>"><i data-feather="edit-2"></i></button>
                                                    <?php if($row['status']==1){ ?>
                                                    <a href="process/statusproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=2" onclick="return confirm('Are you sure you want to deactive this?');" target="_self" class="btn btn-outline-success btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>"><i data-feather="check"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="process/statusproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=1" onclick="return confirm('Are you sure you want to active this?');" target="_self" class="btn btn-outline-warning btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>"><i data-feather="x-square"></i></a>
                                                    <?php } ?>
                                                    <a href="process/statusproduct.php?record=<?php echo $row['idtbl_product'] ?>&type=3" onclick="return confirm('Are you sure you want to remove this?');" target="_self" class="btn btn-outline-danger btn-sm <?php if($deletecheck==0){echo 'd-none';} ?>"><i data-feather="trash-2"></i></a>
                                                </td>
                                            </tr>
                                            <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
<!-- Modal Image View -->
<div class="modal fade" id="modalimageview" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div id="imagelist" class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('#dataTable tbody').on('click', '.btnEdit', function() {
            var r = confirm("Are you sure, You want to Edit this ? ");
            if (r == true) {
                var id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    data: {
                        recordID: id
                    },
                    url: 'getprocess/getproduct.php',
                    success: function(result) { //alert(result);
                        var obj = JSON.parse(result);
                        $('#recordID').val(obj.id);
                        $('#productName').val(obj.productname);                 
                        $('#saleprice').val(obj.price);                      
                        $('#category').val(obj.category);    

                        CKEDITOR.instances['shortdesc'].setData(obj.shortdesc);

                        CKEDITOR.instances['maindesc'].setData(obj.desc);

                        CKEDITOR.instances['specification'].setData(obj.specification);                 

                        $('#recordOption').val('2');
                        $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');

                        $('#productlistimages').removeAttr('required');
                    }
                });
            }
        });

        $('#dataTable tbody').on('click', '.btnview', function() {
            var id = $(this).attr('id');
            loadimages(id);
            $('#modalimageview').modal('show');
        });
        $('#dataTable tbody').on('click', '.btnlistview', function() {
            var id = $(this).attr('id');
            loadlistimages(id);
            $('#modalimageview').modal('show');
        });
    });

    function loadimages(productID){
        $('#imagelist').addClass('text-center');
        $('#imagelist').html('<img src="images/spinner.gif" class="img-fluid">');

        var removestatus = '<?php echo $deletecheck; ?>';
        $.ajax({
            type: "POST",
            data: {
                productID: productID,
                removestatus: removestatus
            },
            url: 'getprocess/getproductimages.php',
            success: function(result) { //alert(result);
                $('#imagelist').removeClass('text-center');
                $('#imagelist').html(result);
                optionimages(productID);
            }
        });
    }

    function loadlistimages(productID){
        $('#imagelist').addClass('text-center');
        $('#imagelist').html('<img src="images/spinner.gif" class="img-fluid">');

        $.ajax({
            type: "POST",
            data: {
                productID: productID
            },
            url: 'getprocess/getproductlistimages.php',
            success: function(result) { //alert(result);
                $('#imagelist').html(result);
            }
        });
    }

    function optionimages(productID){
        $('#productimagetable tbody').on('click', '.btnremoveimage', function() {
            var imageID=$(this).attr('id');
            var r = confirm("Are you sure, You want to Delete this ? ");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    data: {
                        imageID: imageID,
                        type: '3'
                    },
                    url: 'process/statusproductimages.php',
                    success: function(result) { //alert(result);
                        $('#imagelist').html(result);
                        loadimages(productID);
                    }
                });
            }
        });
    }
</script>
<?php include "include/footer.php"; ?>
