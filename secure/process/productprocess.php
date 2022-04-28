<?php
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');//die('bc');
$userID=$_SESSION['userid'];
$company=$_SESSION['company'];

$recordOption=$_POST['recordOption'];
if(!empty($_POST['recordID'])){$recordID=$_POST['recordID'];}
$product_name = $_POST['productName'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
$barcode = $_POST['barcode'];
$cuscode = $_POST['cuscode'];
$weight = $_POST['weight'];
$stockqty = $_POST['stockqty'];
$saleprice = $_POST['saleprice'];
if(!empty($_POST['colour'])){$colour = $_POST['colour'];}else{$colour='';}
if(!empty($_POST['flavour'])){$flavour = $_POST['flavour'];}else{$flavour='';}
$brand = $_POST['brand'];
$productvideo = $_POST['productvideo'];
$displayprice = $_POST['displayprice'];
$disfrom = $_POST['disfrom'];
$disto = $_POST['disto'];
$shortdesc = addslashes($_POST['shortdesc']);
$maindesc = addslashes($_POST['maindesc']);
// $specification = addslashes($_POST['specification']);
$updatedatetime=date('Y-m-d h:i:s');

// print_r($flavour);

if($recordOption==1){
    $query = "INSERT INTO `tbl_product`(`productname`, `shortdesc`, `desc`, `barcode`, `weight`, `stock`, `customcode`, `price`, `videolink`, `brand`, `discountstatus`, `discount`, `featuredstatus`, `disprice`, `disfrom`, `disto`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`, `tbl_product_category_idtbl_product_category`, `tbl_product_sub_category_idtbl_product_sub_category`, `tbl_company_idtbl_company`) VALUES ('$product_name','$shortdesc','$maindesc','$barcode','$weight','$stockqty','$cuscode','$saleprice','$productvideo','$brand','0','0','0','$displayprice','$disfrom','$disto','1','$userID','$updatedatetime','','','$category','$subcategory','$company')";
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
                    
                    $sqlImage="INSERT INTO `tbl_product_images`(`imagepath`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`, `tbl_product_idtbl_product`) VALUES ('$image_path2','1','$userID','$updatedatetime','','','$productID')";
                    $conn->query($sqlImage);
                }
                else{
                    array_push($error,"$file_name, ");
                }
            }
        }

        if(!empty($colour)){
            foreach($colour as $rowcolour){
                $insertcolour="INSERT INTO `tbl_product_has_tbl_product_colour`(`tbl_product_idtbl_product`, `tbl_product_colour_idtbl_product_colour`) VALUES ('$productID','$rowcolour')";
                $conn->query($insertcolour);
            }
        }

        if(!empty($flavour)){
            foreach($flavour as $rowflavour){
                $insertflavour="INSERT INTO `tbl_product_has_tbl_product_flavour`(`tbl_product_idtbl_product`, `tbl_product_flavour_idtbl_product_flavour`) VALUES ('$productID','$rowflavour')";
                $conn->query($insertflavour);
            }
        }

        $actionObj=new stdClass();
        $actionObj->icon='fas fa-save';
        $actionObj->title='';
        $actionObj->message='Record Added Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='success';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
else{
    $query = "UPDATE `tbl_product` SET `productname`='$product_name',`shortdesc`='$shortdesc',`desc`='$maindesc',`barcode`='$barcode',`weight`='$weight',`stock`='$stockqty',`customcode`='$cuscode',`videolink`='$productvideo',`brand`='$brand',`price`='$saleprice',`disprice`='$displayprice',`disfrom`='$disfrom',`disto`='$disto',`updateuser`='$userID',`updatedatetime`='$updatedatetime',`tbl_product_category_idtbl_product_category`='$category',`tbl_product_sub_category_idtbl_product_sub_category`='$subcategory' WHERE `idtbl_product`='$recordID'";
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
                    
                    $sqlImage="INSERT INTO `tbl_product_images`(`imagepath`, `status`, `insertuser`, `insertdatetime`, `updateuser`, `updatedatetime`, `tbl_product_idtbl_product`) VALUES ('$image_path2','1','$userID','$updatedatetime','','','$recordID')";
                    $conn->query($sqlImage);
                }
                else{
                    array_push($error,"$file_name, ");
                }
            }
        }

        $deletecolour="DELETE FROM `tbl_product_has_tbl_product_colour` WHERE `tbl_product_idtbl_product`='$recordID'";
        $conn->query($deletecolour);

        $deleteflavour="DELETE FROM `tbl_product_has_tbl_product_flavour` WHERE `tbl_product_idtbl_product`='$recordID'";
        $conn->query($deleteflavour);

        if(!empty($colour)){
            foreach($colour as $rowcolour){
                $insertcolour="INSERT INTO `tbl_product_has_tbl_product_colour`(`tbl_product_idtbl_product`, `tbl_product_colour_idtbl_product_colour`) VALUES ('$recordID','$rowcolour')";
                $conn->query($insertcolour);
            }
        }

        if(!empty($flavour)){
            foreach($flavour as $rowflavour){
                $insertflavour="INSERT INTO `tbl_product_has_tbl_product_flavour`(`tbl_product_idtbl_product`, `tbl_product_flavour_idtbl_product_flavour`) VALUES ('$recordID','$rowflavour')";
                $conn->query($insertflavour);
            }
        }

        $actionObj=new stdClass();
        $actionObj->icon='fas fa-save';
        $actionObj->title='';
        $actionObj->message='Record Update Successfully';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='primary';

        echo $actionJSON=json_encode($actionObj);
    }
    else{
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-exclamation-triangle';
        $actionObj->title='';
        $actionObj->message='Record Error';
        $actionObj->url='';
        $actionObj->target='_blank';
        $actionObj->type='danger';

        echo $actionJSON=json_encode($actionObj);
    }
}
?>