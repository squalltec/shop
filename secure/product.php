<?php 
include "include/header.php";  

$sql="SELECT `tbl_product`.*, `tbl_product_category`.`category`, `tbl_product_sub_category`.`subcategory` FROM `tbl_product` LEFT JOIN `tbl_product_category` ON `tbl_product_category`.`idtbl_product_category`=`tbl_product`.`tbl_product_category_idtbl_product_category` LEFT JOIN `tbl_product_sub_category` ON `tbl_product_sub_category`.`idtbl_product_sub_category`=`tbl_product`.`tbl_product_sub_category_idtbl_product_sub_category` WHERE `tbl_product`.`status` IN (1,2)";
$result =$conn-> query($sql); 

$sqlcategory="SELECT `idtbl_product_category`, `category` FROM `tbl_product_category` WHERE `status`=1";
$resultcategory=$conn->query($sqlcategory);

$sqlcolour="SELECT `idtbl_product_colour`, `colour` FROM `tbl_product_colour` WHERE `status`=1";
$resultcolour=$conn->query($sqlcolour);

$sqlflavour="SELECT `idtbl_product_flavour`, `flavour` FROM `tbl_product_flavour` WHERE `status`=1";
$resultflavour=$conn->query($sqlflavour);

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
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaladdproduct"><i class="fas fa-plus mr-2"></i>Add New Product</button>
                                <hr class="my-3">
                            </div>
                            <div class="col-12">
                                <div class="scrollbar pb-3" id="style-2">
                                    <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th class="text-right">Sale Price</th>
                                                <th class="text-right">Display Price</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
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
<!-- Modal Add Product -->
<div class="modal fade" id="modaladdproduct" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header p-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="productform" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold text-dark">Product*</label>
                                <input id="productName" type="text" name="productName" class="form-control form-control-sm" required>
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
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Sub Category</label>
                                    <select class="form-control form-control-sm" name="subcategory" id="subcategory" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Colour</label><br>
                                    <select class="form-control form-control-sm" style="width:100%;" name="colour[]" id="colour" multiple>
                                        <?php if($resultcolour->num_rows > 0) {while ($rowcolour = $resultcolour-> fetch_assoc()) { ?>
                                        <option value="<?php echo $rowcolour['idtbl_product_colour'] ?>"><?php echo $rowcolour['colour'] ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Flavour</label><br>
                                    <select class="form-control form-control-sm" style="width:100%;" name="flavour[]" id="flavour" multiple>
                                        <?php if($resultflavour->num_rows > 0) {while ($rowflavour = $resultflavour-> fetch_assoc()) { ?>
                                        <option value="<?php echo $rowflavour['idtbl_product_flavour'] ?>"><?php echo $rowflavour['flavour'] ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Brand*</label>
                                    <div class="input-group input-group-sm">
                                        <select class="form-control" name="brand" id="brand" required>
                                            <option value="">Select</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark" type="button" data-toggle="modal" data-target="#brandmodal"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Barcode</label>
                                    <input id="barcode" type="text" name="barcode" class="form-control form-control-sm" placeholder="">
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Custom Code</label>
                                    <input id="cuscode" type="text" name="cuscode" class="form-control form-control-sm" placeholder="">
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Weight*</label>
                                    <input id="weight" type="number" name="weight" class="form-control form-control-sm" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Stock*</label>
                                    <input id="stockqty" type="number" name="stockqty" class="form-control form-control-sm" placeholder="" required>
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Price*</label>
                                    <input id="saleprice" type="number" name="saleprice" step="any" class="form-control form-control-sm" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Special Price</label>
                                    <input id="displayprice" type="number" name="displayprice" class="form-control form-control-sm" placeholder="">
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">From</label>
                                    <input id="disfrom" type="date" name="disfrom" class="form-control form-control-sm" placeholder="">
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">To</label>
                                    <input id="disto" type="date" name="disto" class="form-control form-control-sm" placeholder="">
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Short Description</label>
                                    <textarea class="form-control form-control-sm texteditor" name="shortdesc" id="shortdesc"></textarea>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Long Description</label>
                                    <textarea class="form-control form-control-sm texteditor" name="maindesc" id="maindesc"></textarea>
                                </div>
                            </div>
                            <!-- <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Specification</label>
                                    <textarea class="form-control form-control-sm ckeditor" name="specification" id="specification"></textarea>
                                </div>
                            </div> -->
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Product Video Link</label>
                                    <input type="text" name="productvideo" id="productvideo" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Product Images</label>
                                    <input type="file" name="productimages[]" id="productimages" class="form-control form-control-sm" multiple  style="padding-bottom:32px;">
                                    <!-- <small id="" class="form-text text-danger">Image size 800X800 Pixel</small> -->
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <button type="button" id="submitproductBtn" onclick="tinyMCE.triggerSave(true,true);" class="btn btn-outline-primary btn-sm px-5 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add</button>
                                <input type="reset" id="hidereset" class="d-none">
                                <input type="submit" class="d-none" id="hideproductsubmit">
                            </div>
                            <input type="hidden" name="recordOption" id="recordOption" value="1">
                            <input type="hidden" name="recordID" id="recordID" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Brand Add -->
<div class="modal fade" id="brandmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header p-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="formbrand" autocomplete="off">
                            <div class="form-group">
                                <label class="small font-weight-bold text-dark">Product Brand*</label>
                                <input type="text" class="form-control form-control-sm" name="productbrand" id="productbrand" required>
                            </div>
                            <div class="form-group mt-2">
                                <button type="button" id="submitBrandBtn" class="btn btn-outline-primary btn-sm px-4 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add</button>
                                <input type="submit" id="hidebrandsubmit" class="d-none">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
        $("#colour").select2();
        $("#flavour").select2();
        loadbrandlist();
        datatableview();

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
                        $('#barcode').val(obj.barcode); 
                        $('#weight').val(obj.weight); 
                        $('#cuscode').val(obj.customcode); 
                        $('#stockqty').val(obj.stock); 
                        $('#displayprice').val(obj.disprice); 
                        $('#disfrom').val(obj.disfrom); 
                        $('#disto').val(obj.disto); 
                        $('#productvideo').val(obj.videolink); 
                        $('#brand').val(obj.brand); 

                        loadsubcategory(obj.category, obj.subcategory);   

                        tinyMCE.get('shortdesc').setContent(obj.shortdesc);
                        
                        tinyMCE.get('maindesc').setContent(obj.desc);

                        // CKEDITOR.instances['specification'].setData(obj.specification); 

                        var colourlist = obj.colour;
                        var colourlistoption = [];
                        $.each(colourlist, function(i, item) {
                            colourlistoption.push(colourlist[i].colourid);
                        });

                        $('#colour').val(colourlistoption);
                        $('#colour').trigger('change');   

                        var flavourlist = obj.flavour;
                        var flavourlistoption = [];
                        $.each(flavourlist, function(i, item) {
                            flavourlistoption.push(flavourlist[i].flavourid);
                        });

                        $('#flavour').val(flavourlistoption);
                        $('#flavour').trigger('change');             

                        $('#recordOption').val('2');
                        $('#submitproductBtn').html('<i class="far fa-save"></i>&nbsp;Update');

                        $('#productlistimages').removeAttr('required');
                        $('#modaladdproduct').modal('show');
                    }
                });
            }
        });

        $('#dataTable tbody').on('click', '.btnview', function() {
            var id = $(this).attr('id');
            loadimages(id);
            $('#modalimageview').modal('show');
        });

        $('#dataTable tbody').on('click', '.deactive', function() {
            var r = confirm("Are you sure you want to deactive this? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type = '2';
                statuschange(id, type);
            }
        });

        $('#dataTable tbody').on('click', '.active', function() {
            var r = confirm("Are you sure you want to active this? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type = '1';
                statuschange(id, type);
            }
        });

        $('#dataTable tbody').on('click', '.delete', function() {
            var r = confirm("Are you sure you want to remove this? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type = '3';
                statuschange(id, type);
            }
        });

        $('#category').change(function(){
            var categoryID = $(this).val();
            var value = '';
            
            loadsubcategory(categoryID, value);
        });

        $('#modaladdproduct').on('hidden.bs.modal', function (event) {
            $('#hidereset').click();
            $("#colour").val("");
            $('#colour').trigger('change');
            $("#flavour").val("");
            $('#flavour').trigger('change');
        });

        $('#submitBrandBtn').click(function(){
            if (!$("#formbrand")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hidebrandsubmit").click();
            } else {
                var productbrand=$('#productbrand').val();
                var recordOption=1;
                var recordID='';

                $.ajax({
                    type: "POST",
                    data: {
                        productbrand: productbrand,
                        recordOption: recordOption,
                        recordID: recordID
                    },
                    url: 'process/productbrandprocess.php',
                    success: function(result) { //alert(result);
                        loadbrandlist();
                        $('#brandmodal').modal('hide');
                    }
                });
            }
        });

        $('#submitproductBtn').click(function(){
            if (!$("#productform")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hideproductsubmit").click();
            } else {  
                var formData = new FormData($('#productform')[0]);

                $.ajax({
                    url: 'process/productprocess.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {//alert(response);
                        // console.log(response);
                        $('#modaladdproduct').modal('hide');
                        action(response);
                        $('#hidereset').click();
                        $('#dataTable').DataTable().ajax.reload( null, false );
                    }
                });
            } 
        });
    });

    function loadsubcategory(categoryID, value){
        $.ajax({
            type: "POST",
            data: {
                categoryID: categoryID
            },
            url: 'getprocess/getsubcategoryaccocategory.php',
            success: function(result) { //alert(result);
                var objfirst = JSON.parse(result);
                var html = '';
                html += '<option value="">Select</option>';
                $.each(objfirst, function(i, item) {
                    //alert(objfirst[i].id);
                    html += '<option value="' + objfirst[i].subcateid + '">';
                    html += objfirst[i].subcate;
                    html += '</option>';
                });

                $('#subcategory').empty().append(html);

                if(value!=''){
                     $('#subcategory').val(value);
                }
            }
        });
    }

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
    
    function loadbrandlist(){
        $.ajax({
            type: "POST",
            data: {},
            url: 'getprocess/getbrandlist.php',
            success: function(result) { //alert(result);
                var objfirst = JSON.parse(result);
                var html = '';
                html += '<option value="">Select</option>';
                $.each(objfirst, function(i, item) {
                    //alert(objfirst[i].id);
                    html += '<option value="' + objfirst[i].brandid + '">';
                    html += objfirst[i].brand;
                    html += '</option>';
                });

                $('#brand').empty().append(html);
            }
        });
    }

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

    function datatableview(){
        var addcheck='<?php echo $addcheck; ?>';
        var editcheck='<?php echo $editcheck; ?>';
        var statuscheck='<?php echo $statuscheck; ?>';
        var deletecheck='<?php echo $deletecheck; ?>';

        $('#dataTable').DataTable( {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "scripts/productlist.php",
                type: "POST", // you can use GET
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": "idtbl_product"
                },
                {
                    "data": "productname"
                },
                {
                    "data": "category"
                },
                {
                    "data": "subcategory"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        return addCommas(parseFloat(full['price']).toFixed(2));
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        return addCommas(parseFloat(full['disprice']).toFixed(2));
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button='';
                        button+='<button class="btn btn-outline-dark btn-sm btnview mr-1 ';if(editcheck==0){button+='d-none';}button+='" id="'+full['idtbl_product']+'"><i class="fas fa-image"></i></button>';
                        button+='<button class="btn btn-outline-primary btn-sm btnEdit mr-1 ';if(editcheck==0){button+='d-none';}button+='" id="'+full['idtbl_product']+'"><i class="fas fa-pen"></i></button>';
                        if(full['status']==1){
                        button+='<button type="button" id="'+full['idtbl_product']+'" class="btn btn-outline-success btn-sm mr-1 deactive ';if(statuscheck==0){button+='d-none';}button+='"><i class="fas fa-check"></i></button>';
                        }else {
                        button+='<button type="button" id="'+full['idtbl_product']+'" class="btn btn-outline-warning btn-sm mr-1 active ';if(statuscheck==0){button+='d-none';}button+='"><i class="fas fa-times"></i></button>';
                        }
                        button+='<button type="button" id="'+full['idtbl_product']+'" class="btn btn-outline-danger btn-sm delete ';if(deletecheck==0){button+='d-none';}button+='"><i class="far fa-trash-alt"></i></button>';
                        
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        } );
    }

    function addCommas(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function statuschange(id, type){
        $.ajax({
            type: "GET",
            data: {
                record: id,
                type: type
            },
            url: 'process/statusproduct.php',
            success: function(result) { //alert(result);
                action(result);
                $('#dataTable').DataTable().ajax.reload( null, false );
            }
        });
    }
</script>
<?php include "include/footer.php"; ?>
