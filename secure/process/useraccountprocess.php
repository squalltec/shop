<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$name=$_POST['accountname'];
$mobile=$_POST['accountmobile'];
$username=$_POST['username'];
if(!empty($_POST['password'])){$password=$_POST['password'];$password = md5($password);}else{$password='';}
$usertype=$_POST['usertype'];
$company=$_POST['company'];
$updatedatetime=date('Y-m-d h:i:s');

if($recordOption==1){
    $insert="INSERT INTO `tbl_user`(`name`, `username`, `mobile`, `password`, `status`, `insertdatetime`, `updateuser`, `updatedatetime`, `tbl_user_type_idtbl_user_type`) VALUES ('$name','$username','$mobile','$password','1','$updatedatetime','','','$usertype')";
    if($conn->query($insert)==true){    
        $useraccountID=$conn->insert_id;
        
        foreach($company as $companylist){
            $insertcompany="INSERT INTO `tbl_user_has_tbl_company`(`tbl_user_idtbl_user`, `tbl_company_idtbl_company`) VALUES ('$useraccountID','$companylist')";
            $conn->query($insertcompany);
        }
        
        header("Location:../useraccount.php?action=4");
    }
    else{header("Location:../useraccount.php?action=5");}
}
else{
    if($password!=''){
        $update="UPDATE `tbl_user` SET `name`='$name',`username`='$username',`mobile`='$mobile',`password`='$password',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_user_type_idtbl_user_type`='$usertype' WHERE `idtbl_user`='$recordID'";
    }
    else{
        $update="UPDATE `tbl_user` SET `name`='$name',`mobile`='$mobile',`username`='$username',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_user_type_idtbl_user_type`='$usertype' WHERE `idtbl_user`='$recordID'";
    }
    if($conn->query($update)==true){  
        $deletecompany="DELETE FROM `tbl_user_has_tbl_company` WHERE `tbl_user_idtbl_user`='$recordID'";
        $conn->query($deletecompany);
        
        foreach($company as $companylist){
            $insertcompany="INSERT INTO `tbl_user_has_tbl_company`(`tbl_user_idtbl_user`, `tbl_company_idtbl_company`) VALUES ('$recordID','$companylist')";
            $conn->query($insertcompany);
        }

        header("Location:../useraccount.php?action=6");
    }
    else{header("Location:../useraccount.php?action=5");}
}
?>