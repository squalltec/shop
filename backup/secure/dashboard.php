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
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                                    <span>Dashboard</span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body">
                        <?php if($_SESSION['type']!=4){ ?>
                        <div class="row row-cols-1 row-cols-md-4">
                            <div class="col mb-3">
                                <div class="card shadow-none border-dark card-icon p-0">
                                    <div class="row no-gutters h-100">
                                        <div class="col-auto card-icon-aside-new text-dark">
                                            <i class="flaticon-017-note"></i>
                                        </div>
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <h1 class=" text-dark my-1"><?php echo $roworder['count']; ?></h1>
                                                <h6 class="card-title m-0 small">Orders</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters h-100">
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: <?php echo $roworder['count']; ?>%;" aria-valuenow="<?php echo $roworder['count']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="card shadow-none border-primary card-icon p-0">
                                    <div class="row no-gutters h-100">
                                        <div class="col-auto card-icon-aside-new text-primary">
                                            <i class="flaticon-038-cargo"></i>
                                        </div>
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <h1 class=" text-primary my-1"><?php echo $rowongoing['count']; ?></h1>
                                                <h6 class="card-title m-0 small">Ongoing</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters h-100">
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $rowongoing['count']; ?>%;" aria-valuenow="<?php echo $rowongoing['count']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="card shadow-none border-success card-icon p-0">
                                    <div class="row no-gutters h-100">
                                        <div class="col-auto card-icon-aside-new text-success">
                                            <i class="flaticon-054-delivery"></i>
                                        </div>
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <h1 class=" text-success my-1"><?php echo $rowdelivered['count']; ?></h1>
                                                <h6 class="card-title m-0 small">Delivered</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters h-100">
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $rowdelivered['count']; ?>%;" aria-valuenow="<?php echo $rowdelivered['count']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="card shadow-none border-orange card-icon p-0">
                                    <div class="row no-gutters h-100">
                                        <div class="col-auto card-icon-aside-new text-orange">
                                            <i class="flaticon-041-customer-service"></i>
                                        </div>
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <h1 class=" text-orange my-1"><?php echo $rownewcus['count']; ?></h1>
                                                <h6 class="card-title m-0 small">New Customers</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row no-gutters h-100">
                                        <div class="col">
                                            <div class="card-body p-0 p-2 text-right">
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-orange" role="progressbar" style="width: <?php echo $rownewcus['count']; ?>%;" aria-valuenow="<?php echo $rownewcus['count']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h6 class="small title-style"><span>This month orders</span></h6>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order No</th>
                                            <th>Customer</th>
                                            <th>Order Date</th>
                                            <th class="text-right">Total</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
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
            <div class="modal-footer">
                <button class="btn btn-outline-danger btn-sm fa-pull-right" id="btnreceiptprint"><i class="fas fa-print"></i>&nbsp;Print Receipt</button>
            </div>
        </div>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function(){
        $('#dataTable').DataTable( {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "scripts/thismonthorderlist.php",
                type: "POST", // you can use GET
                data: function(d) {
                    d.monthID = '<?php echo $thismonth; ?>',
                    d.userID = '<?php echo $_SESSION['userid']; ?>'
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
                        return button;
                    }
                }
            ]
        } );
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

        document.getElementById('btnreceiptprint').addEventListener ("click", print);
    });

    function print() {
        printJS({
            printable: 'modalviewbody',
            type: 'html',
            style: '@page { size: A4 portrait; margin:0.25cm; }',
            targetStyles: ['*']
        })
    }
</script>
<?php include "include/footer.php"; ?>
