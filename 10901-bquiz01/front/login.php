<?php
//因為查題的登入功能比較簡單，所以直接在本頁面處理
//也可以另外做一支API來專門處理登入功能
if(!empty($_POST['acc']) && !empty($_POST['pw'])){
    $admin=new DB("admin");
    $acc=$_POST['acc'];
    $pw=$_POST['pw'];
    $chk=$admin->count(['acc'=>$acc,'pw'=>$pw]);
    if($chk>0){
        to("admin.php");
        $_SESSION['login']=$acc;
    }else{
        echo "<script>alert('帳號或密碼錯誤')</script>";
    }
}
?>
<div class="di"
    style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
    <?php include "maquree.php";?>
    <div style="height:32px; display:block;"></div>
    <!--正中央-->
    <form method="post" action="?do=login">
        <p class="t botli">管理員登入區</p>
        <p class="cent">帳號 ： <input name="acc" autofocus="" type="text"></p>
        <p class="cent">密碼 ： <input name="pw" type="password"></p>
        <p class="cent"><input value="送出" type="submit"><input type="reset" value="清除"></p>
    </form>
</div>
            