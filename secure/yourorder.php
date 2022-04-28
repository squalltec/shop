<?php 
include "include/header.php";  

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
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            <span>Your Order List</span>
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
                                    <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order No</th>
                                                <th>Customer</th>
                                                <th>Order Date</th>
                                                <th class="text-right">Total</th>
                                                <th class="text-center">Payment</th>
                                                <th class="text-center">Status</th>
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
<!-- Modal -->
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
        </div>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {
        loaddatatable();
        $('#dataTable tbody').on('click', '.btncancel', function() {
            var r = confirm("Are you sure, Cancel this order ? ");
            if (r == true) {
                var id = $(this).attr('id');
                var type= '4';
                statuschange(id, type);
            }
        });
        $('#dataTable tbody').on('click', '.btnview', function() {
            var id = $(this).attr('id');
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
    });
    function statuschange(id, type){
        $.ajax({
            type: "POST",
            data: {
                recordID: id,
                type: type
            },
            url: 'process/statusorder.php',
            success: function(result) { //alert(result);
                action(result);
                loaddatatable();
            }
        });
    }
    function loaddatatable(){
        $('#dataTable').DataTable( {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "scripts/yourorderlist.php",
                type: "POST", // you can use GET
                data: function(d) {
                    d.cusID = '<?php echo $_SESSION['userid']; ?>';
                }
            },
            "order": [[ 0, "desc" ]],
            "columns": [
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
                    "targets": -1,
                    "data": null,
                    "render": function(data, type, full) {
                        return full['firstname']+' '+full['lastname'];
                    }
                },
                {
                    "data": "orderdate"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        return 'Rs '+parseFloat(full['nettotal']).toFixed(2);
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
                        if(full['deliverystatus']==0){button+='<button class="btn btn-outline-danger btn-sm btncancel" id="'+full['idtbl_order']+'"><i class="fas fa-window-close"></i></button>';}
                        return button;
                    }
                }
            ]
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
</script>
<?php include "include/footer.php"; ?>
