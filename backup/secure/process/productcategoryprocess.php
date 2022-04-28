<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$productcategory=addslashes($_POST['productcategory']);
$updatedatetime=date('Y-m-d h:i:s');

$imagepath="";

if(!empty($_FILES["categoryimages"]["name"])){
    $error=array();
    $extension=array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF"); 
    $target_path = "../../images/uploads/categoryimage/";

    $imageRandNum=rand(0,100000000);

    $file_name=$_FILES["categoryimages"]["name"];
    $file_tmp=$_FILES["categoryimages"]["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    if(in_array($ext,$extension)){
        if(!file_exists("../../images/uploads/categoryimage/".$file_name)){
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.".".$ext;
            move_uploaded_file($file_tmp=$_FILES["categoryimages"]["tmp_name"],"../../images/uploads/categoryimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        else{
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["categoryimages"]["tmp_name"],"../../images/uploads/categoryimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        $imagepath=substr($image_path,6);
    }
    else{
        array_push($error,"$file_name, ");
    }
}

if($recordOption==1){
    $insert="INSERT INTO `tbl_product_category`(`category`, `imagepath`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`) VALUES ('$productcategory','$imagepath','1','$userID','$updatedatetime','','')";
    if($conn->query($insert)==true){        
        header("Location:../productcategory.php?action=4");
    }
    else{header("Location:../productcategory.php?action=5");}
}
else{
    if(!empty($imagepath)){
        $update="UPDATE `tbl_product_category` SET `category`='$productcategory',`imagepath`='$imagepath',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_category`='$recordID'";
    }
    else{
        $update="UPDATE `tbl_product_category` SET `category`='$productcategory',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_category`='$recordID'";
    }
    if($conn->query($update)==true){     
        header("Location:../productcategory.php?action=6");
    }
    else{header("Location:../productcategory.php?action=5");}
}
?>