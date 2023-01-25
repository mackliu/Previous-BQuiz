<?php
include_once "../base.php";

$sess=[
1=>"14:00~16:00",
2=>"16:00~18:00",
3=>"18:00~20:00",
4=>"20:00~22:00",
5=>"22:00~24:00",

];

$movie=$Movie->find($_GET['movie']);
$date=$_GET['date'];
$session=$_GET['session'];

$orders=$Orders->all([
    'movie'=>$movie['name'],
    'date'=>$date,
    'session'=>$sess[$session]
]);

$seats=[];

foreach($orders as $order){
    $tmp=unserialize($order['seats']);
    $seats=array_merge($seats,$tmp);
}

?>
<style>
.seat{
    width:63px;
    height:85px;
    text-align:center;
    position:relative;
}
.booked{
    background:url('icon/03D03.png') center no-repeat;
}
.empty{
    background:url('icon/03D02.png') center no-repeat;
}

.chk{
    display:block;
    position:absolute;
    bottom:5px;
    right:5px;
}
.booking-block{
    margin:auto;width:540px;height:370px;background:url('icon/03D04.png') no-repeat;padding-top:20px;
}
.seat-block{
    width:315px;height:340px;margin:auto;display:flex;flex-wrap:wrap;
}
</style>

<div class="booking-block">
    <div class="seat-block">
    <?php
    for($i=0;$i<20;$i++){
        if(in_array($i,$seats)){
            echo "<div class='seat booked'>";
        }else{
            echo "<div class='seat empty'>";
        }
        echo (floor($i/5)+1)."排".($i%5+1)."號";
        if(!in_array($i,$seats)){
            echo "<input type='checkbox' value='$i' class='chk'>";
        }
        echo "</div>";
    }

    ?>
    </div>

</div>



<div style="padding:10px 20%;background:#ccc">
    <div>您選擇的電影是：<?=$movie['name'];?></div>
    <div>您選擇的時刻是：<?=$date;?> <?=$sess[$session];?></div>
    <div>您已經勾選<span id='ticket'></span>張票，最多可以購買四張票</div>
    <div class="ct">
        <button onclick="javascript:$('.order,.booking').toggle()">上一步</button><button onclick="finish()">訂購</button>
    </div>
</div>

<script>
//建立座位陣列
let seats=new Array();

//當checkbox被點選時進行檢查
$(".chk").on("click",function(){
    //取得座位值
    let s=$(this).val()

    //判斷checkbox的狀況來決定要做新增還是刪除座位
    if($(this).prop('checked')){
        seats.push(s);

        //計算目前的票數
        if(seats.length>4){
            alert("最多只能購買四張票")
            seats.splice(seats.indexOf(s),1)
            $(this).prop('checked',false)
        }
        $("#ticket").text(seats.length)

    }else{

        //取消選取座位
        seats.splice(seats.indexOf(s),1)
        $("#ticket").text(seats.length)
    }

    console.log(seats)
})

function finish(){
    let movie=$("#movie").val()
    let date=$("#date").val()
    let session=$("#session").val()

    $.post("api/finish_order.php",{seats,movie,date,session},function(num){
        console.log(num);
        location.href="index.php?do=finish&num="+num;
    })
}
</script>