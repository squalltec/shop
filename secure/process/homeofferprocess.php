<?php
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');//die('bc');
$userID=$_SESSION['userid'];
$company=$_SESSION['company'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$offertype = $_POST['offertype'];
$category = $_POST['category'];
$titleone = addslashes($_POST['titleone']);
$titletwo = addslashes($_POST['titletwo']);
$titlethree = addslashes($_POST['titlethree']);
$titlefour = addslashes($_POST['titlefour']);
$updatedatetime=date('Y-m-d h:i:s');

$imagepath='';
// print_r($_FILES["slideimages"]);

if(!empty($_FILES["offerimages"]["name"])){
    $error=array();
    $extension=array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF"); 
    $target_path = "../../images/uploads/offerimage/";

    $imageRandNum=rand(0,100000000);

    $file_name=$_FILES["offerimages"]["name"];
    $file_tmp=$_FILES["offerimages"]["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    if(in_array($ext,$extension)){
        if(!file_exists("../../images/uploads/offerimage/".$file_name)){
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.".".$ext;
            move_uploaded_file($file_tmp=$_FILES["offerimages"]["tmp_name"],"../../images/uploads/offerimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        else{
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["offerimages"]["tmp_name"],"../../images/uploads/offerimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        $imagepath=substr($image_path,6);
    }
    else{
        array_push($error,"$file_name, ");
    }
}

if($recordOption==1){
    $insert="INSERT INTO `tbl_offer_image`(`offertype`, `imagepath`, `titleone`, `titletwo`, `titlethree`, `titlefour`, `status`, `insertuser`, `insertdatetime`, `tbl_product_category_idtbl_product_category`) VALUES ('$offertype','$imagepath','$titleone','$titletwo','$titlethree','$titlefour','1','$userID','$updatedatetime','$category')";
    if($conn->query($insert)==true){        
        header("Location:../homeoffer.php?action=4");
    }
    else{header("Location:../homeoffer.php?action=5");}
}
else{
    if(!empty($imagepath)){
        $update="UPDATE `tbl_offer_image` SET `offertype`='$offertype',`imagepath`='$imagepath',`titleone`='$titleone',`titletwo`='$titletwo',`titlethree`='$titlethree',`titlefour`='$titlefour',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_product_category_idtbl_product_category`='$category' WHERE `idtbl_offer_image`='$recordID'";
    }
    else{
        $update="UPDATE `tbl_offer_image` SET `offertype`='$offertype',`titleone`='$titleone',`titletwo`='$titletwo',`titlethree`='$titlethree',`titlefour`='$titlefour',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_product_category_idtbl_product_category`='$category' WHERE `idtbl_offer_image`='$recordID'";
    }
    if($conn->query($update)==true){     
        header("Location:../homeoffer.php?action=6");
    }
    else{header("Location:../homeoffer.php?action=5");}
}