<?php 
include "include/header.php";  

$sql="SELECT * FROM `tbl_product_category` WHERE `status` IN (1,2)";
$result =$conn-> query($sql); 

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
                            <span>Prodcut Category</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-3">
                                <form action="process/productcategoryprocess.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">Prodcut Category*</label>
                                        <input type="text" class="form-control form-control-sm" name="productcategory" id="productcategory" required>
                                    </div>
                                    <div class="form-row mb-1">
                                        <div class="col">
                                            <label class="small font-weight-bold text-dark">Image</label>
                                            <input type="file" name="categoryimages" id="categoryimages" class="form-control form-control-sm"  style="padding-bottom:32px;">
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" id="submitBtn" class="btn btn-outline-primary btn-sm w-50 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add</button>
                                    </div>
                                    <input type="hidden" name="recordOption" id="recordOption" value="1">
                                    <input type="hidden" name="recordID" id="recordID" value="">
                                </form>
                            </div>
                            <div class="col-9">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Category</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($result->num_rows > 0) {while ($row = $result-> fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['idtbl_product_category'] ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td class="text-right">
                                                <button class="btn btn-outline-secondary btn-sm btnfrontspecial <?php if($addcheck==0){echo 'd-none';} ?>" id="<?php echo $row['idtbl_product_category'] ?>" data-toggle="tooltip" data-placement="bottom" title="Front Discount"><i class="fas fa-medal"></i></button>
                                                <button class="btn btn-outline-dark btn-sm btnimage <?php if($addcheck==0){echo 'd-none';} ?>" id="<?php echo $row['imagepath'] ?>" data-toggle="tooltip" data-placement="bottom" title="View Image"><i data-feather="image"></i></button>
                                                <button class="btn btn-outline-primary btn-sm btnEdit <?php if($editcheck==0){echo 'd-none';} ?>" id="<?php echo $row['idtbl_product_category'] ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i data-feather="edit-2"></i></button>
                                                <?php if($row['status']==1){ ?>
                                                <a href="process/statusproductcategory.php?record=<?php echo $row['idtbl_product_category'] ?>&type=2" onclick="return confirm('Are you sure you want to deactive this?');" target="_self" class="btn btn-outline-success btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="Active"><i data-feather="check"></i></a>
                                                <?php }else{ ?>
                                                <a href="process/statusproductcategory.php?record=<?php echo $row['idtbl_product_category'] ?>&type=1" onclick="return confirm('Are you sure you want to active this?');" target="_self" class="btn btn-outline-warning btn-sm <?php if($statuscheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="Deactive"><i data-feather="x-square"></i></a>
                                                <?php } ?>
                                                <a href="process/statusproductcategory.php?record=<?php echo $row['idtbl_product_category'] ?>&type=3" onclick="return confirm('Are you sure you want to remove this?');" target="_self" class="btn btn-outline-danger btn-sm <?php if($deletecheck==0){echo 'd-none';} ?>" data-toggle="tooltip" data-placement="bottom" title="Delete"><i data-feather="trash-2"></i></a>
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
<!-- Modal Image View -->
<div class="modal fade" id="modalfrontview" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header p-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                        <form id="formfronview" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Image</label>
                                    <input type="file" name="categoryfront" id="categoryfront" class="form-control form-control-sm"  style="padding-bottom:32px;" required>
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
                            <div class="form-group mt-3">
                                <button type="button" id="btnfrontsubmit" class="btn btn-outline-primary btn-sm px-3 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="fas fa-upload"></i>&nbsp;Upload</button>
                                <button type="button" id="btnfrontdeactive" class="btn btn-outline-danger btn-sm px-3 fa-pull-right mr-2" <?php if($addcheck==0){echo 'disabled';} ?> disabled><i class="fas fa-times"></i>&nbsp;Deactivate View</button>
                                <input type="submit" class="d-none" id="hidefonrtsubmit">
                            </div>
                            <input type="hidden" name="recodeidhide" id="recodeidhide" value="">
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7">
                        <div id="frontimageview"></div>
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
                    url: 'getprocess/getproductcategory.php',
                    success: function(result) { //alert(result);
                        var obj = JSON.parse(result);
                        $('#recordID').val(obj.id);
                        $('#productcategory').val(obj.productcategory);                       

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
        $('#dataTable tbody').on('click', '.btnfrontspecial', function() {
            var id=$(this).attr('id');
            $('#recodeidhide').val(id);
            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: 'getprocess/getproductcategoryfrontspecial.php',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);
                    if(obj.status>0){
                        $('#btnfrontdeactive').prop('disabled', false);
                        $('#titleone').val(obj.titleone);
                        $('#titletwo').val(obj.titletwo);
                        $('#titlethree').val(obj.titlethree);
                        $('#frontimageview').html('<img src="../'+obj.imagepath+'" class="img-fluid">');
                    }
                }
            });
            $('#modalfrontview').modal('show');
        });
        $('#btnfrontsubmit').click(function(){
            if (!$("#formfronview")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hidefonrtsubmit").click();
            } else {
                var formData = new FormData($('#formfronview')[0]);

                $.ajax({
                    url: 'process/productcategoryfrontspecialprocess.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {//alert(response);
                        $('#modalfrontview').modal('hide');
                        action(response);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            }
        });
        $('#btnfrontdeactive').click(function(){
            var r = confirm("Are you sure, You want to deactivate this ? ");
            if (r == true) {
                var recordID=$('#recodeidhide').val();
                window.location = "process/statusproductcategory.php?record="+recordID+"&type=4";
            }
        });
    });
    function action(data) { 
        var obj = JSON.parse(data);
        $.notify({
            // options
            icon: obj.icon,
            title: obj.title,
            message: obj.message,
            url: obj.url,
            target: obj.target
        }, {
            // settings
            element: 'body',
            position: null,
            type: obj.type,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 100,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
        });
    }
</script>
<?php include "include/footer.php"; ?>
