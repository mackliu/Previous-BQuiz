<?php include_once "../base.php";

if($Mem->count($_GET)){
    echo $Mem->count($_GET);
    $_SESSION['login']=$_GET['acc'];
};

/* $acc=$_GET['acc'];
$pw=$_GET['pw'];
echo $Mem->count(['acc'=>$acc,'pw'=>$pw]); */

/* $chk=$Mem->count(['acc'=>$acc]);

if($chk>0){
    echo "1";
} */


?>