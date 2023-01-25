<?php
include_once "../base.php";

$db=new DB($_POST['table']);

if(isset($_FILES['img']['tmp_name'])){

    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $data['img']=$_FILES['img']['name'];

}

    switch($_POST['table']){
        case "admin":
            $data['acc']=$_POST['acc'];
            $data['pw']=$_POST['pw'];
        break;
        case "menu":
            $data['text']=$_POST['text'];
            $data['href']=$_POST['href'];
        break;
        default:
            $data['text']=$_POST['text'];
    }

$db->save($data);

to("../backend.php?do=".$_POST['table']);

?>