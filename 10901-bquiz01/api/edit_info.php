<?php 
//請參考add.php的註解，自行讀懂下列程式碼的功能
include_once '../base.php';
$table=$_POST['table'];
 $db=new DB($table);
 $row=$db->find(1);
 
 if(isset($_POST['total'])){
     $row['total']=$_POST['total'];
    }else{
     $row['bottom']=$_POST['bottom'];
 }
$db->save($row);

to("../admin.php?do=$table");

?>