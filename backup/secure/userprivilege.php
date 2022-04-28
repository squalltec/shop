<?php 
include "include/header.php";  

if($_SESSION['type']==1){
    $sqluserlist="SELECT `idtbl_user`, `name` FROM `tbl_user` WHERE `status`=1 ORDER BY `name` ASC";
    $resultuserlist =$conn-> query($sqluserlist);
}
else{
    $sqluserlist="SELECT `idtbl_user`, `name` FROM `tbl_user` WHERE `status`=1 AND `idtbl_user`!=1 ORDER BY `name` ASC";
    $resultuserlist =$conn-> query($sqluserlist);
}

$sqlmenulist="SELECT `idtbl_menulist`, `menu` FROM `tbl_menulist` WHERE `status`=1";
$resultmenulist =$conn-> query($sqlmenulist);

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
                            <div class="page-header-icon"><i data-feather="user-check"></i></div>
                            <span>User Privilege</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-3">
                                <form action="process/userprivilegeprocess.php" method="post" autocomplete="off">
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">User*</label>
                                        <select type="text" class="form-control form-control-sm" name="userlist" id="userlist" required>
                                            <option value="">Select</option>
                                            <?php if($resultuserlist->num_rows > 0) {while ($rowuserlist = $resultuserlist-> fetch_assoc()) { ?>
                                            <option value="<?php echo $rowuserlist['idtbl_user'] ?>"><?php echo $rowuserlist['name'] ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="small font-weight-bold text-dark">Access Menu*</label>
                                        <select type="text" class="form-control form-control-sm" name="menulist[]" id="menulist" required multiple>
                                            <?php if($resultmenulist->num_rows > 0) {while ($rowmenulist = $resultmenulist-> fetch_assoc()) { ?>
                                            <option value="<?php echo $rowmenulist['idtbl_menulist'] ?>"><?php echo $rowmenulist['menu'] ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="small font-weight-bold text-dark">User Privilege*</label><br>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" value="1" id="addcheck" name="addcheck">
                                            <label class="custom-control-label" for="addcheck">
                                                Add Privilege
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" value="1" id="editcheck" name="editcheck">
                                            <label class="custom-control-label" for="editcheck">
                                                Edit Privilege
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" value="1" id="statuscheck" name="statuscheck">
                                            <label class="custom-control-label" for="statuscheck">
                                                Status Privilege
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" value="1" id="removecheck" name="removecheck">
                                            <label class="custom-control-label" for="removecheck">
                                                Delete Privilege
                                            </label>
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
                                            <th>User</th>
                                            <th>Menu</th>
                                            <th>Add</th>
                                            <th>Edit</th>
                                            <th>Active | Deactive</th>
                                            <th>Delete</th>
                                            <th class="text-right">Actions</th>
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
        var addcheck='<?php echo $addcheck; ?>';
        var editcheck='<?php echo $editcheck; ?>';
        var statuscheck='<?php echo $statuscheck; ?>';
        var deletecheck='<?php echo $deletecheck; ?>';

        $("#menulist").select2();

        $('#dataTable').DataTable( {
            "destroy": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "scripts/userprivilegelist.php",
                type: "POST", // you can use GET
                data: function(d) {
                    d.usertype = '<?php echo $_SESSION['type']; ?>';
                }
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": "idtbl_user_privilege"
                },
                {
                    "data": "name"
                },
                {
                    "data": "menu"
                },
                {
                    "targets": -1,
                    "className": 'text-center',
                    "data": null,
                    "render": function(data, type, full) {
                        if(full['add']==1){
                            return '<i class="fas fa-check text-success mt-2"></i>';
                        }
                        else{
                            return '<i class="fas fa-times text-danger mt-2"></i>';
                        }
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-center',
                    "data": null,
                    "render": function(data, type, full) {
                        if(full['edit']==1){
                            return '<i class="fas fa-check text-success mt-2"></i>';
                        }
                        else{
                            return '<i class="fas fa-times text-danger mt-2"></i>';
                        }
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-center',
                    "data": null,
                    "render": function(data, type, full) {
                        if(full['statuschange']==1){
                            return '<i class="fas fa-check text-success mt-2"></i>';
                        }
                        else{
                            return '<i class="fas fa-times text-danger mt-2"></i>';
                        }
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-center',
                    "data": null,
                    "render": function(data, type, full) {
                        if(full['remove']==1){
                            return '<i class="fas fa-check text-success mt-2"></i>';
                        }
                        else{
                            return '<i class="fas fa-times text-danger mt-2"></i>';
                        }
                    }
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button='';
                        button+='<button class="btn btn-outline-primary btn-sm btnEdit mr-1 ';if(editcheck==0){button+='d-none';}button+='" id="'+full['idtbl_user_privilege']+'"><i class="fas fa-pen"></i></button>';
                        if(full['status']==1){
                        button+='<a href="process/statususerprivilege.php?record='+full['idtbl_user_privilege']+'&type=2" onclick="return deactive_confirm()" target="_self" class="btn btn-outline-success btn-sm mr-1 ';if(statuscheck==0){button+='d-none';}button+='"><i class="fas fa-check"></i></a>';
                        }else {
                        button+='<a href="process/statususerprivilege.php?record='+full['idtbl_user_privilege']+'&type=1" onclick="return active_confirm()" target="_self" class="btn btn-outline-warning btn-sm mr-1 ';if(statuscheck==0){button+='d-none';}button+='"><i class="fas fa-times"></i></a>';
                        }
                        button+='<a href="process/statususerprivilege.php?record='+full['idtbl_user_privilege']+'&type=3" onclick="return delete_confirm()" target="_self" class="btn btn-outline-danger btn-sm ';if(deletecheck==0){button+='d-none';}button+='"><i class="far fa-trash-alt"></i></a>';
                        
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        } );
        $('#dataTable tbody').on('click', '.btnEdit', function() {
            var r = confirm("Are you sure, You want to Edit this ? ");
            if (r == true) {
                var id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    data: {
                        recordID: id
                    },
                    url: 'getprocess/getuserprivilege.php',
                    success: function(result) { //alert(result);
                        var obj = JSON.parse(result);
                        $('#recordID').val(obj.id);
                        $('#userlist').val(obj.user);

                        var menulist = obj.menu;
                        var menulistoption = [];
                        $.each(menulist, function(i, item) {
                            menulistoption.push(menulist[i].menulistID);
                        });

                        $('#menulist').val(menulistoption);
                        $('#menulist').trigger('change');

                        if(obj.add==1){$('#addcheck').prop('checked', true);}
                        if(obj.edit==1){$('#editcheck').prop('checked', true);}
                        if(obj.statuschange==1){$('#statuscheck').prop('checked', true);}
                        if(obj.remove==1){$('#removecheck').prop('checked', true);}

                        $('#recordOption').val('2');
                        $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
                    }
                });
            }
        });
    });

    function deactive_confirm() {
        return confirm("Are you sure you want to deactive this?");
    }

    function active_confirm() {
        return confirm("Are you sure you want to active this?");
    }

    function delete_confirm() {
        return confirm("Are you sure you want to remove this?");
    }

</script>
<?php include "include/footer.php"; ?>
