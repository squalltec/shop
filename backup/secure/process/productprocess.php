<?php
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');//die('bc');
$userID=$_SESSION['userid'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$product_name = $_POST['productName'];
$shortdesc = addslashes($_POST['shortdesc']);
$maindesc = addslashes($_POST['maindesc']);
$specification = addslashes($_POST['specification']);
$saleprice = $_POST['saleprice'];
$category = $_POST['category'];
$updatedatetime=date('Y-m-d h:i:s');

$listimagepath="";

if(!empty($_FILES["productlistimages"]["name"])){
    $error=array();
    $extension=array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF"); 
    $target_path = "../../images/uploads/productlist/";

    $imageRandNum=rand(0,100000000);

    $file_name=$_FILES["productlistimages"]["name"];
    $file_tmp=$_FILES["productlistimages"]["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    if(in_array($ext,$extension)){
        if(!file_exists("../../images/uploads/productlist/".$file_name)){
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.".".$ext;
            move_uploaded_file($file_tmp=$_FILES["productlistimages"]["tmp_name"],"../../images/uploads/productlist/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        else{
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["productlistimages"]["tmp_name"],"../../images/uploads/productlist/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        $listimagepath=substr($image_path,6);
    }
    else{
        array_push($error,"$file_name, ");
    }
}

if($recordOption==1){
    $query = "INSERT INTO `tbl_product`(`productname`, `shortdesc`, `desc`, `specification`, `avgrate`, `price`, `listimagepath`, `disstatus`, `newstatus`, `weekstatus`, `topstatus`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_product_category_idtbl_product_category`) VALUES ('$product_name','$shortdesc','$maindesc','$specification','0','$saleprice','$listimagepath','0','0','0','0','1','$updatedatetime','$userID','$category')";
    if($conn->query($query)==true){
        $productID=$conn->insert_id;

        if($_FILES["productimages"]['size'][0]!=0){
            $error=array();
            $extension=array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF"); 
            $target_path = "../../images/uploads/product/";

            foreach($_FILES["productimages"]["tmp_name"] as $key=>$tmp_name){
                $imageRandNum=rand(0,100000000);

                $file_name=$_FILES["productimages"]["name"][$key];
                $file_tmp=$_FILES["productimages"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                if(in_array($ext,$extension)){
                    if(!file_exists("../../images/uploads/product/".$file_name)){
                        $filename=basename($file_name,$ext);
                        $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.".".$ext;
                        move_uploaded_file($file_tmp=$_FILES["productimages"]["tmp_name"][$key],"../../images/uploads/product/".$newFileName);
                        $image_path=$target_path.$newFileName;
                    }
                    else{
                        $filename=basename($file_name,$ext);
                        $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.time().".".$ext;
                        move_uploaded_file($file_tmp=$_FILES["productimages"]["tmp_name"][$key],"../../images/uploads/product/".$newFileName);
                        $image_path=$target_path.$newFileName;
                    }
                    $image_path2=substr($image_path,6);
                    
                    $sqlImage="INSERT INTO `tbl_product_image`(`imagepath`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_product_idtbl_product`) VALUES ('$image_path2','1','$updatedatetime','$userID','$productID')";
                    $conn->query($sqlImage);
                }
                else{
                    array_push($error,"$file_name, ");
                }
            }
        }

        header("Location:../product.php?action=4");
    }
    else{header("Location:../product.php?action=5");}
}
else{
    if($listimagepath!=''){//product list image update
        $query = "UPDATE `tbl_product` SET `productname`='$product_name',`shortdesc`='$shortdesc',`desc`='$maindesc',`specification`='$specification',`price`='$saleprice',`listimagepath`='$listimagepath',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID',`tbl_product_category_idtbl_product_category`='$category' WHERE `idtbl_product`='$recordID'";
    }
    else{
        $query = "UPDATE `tbl_product` SET `productname`='$product_name',`shortdesc`='$shortdesc',`desc`='$maindesc',`specification`='$specification',`price`='$saleprice',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID',`tbl_product_category_idtbl_product_category`='$category' WHERE `idtbl_product`='$recordID'";
    }
    if($conn->query($query)==true){
        if($_FILES["productimages"]['size'][0]!=0){
            $error=array();
            $extension=array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF"); 
            $target_path = "../../images/uploads/product/";

            foreach($_FILES["productimages"]["tmp_name"] as $key=>$tmp_name){
                $imageRandNum=rand(0,100000000);

                $file_name=$_FILES["productimages"]["name"][$key];
                $file_tmp=$_FILES["productimages"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                if(in_array($ext,$extension)){
                    if(!file_exists("../../images/uploads/product/".$file_name)){
                        $filename=basename($file_name,$ext);
                        $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.".".$ext;
                        move_uploaded_file($file_tmp=$_FILES["productimages"]["tmp_name"][$key],"../../images/uploads/product/".$newFileName);
                        $image_path=$target_path.$newFileName;
                    }
                    else{
                        $filename=basename($file_name,$ext);
                        $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.time().".".$ext;
                        move_uploaded_file($file_tmp=$_FILES["productimages"]["tmp_name"][$key],"../../images/uploads/product/".$newFileName);
                        $image_path=$target_path.$newFileName;
                    }
                    $image_path2=substr($image_path,6);
                    
                    $sqlImage="INSERT INTO `tbl_product_image`(`imagepath`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_product_idtbl_product`) VALUES ('$image_path2','1','$updatedatetime','$userID','$recordID')";
                    $conn->query($sqlImage);
                }
                else{
                    array_push($error,"$file_name, ");
                }
            }
        }

        header("Location:../product.php?action=6");
    }
    else{
        header("Location:../product.php?action=5");
    }
}
?>