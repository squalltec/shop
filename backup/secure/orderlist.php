<?php 
include "include/header.php";  

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
                            <div class="page-header-icon"><i data-feather="list"></i></div>
                            <span>Order List</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="scrollbar pb-3" id="style-2">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="custom-control custom-checkbox ml-2 mb-2">
                                                <input type="checkbox" class="custom-control-input checkallocate" id="selectAll">
                                                <label class="custom-control-label" for="selectAll">Select All Records</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-outline-danger btn-sm" id="btnbulkconfirm"><i class="fas fa-check mr-2"></i>Confirm All Orders</button>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>#</th>
                                                <th>Order No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Order Date</th>
                                                <th>Tracking Code</th>
                                                <th class="text-right">Total</th>
                                                <th class="text-center">Payment</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <span class="badge bg-danger-soft px-2 mt-4">&nbsp;</span> Drop ship order
                                <span class="badge bg-info-soft px-2 mt-4">&nbsp;</span> Other delivery location order
                                <span class="badge bg-secondary-soft px-2 mt-4">&nbsp;</span> Colombo Area Order
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
<!-- Modal View -->
<div class="modal fade" id="modalviewdetail" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headertitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalviewbody"></div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hideorderno" value=''>
                <button class="btn btn-outline-primary btn-sm fa-pull-right" id="btncourierprint"><i class="far fa-id-card"></i>&nbsp;Print Courier</button>
                <button class="btn btn-outline-danger btn-sm fa-pull-right" id="btnreceiptprint"><i class="fas fa-print"></i>&nbsp;Print Receipt</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Track -->
<div class="modal fade" id="modaltrack" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Tracking Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formtracking">
                    <div class="form-group mb-1">
                        <label class="small font-weight-bold text-dark">Tracking Code*</label>
                        <input type="text" class="form-control form-control-sm" name="trackingcode" id="trackingcode">
                    </div>
                    <div class="form-group mb-1">
                        <label class="small font-weight-bold text-dark">Url</label>
                        <input type="text" class="form-control form-control-sm" name="trackingurl" id="trackingurl" required value="https://fardardomestic.com/">
                    </div>
                    <div class="form-group mt-3">
                        <button type="button" id="submitBtn" class="btn btn-outline-primary btn-sm w-50 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Add</button>
                        <input type="submit" id="hidesubmit" class="d-none">
                    </div>
                    <input type="hidden" name="orderid" id="orderid" value="">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Track -->
<div class="modal fade" id="modalcancel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Cancel Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process/statusorder.php" method="post">
                    <div class="form-group mb-1">
                        <label class="small font-weight-bold text-dark">Cancel Reason*</label>
                        <textarea type="text" class="form-control form-control-sm" name="cancelreason" id="cancelreason" required rows="5"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" id="submitBtn" class="btn btn-outline-danger btn-sm px-4 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="far fa-save"></i>&nbsp;Cancel Order</button>
                    </div>
                    <input type="hidden" name="recordID" id="recordID" value="">
                    <input type="hidden" name="type" id="type" value="4">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal View -->
<div class="modal fade" id="modalcourierdetail" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headertitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalviewcourierbody"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger btn-sm fa-pull-right px-3" id="btnprint"><i class="fas fa-print"></i>&nbsp;Print</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Track -->
<div class="modal fade" id="modalreturn" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Return Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process/statusorder.php" method="post">
                    <div class="form-group mb-1">
                        <label class="small font-weight-bold text-dark">Order Total</label>
                        <input type="text" class="form-control form-control-sm" name="returnordertotal" id="returnordertotal" readonly>
                    </div>
                    <div class="form-group mb-1">
                        <label class="small font-weight-bold text-dark">Return Price*</label>
                        <input type="text" class="form-control form-control-sm" name="returnprice" id="returnprice" required>
                    </div>
                    <div class="form-group mb-1">
                        <label class="small font-weight-bold text-dark">Return Reason*</label>
                        <textarea class="form-control form-control-sm" name="returnreason" id="returnreason" required rows="5"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" id="submitreturnBtn" class="btn btn-outline-danger btn-sm px-4 fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>><i class="fas fa-redo-alt"></i>&nbsp;Return Order</button>
                    </div>
                    <input type="hidden" name="recordreturnID" id="recordreturnID" value="">
                    <input type="hidden" name="type" id="type" value="8">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal View Receipt -->
<div class="modal fade" id="modalviewreceipt" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headertitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="modalreceiptviewbody"></div>
            </div>
        </div>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {
        loaddatatable();
        $('#selectAll').click(function (e) {
            $('#dataTable').closest('table').find('td input:checkbox').prop('checked', this.checked);
        });

        $('#dataTable tbody').on('click', '.btnpayment', function() {
            var r = confirm("Are you sure, Payment complete this order ? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type= '1';
                statuschange(id, type);
            }
        });
        $('#dataTable tbody').on('click', '.btnship', function() {
            var r = confirm("Are you sure, Ship this order ? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type= '2';
                statuschange(id, type);
            }
        });
        $('#dataTable tbody').on('click', '.btndelivery', function() {
            var r = confirm("Are you sure, Delivery complete this order ? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type= '3';
                statuschange(id, type);
            }
        });
        $('#dataTable tbody').on('click', '.btncancel', function() {
            var r = confirm("Are you sure, Cancel this order ? ");
            if (r == true) {
                var id = $(this).attr('id');
                $('#recordID').val(id);
                $('#modalcancel').modal('show');
            }
        });
        $('#dataTable tbody').on('click', '.btnview', function() {
            var id = $(this).attr('id');
            $('#hideorderno').val(id);
            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: 'getprocess/getorderdetail.php',
                success: function(result) { //alert(result);
                    $('#headertitle').html('PO00'+id);
                    $('#modalviewbody').html(result);
                    $('#modalviewdetail').modal('show');
                }
            });
        });
        $('#dataTable tbody').on('click', '.btnaccept', function() {
            var r = confirm("Are you sure, Accept this order ? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type= '5';
                statuschange(id, type);
            }
        });
        $('#dataTable tbody').on('click', '.btntracking', function() {
            var id = $(this).attr('id');
            $('#orderid').val(id);
            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: 'getprocess/gettrakingnoaccoorder.php',
                success: function(result) { //alert(result);
                    $('#trackingcode').val(result);
                    $('#modaltrack').modal('show');
                }
            });
        });
        $('#dataTable tbody').on('click', '.btncall', function() {
            var r = confirm("Are you sure, customer not confirm this order ? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type= '6';
                statuschange(id, type);
            }
        });
        $('#dataTable tbody').on('click', '.btnreactive', function() {
            var r = confirm("Are you sure, you want to active again this oreder ? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type= '7';
                statuschange(id, type);
            }
        });
        $('#dataTable tbody').on('click', '.btnreturn', function() {
            var r = confirm("Are you sure, ths order is return back ? ");
            if (r == true) {
                var row = $(this).closest("tr"),        // Finds the closest row <tr> 
                tds = row.find("td:eq(7)").text(); // Finds the 2nd <td> element

                var id = $(this).attr('id');
                $('#recordreturnID').val(id);
                $('#returnordertotal').val(tds);
                $('#modalreturn').modal('show');
            }
        });
        $('#dataTable tbody').on('click', '.btnpaydone', function() {
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: 'getprocess/getreceiptaccoorder.php',
                success: function(result) { //alert(result);
                    $('#modalreceiptviewbody').html(result);
                    $('#modalviewreceipt').modal('show');
                }
            });
            
        });
        
        $('#submitBtn').click(function(){
            if (!$("#formtracking")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hidesubmit").click();
            } else {  
                var orderID = $('#orderid').val();
                var trackingcode = $('#trackingcode').val();
                var trackingurl = $('#trackingurl').val();
                
                $.ajax({
                    type: "POST",
                    data: {
                        orderID: orderID,
                        trackingcode: trackingcode,
                        trackingurl: trackingurl,
                    },
                    url: 'process/ordertrackingprocess.php',
                    success: function(result) { //alert(result);
                        action(result);
                        $('#dataTable').DataTable().ajax.reload( null, false );
                        $('#modaltrack').modal('hide');
                    }
                });
            } 
        });
        $('#btncourierprint').click(function(){
            var id = $('#hideorderno').val();

            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: 'getprocess/getordercourierdetail.php',
                success: function(result) { //alert(result);
                    $('#modalviewcourierbody').html(result);
                    $('#modalcourierdetail').modal('show');
                }
            });
        });

        $('#btnbulkconfirm').click(function(){
            $('#btnbulkconfirm').prop('disabled', true);
            var tablelist = $("#dataTable tbody input[type=checkbox]:checked");
                
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
                        tabledata: myJSON
                    },
                    url: 'process/bulkconfirmprocess.php',
                    success: function(result) { //alert(result);
                        //console.log(result);
                        $('#selectAll').prop('checked', false);
                        $('#dataTable').DataTable().ajax.reload( null, false );
                        $('#btnbulkconfirm').prop('disabled', false);
                        // loaddatatable();
                    }
                });
            }
        });

        document.getElementById('btnreceiptprint').addEventListener ("click", print);
        document.getElementById('btnprint').addEventListener ("click", printcourier);
    });
    function statuschange(id, type){
        var cancelreason = '';
        $.ajax({
            type: "POST",
            data: {
                recordID: id,
                type: type,
                cancelreason: cancelreason
            },
            url: 'process/statusorder.php',
            success: function(result) { //alert(result);
                action(result);
                $('#dataTable').DataTable().ajax.reload( null, false );
                // loaddatatable();
            }
        });
        if(type==2){
            $.ajax({
                type: "POST",
                data: {
                    recordID: id
                },
                url: 'getprocess/gettracknumaccoorder.php',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);

                    $.get('https://bulksms.hutch.lk/sendsmsmultimask.php?USER=eRavTest&PWD=erav@123&MASK=eRav Test&NUM=94'+obj.mobile+'&MSG='+obj.msg);
                }
            });
        }        
    }
    function loaddatatable(){
        $('#dataTable').DataTable( {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "scripts/orderlist.php",
                type: "POST", // you can use GET
            },
            "order": [[ 0, "desc" ]],
            "lengthMenu": [10],
            "columns": [
                {
                    "targets": -1,
                    "className": 'text-center',
                    "data": null,
                    "render": function(data, type, full) {
                        if(full['status']==1 && full['acceptstatus']==0){
                            return '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input checkallocate" id="'+full['idtbl_order']+'"><label class="custom-control-label"></label></div>';
                        }
                        else{
                            return '';
                        }
                    }
                },
                {
                    "data": "idtbl_order"
                },
                {
                    "targets": -1,
                    "data": null,
                    "render": function(data, type, full) {
                        return 'PO00'+full['idtbl_order'];
                    }
                },
                {
                    "data": "firstname"
                },
                {
                    "data": "lastname"
                },
                {
                    "data": "orderdate"
                },
                {
                    "data": "trackingnum"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        if(full['dropdiscountstatus']==1){
                            return '<span class="text-danger">Rs '+parseFloat(full['total']).toFixed(2)+'</span>';
                        }
                        else{
                            return 'Rs '+parseFloat(full['nettotal']).toFixed(2);
                        }
                    }
                },
                {
                    "targets": -1,
                    "data": null,
                    "className": 'text-center',
                    "render": function(data, type, full) {
                        if(full['paystatus']==1){return '<i class="text-success fas fa-check-circle"></i>&nbsp;Complete';}
                        else{return '<i class="text-warning fas fa-spinner"></i>&nbsp;Pendding';}
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-center',
                    "data": null,
                    "render": function(data, type, full) {
                        if(full['shipstatus']==0 && full['status']==1){return '<i class="text-info fas fa-times-circle"></i>&nbsp;Not Ship';}
                        else if(full['deliverystatus']==0 && full['status']==1){return '<i class="text-primary fas fa-spinner"></i>&nbsp;Ongoing';}
                        else if(full['deliverystatus']==1 && full['status']==1){return '<i class="text-success fas fa-check-circle"></i>&nbsp;Delivered';}
                        else if(full['status']==2){return '<i class="text-danger fas fa-times-circle"></i>&nbsp;Canceled';}
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button='';
                        button+='<button class="btn btn-outline-dark btn-sm btnview mr-1" id="'+full['idtbl_order']+'"><i class="far fa-eye"></i></button>';
                        if(full['status']==2){
                            button+='<button class="btn btn-secondary btn-sm btnreactive mr-1" id="'+full['idtbl_order']+'"><i class="fas fa-check"></i></button>';
                        }

                        if(full['callstatus']==0 && full['status']==1){
                            button+='<button class="btn btn-success btn-sm btncall mr-1" id="'+full['idtbl_order']+'"><i class="fas fa-phone"></i></button>';
                        }
                        else if(full['status']==1){
                            button+='<button class="btn btn-danger btn-sm mr-1"><i class="fas fa-phone"></i></button>';
                        }

                        if(full['status']==1){
                            button+='<button class="btn btn-outline-secondary btn-sm btntracking mr-1" id="'+full['idtbl_order']+'"><i class="fas fa-map-marker-alt"></i></button>'
                        }

                        if(full['acceptstatus']==0 && full['status']==1){button+='<button class="btn btn-outline-orange btn-sm btnaccept mr-1" data-toggle="tooltip" data-placement="bottom" title="Not Accept Order" id="'+full['idtbl_order']+'"><i class="fas fa-times"></i></button>';}
                        else if(full['acceptstatus']==1 && full['status']==1){button+='<button class="btn btn-outline-success btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Accepted Order"><i class="fas fa-check"></i></button>';}

                        if(full['paystatus']==0 && full['status']==1){button+='<button class="btn btn-outline-danger btn-sm mr-1 btnpayment" id="'+full['idtbl_order']+'"><i class="fas fa-money-bill-alt"></i></button>';}
                        else if(full['status']==1){button+='<button class="btn btn-outline-success btn-sm mr-1 btnpaydone" id="'+full['idtbl_order']+'"><i class="fas fa-money-bill-alt"></i></button>';}

                        if(full['shipstatus']==0 && full['status']==1){button+='<button class="btn btn-outline-danger btn-sm mr-1 btnship" data-toggle="tooltip" data-placement="bottom" title="Order not ship" id="'+full['idtbl_order']+'"><i class="fas fa-dolly"></i></button>';}
                        else if(full['status']==1){button+='<button class="btn btn-outline-success btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Order shipped"><i class="fas fa-dolly"></i></button>';}

                        if(full['deliverystatus']==0 && full['status']==1){button+='<button class="btn btn-outline-danger btn-sm mr-1 btndelivery" id="'+full['idtbl_order']+'"><i class="fas fa-truck"></i></button>';}
                        else if(full['status']==1){button+='<button class="btn btn-outline-success btn-sm mr-1"><i class="fas fa-truck"></i></button>';}

                        if(full['deliverystatus']==0 && full['status']==1){button+='<button class="btn btn-outline-danger btn-sm mr-1 btncancel" id="'+full['idtbl_order']+'"><i class="fas fa-window-close"></i></button><button class="btn btn-primary btn-sm btnreturn" id="'+full['idtbl_order']+'"><i class="fas fa-redo-alt"></i></button>';}
                        return button;
                    }
                }
            ],
            "createdRow": function( row, data, dataIndex){
                if(data['shipcost']  == 200 && data['status']  != 2){
                    $(row).addClass('bg-secondary-soft');
                }
                else if ( data['otherdeliverystatus']  == 1) {
                    $(row).addClass('bg-info-soft');
                }
            },
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        } );
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
    function print() {
        printJS({
            printable: 'modalviewbody',
            type: 'html',
            style: '@page { size: A5 portrait; margin:0.25cm; }',
            targetStyles: ['*']
        })
    }
    function printcourier() {
        printJS({
            printable: 'modalviewcourierbody',
            type: 'html',
            style: '@page { size: 5.5in 5.5in portrait; margin:0.25cm; }',
            targetStyles: ['*']
        })
    }
    
</script>
<?php include "include/footer.php"; ?>
