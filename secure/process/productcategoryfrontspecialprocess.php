<?php 
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');
$userID=$_SESSION['userid'];

$recodeID=$_POST['recodeidhide'];
$titleone=addslashes($_POST['titleone']);
$titletwo=addslashes($_POST['titletwo']);
$titlethree=addslashes($_POST['titlethree']);

$updatedatetime=date('Y-m-d h:i:s');

$imagepath="";

if(!empty($_FILES["categoryfront"]["name"])){
    $error=array();
    $extension=array("jpeg","jpg","png","gif","JPEG","JPG","PNG","GIF"); 
    $target_path = "../../images/uploads/categoryfrontimage/";

    $imageRandNum=rand(0,100000000);

    $file_name=$_FILES["categoryfront"]["name"];
    $file_tmp=$_FILES["categoryfront"]["tmp_name"];
    $ext=pathinfo($file_name,PATHINFO_EXTENSION);

    if(in_array($ext,$extension)){
        if(!file_exists("../../images/uploads/categoryfrontimage/".$file_name)){
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.".".$ext;
            move_uploaded_file($file_tmp=$_FILES["categoryfront"]["tmp_name"],"../../images/uploads/categoryfrontimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        else{
            $filename=basename($file_name,$ext);
            $newFileName=md5($filename).date('Y-m-d').date('h-i-sa').$imageRandNum.time().".".$ext;
            move_uploaded_file($file_tmp=$_FILES["categoryfront"]["tmp_name"],"../../images/uploads/categoryfrontimage/".$newFileName);
            $image_path=$target_path.$newFileName;
        }
        $imagepath=substr($image_path,6);
    }
    else{
        array_push($error,"$file_name, ");
    }
}

if(!empty($imagepath)){
    $update="UPDATE `tbl_product_category` SET `frontstatus`='1',`frontimage`='$imagepath',`titleone`='$titleone',`titletwo`='$titletwo',`titlethree`='$titlethree',`updateuser`='$userID',`updatedatetime`='$updatedatetime' WHERE `idtbl_product_category`='$recodeID'";
    if($conn->query($update)==true){        
        $actionObj=new stdClass();
        $actionObj->icon='fas fa-check-circle';
        $actionObj->title='';
        $actionObj->message='Offer Add Successfully';
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
    $actionObj=new stdClass();
    $actionObj->icon='fas fa-exclamation-triangle';
    $actionObj->title='';
    $actionObj->message='Record Error';
    $actionObj->url='';
    $actionObj->target='_blank';
    $actionObj->type='danger';

    echo $actionJSON=json_encode($actionObj);
}
