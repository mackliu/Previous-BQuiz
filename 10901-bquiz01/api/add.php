<?php
include_once "../base.php";

//利用表單傳過來的資料表名稱當成參數
$table=$_POST['table'];

//建立資料表物件
$db=new DB($table);

//宣告一個陣列來存放資料
$data=[];

//判斷表單傳過來的資料中有沒有檔案上傳的資料
if(!empty($_FILES['img']['tmp_name'])){

    //取得上傳檔案的檔名
    $filename=$_FILES['img']['name'];

    //將檔案搬至指定的目錄下
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$filename);
    
    //將檔名存入陣列中，陣列的key名和資料表的欄位名必須一樣
    $data['img']=$filename;
}

//針對幾個資料表不同的欄位名狀況特別處理，使用switch來區分不同的資料表
//原則上要先檢查表單傳過來的每個欄位是否都有填值或是符合規範的內容，
//但是因為檢定的題目沒有提到表單驗證，因此這裏我們略過驗證，直接寫入資料表，
//在做實務的案子時，要記得對表單傳送過來的資料做檢查
switch($table){
    case "title":
        $data['text']=$_POST['text'];
        $data['sh']=0;
    break;
    case "admin":
        $data["acc"]=$_POST['acc'];
        $data['pw']=$_POST['pw'];
    break;
    case "menu":
        $data["name"]=$_POST['name'];
        $data['href']=$_POST['href'];
        $data['sh']=1;
    break;
    default:
        $data['text']=$_POST['text'];
        $data['sh']=1;
    break;
}

//將陣列的資料寫入到資料表中
$db->save($data);

//導回原本的後台頁面
to("../admin.php?do=$table");
?>