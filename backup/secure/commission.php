<?php 
include "include/header.php";  

// $sqlcustomer="SELECT `idtbl_customer`, `firstname`, `lastname` FROM `tbl_customer` WHERE `status`=1 AND `tbl_user_idtbl_user` IN (SELECT `idtbl_user` FROM `tbl_user` WHERE `status`=1) ORDER BY `firstname` ASC";
// $resultcustomer=$conn->query($sqlcustomer);

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
                            <div class="page-header-icon"><i data-feather="file"></i></div>
                            <span>Commission info</span>
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
                                            <label class="small font-weight-bold text-dark">Commission Month*</label>
                                            <input type="month" class="form-control form-control-sm rounded-0" id="fromdate" name="fromdate" value="" required>
                                        </div>
                                        <!-- <div class="col-2">
                                            <label class="small font-weight-bold text-dark">To Date*</label>
                                            <input type="date" class="form-control form-control-sm rounded-0" id="todate" name="todate" value="" required>
                                        </div> -->
                                        <div class="col-3">
                                            <label class="small font-weight-bold text-dark">Customer</label>
                                            <select class="form-control form-control-sm" name="customer" id="customer">
                                                <option value="">All Customer</option>
                                            </select>
                                        </div>
                                        <div class="col-4 text-right">
                                            <label class="small font-weight-bold text-dark">&nbsp;</label><br>
                                            <button class="btn btn-secondary btn-sm" type="button" id="formSearchBtn"><i data-feather="search"></i>&nbsp;View Commission</button>
                                            <a href="#" class="btn btn-primary btn-sm" type="button" id="formCSV" disabled><i class="fas fa-file-alt"></i>&nbsp;Bank Report</a>
                                            <a href="#" class="btn btn-success btn-sm" type="button" id="formexcel" disabled><i class="fas fa-file-alt"></i>&nbsp;Download</a>
                                            <input type="submit" class="d-none" id="hidesubmitbtn">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php //echo sprintf('%012d', 1234567);  ?>
                                <?php //$number='1225.50'; echo number_format((float)$number, 2, '', '');; ?>
                                <hr class="border-dark">
                                <div class="scrollbar pb-3" id="style-2">
                                    <div id="load_data"></div>
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
<!-- <div class="modal fade" id="modalbankinfo" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title" id="staticBackdropLabel">Account Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="viewbankdetail"></div>
            </div>
        </div>
    </div>
</div> -->
<?php include "include/footerscripts.php"; ?>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="assets/js/table2csv.js"></script>
<script>
    $(document).ready(function() {  
        $('#formexcel').click(function(){
            var fromdate=$('#fromdate').val();
            let options = {
                "filename": fromdate+" - Report.csv"
            }

            $('#dataTable').table2csv('download', options);
        });

        // $("#customer").select2({
        //     // dropdownParent: $('#modalgrnadd'),
        //     // placeholder: 'Select supplier',
        //     ajax: {
        //         url: "getprocess/getcustomerlist.php",
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function (params) {
        //             return {
        //                 searchTerm: params.term // search term
        //             };
        //         },
        //         processResults: function (response) {
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     }
        // });

        $('#formCSV').click(function () {
            var fromdate=$('#fromdate').val();

            var retContent = [];
            var retString = '';
            $('tbody tr').each(function (idx, elem) {
                var elemText = [];
                $(elem).children('td').each(function (childIdx, childElem) {
                    if(9<childIdx && childIdx<29){
                        elemText.push($(childElem).text());
                    }                    
                });
                retContent.push(`${elemText.join('')}`);
            });
            retString = retContent.join('\r\n');
            var file = new Blob([retString], {
                type: 'text/plain'
            });
            var btn = $('#formCSV');
            btn.attr("href", URL.createObjectURL(file));
            btn.prop("download", fromdate+' - Report.txt');
        })

        var limit = 250;
        var start = 0;
        var action = 'inactive';

        $('#formSearchBtn').click(function(){
            if (!$("#searchFrom")[0].checkValidity()) {
                // If the form is invalid, submit it. The form won't actually submit;
                // this will just cause the browser to display the native HTML5 error messages.
                $("#hidesubmitbtn").click();
            } else {
                $('#load_data').html('<div class="card border-0 shadow-none"><div class="card-body text-center"><i class="fas fa-spinner fa-spin fa-4x"></i></div></div>');

                var fromdate = $('#fromdate').val();
                var customer = $('#customer').val();

                $.ajax({
                    type: "POST",
                    data: {
                        fromdate: fromdate
                    },
                    url: 'getprocess/getcommissionlazy.php',
                    success: function(result) { //alert(result);
                        $('#load_data').html(result);
                    }
                }); 
            }
        });

        $('#dataTable tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('bg-danger-soft');
        } );
    });

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
</script>
<?php include "include/footer.php"; ?>
