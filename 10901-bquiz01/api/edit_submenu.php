<?php

include_once "../base.php";

$db=new DB("menu"); //$_GET['table']

//在編輯次選單的功能中，我們在表單中利用欄位名稱將資料區分成要編輯更新及新增的兩組資料
//因此需要分兩組判斷來進行相應的資料處理


//先判斷有帶id值的資料，表示是要進行更新的資料
if(!empty($_POST['id'])){
    foreach($_POST['id'] as $key=>$id){
        if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
            $db->del($id);
        }else{
            $row=$db->find($id);
            $row['name']=$_POST['name'][$key];
            $row['href']=$_POST['href'][$key];
            $db->save($row);
        }
    }
}

//取得主選單的id值
$parent=$_POST['parent'];

//判斷新增用的欄位是否有值，有值才做新增，沒值則略過，
//避免產生沒有內容的空白選單
if(!empty($_POST['name2'])){
    foreach($_POST['name2'] as $key => $name){
        $new=[];
        $new['name']=$name;
        $new['href']=$_POST['href2'][$key];
        $new['sh']=1;
        $new['parent']=$parent;
        $db->save($new);
    }
}

to("../admin.php?do=menu");
?>