<?php 
include "include/header.php";  

$sqlcustomer="SELECT `idtbl_customer`, `firstname`, `lastname` FROM `tbl_customer` WHERE `status`=1 AND `tbl_user_idtbl_user` IN (SELECT `idtbl_user` FROM `tbl_user` WHERE `status`=1) ORDER BY `firstname` ASC";
$resultcustomer=$conn->query($sqlcustomer);

include "include/topnavbar.php"; 
?>
<style>
    .tableprint {
        table-layout: fixed;
    }
</style>
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
                            <div class="page-header-icon"><i data-feather="map-pin"></i></div>
                            <span>Order Tracking</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active text-decoration-none text-dark small" id="tacking-tab" data-toggle="tab" href="#tacking" role="tab"
                                    aria-controls="tacking" aria-selected="true">Tacking Apply</a>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <a class="nav-link text-decoration-none text-dark small" id="download-tab" data-toggle="tab" href="#download" role="tab"
                                    aria-controls="download" aria-selected="false">Download Tracking</a>
                            </li> -->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-decoration-none text-dark small" id="print-tab" data-toggle="tab" href="#print" role="tab"
                                    aria-controls="print" aria-selected="false">Invoice Bill Print</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-decoration-none text-dark small" id="ordersheet-tab" data-toggle="tab" href="#ordersheet" role="tab"
                                    aria-controls="ordersheet" aria-selected="false">Order Sheet Download</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-2" id="tacking" role="tabpanel" aria-labelledby="tacking-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="searchFrom">
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">From Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="fromno" name="fromno" value="" required>
                                                </div>
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">To Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="tono" name="tono" value="" required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="small font-weight-bold text-dark">&nbsp;</label><br>
                                                    <button class="btn btn-secondary btn-sm" type="button" id="formSearchBtn"><i data-feather="search"></i>&nbsp;View Order</button>
                                                    <button class="btn btn-danger btn-sm" type="button" id="btnaddtracking" disabled><i data-feather="map-pin"></i>&nbsp;Add Tracking</button>
                                                    <input type="submit" class="d-none" id="hidesubmitbtn">
                                                </div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <?php //echo sprintf('%012d', 1234567);  ?>
                                        <?php //$number='1225.50'; echo number_format((float)$number, 2, '', '');; ?>
                                        <hr class="border-dark">
                                        <div id="vieworderlist"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="searchExcelFrom">
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">From Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="fromnoexcel" name="fromnoexcel" value="" required>
                                                </div>
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">To Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="tonoexcel" name="tonoexcel" value="" required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="small font-weight-bold text-dark">&nbsp;</label><br>
                                                    <button class="btn btn-secondary btn-sm" type="button" id="formSearchExcellBtn"><i data-feather="search"></i>&nbsp;View Order</button>
                                                    <input type="submit" class="d-none" id="hideexcelsubmitbtn">
                                                </div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr class="border-dark">
                                        <table class="table table-striped table-bordered table-sm small" id="tableloadtrack">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Parcel Type</th>
                                                    <th>Order ID</th>
                                                    <th>Parcel Description</th>
                                                    <th>Recipient Name</th>
                                                    <th>Recipient Mobile</th>
                                                    <th>Recipient Address</th>
                                                    <th>Recipient City</th>
                                                    <th>COD Amount</th>
                                                    <th>Exchange</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div> -->
                            <div class="tab-pane fade" id="print" role="tabpanel" aria-labelledby="download-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="searchPrintFrom">
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">From Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="fromnoprint" name="fromnoprint" value="" required>
                                                </div>
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">To Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="tonoprint" name="tonoprint" value="" required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="small font-weight-bold text-dark">&nbsp;</label><br>
                                                    <button class="btn btn-secondary btn-sm" type="button" id="formSearchprintlBtn"><i data-feather="search"></i>&nbsp;View Order</button>
                                                    <button class="btn btn-danger btn-sm" type="button" id="btnprintallinv" disabled><i data-feather="printer"></i>&nbsp;Print All Invoice</button>
                                                    <input type="submit" class="d-none" id="hideprintsubmitbtn">
                                                </div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr class="border-dark">
                                        <div id="tableinfoprint"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ordersheet" role="tabpanel" aria-labelledby="download-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <form id="searchOrderFrom">
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">From Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="fromnoordersheet" name="fromnoordersheet" value="" required>
                                                </div>
                                                <div class="col-2">
                                                    <label class="small font-weight-bold text-dark">To Order No*</label>
                                                    <input type="text" class="form-control form-control-sm rounded-0" id="tonoordersheet" name="tonoordersheet" value="" required>
                                                </div>
                                                <div class="col-3">
                                                    <label class="small font-weight-bold text-dark">&nbsp;</label><br>
                                                    <button class="btn btn-secondary btn-sm" type="button" id="formSearchordersheetlBtn"><i data-feather="search"></i>&nbsp;View Order</button>
                                                    <button class="btn btn-success btn-sm" type="button" id="btndownloadsheet" disabled><i data-feather="file"></i>&nbsp;Download Sheet</button>
                                                    <input type="submit" class="d-none" id="hideordersheetsubmitbtn">
                                                </div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr class="border-dark">
                                        <div id="tableinfoordersheet"></div>
                                    </div>
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
<!-- Modal -->
<div class="modal fade" id="modaltrackingcode" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title" id="staticBackdropLabel">Add Tracking Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process/trackinglistaddprocess.php" method="POST" enctype="multipart/form-data">
                    <textarea name="orderlist" id="orderlist" class="d-none" rows="10"></textarea>
                    <div class="form-group mt-3">
                        <button type="submit" id="submituploadBtn" class="btn btn-outline-primary btn-sm px-3 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add Tracking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalprintpreview" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header p-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="printinvoiceview"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger btn-sm fa-pull-right" id="btnprint"><i class="fas fa-print"></i>&nbsp;Print Invoice</button>
            </div>
        </div>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<!-- <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script> -->
<script src="assets/js/tableToExcel.js"></script>
<script>
    $(document).ready(function() {
        $('#formSearchBtn').click(function(){
            if (!$("#searchFrom")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hidesubmitbtn").click();
            } else {
                var fromno = $('#fromno').val();
                var tono = $('#tono').val();

                $.ajax({
                    type: "POST",
                    data: {
                        fromno: fromno,
                        tono: tono
                    },
                    url: 'getprocess/getordertrackingenterlist.php',
                    success: function(result) { //alert(result);
                        $('#vieworderlist').html(result);
                        orderlistoption();
                        $('#btnaddtracking').prop('disabled', false);
                    }
                });
            }
        });

        $('#btnaddtracking').click(function(){
            var tablelist = $("#tableorderlist tbody input[type=checkbox]:checked");
                
            if(tablelist.length>0){
                jsonObj = [];
                tablelist.each(function() {
                    item = {}
                    var row = $(this).closest("tr");
                    item["orderid"] = row.find('td:eq(2)').text();
                    jsonObj.push(item);
                });
                var myJSON = JSON.stringify(jsonObj);
                $('#orderlist').val(myJSON);

                $('#submituploadBtn').click();

                // $.ajax({
                //     type: "POST",
                //     data: {
                //         orderlist: myJSON
                //     },
                //     url: 'process/trackinglistaddprocess.php',
                //     success: function(result) { alert(result);
                //         $('#formSearchBtn').click();
                //         action(result);
                //     }
                // });
            }
        });

        // $('#formSearchExcellBtn').click(function(){
        //     if (!$("#searchExcelFrom")[0].checkValidity()) {
        //         // If the form is invalid, submit it. The form won't actually submit;
        //         // this will just cause the browser to display the native HTML5 error messages.
        //         $("#hideexcelsubmitbtn").click();
        //     } else {
        //         var fromnoexcel = $('#fromnoexcel').val();
        //         var tonoexcel = $('#tonoexcel').val();

        //         $('#tableloadtrack').DataTable( {
        //             "destroy": true,
        //             "processing": true,
        //             "serverSide": true,
        //             paging: false,
        //             bInfo : false,
        //             dom: 'Bfrtip',
        //             buttons: [
        //                 { extend: 'excel', text: '<i class="fa fa-file-excel"></i> Excel', className: 'btn btn-outline-success btn-sm px-3' },
        //                 { extend: 'pdf', text: '<i class="fa fa-file-pdf"></i> PDF', className: 'btn btn-outline-danger btn-sm px-3' },
        //                 { extend: 'print', text: '<i class="fa fa-print"></i> Print', className: 'btn btn-outline-primary btn-sm px-3' },
        //                 //'excel', 'pdf', 'print'
        //             ],
        //             ajax: {
        //                 url: "getprocess/gettrackingcodelist.php",
        //                 type: "POST", // you can use GET
        //                 data: {
        //                     fromnoexcel: fromnoexcel,
        //                     tonoexcel: tonoexcel
        //                 }
        //             },
        //             "order": [[ 0, "asc" ]],
        //             "columns": [
        //                 {
        //                     "data": "ordertrack"
        //                 },
        //                 {
        //                     "data": "orderweight"
        //                 },
        //                 {
        //                     "data": "orderno"
        //                 },
        //                 {
        //                     "data": "orderdesc"
        //                 },
        //                 {
        //                     "data": "ordercus"
        //                 },
        //                 {
        //                     "data": "ordercontact"
        //                 },
        //                 {
        //                     "data": "orderaddress"
        //                 },
        //                 {
        //                     "data": "ordercity"
        //                 },
        //                 {
        //                     "data": "orderamount"
        //                 }
        //                 ,
        //                 {
        //                     "data": "orderexchange"
        //                 }
        //             ]
        //         } );
        //     }
        // });

        $('#formSearchprintlBtn').click(function(){
            if (!$("#searchPrintFrom")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hideprintsubmitbtn").click();
            } else {
                var fromnoprint = $('#fromnoprint').val();
                var tonoprint = $('#tonoprint').val();

                $.ajax({
                    type: "POST",
                    data: {
                        fromnoprint: fromnoprint,
                        tonoprint: tonoprint
                    },
                    url: 'getprocess/getorderinvoiceprintlist.php',
                    success: function(result) { //alert(result);
                        $('#tableinfoprint').html(result);
                        orderprintlistoption();
                        $('#btnprintallinv').prop('disabled', false);
                    }
                });
            }
        });

        $('#btnprintallinv').click(function(){
            var tablelist = $("#tableprintlist tbody input[type=checkbox]:checked");
                
            if(tablelist.length>0){
                jsonObj = [];
                tablelist.each(function() {
                    item = {}
                    var row = $(this).closest("tr");
                    item["orderid"] = row.find('td:eq(1)').text();
                    jsonObj.push(item);
                });
                var myJSON = JSON.stringify(jsonObj);
                
                $.ajax({
                    type: "POST",
                    data: {
                        myJSON: myJSON
                    },
                    url: 'getprocess/getprintviewlist.php',
                    success: function(result) { //alert(result);
                        $('#printinvoiceview').html(result);
                        $('#modalprintpreview').modal('show');
                    }
                });
            }
        });

        document.getElementById('btnprint').addEventListener ("click", print);

        $('#formSearchordersheetlBtn').click(function(){
            if (!$("#searchOrderFrom")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hideordersheetsubmitbtn").click();
            } else {
                var fromnoorder = $('#fromnoordersheet').val();
                var tonoorder = $('#tonoordersheet').val();

                $.ajax({
                    type: "POST",
                    data: {
                        fromnoorder: fromnoorder,
                        tonoorder: tonoorder
                    },
                    url: 'getprocess/getordersheetlist.php',
                    success: function(result) { //alert(result);
                        $('#tableinfoordersheet').html(result);
                        $('#btndownloadsheet').prop('disabled', false);
                    }
                });
            }
        });
        $('#btndownloadsheet').click(function(){
            TableToExcel.convert(document.getElementById("tblordersheet"), {
                name: "Order_sheet.xlsx",
                sheet: {
                    name: "Sheet 1"
                }
            });

            // let options = {
            //     "filename": "Order Sheet.csv"
            // }

            // $('#tblordersheet').table2csv('download', options);
        });
    });

    function orderlistoption(){
        $('#selectAll').click(function (e) {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
        });
    }
    function orderprintlistoption(){
        $('#selectPrintAll').click(function (e) {
            $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
        });
    }
    function print() {
        printJS({
            printable: 'printinvoiceview',
            type: 'html',
            style: '@page { size: A4 portrait; }',
            targetStyles: ['*']
        })
    }
    function action(data) { //alert(data);
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
