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
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            <span>Monthly Sale</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                                <form id="searchFrom">
                                    <div class="form-row">
                                        <div class="col-2">
                                            <label class="small font-weight-bold text-dark">Date*</label>
                                            <div class="input-group input-group-sm mb-3">
                                                <input type="text" class="form-control dpd1a rounded-0" id="fromdate" name="fromdate" value="<?php echo date('m-Y') ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text rounded-0" id="inputGroup-sizing-sm"><i data-feather="calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 text-right">
                                            <label class="small font-weight-bold text-dark">&nbsp;</label><br>
                                            <button class="btn btn-secondary btn-sm" type="button" id="formSearchBtn"><i data-feather="search"></i>&nbsp;View Commission</button>
                                            <input type="submit" class="d-none" id="hidesubmitbtn">
                                        </div>
                                        <div class="col">&nbsp;</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="divreportview"></div>
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
        $('.dpd1a').datepicker('remove');
        $('.dpd1a').datepicker({
            uiLibrary: 'bootstrap4',
            autoclose: 'true',
            todayHighlight: true,
            format: 'mm-yyyy',
            viewMode: "months", 
            minViewMode: "months"
        });
        $('#formSearchBtn').click(function(){
            if (!$("#searchFrom")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hidesubmitbtn").click();
            } else {
                var fromdate = $('#fromdate').val();

                $('#divreportview').html('<div class="card border-0 shadow-none"><div class="card-body text-center"><i class="fas fa-spinner fa-spin fa-4x"></i></div></div>');

                $.ajax({
                    type: "POST",
                    data: {
                        fromdate: fromdate
                    },
                    url: 'getprocess/getmonthlysale.php',
                    success: function(result) { //alert(result);
                        $('#divreportview').html(result);
                        // commissionoption();
                    }
                });  
            }
        });
    });
</script>
<?php include "include/footer.php"; ?>
