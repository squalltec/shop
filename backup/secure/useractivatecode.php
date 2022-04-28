<?php 
include "include/header.php";  

$sql="SELECT `tbl_user`.`name`, `tbl_user`.`username`, `tbl_user_codes`.`code`, `tbl_user_codes`.`tbl_user_idtbl_user` FROM `tbl_user_codes` LEFT JOIN `tbl_user` ON `tbl_user`.`idtbl_user`=`tbl_user_codes`.`tbl_user_idtbl_user` WHERE `tbl_user_codes`.`status`=1";
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
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            <span>User Activate Code</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Url</th>
                                            <th>Email Address</th>
                                            <th>Activate code</th>
                                        </tr>
                                    </thead>
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
<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable( {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "scripts/usercodelist.php",
                type: "POST", // you can use GET
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": "idtbl_user_codes"
                },
                {
                    "data": "name"
                },
                {
                    "targets": -1,
                    "className": '',
                    "data": null,
                    "render": function(data, type, full) {
                        return 'https://herbline.lk/Loginregister/Signupapprove/'+full['tbl_user_idtbl_user'];
                    }
                },
                {
                    "data": "username"
                },
                {
                    "data": "code"
                }
            ]
        } );
    });

</script>
<?php include "include/footer.php"; ?>
