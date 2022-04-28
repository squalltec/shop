<?php 
include "include/header.php";  

$sql="SELECT `tbl_offer_image`.`idtbl_offer_image`, `tbl_offer_image`.`imagepath`, `tbl_offer_image`.`offertype`, `tbl_offer_image`.`status`, `tbl_product_category`.`category` FROM `tbl_offer_image` LEFT JOIN `tbl_product_category` ON `tbl_product_category`.`idtbl_product_category`=`tbl_offer_image`.`tbl_product_category_idtbl_product_category` WHERE `tbl_offer_image`.`status` IN (1,2)";
$result =$conn-> query($sql); 

$sqlcategory="SELECT `idtbl_product_category`, `category` FROM `tbl_product_category` WHERE `status`=1";
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
                            <div class="page-header-icon"><i data-feather="image"></i></div>
                            <span>Offer Images</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-3">
                                <form action="process/homeofferprocess.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Offer Type*</label>
                                            <select class="form-control form-control-sm" name="offertype" id="offertype" required>
                                                <option value="">Select</option>
                                                <option value="1">Top Offer</option>
                                                <option value="2">Middle Offer</option>
                                                <option value="3">Bottom Offer</option>
                                                <option value="4">Shop Top Offer</option>
                                                <option value="5">Product View Right</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Category*</label>
                                            <select class="form-control form-control-sm" name="category" id="category" required>
                                                <option value="">Select</option>
                                                <?php if($resultcategory->num_rows > 0) {while ($rowcategory = $resultcategory-> fetch_assoc()) { ?>
                                                <option value="<?php echo $rowcategory['idtbl_product_category'] ?>"><?php echo $rowcategory['category'] ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">Title One</label>
                                        <input type="text" class="form-control form-control-sm" name="titleone" id="titleone" maxlength="100">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">Title Two</label>
                                        <input type="text" class="form-control form-control-sm" name="titletwo" id="titletwo" maxlength="100">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">Title Three</label>
                                        <input type="text" class="form-control form-control-sm" name="titlethree" id="titlethree" maxlength="100">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">Title Four</label>
                                        <input type="text" class="form-control form-control-sm" name="titlefour" id="titlefour" maxlength="100">
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Images*</label>
                                            <input type="file" name="offerimages" id="offerimages" class="form-control form-control-sm" style="padding-bottom:32px;" required>
                                            <h6 class="form-text text-danger my-1 small">*** Image Type 1 size 610X200 Pixel / Image Type 2 size 610X200 Pixel / Image Type 3 size 1240X198 Pixel / Image Type 4 size 1240X300 Pixel / Image Type 5 size 280X220 Pixel ***</h6>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" id="submitBtn" class="btn btn-outline-primary btn-sm px-3 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add</button>
                                    </div>
                                    <input type="hidden" name="recordOption" id="recordOption" value="1">
                                    <input type="hidden" name="recordID" id="recordID" value="">
                                </form>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="form-text text-primary small">*** Image type 3 & 5 title one only enter number without % sign.</h6>
                                        </div>
                                </div>
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Offer Type</th>
                                            <th>Category</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($result->num_rows > 0) {while ($row = $result-> fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['idtbl_offer_image'] ?></td>
                                            <td><?php if($row['offertype']==1){echo 'Top Offer';}else if($row['offertype']==2){echo 'Middle Offer';}else if($row['offertype']==3){echo 'Bottom Offer';}else if($row['offertype']==4){echo 'Shop Top Offer';}else if($row['offertype']==5){echo 'Product View Right';} ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td class="text-right">
                                                <button class="btn btn-outline-dark btn-sm btnimage <?php if($addcheck==0){echo 'd-none';} ?>" id="<?php echo $row['imagepath'] ?>" data-toggle="tooltip" data-placement="bottom" title="View Image"><i data-feather="image"></i></button>
                                                <button class="btn btn-outline-primary btn-sm btnEdit <?php if($editcheck==0){echo 'd-none';} ?>" id="<?php echo $row['idtbl_offer_image'] ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i data-feather="edit-2"></i></button>
                                                <?php if($row['status']==1){ ?>
                                                <a href="process/statushomeoffer.php?record=<?php echo $row['idtbl_offer_image'] ?>&type=2" onclick="return confirm('Are you sure you want to deactive this?');" target="_self" class="btn btn-outline-success btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="Active"><i data-feather="check"></i></a>
                                                <?php }else{ ?>
                                                <a href="process/statushomeoffer.php?record=<?php echo $row['idtbl_offer_image'] ?>&type=1" onclick="return confirm('Are you sure you want to active this?');" target="_self" class="btn btn-outline-warning btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="Deactive"><i data-feather="x-square"></i></a>
                                                <?php } ?>
                                                <a href="process/statushomeoffer.php?record=<?php echo $row['idtbl_offer_image'] ?>&type=3" onclick="return confirm('Are you sure you want to remove this?');" target="_self" class="btn btn-outline-danger btn-sm <?php if($deletecheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="Remove"><i data-feather="trash-2"></i></a>
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
                    <div class="col-12 text-center">
                        <div id="imageview"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {
        $('#offertype').change(function(){
            if($(this).val()==2 | $(this).val()==4 | $(this).val()==5){
                $('#titlethree').prop('readonly', true);
                $('#titlefour').prop('readonly', true);
            }
            else if($(this).val()==3){
                $('#titlefour').prop('readonly', true);
                $('#titlethree').prop('readonly', false);
            }
            else{
                $('#titlethree').prop('readonly', false);
                $('#titlefour').prop('readonly', false);
            }
        });
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
                    url: 'getprocess/gethomeoffer.php',
                    success: function(result) { //alert(result);
                        var obj = JSON.parse(result);
                        $('#recordID').val(obj.id);
                        $('#offertype').val(obj.offertype);                    
                        $('#category').val(obj.category);                    
                        $('#titleone').val(obj.titleone);                    
                        $('#titletwo').val(obj.titletwo);                    
                        $('#titlethree').val(obj.titlethree);                    
                        $('#titlefour').val(obj.titlefour);    

                        $('#offerimages').prop('required', false);                

                        $('#recordOption').val('2');
                        $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
                    }
                });
            }
        });
        $('#dataTable tbody').on('click', '.btnimage', function() {
            var imagepath = $(this).attr('id');

            $('#imageview').html('<img src="../'+imagepath+'" class="img-fluid">');
            $('#modalimageview').modal('show');
        });
    });

</script>
<?php include "include/footer.php"; ?>
