<?php
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');//die('bc');
$userID=$_SESSION['userid'];
$company=$_SESSION['company'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$category = $_POST['category'];
$titleone = addslashes($_POST['titleone']);
$titletwo = addslashes($_POST['titletwo']);
$titlethree = addslashes($_POST['titlethree']);
$updatedatetime=date('Y-m-d h:i:s');

$imagepath='';
// print_r($_FILES["slideimages"]);

if(!empty($_FILES["slideimages"]["name"])){
    $error=array();
    $extension=array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF"); 
    $target_path = "../../images/uploads/mainsliderimage/";

    $imageRandNum=rand(0,100000000);

    $file_name=$_FILES["slideimages"]["name"];
    $file_tmp=$_FILES["slideimages"]["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    if(in_array($ext,$extension)){
        if(!file_exists("../../images/uploads/mainsliderimage/".$file_name)){
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.".".$ext;
            move_uploaded_file($file_tmp=$_FILES["slideimages"]["tmp_name"],"../../images/uploads/mainsliderimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        else{
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["slideimages"]["tmp_name"],"../../images/uploads/mainsliderimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        $imagepath=substr($image_path,6);
    }
    else{
        array_push($error,"$file_name, ");
    }
}

if($recordOption==1){
    $insert="INSERT INTO `tbl_slideshow`(`imagepath`, `titleone`, `titletwo`, `titlethree`, `status`, `insertuser`, `insertdatetime`, `tbl_product_category_idtbl_product_category`) VALUES ('$imagepath','$titleone','$titletwo','$titlethree','1','$userID','$updatedatetime','$category')";
    if($conn->query($insert)==true){        
        header("Location:../slideshow.php?action=4");
    }
    else{header("Location:../slideshow.php?action=5");}
}
else{
    if(!empty($imagepath)){
        $update="UPDATE `tbl_slideshow` SET `imagepath`='$imagepath',`titleone`='$titleone',`titletwo`='$titletwo',`titlethree`='$titlethree',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_product_category_idtbl_product_category`='$category' WHERE `idtbl_slideshow`='$recordID'";
    }
    else{
        $update="UPDATE `tbl_slideshow` SET `titleone`='$titleone',`titletwo`='$titletwo',`titlethree`='$titlethree',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_product_category_idtbl_product_category`='$category' WHERE `idtbl_slideshow`='$recordID'";
    }
    if($conn->query($update)==true){     
        header("Location:../slideshow.php?action=6");
    }
    else{header("Location:../slideshow.php?action=5");}
}